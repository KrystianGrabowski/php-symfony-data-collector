<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use App\Entity\AdStatsSettings;

class SettingsTest extends TestCase
{
    public function testCreateNewSource()
    {
        $settings = new AdStatsSettings();

        $this->assertNotNull($settings);
    }

    public function testSettingsSetCurrency()
    {
        $currency = 'PLN';
        $settings = new AdStatsSettings();
        $settings->setCurrency($currency);

        $this->assertEquals($settings->getCurrency(), $currency);
    }

    public function testSettingsSetPeriodLength()
    {
        $periodLength = 2;
        $settings = new AdStatsSettings();
        $settings->setPeriodLength($periodLength);

        $this->assertEquals($settings->getPeriodLength(), $periodLength);
    }

    public function testSettingsSetGroupBy()
    {
        $groupBy = 2;
        $settings = new AdStatsSettings();
        $settings->setGroupBy($groupBy);

        $this->assertEquals($settings->getGroupBy(), $groupBy);
    }
}

?>