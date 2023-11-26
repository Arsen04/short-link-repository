<?php

namespace App\Controller;

use App\DependencyInjection\LinkExistenceChecker\Exception\LinkExistenceException;
use App\DependencyInjection\LinkExistenceChecker\LinkExistenceChecker;
use App\DependencyInjection\LinkExpirationChecker\Exception\LinkExpirationException;
use App\DependencyInjection\LinkExpirationChecker\LinkExpirationChecker;
use App\Repository\ShortLinkRepository\ShortLinkRepositoryImpl;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @param String $path
     * @return RedirectResponse|void
     * @throws LinkExistenceException
     * @throws LinkExpirationException
     */
    #[NoReturn] #[Route(
        path: '/{path}',
        name: 'link_redirect',
        methods: Request::METHOD_GET
    )]
    public function redirectShortLink(
        ShortLinkRepositoryImpl $shortLinkRepository,
        LinkExistenceChecker $existenceChecker,
        LinkExpirationChecker $expirationChecker,
        String $path
    )
    {
        $urlPath = new Response($path);

        $linkExists = $existenceChecker->linkExists($urlPath->getContent());
        $linkExpired = $expirationChecker->linkExpired($linkExists);

        if (!$linkExpired) {
            $linkRedirect = $linkExists->getRedirectCount() + 1;
            $linkExists->setRedirectCount($linkRedirect);
            $shortLinkRepository->save($linkExists);
            $redirectUrl = $linkExists->getBaseUrl();

            return $this->redirect($redirectUrl);
        }
    }
}