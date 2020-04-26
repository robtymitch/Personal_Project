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
$query=$pdo->prepare('SELECT Type, Photo, Description FROM maintenance_requests WHERE Request_Id=?');
$query->execute([$_GET['id']]);
$row = $query->fetch();

if(count($_POST)>0){
	$error=DataManipulation::updateOrder($_POST);
	if(isset($error{0})){
		$message=$error;
		$alert_type='danger';
	} else {
        $message='The request has been updated please return to work orders to view it <a href="workOrders.php">HERE</a>';
		$alert_type='success';
    }
}
if(count($_POST)>0) echo '<div class="alert alert-'.$alert_type.'" role="alert">'.$message.'</div>';

$backDestination = '';
if(Admin::isAdmin($_SESSION)){
	$backDestination = 'adminPage.php';
} else {
	$backDestination = 'workOrders.php';
}

?>

    <div class="container indexFont ">
        <h3>Welcome to C & M Property Managment</h3>
        <br />
        <div class="row">
        <div class="col-2 center my-5"><a href="<?= $backDestination ?>"> <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-arrow-bar-left" fill="currentColor" viewBox="0 0 20 20" width="4.5em" height="4.5em">
 						<path clip-rule="evenodd" fill-rule="evenodd" d="M 7.854 6.646 a 0.5 0.5 0 0 0 -0.708 0 l -3 3 a 0.5 0.5 0 0 0 0 0.708 l 3 3 a 0.5 0.5 0 0 0 0.708 -0.708 L 5.207 10 l 2.647 -2.646 a 0.5 0.5 0 0 0 0 -0.708 Z" />
 						<path clip-rule="evenodd" fill-rule="evenodd" d="M 12 10 a 0.5 0.5 0 0 0 -0.5 -0.5 H 5 a 0.5 0.5 0 0 0 0 1 h 6.5 a 0.5 0.5 0 0 0 0.5 -0.5 Z m 2.5 6 a 0.5 0.5 0 0 1 -0.5 -0.5 v -11 a 0.5 0.5 0 0 1 1 0 v 11 a 0.5 0.5 0 0 1 -0.5 0.5 Z" />
 					</svg></a></div>
            <div class="col-1"></div>
            <div class="col-7">
                <div class="card" style="width: 50rem; height: 40rem;">
                    <div style="background-color:purple"><img src="" class="card-img-top; solidColor" alt=""></div>
                    <div class="card-body">
                        <h5 class="card-title">Modify Maintenance Request</h5><br />
                        <form method="POST">
                            <br />
                            Picture (Online file location):
                            <input name="Photo" value ="<?= $row['Photo']?>"></input><br /><br />
                            <label class="ast" for="typeIssue">Type of Issue:</label><br />
                            <select id="typeIssue" name="type">
                                <option value="plumbing">Plumbing</option>
                                <option value="electrical">Electrical</option>
                                <option value="hvac">Heating/Air Conditioning</option>
                                <option value="general">General Purpose</option>
                            </select><br /><br />
                            Description of Issue<br />
                            <textarea name="description"><?= $row['Description'] ?></textarea><br /><br />
                            <button class="btn btn-primary" type="submit" value="Submit">Submit</button>
                            
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-4">
            </div>
    </div>


<?php 
Template::showFooter();
?>