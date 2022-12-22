<?php

declare(strict_types=1);

namespace App;

interface AmountParser
{
    /**
     * Convert `8.1` string to 810000000 in case of currency BTC (8 digit after decimal point)
     */
    public function decimalToInteger(string $withDecimalPointValue, string $currency):string;
    /**
     * Convert 810000000 string to 8.1 in case of BTC
     */
    public function integerToDecimal(string $integer, string $currency):string;
}