<?php
/*************************************************************************
 * Project Euler Problem 20 (http://projecteuler.net/problem=20)
 *
 * A PHP implementation by Koen Pasman
 * http://koenpasman.nl
*************************************************************************/

class Solution implements SolutionInterface
{

	private static $N = 100;

	public function solve() 
	{
		$total = 1;
		foreach(range(2, self::$N) as $number)
		{
			$total = bcmul($total, $number);
		}
		
		$totalSum = 0;
		for($i = 0, $j = strlen($total); $i<$j; $i++)
		{
			$totalSum += (int) $total[$i];
		}

		return 'Sum of digits in ' . self::$N . '! = ' . $totalSum;
	}
}