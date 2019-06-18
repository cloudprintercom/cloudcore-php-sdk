<?php

namespace CloudPrinter\CloudCore\Model;

use CloudPrinter\CloudCore\Exception\ValidationException;
use Particle\Validator\Validator;

/**
 * Class Address
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class Address implements ModelInterface, CountryInterface
{
    /**
     * @var string The type of address
     */
    private $type;

    /**
     * @var string Company name
     */
    private $company;

    /**
     * @var string Customers first name
     */
    private $firstName;

    /**
     * @var string Customers last name
     */
    private $lastName;

    /**
     * @var string Customers street name
     */
    private $street;

    /**
     * @var string Customers addition street name
     */
    private $additionStreet;

    /**
     * @var string Customers zip/postal code
     */
    private $zip;

    /**
     * @var string Customers country name
     */
    private $country;

    /**
     * @var string Customers state name
     */
    private $state;

    /**
     * @var string Customers city name
     */
    private $city;

    /**
     * @var string Customers email
     */
    private $email;

    /**
     * @var string Customers phone number
     */
    private $phone;

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
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     * @return $this
     */
    public function setCompany(string $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     * @return $this
     */
    public function setStreet(string $street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return string
     */
    public function getAdditionStreet()
    {
        return $this->additionStreet;
    }

    /**
     * @param string $additionStreet
     * @return $this
     */
    public function setAdditionStreet(string $additionStreet)
    {
        $this->additionStreet = $additionStreet;

        return $this;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     * @return $this
     */
    public function setZip(string $zip)
    {
        $this->zip = $zip;

        return $this;
    }

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
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return $this
     */
    public function setCity(string $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return bool
     */
    private function zipIsRequired()
    {
        return !in_array($this->getCountry(), self::COUNTRIES_WITHOUT_ZIP);
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
     * @return array
     * @throws ValidationException
     */
    public function toArray()
    {
        $data = [
            'type' => $this->getType(),
            'company' => $this->getCompany(),
            'firstname' => $this->getFirstName(),
            'lastname' => $this->getLastName(),
            'street1' => $this->getStreet(),
            'street2' => $this->getAdditionStreet(),
            'zip' => $this->getZip(),
            'city' => $this->getCity(),
            'country' => $this->getCountry(),
            'state' => $this->getState(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone()
        ];

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
        $validator->required('type');
        $validator->required('firstname');
        $validator->required('lastname');
        $validator->required('street1');
        $validator->required('city');
        $validator->required('country');
        $validator->required('phone');
        $validator->optional('email')->email();

        if ($this->zipIsRequired()) {
            $validator->required('zip');
        }

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
