<?php

namespace CloudPrinter\CloudCore\Http;

/**
 * Class Response
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class Response
{
    /**
     * @var int Response code.
     */
    private $statusCode;

    /**
     * @var array Response data.
     */
    private $data;

    /**
     * Response constructor.
     * @param int $statusCode
     * @param array $data
     */
    public function __construct(int $statusCode = null, array $data = null)
    {
        $this->statusCode = $statusCode;
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
