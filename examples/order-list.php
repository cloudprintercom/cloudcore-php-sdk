<?php

use CloudPrinter\CloudCore\Client\CloudCoreClient;

$apiKey = '***';

$client = new CloudCoreClient($apiKey);
$response = $client->order->getList();

print_r($response->getData());
