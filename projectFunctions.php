<?php

function filterInput($data, $allowed_fields)
{
	for ($i = 0; $i < count(array_keys($data)); $i++)
		if (!in_array(array_keys($data)[$i], $allowed_fields)) unset($data[array_keys($data)[$i]]);
	return $data;
}

function writeJSON($file, $data, $mode='w')
{
	if(!isset($data)) return;
	if($mode=='a') {
		if(file_exists($file)) $array=readJSON($file);
		if (!is_array($array)) $array=[];
		$array[] = $data;
	}else $array=$data;
	$h = fopen($file, 'w+');
	fwrite($h,json_encode($array));
	fclose($h);
}

function readJSON($file, $index = null)
{
	$h = fopen($file, 'r');
	$output = '';
	while (!feof($h)) $output .= fgets($h);
	fclose($h);
	$output = json_decode($output, true);
	return !isset($index) ? $output : (isset($output[$index]) ? $output[$index] : null);
}

function modifyJSON($file, $data, $index, $overwrite=false)
{
	if (!file_exists($file) || !isset($data) || !isset($index)) return false;
	$array = readJSON($file);
	if (!is_array($array) || !isset($array[$index])) return false;
	$array[$index] = $overwrite ? $data : array_merge($array[$index], $data);
	writeJSON($file, $array, 'w+');
	return true;
}

function deleteJSON($file, $index)
{
	$input = readJSON($file);
	unset($input[$index]);
	writeJSON($file, $input);
	$jsonArr = array_values(readJSON($file));
	writeJSON($file, $jsonArr);
}
