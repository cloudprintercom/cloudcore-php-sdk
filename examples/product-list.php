<?php

use CloudPrinter\CloudCore\Client\CloudCoreClient;

$apiKey = '***';

$client = new CloudCoreClient($apiKey);
$response = $client->product->getList();

print_r($response->getData());
