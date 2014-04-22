<?php
/*************************************************************************
 * Project Euler Problem 32 (http://projecteuler.net/problem=32)
 *
 * A PHP implementation by Koen Pasman
 * http://koenpasman.nl
 *************************************************************************/

class Solution implements SolutionInterface
{

    public function __construct()
    {
        $this->all = array();
        $this->products = array(
            array(1, 4),
            array(1, 5),
            array(2, 4),
            array(2, 5),
            array(3, 4),
            array(3, 5),
            array(4, 5)
        );
    }

    public function solve()
    {
        $this->findPanDigitals();
        $foundProducts = $this->findProducts();
        return 'Sum of all pandigital products is: ' . array_sum($foundProducts);
    }

    /**
     *  Find all 1 through 9 pandigital numbers.
     */
    public function findPanDigitals($base = '')
    {
        // Find all shuffles of the string 123456789
        for($i = 1; $i <= 9; $i++)
        {
            if(!empty($base) && strpos($base, (string) $i) !== false) continue;

            $newBase = $base . ((string) $i);

            if(strlen($newBase) < 9)
            {
                $this->findPanDigitals($newBase);
            }
            else
            {
                $this->all[] = $newBase;
            }

        }
    }

    /**
     * Find all products.
     *
     * We place the 'x' at a number of places:
     *  - Between #1 and #2
     *  - Between #2 and #3
     *  - Between #3 and #4
     *  - Between #4 and #5
     *
     * We place the '='
     *  - Between #5 and #6
     *  - Between #4 and #5
     */
    public function findProducts()
    {
        $foundProducts = array();
        foreach($this->all as $pandigital)
        {
            $pandigital = (string) $pandigital;
            foreach($this->products as $product)
            {
                $wantedResult = (int) substr($pandigital, $product[1], strlen($pandigital) - $product[1]);

                // We can skip products we already found
                if(in_array($wantedResult, $foundProducts)) continue;

                $firstProduct = (int) substr($pandigital, 0, $product[0]);
                $secondProduct = (int) substr($pandigital, $product[0], $product[1] - $product[0]);
                $result = $firstProduct * $secondProduct;
                if($result == $wantedResult)
                {
                    $foundProducts[] = $wantedResult;
                }
            }
        }

        return $foundProducts;
    }
}