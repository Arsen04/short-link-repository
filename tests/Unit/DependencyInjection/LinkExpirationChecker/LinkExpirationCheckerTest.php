<?php

namespace Unit\DependencyInjection\LinkExpirationChecker;

use App\DependencyInjection\LinkExpirationChecker\Exception\LinkExpirationException;
use App\DependencyInjection\LinkExpirationChecker\LinkExpirationChecker;
use App\Entity\ShortLink;
use App\Repository\ShortLinkRepository\ShortLinkRepositoryImpl;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class LinkExpirationCheckerTest
    extends TestCase
{
    public function testLinkNotExpired()
    {
        $shortLink = new ShortLink();
        $shortLink->setLifeTime(600);

        $reflection = new ReflectionClass($shortLink);
        $property = $reflection->getProperty('created_at');
        $property->setValue($shortLink, new DateTimeImmutable('-5 minutes'));

        $shortLinkRepository = $this->createMock(ShortLinkRepositoryImpl::class);

        $expirationThreshold = 900;

        $linkChecker = new LinkExpirationChecker($shortLinkRepository, $expirationThreshold);

        $result = $linkChecker->linkExpired($shortLink);

        $this->assertFalse($result, 'The link should not be expired');
    }

    public function testLinkExpired()
    {
        $shortLink = new ShortLink();
        $shortLink->setLifeTime(300);

        $reflection = new ReflectionClass($shortLink);
        $property = $reflection->getProperty('created_at');
        $property->setValue($shortLink, new DateTimeImmutable('-10 minutes'));

        $shortLinkRepository = $this->createMock(ShortLinkRepositoryImpl::class);

        $expirationThreshold = 900;

        $linkChecker = new LinkExpirationChecker($shortLinkRepository, $expirationThreshold);

        $this->expectException(LinkExpirationException::class);
        $this->expectExceptionMessage('Link has expired');

        $linkChecker->linkExpired($shortLink);
    }
}
