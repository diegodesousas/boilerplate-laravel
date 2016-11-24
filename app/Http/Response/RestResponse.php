<?php

namespace App\Http\Response;

use Illuminate\Http\JsonResponse;

class RestResponse extends JsonResponse
{
    public function __construct($data, $status = 200, array $headers = [], $options = null)
    {
        parent::__construct($this->defaultFormat($status, $data), $status, $headers, $options);
    }

    private function defaultFormat(int $status, $data)
    {
        return $status <= 200 && $status >= 200 ? ['data' => $data] : ['errors' => $data];
    }
}