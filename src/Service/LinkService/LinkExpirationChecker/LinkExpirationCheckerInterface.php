<?php

namespace App\Service\LinkService\LinkExpirationChecker;

use App\Entity\ShortLink;

interface LinkExpirationCheckerInterface
{
    public function linkExpired(ShortLink $link): bool;
}