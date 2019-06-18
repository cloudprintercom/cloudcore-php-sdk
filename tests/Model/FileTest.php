<?php

namespace CloudPrinter\CloudCore\Tests\Model;

use CloudPrinter\CloudCore\Exception\ValidationException;
use CloudPrinter\CloudCore\Model\File;
use PHPUnit\Framework\TestCase;

/**
 * Class FileTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class FileTest extends TestCase
{
    /**
     * @var File
     */
    public $file;

    public function setUp()
    {
        $this->file = new File();
    }

    public function testFileSuccess()
    {
        $this->file->setType('cover')
            ->setUrl('https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf');

        $expected = [
            'type' => 'cover',
            'url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            'md5sum' => md5_file($this->file->getUrl())
        ];

        $asArray = $this->file->toArray();
        $this->assertEquals($expected, $asArray);
    }

    public function testFileSuccessSetViaConstructor()
    {
        $type = 'cover';
        $url = 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf';
        $file = new File($type, $url);

        $expected = [
            'type' => 'cover',
            'url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            'md5sum' => md5_file($file->getUrl())
        ];

        $asArray = $file->toArray();
        $this->assertEquals($expected, $asArray);
    }

    public function testFileSuccessSetMd5()
    {
        $this->file->setType('cover')
            ->setUrl('https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf')
            ->setMd5sum('123');

        $expected = [
            'type' => 'cover',
            'url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            'md5sum' => '123'
        ];

        $asArray = $this->file->toArray();
        $this->assertEquals($expected, $asArray);
    }

    public function testFailFileIsNotPdf()
    {
        $this->file->setType('cover')
            ->setUrl('http://google.com');

        $this->expectException(ValidationException::class);
        $this->file->toArray();
    }
}
