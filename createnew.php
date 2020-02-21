<?php
require_once('projectFunctions.php');
writeJSON('PersonalProjectData.json', $_POST, 'a');
echo 'Your work order has been submitted; a maintenace professional will be there promptly';
?>