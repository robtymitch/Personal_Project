<?php

require('PersonalProjectHeader.php');
$personalProjectData = file_get_contents('../Data/PersonalProjectData.json');
$tenants = json_decode($personalProjectData,true);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/PersonalProjectCSS.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">

    <title>Tenant Portal</title>
</head>

<body class="bgColor">
    <div class="sidenav">
        <a href="#">Home</a>
        <a href="#">Payments</a>
        <a href="#">Maintenance</a>
        <a href="#">Contact Us</a>
    </div>
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

                        <html>
                        <form action="transitionPages/modifyOld.php" method="POST">
                            <br />
                            <label class="ast" >First Name: </label>
                            <input name="firstname" value="<?php echo $tenants[$_GET['id']]['firstname'] ?>"></input><br /><br />
                            <label class="ast" >Last Name: </label>
                            <input name="lastname" value="<?php echo $tenants[$_GET['id']]['lastname'] ?>"></input><br /><br />
                            Picture:
                            <input name="picture" value="<?php echo $tenants[$_GET['id']]['picture'] ?>"></input><br /><br />
                            <label class="ast" for="typeIssue">Please reselect issue:</label><br />
                            <select id="typeIssue" name="typeIssue">
                                <option value="Plumbing">Plumbing</option>
                                <option value="Electrical">Electrical</option>
                                <option value="Heating/Air Conditioning">Heating/Air Conditioning</option>
                                <option value="General Purpose">General Purpose</option>
                            </select><br /><br />
                            Description of Issue<br />
                            <textarea name="issue"><?php echo $tenants[$_GET['id']]['issue'] ?></textarea><br /><br />
                            
                            <input type="hidden" id="id" name="id" value="<?= $_GET['id'] ?>">

                            <button class="btn btn-primary" type="submit" value="Submit">Submit</button>
                            
                        </form>

                        </html>

                    </div>
                </div>
            </div>
            <div class="col-4">
            </div>
        </div>



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>