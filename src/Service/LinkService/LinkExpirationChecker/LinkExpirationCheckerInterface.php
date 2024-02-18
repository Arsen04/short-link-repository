<?php

namespace App\Service\LinkService\LinkExpirationChecker;

use App\Entity\ShortLink;

interface LinkExpirationCheckerInterface
{
    /**
     * @param ShortLink $link
     * @return bool
     */
    public function linkExpired(ShortLink $link): bool;
}