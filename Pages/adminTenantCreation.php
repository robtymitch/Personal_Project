<?php
session_start();
require('../Libraries/AccountManagement.php');
if(!AccountManagement::isLogged()) header('location: ../index.php');
require_once('../Libraries/AdminFunctions.php');
if(!Admin::isAdmin($_SESSION)) header('location: index.php');
require('../Libraries/Template.php');
Template::printHeader($title);

require_once('../Libraries/dbSettings.php');
require_once('../Libraries/projectFunctions.php');
require_once('../Libraries/mySQLDataBase.php');

if(count($_POST)>0){
	$error=Admin::createTenant($_POST);
	if(isset($error{0})){
		$message=$error;
		$alert_type='danger';
	} else {
        $message='The tenant has been created please return to the admin page to view it <a href="adminPage.php">HERE</a>';
		$alert_type='success';
    }
}

if(count($_POST)>0) echo '<div class="alert alert-'.$alert_type.'" role="alert">'.$message.'</div>';

$pdo=MySQLDB::connect();
$query=$pdo->prepare('SELECT Apt_Id FROM apartments where User_Id IS NULL');
$query->execute();

?>
    <div class="container indexFont ">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-7">
                <div class="card" style="width: 50rem; height: 40rem;">
                    <div style="background-color:purple"><img src="" class="card-img-top; solidColor" alt=""></div>
                    <div class="card-body">
                        <h5 class="card-title">Create a new tenant</h5><br />
                        <form method="POST">
                            <br />
                            Email: <br />
                            <textarea name="User_Email"></textarea>
                            <br />
                            First Name: 
                            <br />
                            <textarea name="First_Name"></textarea>
                            <br />
                            Last Name: 
                            <br />
                            <textarea name="Last_Name"></textarea>
                            <br />
                            Password:
                            <br />
                            <input type="password" textarea name="Password" required minlength="8"></textarea>
                            <br />
                            Role:
                            <br />
                            <select id="Role" name="Role">
                                <option value="Admin">Admin</option>
                                <option value="Tech">Technician</option>
                                <option value="Tenant">Tenant</option>
                            </select>
                            <br />
                            <label class="ast" for="Apt_Id">Select Apartment: </label><br />
                            <select id="Apt_Id" name="Apt_Id">
                            <?php
                                while ($row = $query->fetch()){
                                    echo '<option value='.$row['Apt_Id'].'>'.$row['Apt_Id'].'</option>';
                                }
                            ?>
                            </select>
                            <br />
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