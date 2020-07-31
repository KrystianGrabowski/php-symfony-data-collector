<?php
namespace App\Service;

use Symfony\Component\HttpClient\NativeHttpClient;

class DataFetcher
{
    public function fetchData($url)
    {
        $client = new NativeHttpClient();
        $response = $client->request(
            'GET',
            $url
        );
        $content = $response->getContent();
        $content = $response->toArray();
        return $content;
    }
}
?>