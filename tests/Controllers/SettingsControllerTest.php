<?php

use App\Controller\SourceContoller;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class SettingsControllerTest extends TestCase
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

    public function testCreateNewSettings()
    {
        $data = array(
            "currency" => "EUR",
            "periodLength" => 1,
            "groupby" => ""
        );
        $response = $this->client->post('/settings', ['json' => $data]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetAllSettings()
    {
        $response = $this->client->get('/settings');

        $this->assertEquals(200, $response->getStatusCode());
    }
}

?>