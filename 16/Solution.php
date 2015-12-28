<?php

/*************************************************************************
 * Project Euler Problem 16 (http://projecteuler.net/problem=16)
 *
 * A PHP implementation by Koen Pasman
 * http://koenpasman.nl
 *************************************************************************/
class Solution implements SolutionInterface
{

    private static $POWER = 1000;

    public function solve()
    {
        $number = bcpow(2, self::$POWER);
        $sum = 0;
        for ($i = 0, $j = strlen($number); $i < $j; $i++) {
            $sum += (int)$number[$i];
        }

        return 'Sum is ' . $sum;
    }
}
