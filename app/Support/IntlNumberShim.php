<?php

/**
 * When the intl extension is missing (common on XAMPP macOS), define Illuminate\Support\Number
 * before Laravel's vendor copy loads, using number_format() fallbacks.
 */
namespace Illuminate\Support;

use Illuminate\Support\Traits\Macroable;

if (extension_loaded('intl')) {
    return;
}

if (class_exists(Number::class, false)) {
    return;
}

class Number
{
    use Macroable;

    protected static string $locale = 'en';

    protected static string $currency = 'USD';

    public static function format(int|float $number, ?int $precision = null, ?int $maxPrecision = null, ?string $locale = null): string
    {
        $decimals = $precision ?? $maxPrecision ?? 0;

        return number_format($number, $decimals, '.', ',');
    }

    public static function currency(int|float $number, string $currency = 'USD', ?string $locale = null, ?int $precision = 2): string
    {
        return static::format($number, $precision).' '.$currency;
    }

    public static function percentage(int|float $number, int $precision = 0, ?int $maxPrecision = null, ?string $locale = null): string
    {
        return static::format($number, $precision, $maxPrecision, $locale).'%';
    }

    public static function ordinal(int|float $number): string
    {
        $suffixes = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
        $n = abs((int) $number) % 100;

        if ($n >= 11 && $n <= 13) {
            return $number.'th';
        }

        return $number.$suffixes[$n % 10];
    }

    public static function spell(int|float $number, ?string $locale = null, ?string $after = null, ?string $before = null): string
    {
        return (string) $number;
    }

    public static function spellOrdinal(int|float $number, ?string $locale = null): string
    {
        return static::ordinal($number);
    }

    public static function useLocale(string $locale): void
    {
        static::$locale = $locale;
    }

    public static function defaultLocale(): string
    {
        return static::$locale;
    }

    public static function useCurrency(string $currency): void
    {
        static::$currency = $currency;
    }

    public static function defaultCurrency(): string
    {
        return static::$currency;
    }

    public static function parse(string $string, ?int $type = null, ?string $locale = null): int|float|false
    {
        return (float) preg_replace('/[^\d.-]/', '', $string);
    }

    public static function parseInt(string $string, ?string $locale = null): int|false
    {
        return (int) static::parse($string, null, $locale);
    }

    public static function parseFloat(string $string, ?string $locale = null): float|false
    {
        return (float) static::parse($string, null, $locale);
    }

    public static function withLocale(string $locale, callable $callback): mixed
    {
        $previous = static::$locale;
        static::$locale = $locale;

        try {
            return $callback();
        } finally {
            static::$locale = $previous;
        }
    }

    public static function withCurrency(string $currency, callable $callback): mixed
    {
        $previous = static::$currency;
        static::$currency = $currency;

        try {
            return $callback();
        } finally {
            static::$currency = $previous;
        }
    }

    public static function abbreviate(int|float $number, int $precision = 0, ?int $maxPrecision = null): string
    {
        if ($number >= 1_000_000_000) {
            return static::format($number / 1_000_000_000, $precision, $maxPrecision).'B';
        }

        if ($number >= 1_000_000) {
            return static::format($number / 1_000_000, $precision, $maxPrecision).'M';
        }

        if ($number >= 1_000) {
            return static::format($number / 1_000, $precision, $maxPrecision).'K';
        }

        return static::format($number, $precision, $maxPrecision);
    }

    public static function fileSize(int|float $bytes, int $precision = 0, ?int $maxPrecision = null): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $power = $bytes > 0 ? floor(log($bytes, 1024)) : 0;
        $power = min($power, count($units) - 1);

        return static::format($bytes / (1024 ** $power), $precision, $maxPrecision).' '.$units[(int) $power];
    }
}
