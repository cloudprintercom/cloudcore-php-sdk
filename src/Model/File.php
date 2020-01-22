<?php

namespace CloudPrinter\CloudCore\Model;

use CloudPrinter\CloudCore\Exception\ValidationException;
use Particle\Validator\Exception\InvalidValueException;
use Particle\Validator\Validator;

/**
 * Class File
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class File implements ModelInterface
{
    /**
     * List of supported files mime types
     * Use for validation.
     */
    const FILE_MIME_TYPES = [
      'application/pdf',
      'application/zip'
    ];

    /**
     * @var string The type of file
     */
    private $type;

    /**
     * @var string Url to the order file
     */
    private $url;

    /**
     * @var string Md5 sum of the file
     */
    private $md5sum;

    /**
     * File constructor.
     * @param string|null $type
     * @param string|null $url
     */
    public function __construct(string $type = null, string $url = null)
    {
        if ($type) {
            $this->setType($type);
        }

        if ($url) {
            $this->setUrl($url);
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
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getMd5sum()
    {
        return $this->md5sum;
    }

    /**
     * @param string $md5Sum
     * @return string
     */
    public function setMd5sum(string $md5Sum)
    {
        $this->md5sum = $md5Sum;

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
            'type' => $this->getType(),
            'url' => $this->getUrl(),
            'md5sum' => $this->getMd5sum() ?: md5_file($this->getUrl()),
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
        $validator->required('md5sum');
        $validator->required('url')->callback(function ($value) {
            $mimeType = $this->getFileMimeType($value);

            if (!in_array($mimeType, self::FILE_MIME_TYPES)) {
                throw new InvalidValueException(
                    'The file type is not valid',
                    'url'
                );
            }

            return true;
        });

        $result = $validator->validate($data);

        if ($result->isNotValid()) {
            throw new ValidationException(self::class, $result->getMessages());
        }

        return true;
    }

    /**
     * Get mime type of the file.
     * @param $destinationPath
     * @return string
     */
    private function getFileMimeType($destinationPath)
    {
        $host = parse_url($destinationPath, PHP_URL_HOST);

        if (null == $host) {
            $content = file_get_contents($destinationPath, false, null, 0, 1024);
        } else {
            $curl = curl_init($destinationPath);
            curl_setopt($curl, CURLOPT_RANGE, "0-1024");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $content = curl_exec($curl);
            curl_close($curl);
        }

        $fileInfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $fileInfo->buffer($content);

        return $mimeType;
    }
}
