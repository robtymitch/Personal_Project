<?php
session_start();
require_once('../../Libraries/projectFunctions.php');
if(count($_POST)>0){ // when user submits form:
	$error=signin('../../Data/database.csv.php','user/email');
	if(isset($error{0})) echo $error;
	else header('location: ../workOrders.php');
}
?>