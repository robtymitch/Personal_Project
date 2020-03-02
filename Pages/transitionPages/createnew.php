<?php
require_once('../../Libraries/projectFunctions.php');
writeJSON('../../Data/PersonalProjectData.json', $_POST, 'a');
echo 'Your work order has been submitted; a maintenace professional will be there promptly';
?>