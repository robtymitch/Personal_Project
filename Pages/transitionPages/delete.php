<?php
require_once('../../Libraries/projectFunctions.php');

DataManipulation::deleteJSON('../../Data/PersonalProjectData.json',$_GET['id']);

header('location: workOrders.php');
?>