<?php

namespace App\Service\GettingHost;

class UrlParser
    implements UrlParserInterface
{
    /**
     * @var string
     */
    protected string $url;
    /**
     * @var string
     */
    protected string $protocol;
    /**
     * @var string
     */
    protected string $host;
    /**
     * @var string
     */
    protected string $path;

    /**
     * UrlParser constructor.
     * @param string $url
     */
    public function __construct(string $url)
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
     * @return string
     */
    public function getProtocol(): string
    {
        return $this->protocol;
    }

    /**
     * Get path
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * Get path values
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}