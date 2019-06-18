<?php

namespace CloudPrinter\CloudCore\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

/**
 * Class HttpClient
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class HttpClient extends Client
{
    /**
     * @param string|null $uri
     * @param array|null $data
     * @param string $method
     * @return Response
     */
    public function makeRequest(string $uri = null, array $data = null, $method = 'post'): Response
    {
        $headers = [
            'Content-Type' => 'application/json'
        ];

        try {
            switch ($method) {
                case 'post':
                    $response = $this->post($uri, ['json' => $data, 'headers' => $headers]);
                    break;
                case 'delete':
                    $response = $this->delete($uri, ['json' => $data, 'headers' => $headers]);
                    break;
                default:
                    $response = $this->post($uri, ['json' => $data, 'headers' => $headers]);
            }
            $data = json_decode($response->getBody(), true);
            $code = $response->getStatusCode();
        } catch (BadResponseException $e) {
            $e->getResponse()->getStatusCode();
            $data = json_decode($e->getResponse()->getBody(), true);
            $code = $e->getResponse()->getStatusCode();
        }

        return new Response($code, $data);
    }
}
