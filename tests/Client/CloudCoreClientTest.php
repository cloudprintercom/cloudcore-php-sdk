<?php

namespace CloudPrinter\CloudCore\Tests\Client;

use CloudPrinter\CloudCore\Client\CloudCoreClient;
use CloudPrinter\CloudCore\Http\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class CloudCoreClientTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class CloudCoreClientTest extends TestCase
{
    const BASE_URL = 'https://api.cloudprinter.com/cloudcore/1.0/';
    const API_KEY = '123123';

    /**
     * @var cloudCoreClient
     */
    public $cloudCoreClient;

    public function setUp()
    {
        $this->cloudCoreClient = new CloudCoreClient(self::API_KEY);
    }

    public function testGetBaseUrl()
    {
        $baseUrl = $this->cloudCoreClient->getBaseUrl();
        $this->assertEquals(self::BASE_URL, $baseUrl);
    }

    public function testGetApiKey()
    {
        $apiKey = $this->cloudCoreClient->getApiKey();
        $this->assertEquals(self::API_KEY, $apiKey);
    }

    public function testMakeRequest()
    {
        $response = $this->cloudCoreClient->makeRequest('test', []);
        $this->assertInstanceOf(Response::class, $response);
    }
}
