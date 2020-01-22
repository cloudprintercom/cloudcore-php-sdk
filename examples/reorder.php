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

$fileCover = new File();
$fileCover->setUrl('https://s3-eu-west-1.amazonaws.com/demo.cloudprinter.com/b52f510a5e2419f67c4925153ec0c080_v2/CP_Sample_doc_A4_Book_Cover_Textbook_80_gsm_Casewrap_v2.1.pdf')
    ->setType('cover');

$fileBook = new File();
$fileBook->setUrl('https://s3-eu-west-1.amazonaws.com/demo.cloudprinter.com/b52f510a5e2419f67c4925153ec0c080_v2/CP_Sample_doc_A4_Book_Interior_Textbook_v2.1.pdf')
    ->setType('book');

$item = new OrderItem();
$item->setReference('item-1')
    ->setCount(1)
    ->setProduct('textbook_cw_a4_p_bw')
    ->setShippingLevel('cp_saver')
    ->addFile($fileCover)
    ->addFile($fileBook)
    ->setReorderItemReference('reorder-item-1')
    ->setReorderOrderReference('order-reference')
    ->setReorderCause('reorder cause')
    ->setReorderDescription('reorder description')
    ->addOption(new Option('cover_finish_gloss', 1))
    ->addOption(new Option('pageblock_80off', 1))
    ->addOption(new Option('cover_130mcg', 1))
    ->addOption(new Option('total_pages', 100));

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



