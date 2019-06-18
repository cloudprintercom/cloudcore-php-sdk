<?php

namespace CloudPrinter\CloudCore\Model;

use CloudPrinter\CloudCore\Exception\ValidationException;
use Particle\Validator\Validator;

/**
 * Class Option
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class Option implements ModelInterface
{
    /**
     * @var string Type of option
     */
    private $type;

    /**
     * @var int The number of times the specific option is used per item.
     */
    private $count;

    /**
     * Option constructor.
     * @param string $type
     * @param int $count
     */
    public function __construct(string $type = null, int $count = null)
    {
        if ($type) {
            $this->setType($type);
        }

        if ($count) {
            $this->setCount($count);
        }
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return $this
     */
    public function setCount(int $count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Object to array
     * @return array
     * @throws ValidationException
     */
    public function toArray()
    {
        $data = [
            'type' => $this->getType(),
            'count' => $this->getCount(),
        ];

        $this->validate($data);

        return $data;
    }

    /**
     * @param array $data
     * @return bool
     * @throws ValidationException
     */
    public function validate(array $data)
    {
        $validator = new Validator();
        $validator->required('type');
        $validator->required('count');

        $result = $validator->validate($data);

        if ($result->isNotValid()) {
            throw new ValidationException(self::class, $result->getMessages());
        }

        return true;
    }
}
