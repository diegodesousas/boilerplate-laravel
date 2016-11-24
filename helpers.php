<?php

if (!function_exists('rest_response'))
{
    function rest_response($data, $status = 200, array $headers = [], $options = null)
    {
        return new \App\Http\Response\RestResponse($data, $status, $headers, $options);
    }
}