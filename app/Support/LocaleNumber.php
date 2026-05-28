<?php

namespace App\Support;

use Illuminate\Support\Number;

class LocaleNumber
{
    public static function format(int|float|string $number): string
    {
        if (extension_loaded('intl')) {
            return Number::format($number);
        }

        return number_format((float) $number, 0, '.', ',');
    }
}
