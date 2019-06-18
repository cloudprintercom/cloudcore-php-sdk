<?php

namespace CloudPrinter\CloudCore\Client;

/**
 * Interface BaseClient
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
interface ClientInterface
{
    /**
     * Get base CloudPrinter api url
     * @return string
     */
    public function getBaseUrl();

    /**
     * Get access token
     * @return string
     */
    public function getApiKey();

    /**
     * Make simple request
     * @param string $uri
     * @param array|null $data
     * @return mixed
     */
    public function makeRequest(string $uri, array $data = null);
}
