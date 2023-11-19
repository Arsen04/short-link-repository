<?php

namespace App\Controller;

use App\Entity\ShortLink;
use App\Repository\ShortLinkRepository\ShortLinkRepositoryImpl;
use App\Service\GettingHost\UrlParser;
use App\Service\HashingService\HashingService;
use App\Service\Validator\Exception\ValidationException;
use App\Service\Validator\UrlValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class LinkShortenerController
    extends AbstractController
{
    /**
     * @var HashingService
     */
    protected HashingService $hashingService;

    /**
     * @var UrlValidator
     */
    protected UrlValidator $urlValidator;

    /**
     * @var ShortLinkRepositoryImpl
     */
    protected ShortLinkRepositoryImpl $shortLinkRepository;

    /**
     * @param HashingService $hashingService
     * @param UrlValidator $urlValidator
     * @param ShortLinkRepositoryImpl $shortLinkRepository
     */
    public function __construct
    (
        HashingService $hashingService,
        UrlValidator $urlValidator,
        ShortLinkRepositoryImpl $shortLinkRepository
    )
    {
        $this->hashingService = $hashingService;
        $this->urlValidator = $urlValidator;
        $this->shortLinkRepository = $shortLinkRepository;
    }

    /**
     * @throws ValidationException
     */
    #[Route(
        path: '/link/shortener',
        name: 'link_shortener',
        methods: Request::METHOD_POST
    )]
    public function generateShortLink(
        Request $request,
        HashingService $hashingService,
        UrlValidator $urlValidator,
        ShortLinkRepositoryImpl $shortLinkRepository
    ): JsonResponse
    {
        $decodedRequest = json_decode($request->getContent());

        $url = $decodedRequest->url;

        $urlValidator->validateUrl($url);
        $shortedLink = $hashingService->hashLink($url);

        $urlParser = new UrlParser($url);
        $urlProtocol = $urlParser->getProtocol() . PHP_EOL;
        $urlHost = $urlParser->getHost() . PHP_EOL;
        $urlPath = $urlParser->getPath() . PHP_EOL;

        $shortLink = new ShortLink();
        $shortLink->setBaseUrl($url);
        $shortLink->setShortUrl($shortedLink);
        $shortLink->setWebsiteHost($urlHost);
        $shortLink->setLifeTime(1728000);
        $shortLink->setCreatedAt();

        $shortLinkRepository->save($shortLink);
        $message = 'added';

        return $this->json([
            'link' => $shortLink,
            'status' => 201,
            'message' => $message
        ]);
    }
}
