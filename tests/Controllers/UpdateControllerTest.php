<?php

use App\Controller\SourceContoller;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class UpdateControllerTest extends TestCase
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

    public function testUpdateFetchAll()
    {
        $response = $this->client->get('/update');

        $this->assertEquals(200, $response->getStatusCode());
    }
}

?>