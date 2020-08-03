<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use App\Service\DataFetcher;
use Symfony\Component\HttpFoundation\JsonResponse;

class DataFetcherTest extends TestCase
{
    public function testDataFetcher()
    {
        $dataFetcher = new DataFetcher();
        $jsonResponse = $dataFetcher->fetch('https://api.optad360.com/testapi');
        $this->assertIsArray($jsonResponse);
    }
}

?>