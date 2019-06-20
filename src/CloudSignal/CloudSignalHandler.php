<?php

namespace CloudPrinter\CloudCore\CloudSignal;

use CloudPrinter\CloudCore\Exception\CloudSignalApiKeyException;
use CloudPrinter\CloudCore\Http\Request;

/**
 * Class CloudSignalHandler
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 *
 * @method onItemShipped(callable $callBackFunction)
 * @method onItemError(callable $callBackFunction)
 * @method onCloudprinterOrderValidated(callable $callBackFunction)
 * @method onCloudprinterOrderCanceled(callable $callBackFunction)
 * @method onItemValidated(callable $callBackFunction)
 * @method onItemProduce(callable $callBackFunction)
 * @method onItemProduced(callable $callBackFunction)
 * @method onItemPacked(callable $callBackFunction)
 * @method onItemCanceled(callable $callBackFunction)
 * @method onAll(callable $callBackFunction)
 */
class CloudSignalHandler
{
    const ALL_SIGNALS = 'All';

    /** @var string */
    private $cloudSignalApiKey;

    /**
     * CloudSignalHandler constructor.
     * @param $cloudSignalApiKey
     */
    public function __construct($cloudSignalApiKey)
    {
        $this->cloudSignalApiKey = $cloudSignalApiKey;
    }

    /**
     * Handle all possible signals.
     * @param $name
     * @param $arguments
     * @throws CloudSignalApiKeyException
     */
    public function __call($name, $arguments)
    {
        $signalName = preg_replace('/^on/', '', $name);
        $signalData = $this->getSignalData();

        if ($signalData) {
            $this->validateSignalData($signalData);

            if (!empty($signalData['type']) && in_array($signalName, [$signalData['type'], self::ALL_SIGNALS])) {
                $arguments[0]($signalData);
            }
        }
    }

    /**
     * Allows handle more than one signal types in one function.
     * @param array $signals
     * @param callable $handlerFunction
     * @throws CloudSignalApiKeyException
     */
    public function on(array $signals, callable $handlerFunction)
    {
        $signalData = $this->getSignalData();

        if ($signalData) {
            $this->validateSignalData($signalData);

            if (in_array($signalData['type'], $signals)) {
                $handlerFunction($signalData);
            }
        }
    }

    /**
     * @param array $signalData
     * @throws CloudSignalApiKeyException
     */
    private function validateSignalData(array $signalData)
    {
        if (empty($signalData['apikey']) || $signalData['apikey'] != $this->cloudSignalApiKey) {
            throw new CloudSignalApiKeyException();
        }
    }

    /**
     * Reading HTTP request data from a JSON POST.
     * @return array
     */
    public function getSignalData(): array
    {
        $request = new Request();

        return $request->getJsonPostData();
    }
}
