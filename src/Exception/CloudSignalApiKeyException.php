<?php

namespace CloudPrinter\CloudCore\Exception;

/**
 * Class CloudSignalApiKeyException
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class CloudSignalApiKeyException extends \Exception
{
    /**
     * CloudSignalApiKeyException constructor.
     */
    public function __construct()
    {
        $message = 'Cloud signal api key is not valid.';
        parent::__construct($message);
    }
}
