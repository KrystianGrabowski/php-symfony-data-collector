<?php

use App\Controller\SourceContoller;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class DataControllerTest extends TestCase
{
    protected function setUp(): void
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => 'http://nginx:80',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
    }

    public function testGetAllData()
    {
        $response = $this->client->get('/data');
        $this->assertEquals(200, $response->getStatusCode());
    }
}

?>