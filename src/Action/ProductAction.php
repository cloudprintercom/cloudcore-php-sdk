<?php

namespace CloudPrinter\CloudCore\Action;

use CloudPrinter\CloudCore\Http\Response;

/**
 * Class ProductAction
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class ProductAction extends BaseAction
{
    /**
     * @return Response
     */
    public function getList(): Response
    {
        $data = ['apikey' =>  $this->client->getApiKey()];
        $response = $this->httpClient->makeRequest('products', $data);

        return $response;
    }

    /**
     * @param string $orderReference
     * @return Response
     */
    public function getInfo(string $orderReference): Response
    {
        $data = [
            'reference' => $orderReference,
            'apikey' =>  $this->client->getApiKey()
        ];
        $response = $this->httpClient->makeRequest('products/info', $data);

        return $response;
    }
}
