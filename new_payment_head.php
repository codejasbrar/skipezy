<!doctype html>
<?php 
//include "admin_side_bar.php";
include "navbar.php";

?>
<html>
<head>
<meta charset="utf-8">
<title>SkipTrak Software for Skip Hire Business</title>

</head>

<body>
    <div class="container-fluid">
        <div class="col-md-12"  style="margin-top:7%;">
           <div class="col-md-3"></div>
           <div class="col-md-6">
              <div class="panel">
                <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                  <div class="panel-heading"><h3><center>Payment Head</center></h3></div>
                </div>
                <div class="panel-body" style="background-color:#e9e9e9;box-shadow: 5px 5px 5px;">
                    <label for="phname">Name</label>
               <div class="form-group">
                  <input type="text" id="phname" class="form-control" placeholder="Enter Name...">
               </div>
               <center>
              <button type="submit" name="button" class=" add_job
                   btn btn-lg btn-default">Save</button></center>
                </div>
              </div>
           </div>
           <div class="col-md-3"></div>
        </div>
    </div>
</body>
</html>