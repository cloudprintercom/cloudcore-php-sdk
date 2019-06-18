<?php

namespace CloudPrinter\CloudCore\Tests\Http;

use CloudPrinter\CloudCore\Http\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class ResponseTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class ResponseTest extends TestCase
{
    /**
     * @var Response
     */
    public $response;

    public function setUp()
    {
        $status = 200;
        $data = ['result' => true];
        $this->response = new Response($status, $data);
    }

    public function testGetStatusCode()
    {
        $code = $this->response->getStatusCode();
        $this->assertEquals(200, $code);
    }

    public function testGetData()
    {
        $data = $this->response->getData();
        $this->assertEquals(['result' => true], $data);
    }
}
