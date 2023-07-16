<!doctype html>
<?php 
 include "navbar.php";
 include "dbconfig.php";
 $cid=$_GET['cid'];
 include("edit_backend_customer.php");
?>
<html>
<head>
<meta charset="utf-8">
<title>SkipTrak Software for Skip Hire Business</title>

</head>

<body>
  <form method="post">
      <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div>&ensp;</div>
            <div>&ensp;</div>
            <div>&ensp;</div>
         </div>
      </div>
        <div class="row">
        <div class="col-md-12" style="margin-top:7%;">
         <form method="post">
           <div class="col-md-2"></div>
           <div class="col-md-8">
              <div class="row">
                  <div class="panel">
                    <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                      <div class="panel-heading">
                        <h4><center>Personal Detail</center></h4>
                      </div>
                    </div>
                    <div class="panel-body" style="background-color:#e9e9e9;box-shadow: 5px 5px 5px;">
                      <div class="col-md-6">
                      <?php
                      
                      $sql="SELECT customers.name, customers.mobile, customers.address1,customers.address2, customers.city, customers.post_code,customers.phone,customers.email,delivery_address.address1 AS delivery_address1,delivery_address.address2 AS delivery_address2,delivery_address.city AS delivery_city,delivery_address.post_code AS delivery_post_code
FROM customers
LEFT JOIN delivery_address ON customers.id=delivery_address.customer_id
WHERE customers.id='$cid' ";
            $query=mysqli_query($con,$sql);
            $delivery_row=mysqli_fetch_array($query);

                  ?>
                        <label for="name">Full Name</label>
                        <div class="form-group">
                          <input type="text" id="name" name="name" value="<?php echo $delivery_row['name'];?>" class="form-control">
                       </div>
                       <label for="mobile">Mobile</label>
                       <div class="form-group">
                         <input type="text" id="mobile" name="mobile" value="<?php echo $delivery_row['mobile'];?>" class="form-control">
                       </div>
                       <label for="address1">Address Line1</label>
                       <div class="form-group">
                         <input type="text" name="address1" id="address1" value="<?php echo $delivery_row['address1'];?>" class="form-control">
                       </div>
                       <label for="city">City</label>
                       <div class="form-group">
                         <input type="text" name="city" id="city" value="<?php echo $delivery_row['city'];?>" class="form-control">
                      </div> 
                     </div>
                      <div class="col-md-6">
               <label for="phone">Phone</label> 
                  <div class="form-group">
                    <input type="text" id="phone" name="phone" value="<?php echo $delivery_row['phone']?>" class="form-control">
                  </div>
                 <label for="email">Email</label>
                  <div class="form-group">
                    <input type="Email" id="email" name="email" value="<?php echo $delivery_row['email'];?>" class="form-control">
                  </div>
                  <label for="address2">Address Line2</label>
                  <div class="form-group">
                    <input type="text" id="address2" name="address2" value="<?php echo  $delivery_row['address2'];?>" class="form-control">
                  </div>
                   <label for="post_code">Post Code</label>
                  <div class="form-group">
                    <input type="text" id="post_code" name="post_code" value="<?php echo $delivery_row['post_code'];?>" class="form-control">
                  </div>
              </div>
              
              </div>
              </div>
           </div>                                          
                </div>
                <div class="col-md-2"></div>
                </div>
                </div>
                  <div class="row">
           <div class="col-md-12">
              <div class="col-md-2"></div>
               <div class="col-md-8">
               <div class="panel">
                    <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                       <div class="panel-heading"><h4><center>Delivery Address</center></h4></div>
                    </div>
                    <div class="panel-body" style="background-color:#e9e9e9;box-shadow: 5px 5px 5px;">
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="btn-primary">
                             <th class="col-md-1">Location</th>
                             <th class="col-md-4"><center>Address Line 1</center></th>
                             <th class="col-md-4"><center>Address Line 2</center></th>
                             <th class="col-md-2"><center>City</center></th>
                             <th class="col-md-1"><center>Post_Code</center></th>
                        </tr>     
                        </thead>
                        <tbody>
                           <tr>
                              <td class="col-md-1">&ensp;</td>
                              <td class="col-md-4">&ensp;</td>
                              <td class="col-md-4">&ensp;</td>
                              <td class="col-md-2">&ensp;</td>
                               <td class="col-md-1">&ensp;</td>
                           </tr>
                        </tbody>
                         <?php 
                              $query=mysqli_query($con,$sql);
                              while($delivery_row1=mysqli_fetch_array($query))
                              {

                          ?>
                        <tbody>
                            <tr> 
                                <td class="col-md-1">1</td>
                                <td class="col-md-4">
                                  <div class="form-group">
                                     <input type="text" class="form-control" name="delivery_address1" id="delivery_address1" value="<?php echo $delivery_row1['delivery_address1'];?>">
                                  </div>
                                </td>
                                <td class="col-md-4">
                                    <div class="form-group">
                                    <input type="text" name="delivery_address2" id="delivery_address2" class="form-control" value="<?php echo $delivery_row1['delivery_address2'];?>">
                                  </div>
                                </td>
                                <td class="col-md-2">
                                  <div class="form-group">
                                     <input type="text" class="form-control" name="delivery_city" id="delivery_city" value="<?php echo $delivery_row1['delivery_city'];?>">
                                  </div>
                                </td>
                                <td class="col-md-1">
                                  <div class="form-group">
                                     <input type="text" class="form-control" name="delivery_post_code" id="delivery_post_code" value="<?php echo $delivery_row1['delivery_post_code'];?>">
                                  </div>
                                </td>
                            </tr>
                        </tbody>
                        <?php
                          }
                        ?>
                      </table>
                      </div>
                          <center><button type="submit" name="btn" class="add_customer btn btn-lg btn-large btn-success" >Save</button></center>  
                    </div>
                 </div>
                  <div class="col-md-2"></div>
                  </div>
                </div>
           </div>
                 </div>
          </form>
</body>
</html>  
