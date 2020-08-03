<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use App\Entity\AdStats;

class AdStatsTest extends TestCase
{
    public function testCreateNewStats()
    {
        $stats = new AdStats();

        $this->assertNotNull($stats);
    }

    public function testStatsSetUrl()
    {
        $url = 'mastercuriosidadesbr.com';
        $stats = new AdStats();
        $stats->setUrl($url);

        $this->assertEquals($stats->getUrl(), $url);
    }

    public function testStatsSetTags()
    {
        $tags = 'optad360.test_am_S2';
        $stats = new AdStats();
        $stats->setTags($tags);

        $this->assertEquals($stats->getTags(), $tags);
    }

    public function testStatsSetDate()
    {
        $date = date_create('2000-01-01');
        $stats = new AdStats();
        $stats->setDate($date);

        $this->assertEquals($stats->getDate(), $date);
    }

    public function testStatsSetEstimatedRevenue()
    {
        $estimatedRevenue = 43.33;
        $stats = new AdStats();
        $stats->setEstimatedRevenue($estimatedRevenue);

        $this->assertEquals($stats->getEstimatedRevenue(), $estimatedRevenue);
    }

    public function testStatsSetAdImpressions()
    {
        $adImpressions = 43;
        $stats = new AdStats();
        $stats->setAdImpressions($adImpressions);

        $this->assertEquals($stats->getAdImpressions(), $adImpressions);
    }

    public function testStatsSetAdEcpm()
    {
        $adEcpm = 22.11;
        $stats = new AdStats();
        $stats->setAdEcpm($adEcpm);

        $this->assertEquals($stats->getAdEcpm(), $adEcpm);
    }

    public function testStatsSetClicks()
    {
        $clicks = 666;
        $stats = new AdStats();
        $stats->setClicks($clicks);

        $this->assertEquals($stats->getClicks(), $clicks);
    }

    public function testStatsSetAdCtr()
    {
        $adCtr = 0.11;
        $stats = new AdStats();
        $stats->setAdCtr($adCtr);

        $this->assertEquals($stats->getAdCtr(), $adCtr);
    }

    public function testStatsSetAdSettingsId()
    {
        $adSettingsId = 1;
        $stats = new AdStats();
        $stats->setAdSettingsId($adSettingsId);

        $this->assertEquals($stats->getAdSettingsId(), $adSettingsId);
    }

    public function testStatsSetSourceId()
    {
        $sourceId = 2;
        $stats = new AdStats();
        $stats->setAdSettingsId($sourceId);

        $this->assertEquals($stats->getSourceId(), $sourceId);
    }
}

?>