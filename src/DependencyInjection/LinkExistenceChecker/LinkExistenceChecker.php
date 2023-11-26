<?php

namespace App\DependencyInjection\LinkExistenceChecker;

use App\DependencyInjection\LinkExistenceChecker\Exception\LinkExistenceException;
use App\Entity\ShortLink;
use App\Repository\ShortLinkRepository\ShortLinkRepositoryImpl;

class LinkExistenceChecker
    implements LinkExistenceCheckerInterface
{
    /**
     * @var string
     */
    protected string $baseUrl;

    /**
     * @var ShortLinkRepositoryImpl
     */
    private ShortLinkRepositoryImpl $shortLinkRepository;

    /**
     * @param ShortLinkRepositoryImpl $shortLinkRepository
     * @param string $baseUrl
     */
    public function __construct(
        ShortLinkRepositoryImpl $shortLinkRepository,
        string $baseUrl
    )
    {
        $this->shortLinkRepository = $shortLinkRepository;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @param string $path
     * @return ShortLink
     * @throws LinkExistenceException
     */
    public function linkExists(String $path): ShortLink
    {
        $url = $this->baseUrl . $path;
        $linkExists = $this->shortLinkRepository->findOneBy(['shortUrl' => $url]);

        if ($linkExists) {
            return $linkExists;
        } else {
            throw new LinkExistenceException('Link does not exist for path: ' . $path);
        }
    }
}