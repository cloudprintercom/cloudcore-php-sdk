<?php

use CloudPrinter\CloudCore\CloudSignal\CloudSignalHandler;

$cloudSignalApiKey = '***';
$cloudSignalHandler = new CloudSignalHandler($cloudSignalApiKey);

$signals = [
    'ItemProduced',
    'ItemProduced',
    'CloudprinterOrderValidated',
];

$cloudSignalHandler->on($signals, function(array $signalData) {
    // handle
});
