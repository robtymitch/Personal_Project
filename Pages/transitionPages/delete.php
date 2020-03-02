<?php
require_once('../../Libraries/projectFunctions.php');

deleteJSON('../../Data/PersonalProjectData.json',$_GET['id']);

header('location: workOrders.php');
?>