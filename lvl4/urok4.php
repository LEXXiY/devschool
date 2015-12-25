<?php
	error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
	ini_set('display_errors', 1);
	
	$test='anna';
	
	function test_ok(&$parametr, $gender='man'){
		$parametr .= ' 28y.o '.$gender;
	}
	
	test_ok($test, 'female');
	
	echo $test;