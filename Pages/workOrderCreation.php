<?php
require('../Libraries/Template.php');
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
                        <form action="transitionPages/createnew.php" method="POST">
                            <br />
                            <label class="ast" >First Name: </label>
                            <input name="firstname"></input><br /><br />
                            <label class="ast" >Last Name: </label>
                            <input name="lastname"></input><br /><br />
                            Picture:
                            <input name="picture"></input><br /><br />
                            <label class="ast" for="typeIssue">Type of Issue:</label><br />
                            <select id="typeIssue" name="typeIssue">
                                <option value="plumbing">Plumbing</option>
                                <option value="electrical">Electrical</option>
                                <option value="hvac">Heating/Air Conditioning</option>
                                <option value="general">General Purpose</option>
                            </select><br /><br />
                            Description of Issue<br />
                            <textarea name="issue"></textarea><br /><br />

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