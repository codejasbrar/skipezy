<!doctype html>
<?php 
include "navbar.php";

?>
1<html>
<head>
<meta charset="utf-8">
<title>SkipTrak Software for Skip Hire Business</title>
<style type="text/css">

    @media screen and (min-width: 768px) {

        .modal-dialog {

          width: 700px; / New width for default modal /

        }

        .modal-sm {

          width: 350px; / New width for small modal /

        }

    }

    @media screen and (min-width: 992px) {

        .modal-lg {

          width: 1000px;
		  vertical-align:central;
		  align-content:center;

        }

    }


</style>
</head>

<body>
      <div class="container-fluid">
         <div class="col-md-12" style="margin-top:5%;">
            <div class="row">

                 <table class="table">
                    <thead>
                        <tr class="btn-primary">
                           <th>
                              <label for="search" class="col-sm-1">Search</label>
                              <div class="form-group col-sm-2">
                                 <input type="text" style="margin-left:-15%;" name="search" class="form-control">
                              </div>
                              <button type="button" class="btn btn-default col-sm-1">Search</button>
                              <div class="col-sm-4"></div>
                               <label for="search" class="col-sm-1">Add New Customer</label>
                                <div class="form-group col-sm-2">
                                 <input type="text" name="search" class="form-control">
                                 </div>
                                 <button type="button" class="btn btn-default col-sm-1">Search</button>

                           </th>
                        </tr>
                    </thead>
                 </table>
            </div>
            <div class="row">     
                 <table class="table table-bordered">
                    <thead>
                        <tr class="btn-primary">
                           <th>Order Id</th>
                           <th>Customer Name</th>
                           <th>Amount</th>
                           <th>Paid</th>
                           <th>Start Date</th>
                           <th>End Date</th>
                           <th>Edit</th>
                           <th>View</th>
                           <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                           <td>A5025</td>
                           <td>Aderson</td>
                           <td>$500</td>
                           <td>Yes</td>
                           <td>16/05/2016</td>
                           <td>20/06/2016</td>
                           <td>Edit</td>
                           <td> <a type="button" class="btn" data-toggle="modal" data-target="#myModal">View</a></td>
                           <td>Delete</td>
                        </tr>
                        <tr class="info">
                           <td>A5025</td>
                           <td>Aderson</td>
                           <td>$500</td>
                           <td>Yes</td>
                           <td>16/05/2016</td>
                           <td>20/06/2016</td>
                           <td>Edit</td>
                           <td><a type="button" class="btn" data-toggle="modal" data-target="#myModal">View</a></td>
                           <td>Delete</td>
                        </tr>
                        <tr>
                          <td>A5025</td>
                           <td>Aderson</td>
                           <td>$500</td>
                           <td>No</td>
                           <td>16/05/2016</td>
                           <td>20/06/2016</td>
                           <td>Edit</td>
                           <td><a type="button" class="btn" data-toggle="modal" data-target="#myModal">View</a></td>
                           <td>Delete</td>
                        </tr>
                        <tr class="info">
                           <td>A5025</td>
                           <td>Aderson</td>
                           <td>$500</td>
                           <td>Yes</td>
                           <td>16/05/2016</td>
                           <td>20/06/2016</td>
                           <td>Edit</td>
                           <td><a type="button" class="btn" data-toggle="modal" data-target="#myModal">View</a></td>
                           <td>Delete</td>
                        </tr>
                        <tr>
                           <td>A5025</td>
                           <td>Aderson</td>
                           <td>$500</td>
                           <td>No</td>
                           <td>16/05/2016</td>
                           <td>20/06/2016</td>
                           <td>Edit</td>
                           <td><a type="button" class="btn" data-toggle="modal" data-target="#myModal">View</a></td>
                           <td>Delete</td>
                        </tr>
                    </tbody>
                 </table>
                 </div>
             </div>
         </div>
         <?php
                    ////
         ?>
<div class="container">
  <!-- Trigger the modal with a button -->
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
       <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
       <div class="modal-dialog modal-lg">
      <div class="modal-content">
     
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Jhon</h3>
        </div>
        <div class="modal-body">
           <?php
              include("edit_job_modal.php");
           ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  </div>
</div>
</div>
</div>
</body>
</html>