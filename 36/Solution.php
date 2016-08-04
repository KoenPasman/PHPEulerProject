<?php

/*************************************************************************
 * Project Euler Problem 36 (http://projecteuler.net/problem=36)
 *
 * A PHP implementation by Koen Pasman
 * http://koenpasman.nl
 *************************************************************************/
class Solution implements SolutionInterface
{

    public function solve()
    {
        $found = [];
        for ($i = 1; $i < 1000000; $i++) {
            if ($this->isPalindrome($i) && $this->isPalindrome(decbin($i))) {
                $found[] = $i;
            }
        }

        return 'The sum of palindromic numbers in base 10 and base 2 is: ' . array_sum($found);
    }

    public function isPalindrome($number)
    {
        return (string)$number == (string)strrev($number);
    }
}
