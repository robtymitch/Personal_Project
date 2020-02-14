<?php
$tenants = json_decode(file_get_contents('PersonalProjectData.json'),true);
require('PersonalProjectHeader.php');
printHeader($title);
?>

    <h1>Tenant Work Orders</h1>
    <br />
    <?php
    for ($i=0;$i<count($tenants);$i++) {
      echo '<div class="media">
            <img src="' . $tenants[$i]['picture'] . '" class="mr-3" alt="' . $tenants[$i]['firstname'] . ' ' . $tenants[$i]['lastname'] . '" width="96">
            <div class="media-body">
            <h4 class="mt-0">' . $tenants[$i]['firstname'] . ' ' . $tenants[$i]['lastname'] . '</h4>
            <button type="button" class="btn btn-primary"><a href="PersonalProjectDetails.php?id=' . $i . '">View Work Order</a></button>
            <button type="button" class="btn btn-warning"><a href="modifyWorkOrder.php?id=' . $i . '">Modify Work Order</a></button>
            <form method="post">
              <input type="submit" name="del" id="del" value="Delete />
            </form>
            <br />
            Invoice Date: ' . $tenants[$i]['date_of_issue'] . '
            </div>
          </div>';

      echo '<hr align="left" class="ahr";>';
      
    }
    
    ?>

