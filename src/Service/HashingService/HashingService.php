<?php

namespace App\Service\HashingService;

class HashingService
    implements HashingServiceInterface
{
    /**
     * @var String
     */
    protected String $baseUrl;

    /**
     * @param String $baseUrl
     */
    public function __construct(String $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @param String $url
     * @return String
     */
    public function hashLink(String $url): String
    {
        $hashedUrl = hash("sha256", $url);
        $shortId = substr($hashedUrl, 0, 8);

        return $this->baseUrl . $shortId;
    }
}