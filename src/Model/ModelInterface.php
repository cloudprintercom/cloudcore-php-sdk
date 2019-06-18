<?php

namespace CloudPrinter\CloudCore\Model;

use CloudPrinter\CloudCore\Exception\ValidationException;

/**
 * Class ModelInterface
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
interface ModelInterface
{
    /**
     * Object to array
     * @return array
     */
    public function toArray();

    /**
     * @param array $data
     * @return boolean
     * @throws ValidationException
     */
    public function validate(array $data);
}
