<?php

if (!function_exists('image_resize_save')) {
    function image_resize_save($image, $path)
    {
        $filename = date('YmdHi') . str_replace(" ", "", $image->getClientOriginalName());
        $image->move(public_path($path), $filename);
        return $filename;
    }
}

if (!function_exists('generateSmsCode')) {
    function generateSmsCode()
    {
        return rand(1000, 9999);
    }
}

if (!function_exists('generateEmailCode')) {
    function generateEmailCode()
    {
        return rand(1000, 9999);
    }
}

if (!function_exists('isJson')) {
    function isJson($value): bool
    {
        return is_string($value) && is_array(json_decode($value, true)) && (json_last_error() == JSON_ERROR_NONE);
    }
}
