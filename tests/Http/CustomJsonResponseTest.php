<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use App\Http\CustomJsonResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class CustomJsonResponseTest extends TestCase
{
    public function testCustomJsonResponseSuccess()
    {
        $cjr = new CustomJsonResponse();
        $response = $cjr->success();
        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    public function testCustomJsonResponseFailure()
    {
        $cjr = new CustomJsonResponse();
        $response = $cjr->failure(new Exception("Test Exception", 666));
        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}

?>