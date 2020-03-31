 <?php

$personalProjectData = file_get_contents('../Data/PersonalProjectData.json');
$tenants = json_decode($personalProjectData,true);
require('../Libraries/Template.php');
Template::printHeader($title);
?>

 	<div class="container">
 		<div class="row ">
 			<div class="col-2 center my-5"><a href="workOrders.php"> <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-arrow-bar-left" fill="currentColor" viewBox="0 0 20 20" width="4.5em" height="4.5em">
 						<path clip-rule="evenodd" fill-rule="evenodd" d="M 7.854 6.646 a 0.5 0.5 0 0 0 -0.708 0 l -3 3 a 0.5 0.5 0 0 0 0 0.708 l 3 3 a 0.5 0.5 0 0 0 0.708 -0.708 L 5.207 10 l 2.647 -2.646 a 0.5 0.5 0 0 0 0 -0.708 Z" />
 						<path clip-rule="evenodd" fill-rule="evenodd" d="M 12 10 a 0.5 0.5 0 0 0 -0.5 -0.5 H 5 a 0.5 0.5 0 0 0 0 1 h 6.5 a 0.5 0.5 0 0 0 0.5 -0.5 Z m 2.5 6 a 0.5 0.5 0 0 1 -0.5 -0.5 v -11 a 0.5 0.5 0 0 1 1 0 v 11 a 0.5 0.5 0 0 1 -0.5 0.5 Z" />
 					</svg></a></div>
 			<div class="col-8 my-5 mx-5">

 				<div class="card" style="width: 90%;">
 					<img src="<?= $tenants[$_GET['id']]['picture'] ?>" class="card-img-top" alt="Place holder for photoa;skdjljdfsjk">
 					<div class="card-body">
 						<h5 class="card-title"><?= $tenants[$_GET['id']]['firstname'] . ' ' . $tenants[$_GET['id']]['lastname'] ?></h5>
 						<p class="card-text"><?= $tenants[$_GET['id']]['typeIssue'] ?></p>
 						<p class="card-text"><?= $tenants[$_GET['id']]['issue'] ?></p>
 						<a href="#" class="btn btn-primary">Completed</a>
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