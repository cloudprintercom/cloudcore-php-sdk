<?php

namespace CloudPrinter\CloudCore\Tests\CloudSignal;

use CloudPrinter\CloudCore\Exception\CloudSignalApiKeyException;
use CloudPrinter\CloudCore\CloudSignal\CloudSignalHandler;
use PHPUnit\Framework\TestCase;

/**
 * Class CloudSignalHandlerTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class CloudSignalHandlerTest extends TestCase
{
    public function testOn()
    {
        $cloudSignalApiKey = '123';
        $cloudSignalHandler = $this->getMockBuilder(CloudSignalHandler::class)
            ->setConstructorArgs([$cloudSignalApiKey])
            ->setMethods(['getSignalData'])
            ->getMock();

        $cloudSignalHandler->expects($this->any())
            ->method('getSignalData')
            ->willReturn([
                "apikey" => "123",
                "type" => "ItemShipped",
                "order" => "21034900000000",
                "item" => "21034901040001",
                "order_reference" => "wp-a18310ee15a8d8ef9010fee2fea95686",
                "item_reference" => "99",
                "datetime" => "2019-05-30T09:49:34+00:00",
                "tracking" => "SANDBOX_99",
                "shipping_option" => "postal"
            ]);

        $cloudSignalHandler->on(['ItemShipped', 'ItemError'], function ($signalData) {
            echo 'ItemShipped';
        });

        $this->expectOutputString('ItemShipped');
    }

    public function testOnFail()
    {
        $cloudSignalApiKey = '111';
        $cloudSignalHandler = $this->getMockBuilder(CloudSignalHandler::class)
            ->setConstructorArgs([$cloudSignalApiKey])
            ->setMethods(['getSignalData'])
            ->getMock();

        $cloudSignalHandler->expects($this->any())
            ->method('getSignalData')
            ->willReturn([
                "apikey" => "123",
                "type" => "ItemShipped",
                "order" => "21034900000000",
                "item" => "21034901040001",
                "order_reference" => "wp-a18310ee15a8d8ef9010fee2fea95686",
                "item_reference" => "99",
                "datetime" => "2019-05-30T09:49:34+00:00",
                "tracking" => "SANDBOX_99",
                "shipping_option" => "postal"
            ]);

        $this->expectException(CloudSignalApiKeyException::class);

        $cloudSignalHandler->on(['ItemShipped', 'ItemError'], function ($signalData) {
            echo 'ItemShipped';
        });
    }

    public function testAll()
    {
        $cloudSignalApiKey = '123';
        $cloudSignalHandler = $this->getMockBuilder(CloudSignalHandler::class)
            ->setConstructorArgs([$cloudSignalApiKey])
            ->setMethods(['getSignalData'])
            ->getMock();

        $cloudSignalHandler->expects($this->any())
            ->method('getSignalData')
            ->willReturn([
                "apikey" => "123",
                "type" => "ItemShipped",
                "order" => "21034900000000",
                "item" => "21034901040001",
                "order_reference" => "wp-a18310ee15a8d8ef9010fee2fea95686",
                "item_reference" => "99",
                "datetime" => "2019-05-30T09:49:34+00:00",
                "tracking" => "SANDBOX_99",
                "shipping_option" => "postal"
            ]);

        $cloudSignalHandler->onAll(function ($signalData) {
            echo 'ItemShipped';
        });

        $this->expectOutputString('ItemShipped');
    }
}
