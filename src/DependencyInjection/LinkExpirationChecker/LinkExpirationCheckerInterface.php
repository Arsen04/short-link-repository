<?php

namespace App\DependencyInjection\LinkExpirationChecker;

use App\Entity\ShortLink;

interface LinkExpirationCheckerInterface
{
    public function linkExpired(ShortLink $link): bool;
}