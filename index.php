<?php
session_start();
require_once('Libraries/AccountManagement.php');
if (AccountManagement::isLogged()) header('location: Pages/workOrders.php');
require_once('Libraries/Template.php');
require_once('Libraries/dbSettings.php');
require_once('Libraries/AdminFunctions.php');


if (count($_POST) > 0) {
    $error = AccountManagement::signin($_POST);
    if (isset($error{
        0})) {
        $message = $error;
        $alert_type = 'danger';
    } elseif (Admin::isAdmin($_SESSION)) {
        header('location: Pages/adminPage.php');
    } else {
        header('location: Pages/workOrders.php');
    }
}

if (count($_POST) > 0) echo '<div class="alert alert-' . $alert_type . '" role="alert">' . $message . '</div>';

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="CSS/PersonalProjectCSS.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Christen & Mitchell Properties</title>
</head>

<body class="main-Photo">
    <div>
        <div class="cntr " style="color: white">
            Welcome to Christen & Mitchell Property Managment

        </div><br />
        <div class='cntr' style="color: white">
            Please Log In
        </div>

        <form method="post">
            <div class="container">
                <label for="email"><b class="b">Username</b></label>
                <input type="text" placeholder="Enter Username" name="email" required>

                <label for="password"><b class="b">Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required minlength="8">

                <button type="submit">Login</button>
                
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" class="cancelbtn"><a href="Pages/user_signup.php">Create New Account</a></button>
                <button type="button" class="cancelbtn">Cancel</button>
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
        </form>
    </div>
</body>


<?php
Template::showFooter();
?>