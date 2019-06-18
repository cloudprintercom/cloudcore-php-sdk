<?php

use CloudPrinter\CloudCore\Client\CloudCoreClient;

$apiKey = '***';
$quoteHash = '123';

$client = new CloudCoreClient($apiKey);
$response = $client->order->quoteInfo($quoteHash);

print_r($response->getData());
