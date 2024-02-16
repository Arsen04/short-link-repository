<?php

namespace App\Service\LinkService\LinkExistenceChecker;

use App\Entity\ShortLink;

interface LinkExistenceCheckerInterface
{

    /**
     * @param String $path
     * @return ShortLink
     */
    public function linkExists(String $path): ShortLink;
}