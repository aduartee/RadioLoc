<?php

namespace app\Helpers;

class Request
{
    public static function get()
    {
        return strtolower($_REQUEST['REQUEST_METHOD']);
    }
}