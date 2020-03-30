<?php
session_start();
require_once('../../Libraries/AccountManagement.php');
if(count($_POST)>0){ // when user submits form:
	$error=AccountManagement::signup('../../Data/database.csv.php');
	if(isset($error{0})) echo $error;
}
?>