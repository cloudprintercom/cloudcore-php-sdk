<?php

namespace CloudPrinter\CloudCore\Client;

use CloudPrinter\CloudCore\Action\OrderAction;
use CloudPrinter\CloudCore\Action\ProductAction;
use CloudPrinter\CloudCore\Http\HttpClient;
use CloudPrinter\CloudCore\Http\Response;

/**
 * Class CloudCoreClient
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class CloudCoreClient implements ClientInterface
{
    /** @var OrderAction */
    public $order;

    /** @var ProductAction */
    public $product;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * CloudCoreClient constructor.
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->order = new OrderAction($this);
        $this->product = new ProductAction($this);
    }

    /**
     * Get base CloudPrinter api url
     * @return string
     */
    public function getBaseUrl()
    {
        return 'https://api.cloudprinter.com/cloudcore/1.0/';
    }

    /**
     * Get base CloudPrinter api url
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $uri
     * @param array $data
     * @param string $method
     * @return Response
     */
    public function makeRequest(string $uri, array $data = null, $method = 'post')
    {
        $data['apikey'] = $this->getApiKey();
        $config = ['base_url' => $this->getBaseUrl()];
        $httpClient = new HttpClient($config);
        $response = $httpClient->makeRequest($uri, $data, $method);

        return $response;
    }
}
