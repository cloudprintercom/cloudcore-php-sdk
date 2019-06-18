<?php

namespace CloudPrinter\CloudCore\Tests\Action;

use CloudPrinter\CloudCore\Action\ProductAction;
use CloudPrinter\CloudCore\Client\CloudCoreClient;
use CloudPrinter\CloudCore\Http\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class ProductActionTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class ProductActionTest extends TestCase
{
    /**
     * @var ProductAction
     */
    public $productAction;

    public function setUp()
    {
        $apiKey = 123;
        $client = new CloudCoreClient($apiKey);
        $this->productAction = new ProductAction($client);
    }

    public function testGetList()
    {
        $result = $this->productAction->getList();
        $this->assertInstanceOf(Response::class, $result);
    }

    public function testGetInfo()
    {
        $reference = '123';
        $result = $this->productAction->getInfo($reference);
        $this->assertInstanceOf(Response::class, $result);
    }
}
