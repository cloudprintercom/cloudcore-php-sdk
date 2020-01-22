<?php

namespace CloudPrinter\CloudCore\Tests\Model;

use CloudPrinter\CloudCore\Exception\ValidationException;
use CloudPrinter\CloudCore\Model\Address;
use CloudPrinter\CloudCore\Model\File;
use CloudPrinter\CloudCore\Model\Order;
use CloudPrinter\CloudCore\Model\OrderItem;
use PHPUnit\Framework\TestCase;

/**
 * Class OrderTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class OrderTest extends TestCase
{
    public function testOrderSuccess()
    {
        $item = $this->getMockBuilder(OrderItem::class)
            ->getMock();

        $file = $this->getMockBuilder(File::class)
            ->getMock();

        $address = $this->getMockBuilder(Address::class)
            ->getMock();

        $order = new Order();
        $order
            ->setEmail('test@cloudprinter.com')
            ->setReference('123')
            ->setPrice('100')
            ->setCurrency('USD')
            ->setHc('test')
            ->addItem($item)
            ->addAddress($address)
            ->addFile($file);

        $orderAsArray = $order->toArray();

        $expectedSubset = [
            'reference' =>  123,
            'email' => 'test@cloudprinter.com',
            'price' => '100',
            'currency' => 'USD',
            'hc' => 'test',
            'items' => [],
            'addresses' => []
        ];
        $this->assertArraySubset($expectedSubset, $orderAsArray);
    }

    public function testOrderFail()
    {
        $item = $this->getMockBuilder(OrderItem::class)
            ->getMock();

        $address = $this->getMockBuilder(Address::class)
            ->getMock();

        $order = new Order();
        $order
            ->setEmail('test@cloudprinter.com')
            ->addItem($item)
            ->addAddress($address);

        $this->expectException(ValidationException::class);
        $order->toArray();
    }
}
