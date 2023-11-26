<?php

namespace App\Service\HashingService;

interface HashingServiceInterface
{
    /**
     * @param String $url
     * @return String
     */
    public function hashLink(String $url): String;
}