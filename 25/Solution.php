<?php

/*************************************************************************
 * Project Euler Problem 25 (http://projecteuler.net/problem=25)
 *
 * A PHP implementation by Koen Pasman
 * http://koenpasman.nl
 *************************************************************************/
class Solution implements SolutionInterface
{

    private static $DIGIT_LIMIT = 1000;
    private $fiboCache = [];

    public function solve()
    {
        // init cache
        $this->fiboCache[1] = 1;
        $this->fiboCache[2] = 1;

        $term = 2;
        $fiboDigitLength = 1;
        while ($fiboDigitLength < self::$DIGIT_LIMIT) {
            $term++;
            $fibo = $this->calcFibonacci($term);
            $fiboDigitLength = strlen($fibo);
        }

        return 'The first term with ' . self::$DIGIT_LIMIT . ' digits in the fibonacci sequences = ' . $term;
    }

    /**
     * Calculate the n-th item in the fibonacci sequence.
     **/
    public function calcFibonacci($n)
    {
        if (isset($this->fiboCache[$n])) {
            return $this->fiboCache[$n];
        } else {
            $fiboN = bcadd($this->calcFibonacci($n - 2), $this->calcFibonacci($n - 1));
            $this->fiboCache[$n] = $fiboN;
            return $fiboN;
        }
    }
}
