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
        $dateParts = explode('/', $date);

        $formattedDate = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];

        return $formattedDate;
    }
}
