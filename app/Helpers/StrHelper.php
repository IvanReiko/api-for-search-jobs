<?php
namespace App\Helpers;


class StrHelper
{
    static function strpos($value, $chars = [])
    {
        foreach ($chars as $char) {
            if($str = strpos($value, $char)){
                $value = substr($value, 0, $str);
            }
        }

        return $value;
    }
}