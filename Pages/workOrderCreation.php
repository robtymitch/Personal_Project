<?php
session_start();
require('../Libraries/AccountManagement.php');
if(!AccountManagement::isLogged()) header('location: ../index.php');
require('../Libraries/Template.php');
Template::printHeader($title);

require_once('../Libraries/dbSettings.php');
require_once('../Libraries/projectFunctions.php');
require_once('../Libraries/mySQLDataBase.php');

if(count($_POST)>0){
	$error=DataManipulation::createWorkOrder($_POST);
	if(isset($error{0})){
		$message=$error;
		$alert_type='danger';
	} else {
        $message='The request has been created please return to work orders to view it <a href="workOrders.php">HERE</a>';
		$alert_type='success';
    }
}
if(count($_POST)>0) echo '<div class="alert alert-'.$alert_type.'" role="alert">'.$message.'</div>';

$pdo=MySQLDB::connect();
$query=$pdo->prepare('SELECT Apt_Id FROM apartments WHERE User_Id=?');
$query->execute([$_SESSION['User_Id']]);
$row = $query->fetch();
?>
    <div class="container indexFont ">
        <h3>Welcome to C & M Property Managment</h3>
        <br />
        <div class="row">
            <div class="col-1"></div>
            <div class="col-7">
                <div class="card" style="width: 50rem; height: 40rem;">
                    <div style="background-color:purple"><img src="" class="card-img-top; solidColor" alt=""></div>
                    <div class="card-body">
                        <h5 class="card-title">Create a new Maintenance Request</h5><br />
                        <form method="POST">
                            <br />
                            Picture (Online file location):
                            <input name="Photo"></input><br /><br />
                            <label class="ast" for="typeIssue">Type of Issue:</label><br />
                            <select id="typeIssue" name="type">
                                <option value="plumbing">Plumbing</option>
                                <option value="electrical">Electrical</option>
                                <option value="hvac">Heating/Air Conditioning</option>
                                <option value="general">General Purpose</option>
                            </select><br /><br />
                            Description of Issue<br />
                            <textarea name="description"></textarea><br /><br />
                            <input hidden name="Apt_Id" value="<?= $row['Apt_Id'] ?>">
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