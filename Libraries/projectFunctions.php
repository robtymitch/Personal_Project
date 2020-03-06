<?php

function filterInput($data, $allowed_fields)
{
	for ($i = 0; $i < count(array_keys($data)); $i++)
		if (!in_array(array_keys($data)[$i], $allowed_fields)) unset($data[array_keys($data)[$i]]);
	return $data;
}

function writeJSON($file, $data, $mode = 'w')
{
	if (!isset($data)) return;
	if ($mode == 'a') {
		if (file_exists($file)) $array = readJSON($file);
		if (!is_array($array)) $array = [];
		$array[] = $data;
	} else $array = $data;
	$h = fopen($file, 'w+');
	fwrite($h, json_encode($array));
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

function modifyJSON($file, $data, $index, $overwrite = false)
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








function is_logged($userid_field)
{
	return isset($_SESSION[$userid_field]{
	0});
}
function signout($signin_URL, $signout_URL, $userid_field)
{
	if (!isset($_SESSION[$userid_field]{
	0})) //header('location: PersonalProjectIndex.php');
		session_start();
	$_SESSION = [];
	session_destroy();
	header('location: ' . $signin_URL);
}


function signin($database_file, $userid_field)
{
	if (count($_POST) > 0) { // when user submits form:
		// check if email is valid
		
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			return 'The email you entered is not valid';
		}
		$_POST['email'] = strtolower($_POST['email']);

		// check if password is valid and check if password meets requirements
		$_POST['password'] = trim($_POST['password']);
		if (strlen($_POST['password']) < 8) {
			return 'The password must be at least 8 characters';
		}

		// if the database does not exist, we create it!!
		if (!file_exists($database_file)) {
			$h = fopen($database_file, 'w+');
			fwrite($h, '');
			fclose($h);
		}
		$h = fopen($database_file, 'r');

		while (!feof($h)) {
			$line = preg_replace('/\n/', '', fgets($h));
			if (strstr($line, $_POST['email'])) {
				$line = explode(';', $line);
				if (!password_verify($_POST['password'], $line[1])) {
					fclose($h);
					return 'The password you entered does not match the stored password';
				}
				// passwords match!
				$_SESSION[$userid_field] = $_POST['email'];
				fclose($h);
				return '';
			}
		}
		fclose($h);
		return 'Email does not exist, please create an account <a href="index.php">HERE</a>';
	}
}


function signup($database_file)
{
	if (count($_POST) > 0) { // when user submits form:
		// check if email is valid
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			return 'The email you entered is not valid';
		}
		$_POST['email'] = strtolower($_POST['email']);

		// check if password is valid and check if password meets requirements
		$_POST['password'] = trim($_POST['password']);
		if (strlen($_POST['password']) < 8) {
			return 'The password must be at least 8 characters';
		}

		// if the database does not exist, we create it!!
		if (!file_exists($database_file)) {
			$h = fopen($database_file, 'w+');
			fwrite($h, '<?php die() ?>' . "\n");
			fclose($h);
		}
		// check if email is already there
		$h = fopen($database_file, 'r');
		while (!feof($h)) {
			$line = fgets($h);
			if (strstr($line, $_POST['email'])) return 'The email is already registered.';
		}
		fclose($h);

		// encrypt password
		$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

		//append the data to a file
		$h = fopen($database_file, 'a+');
		fwrite($h, implode(';', [$_POST['email'], $_POST['password']]) . "\n");
		fclose($h);

		// welcome the user with a warm and cheerful message.
		echo 'You successfully registered your account. Now you can <a href="../../index.php">Sign in</a>.';
		return '';
	}
}
