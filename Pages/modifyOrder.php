<?php
require('../Libraries/Template.php');
$personalProjectData = file_get_contents('../Data/PersonalProjectData.json');
$tenants = json_decode($personalProjectData,true);
Template::printHeader($title);
?>

    <div class="container indexFont ">
        <h3>Welcome to C & M Property Managment</h3>
        <br />
        <div class="row">
            <div class="col-1"></div>
            <div class="col-7">

                <div class="card" style="width: 50rem; height: 40rem;">
                    <div style="background-color:purple"><img src="" class="card-img-top; solidColor" alt=""></div>
                    <div class="card-body">
                        <h5 class="card-title">Create a new Maintenance Request</h5><br />

                        <html>
                        <form action="transitionPages/modifyOld.php" method="POST">
                            <br />
                            <label class="ast" >First Name: </label>
                            <input name="firstname" value="<?php echo $tenants[$_GET['id']]['firstname'] ?>"></input><br /><br />
                            <label class="ast" >Last Name: </label>
                            <input name="lastname" value="<?php echo $tenants[$_GET['id']]['lastname'] ?>"></input><br /><br />
                            Picture:
                            <input name="picture" value="<?php echo $tenants[$_GET['id']]['picture'] ?>"></input><br /><br />
                            <label class="ast" for="typeIssue">Please reselect issue:</label><br />
                            <select id="typeIssue" name="typeIssue">
                                <option value="Plumbing">Plumbing</option>
                                <option value="Electrical">Electrical</option>
                                <option value="Heating/Air Conditioning">Heating/Air Conditioning</option>
                                <option value="General Purpose">General Purpose</option>
                            </select><br /><br />
                            Description of Issue<br />
                            <textarea name="issue"><?php echo $tenants[$_GET['id']]['issue'] ?></textarea><br /><br />
                            
                            <input type="hidden" id="id" name="id" value="<?= $_GET['id'] ?>">

                            <button class="btn btn-primary" type="submit" value="Submit">Submit</button>
                            
                        </form>

                        </html>

                    </div>
                </div>
            </div>
            <div class="col-4">
            </div>
        </div>


<?php 
Template::showFooter();
?>