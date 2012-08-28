<?php

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

	public function isWorking()
	{
		return true;
	}
}