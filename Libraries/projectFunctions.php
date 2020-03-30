<?php

class DataManipulation
{

	public static function readJSON($file, $index = null)
	{
		$h = fopen($file, 'r');
		$output = '';
		while (!feof($h)) $output .= fgets($h);
		fclose($h);
		$output = json_decode($output, true);
		return !isset($index) ? $output : (isset($output[$index]) ? $output[$index] : null);
	}

	public static function writeJSON($file, $data, $mode = 'w') 
	{
		if (!isset($data)) return;
		if ($mode == 'a') {
			if (file_exists($file)) $array = self::readJSON($file);
			if (!is_array($array)) $array = [];
			$array[] = $data;
		} else $array = $data;
		$h = fopen($file, 'w+');
		fwrite($h, json_encode($array));
		fclose($h);
	}

	public static function modifyJSON($file, $data, $index, $overwrite = false)
	{
		if (!file_exists($file) || !isset($data) || !isset($index)) return false;
		$array = self::readJSON($file);
		if (!is_array($array) || !isset($array[$index])) return false;
		$array[$index] = $overwrite ? $data : array_merge($array[$index], $data);
		self::writeJSON($file, $array, 'w+');
		return true;
	}
	
	public static function deleteJSON($file, $index)
	{
		$input = self::readJSON($file);
		unset($input[$index]);
		self::writeJSON($file, $input);
		$jsonArr = array_values(self::readJSON($file));
		self::writeJSON($file, $jsonArr);
	}
}
