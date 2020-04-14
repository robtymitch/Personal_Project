<?php
session_start();
require_once('../Libraries/AccountManagement.php');
if(!AccountManagement::isLogged()) header('location: ../index.php');
require('../Libraries/Template.php');
require_once('../Libraries/projectFunctions.php');
Template::printHeader($title);
require_once('../Libraries/dbSettings.php');
require_once('../Libraries/mySQLDataBase.php');

if(count($_POST)>0){
	$error=DataManipulation::Delete($_POST);
	if(isset($error{0})){
		$message=$error;
		$alert_type='danger';
	}
	else{
        $message='Something went wrong please try again';
		$alert_type='success';
	}
}
if(count($_POST)>0) echo '<div class="alert alert-'.$alert_type.'" role="alert">'.$message.'</div>';


    $pdo=MySQLDB::connect();
		$query=$pdo->prepare('SELECT Request_Id, Date, Type, Photo FROM maintenance_requests WHERE User_Id=?');
    $query->execute([$_SESSION['User_Id']]);
        echo '<h1>Work Orders</h1>
        <button type="button" class="btn btn-primary"><a href="workOrderCreation.php">Create work order</a></button><br /><br />
        <br />';
        while ($row = $query->fetch()){
            echo '<div class="media">
            <img src="' . $row['Photo'] . '" class="mr-3" alt="Place Holder for photo" width="96">
            <div class="media-body">
            <h4 class="mt-0">Request Id: ' . $row['Request_Id'] . '</h4>
            <h4 class="mt-0">Date: ' . $row['Date'] . '</h4>
            <h4 class="mt-0">Type: ' . $row['Type'] . '</h4>
            <button type="button" class="btn btn-primary"><a href="PersonalProjectDetails.php?id=' . $row['Request_Id'] . '">View Work Order</a></button>
            <button type="button" class="btn btn-warning"><a href="modifyOrder.php?id=' . $row['Request_Id'] . '">Modify Work Order</a></button>
            <button type="button" class="btn btn-danger"><a a href="TransitionPages/Delete.php?id=' . $row['Request_Id'] . '">Delete</a></button>
            </div>
          </div>';
        }

Template::showFooter();
?>