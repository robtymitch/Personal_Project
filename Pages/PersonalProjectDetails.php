<?php
session_start();
require('../Libraries/AccountManagement.php');
if(!AccountManagement::isLogged()) header('location: ../index.php');
require('../Libraries/Template.php');
Template::printHeader($title);
require_once('../Libraries/dbSettings.php');
require_once("../Libraries/mySQLDataBase.php");
require_once('../Libraries/projectFunctions.php');
require_once('../Libraries/AdminFunctions.php');


$pdo=MySQLDB::connect();
$query=$pdo->prepare('SELECT Type, Photo, Description, Tech_Id, Apt_Id FROM maintenance_requests WHERE Request_Id=?');
$query->execute([$_GET['id']]);
$row = $query->fetch();
$tech = 'No technician assigned yet';
if(isset($row['Tech_Id'])){
	$tech = $row['Tech_Id'];	
}

$backDestination = '';
if(Admin::isAdmin($_SESSION)){
	$backDestination = 'adminPage.php';
} else {
	$backDestination = 'workOrders.php';
}
?>

 	<div class="container">
 		<div class="row ">
 			<div class="col-2 center my-5"><a href="<?= $backDestination ?>"> <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-arrow-bar-left" fill="currentColor" viewBox="0 0 20 20" width="4.5em" height="4.5em">
 						<path clip-rule="evenodd" fill-rule="evenodd" d="M 7.854 6.646 a 0.5 0.5 0 0 0 -0.708 0 l -3 3 a 0.5 0.5 0 0 0 0 0.708 l 3 3 a 0.5 0.5 0 0 0 0.708 -0.708 L 5.207 10 l 2.647 -2.646 a 0.5 0.5 0 0 0 0 -0.708 Z" />
 						<path clip-rule="evenodd" fill-rule="evenodd" d="M 12 10 a 0.5 0.5 0 0 0 -0.5 -0.5 H 5 a 0.5 0.5 0 0 0 0 1 h 6.5 a 0.5 0.5 0 0 0 0.5 -0.5 Z m 2.5 6 a 0.5 0.5 0 0 1 -0.5 -0.5 v -11 a 0.5 0.5 0 0 1 1 0 v 11 a 0.5 0.5 0 0 1 -0.5 0.5 Z" />
 					</svg></a></div>
 			<div class="col-8 my-5 mx-5">

 				<div class="card" style="width: 90%;">
 					<img src="<?= $row['Photo'] ?>" class="card-img-top" alt="Place holder for photo">
 					<div class="card-body">
 						<p class="card-text">Type: <?= $row['Type'] ?></p>
						<p class="card-text">Description: <?= $row['Description'] ?></p>
						<p class="card-text">Tech Id: <?= $tech ?></p>
 						<p class="card-text">Apartment Id: <?= $row['Apt_Id'] ?></p>
 					</div>
 				</div>
 			</div>
 			<div class="col-2"></div>
 		</div>
 	</div>
 	</div>

<?php 
Template::showFooter();
?>