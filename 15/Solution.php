<?php

/*************************************************************************
 * Project Euler Problem 15 (http://projecteuler.net/problem=15)
 *
 * A PHP implementation by Koen Pasman
 * http://koenpasman.nl
 *************************************************************************/
class Solution implements SolutionInterface
{

    private static $NUMBER_OF_SQUARES = 22;
    private $cache = [];

    public function solve()
    {
        /*
        The problem comes down to creating a Pascal's Triangle.

        We have to calculate all the points in the grid.
        Every point in the grid is the sum of the points it is connected to.

        (0,0)		  (4,0)
        0--1--1--1--1
        |  |  |  |  |
        1--2--3--4--5
        |  |  |  |  |
        1--3--6--10-15
        |  |  |  |  |
        1--4--10-20-35
        |  |  |  |  |
        1--5--15-35-70
        (0,4)         (4,4)

        (4,4) = (3,4) + (4,3)
        (3,4) = (2,4) + (3,3)
        (4,3) = (3,3) + ...

        (1,1) = (0,1) + (1,0)
        (0,1) = 1
        (1,0) = 1

        */

        // initiate cache with the target node as distance = 0
        $cache[0] = [0];

        $result = $this->pascalTriangle(self::$NUMBER_OF_SQUARES, self::$NUMBER_OF_SQUARES);

        return 'Number of ways in a grid: ' . $result;

    }


    /**
     * Recursively calculate the edges in the Pascal Triangle
     * @return integer
     **/
    public function pascalTriangle($a, $b)
    {
        if ($this->inCache($a, $b)) return $this->fromCache($a, $b);

        if ($a == 0 || $b == 0) {
            // always 1, cache and return
            $this->toCache($a, $b, 1);
            return 1;
        }

        $totalWays = $this->pascalTriangle($a - 1, $b) + $this->pascalTriangle($a, $b - 1);
        $this->toCache($a, $b, $totalWays);

        return $totalWays;
    }

    /**
     * Check if the result for a node is in the cache
     * @return boolean whether or not the node distance is in the cache available
     **/
    private function inCache($a, $b)
    {
        return isset($this->cache[$a][$b]);
    }

    /**
     * Fetch result from cache, knowing that it is available in cache
     * @return Integer for the distance in a node to the target node
     **/
    private function fromCache($a, $b)
    {
        return $this->cache[$a][$b];
    }

    /**
     * Add distance to cache
     * @return null
     **/
    private function toCache($a, $b, $value)
    {
        if (!is_array($this->cache[$a])) $this->cache[$a] = array();
        $this->cache[$a][$b] = $value;
    }
}
