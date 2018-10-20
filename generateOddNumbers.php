<?php

$randomNumbers = [];

$options = getopt('c:');

$count = isset($options['c'])? $options['c'] : 200;	

while(count($randomNumbers) < $count) {
	$randomNumber = rand(7, 99999);
	if ($randomNumber % 2 != 0 && !in_array($randomNumber, $randomNumbers))
		$randomNumbers[] = $randomNumber;
}

$my_file = 'input.txt';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
$data = implode("\n", $randomNumbers);
fwrite($handle, $data);