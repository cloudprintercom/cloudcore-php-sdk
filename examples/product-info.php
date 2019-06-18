<?php

use CloudPrinter\CloudCore\Client\CloudCoreClient;

$apiKey = '***';
$productReference = 'folder_s150_s_fc';

$client = new CloudCoreClient($apiKey);
$response = $client->product->getInfo($productReference);

print_r($response->getData());
