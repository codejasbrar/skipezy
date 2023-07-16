<?php
            if(isset($_POST['btn']))
            {
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
                $update=mysqli_query($con,"UPDATE customers,delivery_address SET customers.name='$name',customers.mobile='$mobile', customers.city='$city', customers.phone='$phone',customers.email='$email',customers.address1='$address1',customers.address2='$address2',customers.post_code='$post_code',delivery_address.address1='$value['delivery_address1']',delivery_address.address2='$value['delivery_address2']',delivery_address.city='$value['delivery_city']',delivery_address.post_code='$value['delivery_post_code']' WHERE customers.id=delivery_address.customer_id and customers.id='$cid' ");
            }
        
            else
            {
                echo "error";
            }
?>