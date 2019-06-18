<?php

namespace CloudPrinter\CloudCore\Tests\Model;

use CloudPrinter\CloudCore\Exception\ValidationException;
use CloudPrinter\CloudCore\Model\Option;
use PHPUnit\Framework\TestCase;

/**
 * Class OptionTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class OptionTest extends TestCase
{
    /**
     * @var Option
     */
    private $option;

    public function setUp()
    {
        $this->option = new Option();
    }

    public function testOptionSuccessSetViaConstructor()
    {
        $option = new Option('reference', 1);

        $asArray = $option->toArray();
        $expected = [
            'type' => 'reference',
            'count' => 1,
        ];
        $this->assertEquals($expected, $asArray);
    }

    public function testOptionSuccess()
    {
        $this->option->setType('reference')
            ->setCount(1);

        $asArray = $this->option->toArray();
        $expected = [
            'type' => 'reference',
            'count' => 1,
        ];
        $this->assertEquals($expected, $asArray);
    }

    public function testOptionFail()
    {
        $this->option->setType('reference');

        $this->expectException(ValidationException::class);
        $this->option->toArray();
    }
}
