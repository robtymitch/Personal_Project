<?php
require_once('../../Libraries/AdminFunctions.php');
require_once('../../Libraries/dbSettings.php');
require_once('../../Libraries/mySQLDataBase.php');
require('../../Libraries/AccountManagement.php');
if(!AccountManagement::isLogged()) header('location: ../../index.php');

Admin::adminDeleteTenant($_GET['id']);

header('location: ../adminPage.php');
?>