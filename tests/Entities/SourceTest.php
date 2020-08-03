<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use App\Entity\Source;

class SourceTest extends TestCase
{
    public function testCreateNewSource()
    {
        $source = new Source();

        $this->assertNotNull($source);
    }

    public function testSourceSetUrl()
    {
        $url = 'https://api.optad360.com/testapi';
        $source = new Source();
        $source->setUrl($url);

        $this->assertEquals($source->getUrl(), $url);
    }

    public function testSourceSetInvalidUrl()
    {
        $this->expectErrorMessage('Invalid URL');

        $url = 'testapi';
        $source = new Source();
        $source->setUrl($url);
    }

    public function testSourceDefaultIsActive()
    {
        $source = new Source();

        $this->assertNotFalse($source->getIsActive());
    }

    public function testSourceSetIsActive()
    {
        $source = new Source();
        $source->setIsActive(false);

        $this->assertNotTrue($source->getIsActive());
    }
}

?>