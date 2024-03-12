<?php

namespace app\Helpers;

class Uri
{
    public static function get($typeRequest):string
    {
        return parse_url($_SERVER['REQUEST_URI'])[$typeRequest];
    }
}