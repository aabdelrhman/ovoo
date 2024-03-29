<?php

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast\Object_;

if (!function_exists('image_resize_save')) {
    function uploadImage($file , $path = 'images')
    {
        $path = $file->store('public/'.$path);
        return $path;
    }
}

if (!function_exists('image_resize_save')) {
    function image_resize_save($image, $path)
    {
        $filename = uniqid() . '.' . $image->extension();
        $image->move(public_path($path), $filename);
        return 'public/'.$path.'/' .$filename;
    }
}

if (!function_exists('generateSmsCode')) {
    function generateSmsCode()
    {
        return 12345;
        // return rand(10000, 99999);
    }
}

if (!function_exists('generateEmailCode')) {
    function generateEmailCode()
    {
        return rand(10000, 99999);
    }
}

if (!function_exists('isJson')) {
    function isJson($value): bool
    {
        return is_string($value) && is_array(json_decode($value, true)) && (json_last_error() == JSON_ERROR_NONE);
    }
}


if (!function_exists('getNextid')) {
    function getNextid(Model $model, $key)
    {
        $data=  $model->where('id', '>', $key)->first();
        return $data ? $data->id : null;
    }
}
