<?php

namespace CloudPrinter\CloudCore\Tests\Model;

use CloudPrinter\CloudCore\Exception\ValidationException;
use CloudPrinter\CloudCore\Model\Address;
use PHPUnit\Framework\TestCase;

/**
 * Class AddressTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class AddressTest extends TestCase
{
    /**
     * @var Address
     */
    public $address;

    public function setUp()
    {
        $this->address = new Address();
    }

    public function testAddressSuccess()
    {
        $this->address
            ->setType('type')
            ->setCompany('company')
            ->setFirstName('first name')
            ->setLastName('last name')
            ->setStreet('street')
            ->setAdditionStreet('additional street')
            ->setZip('2134')
            ->setCity('city')
            ->setCountry('US')
            ->setState('AI')
            ->setEmail('test@cloudprinter.com')
            ->setPhone('phone');

        $expectedData = [
            'type' => 'type',
            'company' => 'company',
            'firstname' => 'first name',
            'lastname' => 'last name',
            'street1' => 'street',
            'street2' => 'additional street',
            'zip' => '2134',
            'city' => 'city',
            'country' => 'US',
            'state' => 'AI',
            'email' => 'test@cloudprinter.com',
            'phone' => 'phone'
        ];

        $asArray = $this->address->toArray();
        $this->assertEquals($expectedData, $asArray);
    }

    public function testFailAddressStateRequired()
    {
        $this->address
            ->setType('type')
            ->setCompany('company')
            ->setFirstName('first name')
            ->setLastName('last name')
            ->setStreet('street')
            ->setAdditionStreet('additional street')
            ->setZip('2134')
            ->setCity('city')
            ->setCountry('US')
            ->setEmail('test@cloudprinter.com')
            ->setPhone('phone');

        $this->expectException(ValidationException::class);
        $this->address->toArray();
    }

    public function testFailAddressEmailIsNotCorrect()
    {
        $this->address
            ->setType('type')
            ->setCompany('company')
            ->setFirstName('first name')
            ->setLastName('last name')
            ->setStreet('street')
            ->setAdditionStreet('additional street')
            ->setZip('2134')
            ->setCity('city')
            ->setCountry('NL')
            ->setEmail('testcloudprinter.com')
            ->setPhone('phone');

        $this->expectException(ValidationException::class);
        $this->address->toArray();
    }
}
