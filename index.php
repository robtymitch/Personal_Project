<?php
session_start();
require_once('Libraries/Template.php');
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

<body>
    <div class="cntr">
        Welcome to Christen & Mitchell Property Managment

    </div><br />
    <div class='cntr'>
        Please Log In
    </div>

    <form action="Pages/transitionPages/signinUser.php" method="post">


        <div class="container" >
            <label for="email"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="email" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required minlength="8">

            <button type="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" class="cancelbtn"><a href="Pages/user_signup.php">Create New Account</a></button>
            <button type="button" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>


    </form>
<?php
Template::showFooter();
?>
