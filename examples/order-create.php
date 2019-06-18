<?php

use CloudPrinter\CloudCore\Client\CloudCoreClient;
use CloudPrinter\CloudCore\Exception\ValidationException;
use CloudPrinter\CloudCore\Model\{Address, File, OrderItem, Order, Option};

$apiKey = '***';
$client = new CloudCoreClient($apiKey);

$address = new Address();
$address->setEmail('test@mail.com')
    ->setFirstName('John')
    ->setLastName('Doe')
    ->setCountry('NL')
    ->setCity('Amsterdam')
    ->setStreet('Street1')
    ->setPhone('+31-655-538-848')
    ->setZip('1071 JA')
    ->setType('delivery');

$file = new File();
$file->setUrl('https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf')
    ->setType('cover');

$item = new OrderItem();
$item->setReference('item-1')
    ->setCount(1)
    ->setProduct('textbook_cw_a6_p_bw')
    ->setShippingLevel('cp_saver')
    ->addFile($file)
    ->addOption(new Option('cover_finish_gloss', 1))
    ->addOption(new Option('pageblock_80off', 1))
    ->addOption(new Option('cover_130mcg', 1))
    ->addOption(new Option('total_pages', 200));

$order = new Order();
$order
    ->setEmail('test@mail.com')
    ->setReference('sdk-' . time())
    ->addItem($item)
    ->addAddress($address);

try {
    $response = $client->order->create($order);
    print_r($response->getData());
} catch (ValidationException $e) {
    print_r($e->getValidationMessages());
}



