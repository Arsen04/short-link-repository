<?php

namespace App\DataFixtures;

use App\Entity\ShortLink;
use App\Enum\LifeTimeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ShortLinkFixtures
    extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $shortLink = new ShortLink();
        $shortLink->setBaseUrl('https://www.google.com/query?=something');
        $shortLink->setShortUrl('https://www.short.link/9b639721');
        $shortLink->setRedirectCount(12);
        $shortLink->setWebsiteHost('www.google.com');
        $shortLink->setLifeTime(LifeTimeEnum::TWENTY->value);
        $shortLink->setCreatedAt();
        $manager->persist($shortLink);

        $manager->flush();
    }
}
