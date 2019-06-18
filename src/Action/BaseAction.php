<?php

namespace CloudPrinter\CloudCore\Action;

use CloudPrinter\CloudCore\Client\CloudCoreClient;
use CloudPrinter\CloudCore\Http\HttpClient;

/**
 * Class BaseAction
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class BaseAction
{
    /**
     * @var CloudCoreClient
     */
    protected $client;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * BaseAction constructor.
     * @param CloudCoreClient $client
     */
    public function __construct(CloudCoreClient $client)
    {
        $this->client = $client;
        $config = ['base_url' => $client->getBaseUrl()];
        $this->httpClient = new HttpClient($config);
    }
}
