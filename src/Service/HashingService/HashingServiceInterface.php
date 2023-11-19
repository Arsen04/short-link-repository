<?php

namespace App\Service\HashingService;

interface HashingServiceInterface
{
    /**
     * @param string $url
     * @return string
     */
    public function hashLink(string $url): string;
}