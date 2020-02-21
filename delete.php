<?php
require_once('projectFunctions.php');

deleteJSON('PersonalProjectData.json',$_GET['id']);

echo 'Succesfully deleted'
?>