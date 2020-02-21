<?php
$tenants = json_decode(file_get_contents('PersonalProjectData.json'), true);
require('PersonalProjectHeader.php');
require('projectFunctions.php');
printHeader($title);
?>

<h1>Tenant Work Orders</h1>
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
            <button type="button" class="btn btn-danger"><a href="delete.php?id=' . $i . '">Delete</a></button>
            
            
            </div>
          </div>';

  echo '<hr align="left" class="ahr";>';
}

?>


</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>