
                    <div class="panel">
                        
			       		<div class="panel-primary"style="box-shadow: 5px 5px 5px;">
			       	  	 <div class="panel-heading"><center>Customer Details</center></div>
			      	 </div>
                    <div class="panel-body" style="background-color:#e9e9e9;box-shadow: 5px 5px 5px;">
                      <div class="col-md-6">
                      <?php
                      $customer_id = $_GET['customer_id'];
                      $sql="SELECT customers.name, customers.mobile, customers.address1,customers.address2, customers.city, customers.post_code,customers.phone,customers.email,delivery_address.address1 AS delivery_address1,delivery_address.address2 AS delivery_address2,delivery_address.city AS delivery_city,delivery_address.post_code AS delivery_post_code
FROM customers
LEFT JOIN delivery_address ON customers.id=delivery_address.customer_id
WHERE customers.id='$customer_id' ";
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
                      <label for="delivery_address1">Delivery Address</label>
                      <div class="form-group">
                          <input type="text" class="form-control" name="delivery_address1" id="delivery_address1" value="<?php echo $delivery_row['delivery_address1'];?>">
                      </div>
                      <label for="delivery_city">Delivery City</label>
                      <div class="form-group">
                          <input type="text" class="form-control" name="delivery_city" id="delivery_city" value="<?php echo $delivery_row['delivery_city'];?>">
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
                  <label for="delivery_address2">Delivery Address</label>
                      <div class="form-group">
                          <input type="text" name="delivery_address2" id="delivery_address2" class="form-control" value="<?php echo $delivery_row['delivery_address2'];?>">
                      </div>
                      <label for="delivery_post_code">Delivery Post Code</label>
                      <div class="form-group">
                          <input type="text" class="form-control" name="delivery_post_code" id="delivery_post_code" value="<?php echo $delivery_row['delivery_post_code'];?>">
                      </div>
              </div>
              </div>
                       <input style="border-radius: 0px;" type="submit" value="Update" name="cust_btn" class="btn btn-primary">
              </div>
               <?php 
               
               if(isset($_POST['cust_btn']))
               {
                  print_r($_POST);
              $name=$_POST['name'];
                $mobile=$_POST['mobile'];
                $address1=$_POST['address1'];
                $city=$_POST['city'];
                $phone=$_POST['phone'];
                $email=$_POST['email'];
                $address2=$_POST['address2'];
                $post_code=$_POST['post_code'];
                $delivery_address1=$_POST['delivery_address1'];
                $delivery_address2=$_POST['delivery_address2'];
                $delivery_city=$_POST['delivery_city'];
                $delivery_post_code=$_POST['delivery_post_code'];
                
                $update ="UPDATE customers,delivery_address SET customers.name='$name',customers.mobile='$mobile', customers.city='$city', customers.phone='$phone',customers.email='$email',customers.address1='$address1',customers.address2='$address2',customers.post_code='$post_code',delivery_address.address1='$delivery_address1',delivery_address.address2='$delivery_address2',delivery_address.city='delivery_city',delivery_address.post_code='$delivery_post_code' WHERE customers.id=delivery_address.customer_id and customers.id='$customer_id' ";
                $res =  mysqli_query($con,$update);
              
            }
        
           
               ?>