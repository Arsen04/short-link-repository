<?php

namespace Unit\Service\GettingHost;

use PHPUnit\Framework\TestCase;
use App\Service\GettingHost\UrlParser;

class UrlParserTest extends TestCase
{
    public function testGetProtocol()
    {
        $urlParser = new UrlParser('https://www.example.com/path/to/resource');
        $this->assertEquals('https://', $urlParser->getProtocol());

        $urlParser = new UrlParser('http://example.com');
        $this->assertEquals('http://', $urlParser->getProtocol());

        $urlParser = new UrlParser('www.example.com');
        $this->assertEquals('', $urlParser->getProtocol());
    }

    public function testGetHost()
    {
        $urlParser = new UrlParser('https://www.example.com/path/to/resource');
        $this->assertEquals('www.example.com', $urlParser->getHost());

        $urlParser = new UrlParser('http://sub.domain.example.org');
        $this->assertEquals('sub.domain.example.org', $urlParser->getHost());

        $urlParser = new UrlParser('/path/to/resource');
        $this->assertEquals('', $urlParser->getHost());
    }

    public function testGetPath()
    {
        $urlParser = new UrlParser('https://www.example.com/path/to/resource');
        $this->assertEquals('/path/to/resource', $urlParser->getPath());

        $urlParser = new UrlParser('http://example.com');
        $this->assertEquals('', $urlParser->getPath());

        $urlParser = new UrlParser('https://www.example.com');
        $this->assertEquals('', $urlParser->getPath());
    }
}