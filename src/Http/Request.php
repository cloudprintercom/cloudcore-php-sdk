<?php

namespace CloudPrinter\CloudCore\Http;

/**
 * Class Request
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class Request
{
    /**
     * Reading HTTP request data from a JSON POST.
     * @return array
     */
    public function getJsonPostData(): array
    {
        $inputJSON = file_get_contents('php://input');
        $data = json_decode($inputJSON, true);

        return $data ?? [];
    }
}
