<?php

namespace App\Service\HashingService;

class HashingService
    implements HashingServiceInterface
{
    /**
     * @param String $url
     * @return String
     */
    public function hashLink(String $url): String
    {
        $hashedUrl = hash("sha256", $url);
        $shortId = substr($hashedUrl, 0, 8);

        return $shortId;
    }
}