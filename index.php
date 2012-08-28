<?php

require_once('SolutionInterface.php');

$problem = isset($_GET['problem']) && ctype_digit($_GET['problem']) ? $_GET['problem'] : null;

ini_set('max_execution_time', 180);

if($problem != null && is_dir($problem)) 
{
	
	if(file_exists($problem . '/Solution.php')) 
	{
		require_once($problem . '/Solution.php');

		$solution = new Solution();

		// benchmark execution time
		$start = microtime(true);
		echo $solution->solve();
		$end = microtime(true);
		
		echo '<p>Execution time: ' . round($end - $start, 1) . 'ms</p>';
	}
	else
	{
		echo 'Problem not implemented yet';
	}
}
else 
{
	echo 'This particular Euler problem has not been solved yet';
}