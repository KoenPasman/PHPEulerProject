<?php

/*************************************************************************
 * Project Euler Problem 15 (http://projecteuler.net/problem=15)
 *
 * A PHP implementation by Koen Pasman
 * http://koenpasman.nl
 *************************************************************************/
class Solution implements SolutionInterface
{
    private static $NUMBER_OF_SQUARES = 20;
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
     * Recursively calculate the edges in the Pascal Triangle.
     *
     * @param int $x
     * @param int $y
     * @return integer
     **/
    public function pascalTriangle($x, $y)
    {
        if ($this->inCache($x, $y)) return $this->fromCache($x, $y);

        if ($x == 0 || $y == 0) {
            // always 1, cache and return
            $this->toCache($x, $y, 1);
            return 1;
        }

        $totalWays = $this->pascalTriangle($x - 1, $y) + $this->pascalTriangle($x, $y - 1);
        $this->toCache($x, $y, $totalWays);

        return $totalWays;
    }

    /**
     * Check if the result for a node is in the cache.
     *
     * @param int $x
     * @param int $y
     * @return boolean whether or not the node distance is in the cache available
     **/
    private function inCache($x, $y)
    {
        return isset($this->cache[$x][$y]);
    }

    /**
     * Fetch result from cache, knowing that it is available in cache.
     *
     * @param int $x
     * @param int $y
     * @return integer for the distance in a node to the target node
     **/
    private function fromCache($x, $y)
    {
        return $this->cache[$x][$y];
    }

    /**
     * Add distance to cache
     *
     * @param int $x
     * @param int $y
     * @param int $value Calculated value for edge (x, y) on the Pascal triangle.
     * @return null
     **/
    private function toCache($x, $y, $value)
    {
        if (!is_array($this->cache[$x])) $this->cache[$x] = array();
        $this->cache[$x][$y] = $value;
    }
}
