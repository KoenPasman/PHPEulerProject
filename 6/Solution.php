<?php
/*************************************************************************
 * Project Euler Problem 6 (http://projecteuler.net/problem=6)
 *
 * A PHP implementation by Koen Pasman
 * http://koenpasman.nl
*************************************************************************/

class Solution implements SolutionInterface 
{
	private static $N = 100;

	public function solve()
	{
		// square of the sums
		$difference = pow( (self::$N * (self::$N + 1)) / 2, 2);
		
		// sum of squares, directly calculating the difference
		foreach(range(0, self::$N) as $number)
		{
			$difference -= pow($number, 2);
		}

		return 'difference is ' . $difference;
	}
}