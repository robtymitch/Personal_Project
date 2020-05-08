<?php
session_start();
require_once('../Libraries/AccountManagement.php');
if(!AccountManagement::isLogged()) header('location: ../index.php');
require_once('../Libraries/AdminFunctions.php');
if(!Admin::isAdmin($_SESSION)) header('location: ../index.php');
require('../Libraries/Template.php');
require_once('../Libraries/projectFunctions.php');
Template::printHeader($title);
require_once('../Libraries/dbSettings.php');
require_once('../Libraries/mySQLDataBase.php');


?>

    <div class="cen textStyle">Administration</div><br />
    <div class="row">
        
        <div class="col-7 verticalLine textStyle  ">Tenants and Billing:<hr>
            <button type="button" class="btn btn-primary"><a href="adminTenantCreation.php">Create New Tenant</a></button><br /><br />
            <br />
            <div class="scrollable">
                <?php
                    $pdo=MySQLDB::connect();
                    $query=$pdo->prepare('SELECT users.User_Id, User_Email, First_Name, Last_Name, Amount_Due from users INNER JOIN billing on users.User_Id = billing.User_Id WHERE Role != "Admin"');
                    $query->execute();
                    while ($row = $query->fetch()){
                        echo '<div class="media">
                        <div class="media-body">
                            <h4 class="mt-0">User Email: ' . $row['User_Email'] . '</h4>
                            <h4 class="mt-0">First Name: ' . $row['First_Name'] . '</h4>
                            <h4 class="mt-0">Last Name: ' . $row['Last_Name'] . '</h4>
                            <h4 class="mt-0">Amount Due: ' . $row['Amount_Due'] . '</h4>
                            <button type="button" class="btn btn-warning"><a href="adminModifyUser.php?id=' . $row['User_Id'] . '">Modify Tenant</a></button>
                            <button type="button" class="btn btn-danger"><a a href="TransitionPages/adminDeleteTenant.php?id=' . $row['User_Id'] . '">Delete</a></button><br /><br />
                        </div>
                    </div>';
                    }
                ?>
            </div>
        </div>



        <div class="col-5 verticalLine textStyle">Maintenance Orders:<hr>
            <button type="button" class="btn btn-primary"><a href="adminWorkOrderCreation.php">Create work order</a></button><br /><br />
            <br />
            <div class="scrollable">
                <?php
                    $pdo=MySQLDB::connect();
                    $query=$pdo->prepare('SELECT Request_Id, Date, Type, Photo FROM maintenance_requests');
                    $query->execute();
                    while ($row = $query->fetch()){
                        echo '<div class="media">
                        <img src="' . $row['Photo'] . '" class="mr-3" alt="Place Holder for photo" width="96">
                        <div class="media-body">
                        <h4 class="mt-0">Request Id: ' . $row['Request_Id'] . '</h4>
                        <h4 class="mt-0">Date: ' . $row['Date'] . '</h4>
                        <h4 class="mt-0">Type: ' . $row['Type'] . '</h4>
                        <button type="button" class="btn btn-primary"><a href="PersonalProjectDetails.php?id=' . $row['Request_Id'] . '">View Work Order</a></button>
                        <button type="button" class="btn btn-warning"><a href="adminModifyOrder.php?id=' . $row['Request_Id'] . '">Modify Work Order</a></button>
                        <button type="button" class="btn btn-danger"><a a href="TransitionPages/adminDelete.php?id=' . $row['Request_Id'] . '">Delete</a></button>
                        </div>
                    </div>';
                    }
                ?>
            </div>
        </div>



    </div>



<?php
Template::showFooter();
?>
</html>