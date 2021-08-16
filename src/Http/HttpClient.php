<?php

namespace CloudPrinter\CloudCore\Http;

/**
 * Class HttpClient
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class HttpClient
{
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * HttpClient constructor.
     * @param string $baseUrl
     */
    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return array
     */
    public function getHttpHeaders()
    {
        return [
            'Content-Type: application/json'
        ];
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param string $uri
     * @param array $requestData
     * @param string $httpMethod
     * @return Response
     */
    public function makeRequest(string $uri, array $requestData = null, $httpMethod = 'post'): Response
    {
        $endpointUrl = $this->getBaseUrl() . $uri;

        $ch = curl_init($endpointUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($httpMethod));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHttpHeaders());
        if ($requestData) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
        }

        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        $code = $info['http_code'];
        $data = json_decode($response, true);

        return new Response($code, $data);
    }
}
