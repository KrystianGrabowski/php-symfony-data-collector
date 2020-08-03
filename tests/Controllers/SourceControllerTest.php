<?php

use App\Controller\SourceContoller;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class SourceControllerTest extends TestCase
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

    public function testCreateNewSource()
    {
        $data = array(
            "url" => "https://api.optad360.com/testapi",
            "is_active" => true
        );
        $response = $this->client->post('/source', ['json' => $data]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetAllSources()
    {
        $response = $this->client->get('/source');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testSourceDoubleInsert()
    {
        $this->expectErrorMessage('Server Error');
        $data = array(
            "url" => "https://api.optad360.com/testapi",
            "is_active" => true
        );
        $this->client->post('/source', ['json' => $data]);
        $this->client->post('/source', ['json' => $data]);
    }
}

?>