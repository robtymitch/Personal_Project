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
                <form action="transitionPages/signupCreate.php" method="POST">
                    <h4 class="mb">E-mail:</h4>
                    <input type="text" name="email" required /><br />
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