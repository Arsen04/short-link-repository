<?php

namespace App\Service\LinkService\LinkExistenceChecker;

use App\Entity\ShortLink;
use App\Repository\ShortLinkRepository\ShortLinkRepositoryImpl;
use App\Service\LinkService\LinkExistenceChecker\Exception\LinkExistenceException;

class LinkExistenceChecker
    implements LinkExistenceCheckerInterface
{
    /**
     * @var ShortLinkRepositoryImpl
     */
    private ShortLinkRepositoryImpl $shortLinkRepository;

    /**
     * @param ShortLinkRepositoryImpl $shortLinkRepository
     */
    public function __construct(
        ShortLinkRepositoryImpl $shortLinkRepository,
    )
    {
        $this->shortLinkRepository = $shortLinkRepository;
    }

    /**
     * @param string $path
     * @return ShortLink
     * @throws LinkExistenceException
     */
    public function linkExists(String $path): ShortLink
    {
        $linkExists = $this->shortLinkRepository->findOneBy(['shortUrl' => $path]);

        if ($linkExists) {
            return $linkExists;
        } else {
            throw new LinkExistenceException('Link does not exist for path: ' . $path);
        }
    }
}