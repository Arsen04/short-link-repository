<?php

namespace App\Service\GettingHost;

class UrlParser
    implements UrlParserInterface
{
    /**
     * @var String
     */
    protected String $url;

    /**
     * @var String
     */
    protected String $protocol;

    /**
     * @var String
     */
    protected String $host;

    /**
     * @var String
     */
    protected String $path;

    /**
     * UrlParser constructor.
     * @param String $url
     */
    public function __construct(String $url)
    {
        $this->url = $url;
        $this->parseUrl();
    }

    /**
     * Parsing Url (protocol, host and path)
     */
    protected function parseUrl(): void
    {
        $urlParts = parse_url($this->url);

        if ($urlParts !== false) {
            $this->protocol = isset($urlParts['scheme']) ? $urlParts['scheme'] . '://' : '';
            $this->host = $urlParts['host'] ?? '';
            $this->path = $urlParts['path'] ?? '';
        }
    }

    /**
     * Getting Protocol (http:// or https://).
     * @return String
     */
    public function getProtocol(): String
    {
        return $this->protocol;
    }

    /**
     * Get path
     * @return String
     */
    public function getHost(): String
    {
        return $this->host;
    }

    /**
     * Get path values
     * @return String
     */
    public function getPath(): String
    {
        return $this->path;
    }
}