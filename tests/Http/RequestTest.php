<?php

namespace CloudPrinter\CloudCore\Tests\Http;

use CloudPrinter\CloudCore\Http\HttpClient;
use CloudPrinter\CloudCore\Http\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class ResponseTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class RequestTest extends TestCase
{
    public function testMakePostSuccess()
    {
        $request = new HttpClient();
        $response = $request->makeRequest('https://jsonplaceholder.typicode.com/posts');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testMakeDeleteSuccess()
    {
        $request = new HttpClient();
        $response = $request->makeRequest('https://jsonplaceholder.typicode.com/posts/1', [], 'delete');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testMakeRequestWithWrongMethodSuccess()
    {
        $request = new HttpClient();
        $response = $request->makeRequest('https://jsonplaceholder.typicode.com/posts', ['json' => []], 'test');

        $this->assertInstanceOf(Response::class, $response);
    }


    public function testMakePostFail()
    {
        $request = $this->getMockBuilder(HttpClient::class)
            ->disableOriginalConstructor()
            ->getMock();
        $response = $request->makeRequest('test');

        $this->assertInstanceOf(Response::class, $response);
    }
}
