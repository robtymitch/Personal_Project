<?php
require_once('../../Libraries/projectFunctions.php');
$index = $_POST['id'];
unset($_POST['id']);
modifyJSON('../../Data/PersonalProjectData.json', $_POST, $index);
echo 'Successfuly updated';
?>