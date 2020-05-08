<?php
require_once('../../Libraries/projectFunctions.php');
require_once('../../Libraries/dbSettings.php');
require_once('../../Libraries/mySQLDataBase.php');
require('../../Libraries/AccountManagement.php');
if(!AccountManagement::isLogged()) header('location: ../../index.php');

DataManipulation::delete($_GET['id']);

header('location: ../workOrders.php');
?>