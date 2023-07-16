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
    <form name="new_job_titles_form" id="new_job_titles_form">
    <input type="hidden" name="new_job_titles_form"/>
        <div class="col-md-12"  style="margin-top:7%;">
           <div class="col-md-3"></div>
           <div class="col-md-6">
              <div class="panel">
                <div class="panel-primary">
                  <div class="panel-heading">Job Title</div>
                </div>
                <div class="panel-body" style="background-color:#e9e9e9;box-shadow: 5px 5px 5px gray;">
                    <label for="sjobid" style="margin-right: -10%;" class="col-sm-3">Payment Date</label>
			       	   <input type="text" style="width:50%;height:30px;" name="pay_date" id="pay_date" class="form-control">
			       	  
                    <label for="name">Name</label>
               <div class="form-group">
                  <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name...">
               </div>
               <center>
               <div id="job_created"></div>
              <button type="button" name="btn" id="save_job" class=" add_job
                   btn btn-lg btn-default">Save</button></center>
                </div>
              </div>
           </div>
           <div class="col-md-3"></div>
        </div>
        </form>
    </div>
    <script type="text/javascript">
            $('#save_job').click(function(){
        alert("Demo");
              var form=$('#new_job_titles_form');
       var dataString = $("#new_job_titles_form").serialize();
       alert(dataString);
                $.ajax({
                    type: "POST",
                    url: "post_process.php",
              data: form.serialize(),
                    success: function(data) {
                     console.log(data); 
           $('#job_created').html(data); 
                }
            });
        });
   
  </script>
</body>
</html>