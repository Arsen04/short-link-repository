<?php

namespace App\Service\HashingService;

class HashingService
    implements HashingServiceInterface
{
    /**
     * @var string
     */
    protected string $baseUrl;

    /**
     * @param string $baseUrl
     */
    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @param string $url
     * @return string
     */
    public function hashLink(string $url): string
    {
        $hashedUrl = hash("sha256", $url);
        $shortId = substr($hashedUrl, 0, 8);

        return $this->baseUrl . $shortId;
    }
}