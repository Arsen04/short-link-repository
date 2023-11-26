<?php

namespace App\Service\GettingHost;

interface UrlParserInterface
{
    /**
     * @return string
     */
    public function getProtocol(): String;

    /**
     * @return String
     */
    public function getHost(): String;

    /**
     * @return String
     */
    public function getPath(): String;
}