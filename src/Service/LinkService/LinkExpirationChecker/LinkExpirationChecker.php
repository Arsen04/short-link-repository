<?php

namespace App\Service\LinkService\LinkExpirationChecker;

use App\Entity\ShortLink;
use App\Repository\ShortLinkRepository\ShortLinkRepositoryImpl;
use App\Service\LinkService\LinkExpirationChecker\Exception\LinkExpirationException;
use DateTimeImmutable;

class LinkExpirationChecker
    implements LinkExpirationCheckerInterface
{
    /**
     * @var ShortLinkRepositoryImpl
     */
    protected ShortLinkRepositoryImpl $shortLinkRepository;

    /**
     * @var int
     */
    protected int $expirationThreshold;

    /**
     * @param ShortLinkRepositoryImpl $shortLinkRepository
     * @param int $expirationThreshold
     */
    public function __construct(
        ShortLinkRepositoryImpl $shortLinkRepository,
        int $expirationThreshold
    )
    {
        $this->shortLinkRepository = $shortLinkRepository;
        $this->expirationThreshold = $expirationThreshold;
    }

    /**
     * @param ShortLink $link
     * @return bool
     * @throws LinkExpirationException
     */
    public function linkExpired(ShortLink $link): bool
    {
        $creatingDate = $link->getCreatedAt();
        $currentDate = new DateTimeImmutable();

        $expirationTime = $link->getLifeTime();

        $difference = $currentDate->getTimestamp() - $creatingDate->getTimestamp();

        if ($difference < $expirationTime) {
            return false;
        } else {
            throw new LinkExpirationException('Link has expired');
        }
    }
}
