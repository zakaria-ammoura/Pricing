<?php

namespace App\Utils;

/**
 * Class PriceHelper
 */
class PriceHelper
{

    /**
     * @param float $euro
     *
     * @return float
     */
    public static function euroToCent(float $euro): float
    {
        return $euro * 100;
    }

    /**
     * @param float $cents
     *
     * @return float
     */
    public static function centToEuro(float $cents): float
    {
        return $cents / 100;
    }
}