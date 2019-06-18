<?php

namespace CloudPrinter\CloudCore\Model;

use CloudPrinter\CloudCore\Exception\ValidationException;
use Particle\Validator\Validator;

/**
 * Class OrderQuote
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class OrderQuote implements ModelInterface, CountryInterface
{
    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $state;

    /**
     * @var array Array of one or more item objects
     */
    private $items = [];

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return $this
     */
    public function setCountry(string $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return $this
     */
    public function setState(string $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param OrderQuoteItem $item
     * @return $this
     */
    public function addItem(OrderQuoteItem $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @return bool
     */
    private function stateIsRequired()
    {
        return in_array($this->getCountry(), self::COUNTRIES_WITH_STATES);
    }

    /**
     * Object to array
     * @return mixed
     * @throws ValidationException
     */
    public function toArray()
    {
        $data = [
            'country' => $this->getCountry(),
            'state' => $this->getState(),
            'items' => []
        ];

        /** @var OrderItem $item */
        foreach ($this->getItems() as $item) {
            $data['items'][] = $item->toArray();
        }

        $dataFiltered = array_filter($data);
        $this->validate($dataFiltered);

        return $dataFiltered;
    }

    /**
     * @param array $data
     * @return bool
     * @throws ValidationException
     */
    public function validate(array $data)
    {
        $validator = new Validator();
        $validator->required('country');
        $validator->required('items')->isArray();
        if ($this->stateIsRequired()) {
            $validator->required('state');
        }

        $result = $validator->validate($data);

        if ($result->isNotValid()) {
            throw new ValidationException(self::class, $result->getMessages());
        }

        return true;
    }
}
