<?php

namespace app\Helpers;

class DataHelper
{
    public static function formatToBrazil($date)
    {
        return date('d/m/Y', strtotime($date));
    }

    public static function formatToSql($date)
    {
        return date('Y-m-d', strtotime($date));
    }
}
