<?php

require_once('SolutionInterface.php');

$problem = isset($_GET['problem']) && ctype_digit($_GET['problem']) ? $_GET['problem'] : null;

ini_set('max_execution_time', 180);
ini_set('Display_errors', 'on');
error_reporting(E_ALL ^ E_NOTICE);

if($problem == null)
{
    // Show small index
    $dirList = glob('[0-9]*', GLOB_ONLYDIR);
    sort($dirList, SORT_NUMERIC);

    echo '<h1>Problem overview</h1>';
    echo '<ul>';
    foreach($dirList as $dir) {
        echo '<li><a href="./?problem=' . $dir . '">Problem #' . $dir . '</a>';
    }
    echo '</ul>';
}
else if($problem != null && is_dir($problem))
{
    $solutionFile = $problem . '/Solution.php';
	if(file_exists($solutionFile))
	{
		require_once($solutionFile);


		$solution = new Solution();

		// benchmark execution time
		$start = microtime(true);
		echo $solution->solve();
		$end = microtime(true);
		
		echo '<p>Execution time: ' . round($end - $start, 3) . 's</p>';
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