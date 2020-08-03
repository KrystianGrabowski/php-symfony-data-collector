<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use App\Service\ResponseHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\AdStatsSettings;
use App\Entity\AdStats;
use App\Entity\Source;

class ResponseHandlerTest extends TestCase
{
    public static $jsonFile;

    public static function setUpBeforeClass(): void
    {
        $json = <<<JSON
            {"settings":{"currency":"EUR","PeriodLength":1,"groupby":""},"headers":["URLs","Tags","DATE","Estimated revenue","Ad impressions","Ad eCPM","CLICKS","Ad CTR"],"data":[["mastercuriosidadesbr.com","mastercuriosidadesbr.com \u00c2\u00bb mastercuriosidadesbr.com_S1-static","2019-07-02",65.37,42475,1.54,2044,4.81],["optad360.test","optad360.test_am_S1","2019-07-02",0.02,3688,0.01,10,0.27],["optad360.test","optad360.test_am_S2","2019-07-02",0.02,2685,0.01,23,0.86],["optad360.test","optad360.test_am_S3","2019-07-02",0.03,2079,0.01,11,0.53]]}
        JSON;
        self::$jsonFile = json_decode($json, true);
    }

    public function testRequestHandlerSettings()
    {
        $dataFetcher = new ResponseHandler();
        $response = $dataFetcher->handleSettings(self::$jsonFile['settings']);
        $this->assertInstanceOf(AdStatsSettings::class, $response);
    }

    public function testRequestHandlerHeaders()
    {
        $dataFetcher = new ResponseHandler();
        $response = $dataFetcher->handleHeaders(self::$jsonFile['headers']);
        $this->assertIsArray($response);
    }

    public function testRequestHandlerData()
    {
        $dataFetcher = new ResponseHandler();
        $headers = $dataFetcher->handleHeaders(self::$jsonFile['headers']);
        $source = new Source;
        $source->setId(1);
        $source->setUrl("https://api.optad360.com/testapi");
        $response = $dataFetcher->handleData(self::$jsonFile['data'], $headers, 1, $source);
        $this->assertIsArray($response);
        $this->assertInstanceOf(AdStats::class, $response[0]);
    }

}

?>