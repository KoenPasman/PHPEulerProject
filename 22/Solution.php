<?php
/*************************************************************************
 * Project Euler Problem 22 (http://projecteuler.net/problem=22)
 *
 * A PHP implementation by Koen Pasman
 * http://koenpasman.nl
*************************************************************************/

class Solution implements SolutionInterface {

	public function solve() 
	{
		$names = $this->readNames();
		sort($names, SORT_STRING);

		$totalSum = 0;

		// iterate all names
		for($i=0, $j=count($names); $i<$j; $i++)
		{
			$nameSum = 0;
			$name = strtolower($names[$i]);
			for($k=0; $k<strlen($name); $k++)
			{
				$nameSum += ord($name[$k]) - 96;
			}
			$totalSum += $nameSum * ($i+1);
		}

		return 'Total sum is ' . $totalSum;
	}

	/**
	 * Read all names from names.txt into an array
	 * @ return string array containing names
	**/
	private function readNames() 
	{
		// Formatted as "NAME", "NAME2", ..., "NAMEn"
		$all = file_get_contents('22/names.txt');
		$final = array();
		foreach(explode(',', $all) as $name)
		{
			$final[] = str_replace('"', '', $name);
		}

		return $final;
	}
}