<?php 
		ob_start();
		require_once('header.php');
		require_once('dbconfig.php');
		include "admin_side_bar.php";
		error_reporting(E_ALL);
?>
<body>

<?php
	$shift_id=$_REQUEST['id'];
	//$shift_date=$_REQUEST['date'];
	$sql= "SELECT * FROM shifts where id='".$shift_id."'";
	$res=mysql_query($sql); 
	$shift=mysql_fetch_assoc($res);
		 	 //fetch the client name from client table
				$sql= "SELECT company_name FROM clients WHERE id='".$shift['client_id']."'";
		 		$client_sql=mysql_query($sql); 
		 		$client=mysql_fetch_assoc($client_sql);
				
				
				
				 
?>			 
<section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Allocate Shifts
      </header>
      <div class="panel-body">
                    <form name="allocate" method="post">
				       <table class="table table-striped table-bordered">
                	        <thead class="head_table">
                            <tr>
                                <th>Shift Name</th>
                                <th>Client</th>
                                <th>Venue</th>
                                <th>Start Timee</th>
                                <th>Finish Timee</th>
                                <th>Point of Contact</th>
                           </tr>
                        </thead>
                        <tbody>
                        	<tr>
                                <td>
                                <?php echo $shift['name'];?>
                                </td>
                                <td>
                                 <?php echo $shift['name'];?>
                                </td>
                                <td>
                                 <?php echo $shift['venue'];?>
                                </td>
                                <td>
                                <?php echo $shift['start_time'];?>
                                </td>
                                <td>
                                <?php echo $shift['finish_time'];?>
                                </td>
                                <td>
                                <?php echo $shift['point_of_contact'];?>
                                </td>
                             </tr>
                         </tbody></form>
          
                         
                         
            <section id="sc-table" class="section dark" style="padding:0px">
                
                    <table class="table table-striped table-bordered">
                        <thead class="head_table">
                            <tr>
                                <th>Pic</th>
                                <th>Employee Name</th>
                                <th>Mobile</th>
                                <th><input type="checkbox" id="selectall" name='staff[]'></th>
                            </tr>
                        </thead>
                        <tbody>
                      <?php 
					  
					  $sql= "SELECT * FROM candidates";
					  $cand_sql=mysql_query($sql);
					  while($candidate=mysql_fetch_assoc($cand_sql))
		 				 {
						 	$status="Available";
							//$is_disabled = false;	
							$shiftname = "No Shift Allocated";  
							$shift_sql2= "SELECT * FROM shift_status where candidate_id='".$candidate['id']."'";
							$s_res2=mysql_query($shift_sql2);
							while($cand_status=mysql_fetch_assoc($s_res2))
							{			
								//$sql_s= "SELECT name,date FROM shifts where id='".$cand_status['shift_id']."' AND date='".$shift_date."'";
								$sql_s= "SELECT name,date FROM shifts where id='".$cand_status['shift_id']."'";
								$res_s=mysql_query($sql_s); 
								while($shift_n=mysql_fetch_assoc($res_s))
								{
									//$status="Not Available";
									$status=$cand_status['status'];
									$shiftname = $shift_n['name'];	
									$is_disabled = true;	
								}
					   		}
					
                     
	   		
					?>
                        <tr>
                            <td> 
                               <img src="images/avatar1.jpg"alt="profile-pic" class="img-circle img-responsive" style="width:50px;height:50px;">                			</td>
                            <td>
                            	<a href="#" onClick="window.open('candidate_profile_demo.php','name','width=1200','height=800','left=400')"> <?php echo $candidate['name'];?><p>Current Shift:<strong style="color:#0000FF"><?php echo $shiftname;?></strong>,
                                <?php 
                                if($status=="Available")
                                	{;?>
                                    Status:<strong style="color:#009933"><?php echo $status ;?></strong></p></a>
                                    <?php
                                    }
									else {
                                    ;?>
									Status:<strong style="color:#FF0000"><?php echo $status ;?></strong></p></a>
                                    <?php 
                                    }
									;?>
                                 
                            </td>
                            <td>
                            <a href="10" data-target="#myModal5" data-toggle="modal"><?php echo $candidate['phone'];?></a>
                            </td>
                            
                            <td>
								<input type="checkbox" name="selected_candidate[]" class="employee_id" value=<?php echo $candidate['id'];?> <?php //if($is_disabled){ echo 'disabled="disabled"';};?>>
                            </td>
                          </tr>
                     <?php
					   }
				   	?>
                  </tbody>
               </table></form>
          
                    <input type="hidden" name="status" value="waiting">
                    <input  type="submit" name="allocate" class="btn btn-round btn-success" style="float:right;" value="Allocate Shift"></button>
                </section>
        <!--- Now we start the update candidate code-->
   <?php
   
		if(isset($_POST['allocate']))
			{
				$status=$_POST['status'];
				$id=$_POST['selected_candidate'];
				//print_r($_POST);
				//echo $id;
							//exit;
			
			foreach($id as $key=>$ID)
				{
				    
					$candidate_id=$ID;
					$check_sql="SELECT * FROM shift_status where candidate_id='".$candidate_id."' AND shift_id='".$shift_id."'";
					$check_result=mysql_query($check_sql);
					$check_candidate=mysql_fetch_assoc($check_result);
					//echo $check_candidate['candidate_id'];
					//echo $candidate_id;
					$check_sql2="SELECT * FROM candidates where id='".$candidate_id."'"; 
					$check_result2=mysql_query($check_sql2);
					$check_candidate2=mysql_fetch_assoc($check_result2);
				
			if($check_candidate['candidate_id']==$candidate_id&$check_candidate['shift_id']==$shift_id)

						{
						echo "<h2 class='title_back'>".$check_candidate2['name']." is already booked. <br>";
						echo '<script language="javascript">';
						echo 'alert("Some candidates are already booked. Plase scroll down to bottom of page for list of nzmes.")';
						echo '</script>';	  
						exit;	
						}
							
						else
						
						{
					$select_sql="SELECT * FROM candidates where id='".$candidate_id."'";
					$result=mysql_query($select_sql);
					
					$sql="INSERT INTO shift_status"
					 ." (status,candidate_id,shift_id)".
					  " VALUES (
					 '$status',
					 '$ID', 
					 '$shift_id'
					 )";
		//echo "Query is " .$sql. "<br>";
		//exit;
		$res = mysql_query($sql);				
		// Now we will send an email to all the selected candidates  -->
		// Random confirmation code 
		$accept_code=md5(uniqid(rand()));       
		$decline_code=md5(uniqid(rand()));       
		// ---------------- SEND MAIL FORM ----------------
		// send e-mail to ...
		$candidate=mysql_fetch_assoc($result);
		$to=$candidate['email'];
		//echo $to;
		// Your subject
		$subject="Your Shift Details:";
		$from="Impulse Agency<impulsecateringagency@gmail.com>";
		$header="from: Impulse Agency";
		// Your message
		echo $shift_id;
		$message="Click on this link to confirm your shift \r\n\n";
		$message.="http://webdynamicslondon.co.uk/miracle/shift_confirmation.php?status=$status&shift_id=$shift_id&candidate_id=$candidate_id";
		// send email##
		$sentmail = mail($to,$subject,$message,"from:".$from);
		// if your email succesfully sent
	}// for bracket
		//header("Refresh: 1; url=allocate_shift.php");
		}//}//IF
					echo '<script language="javascript">';
					echo 'alert("Shift allocated successfully. All candidates are notified by an email. Now refresh this page.")';
					echo '</script>';	  
	  }//if check canddiate
	  
			//header("Refresh: 1; url=allocate_shift.php");

	?>
	     </form>
  </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
    </section>
    <!--main content end-->

<?php 


include "footer.php";?>

</body>
</html>
