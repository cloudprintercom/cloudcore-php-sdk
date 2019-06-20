<?php

use CloudPrinter\CloudCore\CloudSignal\CloudSignalHandler;

$cloudSignalApiKey = '***';
$cloudSignalHandler = new CloudSignalHandler($cloudSignalApiKey);

// handle ItemShipped signal
$cloudSignalHandler->onItemShipped(function(array $signalData) {
   // handle
});

// handle CloudprinterOrderCanceled signal
$cloudSignalHandler->onCloudprinterOrderCanceled(function(array $signalData) {
    // handle
});

// handle CloudprinterOrderValidated signal
$cloudSignalHandler->onCloudprinterOrderValidated(function(array $signalData) {
    // handle
});

// handle ItemCanceled signal
$cloudSignalHandler->onItemCanceled(function(array $signalData) {
    // handle
});

// handle ItemError signal
$cloudSignalHandler->onItemError(function(array $signalData) {
    // handle
});

// handle ItemPacked signal
$cloudSignalHandler->onItemPacked(function(array $signalData) {
    // handle
});

// handle ItemProduced signal
$cloudSignalHandler->onItemProduced(function(array $signalData) {
    // handle
});
