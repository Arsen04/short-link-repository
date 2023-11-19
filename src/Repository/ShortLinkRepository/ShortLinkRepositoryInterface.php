<?php

namespace App\Repository\ShortLinkRepository;

use App\Entity\ShortLink;

interface ShortLinkRepositoryInterface
{
    /**
     * @param ShortLink $shortLink
     * @return void
     */
    public function save(ShortLink $shortLink): void;
}