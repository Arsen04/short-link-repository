<?php

namespace App\DependencyInjection\LinkExistenceChecker;

use App\Entity\ShortLink;

interface LinkExistenceCheckerInterface
{

    /**
     * @param String $path
     * @return ShortLink
     */
    public function linkExists(String $path): ShortLink;
}