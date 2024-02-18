<?php

namespace App\Controller;

use App\Repository\ShortLinkRepository\ShortLinkRepositoryImpl;
use App\Service\LinkService\LinkExistenceChecker\Exception\LinkExistenceException;
use App\Service\LinkService\LinkExistenceChecker\LinkExistenceChecker;
use App\Service\LinkService\LinkExpirationChecker\Exception\LinkExpirationException;
use App\Service\LinkService\LinkExpirationChecker\LinkExpirationChecker;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LinkRedirectController
    extends AbstractController
{
    /**
     * @var ShortLinkRepositoryImpl
     */
    protected ShortLinkRepositoryImpl $shortLinkRepository;

    /**
     * @var LinkExistenceChecker
     */
    protected LinkExistenceChecker $existenceChecker;

    /**
     * @var LinkExpirationChecker
     */
    protected LinkExpirationChecker $expirationChecker;

    /**
     * @param ShortLinkRepositoryImpl $shortLinkRepository
     * @param LinkExistenceChecker $existenceChecker
     * @param LinkExpirationChecker $expirationChecker
     */
    public function __construct
    (
        ShortLinkRepositoryImpl $shortLinkRepository,
        LinkExistenceChecker $existenceChecker,
        LinkExpirationChecker $expirationChecker
    )
    {
        $this->shortLinkRepository = $shortLinkRepository;
        $this->existenceChecker = $existenceChecker;
        $this->expirationChecker = $expirationChecker;
    }

    /**
     * @param ShortLinkRepositoryImpl $shortLinkRepository
     * @param LinkExistenceChecker $existenceChecker
     * @param LinkExpirationChecker $expirationChecker
     * @param Request $request
     * @return RedirectResponse|void
     * @throws LinkExistenceException
     * @throws LinkExpirationException
     */
    #[NoReturn] #[Route(
        path: '/redirect/{path}',
        name: 'link_redirect',
        methods: Request::METHOD_GET
    )]
    public function redirectShortLink(
        ShortLinkRepositoryImpl $shortLinkRepository,
        LinkExistenceChecker $existenceChecker,
        LinkExpirationChecker $expirationChecker,
        Request $request
    )
    {
        $urlPath = $request->attributes->get('path');

        $linkExists = $existenceChecker->linkExists($urlPath);
        $linkExpired = $expirationChecker->linkExpired($linkExists);

        if (!$linkExpired) {
            $linkRedirect = $linkExists->getRedirectCount() + 1;
            $linkExists->setRedirectCount($linkRedirect);

            $shortLinkRepository->save($linkExists);

            $baseUrl = getenv('BASE_URL');
            $redirectUrl = $baseUrl . $linkExists->getBaseUrl();

            return $this->redirect($redirectUrl);
        }
    }
}