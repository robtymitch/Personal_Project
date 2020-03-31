<?php
$tenants = json_decode(file_get_contents('../Data/PersonalProjectData.json'), true);
require('../Libraries/projectFunctions.php');
require('../Libraries/Template.php');
Template::printHeader($title);
?>


<h1>Work Orders</h1>
<button type="button" class="btn btn-primary"><a href="workOrderCreation.php">Create work order</a></button><br /><br />
<br />
<?php
for ($i = 0; $i < count($tenants); $i++) {
  echo '<div class="media">
            <img src="' . $tenants[$i]['picture'] . '" class="mr-3" alt="Place Holder for photo" width="96">
            <div class="media-body">
            <h4 class="mt-0">' . $tenants[$i]['firstname'] . ' ' . $tenants[$i]['lastname'] . '</h4>
            <button type="button" class="btn btn-primary"><a href="PersonalProjectDetails.php?id=' . $i . '">View Work Order</a></button>
            <button type="button" class="btn btn-warning"><a href="modifyOrder.php?id=' . $i . '">Modify Work Order</a></button>
            <button type="button" class="btn btn-danger"><a href="transitionPages/delete.php?id=' . $i . '">Delete</a></button>
            
            
            </div>
          </div>';

  echo '<hr align="left" class="ahr";>';
}

Template::showFooter();
?>