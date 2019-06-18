<?php

namespace CloudPrinter\CloudCore\Exception;

/**
 * Class ValidationException
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class ValidationException extends \Exception
{
    /**
     * @var array
     */
    private $validationMessages;

    /**
     * ValidationException constructor.
     * @param string $className
     * @param array $validationMessages
     */
    public function __construct(string $className, array $validationMessages)
    {
        $this->validationMessages = $validationMessages;
        $message = $className . ' is not valid.';
        parent::__construct($message);
    }

    /**
     * @return array
     */
    public function getValidationMessages()
    {
        return $this->validationMessages;
    }
}
