 <?php

$personalProjectData = file_get_contents('PersonalProjectData.json');
$tenants = json_decode($personalProjectData,true);

	if (!isset($_GET['id'])) {
		echo 'Please enter the id of a member or visit the <a href="PersonalProjectDetails.php">index page</a>.';
		die();
	}
	if ($_GET['id'] < 0 || $_GET['id'] > count($tenants) - 1) {
		echo 'Please enter the id of a member or visit the <a href="PersonalProjectDetails.php">index page</a>.';
		die();
	}

	?>
 <!doctype html>
 <html lang="en">

 <head>
 	<!-- Required meta tags -->
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 	<!-- Bootstrap CSS -->
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 	<link rel="stylesheet" href="PersonalProjectCSS.css">
 	<title><?= $tenants[$_GET['id']]['firstname'] . ' ' . $tenants[$_GET['id']]['lastname'] ?></title>
 </head>

 <body class="bgColor">
 	<div class="sidenav">
 		<a href="#">About</a>
 		<a href="#">Services</a>
 		<a href="#">Clients</a>
 		<a href="#">Contact</a>
 	</div>
 	<div class="container">
 		<div class="row ">
 			<div class="col-2 center my-5"><a href="PersonalProjectIndex.php"> <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-arrow-bar-left" fill="currentColor" viewBox="0 0 20 20" width="4.5em" height="4.5em">
 						<path clip-rule="evenodd" fill-rule="evenodd" d="M 7.854 6.646 a 0.5 0.5 0 0 0 -0.708 0 l -3 3 a 0.5 0.5 0 0 0 0 0.708 l 3 3 a 0.5 0.5 0 0 0 0.708 -0.708 L 5.207 10 l 2.647 -2.646 a 0.5 0.5 0 0 0 0 -0.708 Z" />
 						<path clip-rule="evenodd" fill-rule="evenodd" d="M 12 10 a 0.5 0.5 0 0 0 -0.5 -0.5 H 5 a 0.5 0.5 0 0 0 0 1 h 6.5 a 0.5 0.5 0 0 0 0.5 -0.5 Z m 2.5 6 a 0.5 0.5 0 0 1 -0.5 -0.5 v -11 a 0.5 0.5 0 0 1 1 0 v 11 a 0.5 0.5 0 0 1 -0.5 0.5 Z" />
 					</svg></a></div>
 			<div class="col-8 my-5 mx-5">

 				<div class="card" style="width: 90%;">
 					<img src="<?= $tenants[$_GET['id']]['picture'] ?>" class="card-img-top" alt="...">
 					<div class="card-body">
 						<h5 class="card-title"><?= $tenants[$_GET['id']]['firstname'] . ' ' . $tenants[$_GET['id']]['lastname'] ?></h5>
 						<p class="card-text"><?= $tenants[$_GET['id']]['type_of_issue'] ?></p>
 						<p class="card-text"><?= $tenants[$_GET['id']]['issue_description'] ?></p>
 						<a href="#" class="btn btn-primary">Completed</a>
 					</div>
 				</div>
 			</div>
 			<div class="col-2"></div>
 		</div>
 	</div>
 	</div>
 	<!-- Optional JavaScript -->
 	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
 	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
 	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
 </body>

 </html>