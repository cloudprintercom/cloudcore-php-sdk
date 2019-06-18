<?php

use CloudPrinter\CloudCore\Client\CloudCoreClient;
use CloudPrinter\CloudCore\Exception\ValidationException;
use CloudPrinter\CloudCore\Model\{Option, OrderQuote, OrderQuoteItem};

$apiKey = '***';
$client = new CloudCoreClient($apiKey);

$option = new Option();
$option->setType('paper_90off')
    ->setCount(1);

$itemQuote = new OrderQuoteItem();
$itemQuote->setReference('123')
    ->setCount(250)
    ->setProduct('letterheading_ss_a4_2_0')
    ->addOption($option);

$orderQuote = new OrderQuote();
$orderQuote->setCountry('NL')
    ->addItem($itemQuote);

try {
    $response = $client->order->quote($orderQuote);
    print_r($response->getData());
} catch (ValidationException $e) {
    print_r($e->getValidationMessages());
}

