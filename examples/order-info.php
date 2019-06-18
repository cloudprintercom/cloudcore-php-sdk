<?php

use CloudPrinter\CloudCore\Client\CloudCoreClient;

$apiKey = '***';
$orderReference = 123;

$client = new CloudCoreClient($apiKey);
$response = $client->order->getInfo($orderReference);

print_r($response->getData());
