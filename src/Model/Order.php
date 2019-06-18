<?php

namespace CloudPrinter\CloudCore\Model;

use CloudPrinter\CloudCore\Exception\ValidationException;
use Particle\Validator\Validator;

/**
 * Class Order
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class Order implements ModelInterface
{
    /**
     * @var string Order reference identifier
     */
    private $reference;

    /**
     * @var string Email address of the client
     */
    private $email;

    /**
     * @var float End customer sales price
     */
    private $price;

    /**
     * @var string The currency of the end customer sales price
     */
    private $currency;

    /**
     * @var string Harmonized code
     */
    private $hc;

    /**
     * @var array Array of one or more address objects
     */
    private $addresses = [];

    /**
     * @var array Array of one or more item objects
     */
    private $items = [];

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return array
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param string $reference
     * @return $this
     */
    public function setReference(string $reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param Address $address
     * @return $this
     */
    public function addAddress(Address $address)
    {
        $this->addresses[] = $address;

        return $this;
    }

    /**
     * @param OrderItem $item
     * @return $this
     */
    public function addItem(OrderItem $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return $this
     */
    public function setPrice(float $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return string
     */
    public function getHc()
    {
        return $this->hc;
    }

    /**
     * @param string $hc
     * @return $this
     */
    public function setHc(string $hc)
    {
        $this->hc = $hc;

        return $this;
    }

    /**
     * Object to Array
     * @return array
     * @throws ValidationException
     */
    public function toArray()
    {
        $data = [
            'reference' => $this->getReference(),
            'email' => $this->getEmail(),
            'price' => $this->getPrice(),
            'currency' => $this->getCurrency(),
            'hc' => $this->getHc(),
            'addresses' => [],
            'items' => [],
        ];

        /** @var Address $address */
        foreach ($this->getAddresses() as $address) {
            $data['addresses'][] = $address->toArray();
        }

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
        $validator->required('reference');
        $validator->required('email')->email();
        $validator->required('addresses')->isArray();
        $validator->required('items')->isArray();

        $result = $validator->validate($data);

        if ($result->isNotValid()) {
            throw new ValidationException(self::class, $result->getMessages());
        }

        return true;
    }
}
