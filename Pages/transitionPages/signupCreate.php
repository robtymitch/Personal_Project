<?php
session_start();
require_once('../../Libraries/projectFunctions.php');
if(count($_POST)>0){ // when user submits form:
	$error=signup('../../Data/database.csv.php');
	if(isset($error{0})) echo $error;
}
?>