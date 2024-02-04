<?php

namespace App\Helpers;

class FormatDate
{
    public static function format(string $date): string
    {
        $date = \DateTime::createFromFormat('d/m/Y', $date);
        return $date->format('Y-m-d');
    }
}
