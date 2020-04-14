<?php 
session_start();
require_once('../Libraries/Template.php');
require_once('../Libraries/dbSettings.php');
require_once('../Libraries/AccountManagement.php');

if(count($_POST)>0){
	$error=AccountManagement::signup($_POST);
	if(isset($error{0})){
		$message=$error;
		$alert_type='danger';
	}
	else{
        $message='The account has been created please sign in <a href="../index.php">HERE</a>';
		$alert_type='success';
	}
}
if(count($_POST)>0) echo '<div class="alert alert-'.$alert_type.'" role="alert">'.$message.'</div>';

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../CSS/PersonalProjectCSS.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


</head>

<body>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="signUp my-5">
                <form method="POST">
                    <h4 class="mb">E-mail:</h4>
                    <input type="text" name="email" required /><br />
                    <h4 class="mb">First Name:</h4>
                    <input type="text" name="first_name" required /><br />
                    <h4 class="mb">Last Name:</h4>
                    <input type="text" name="last_name" required /><br />
                    <h4 class="mb">Password:</h4>
                    <input type="password" name="password" required minlength="8" /><br />
                    <button class="my-2" type="submit">Create account</button>
                </form>
            </div>
        </div>
        <div class="col-2"></div>

<?php 
Template::showFooter();
?>