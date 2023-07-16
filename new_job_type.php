

<!DOCTYPE html>

<?php

error_reporting(E_ALL);

		include "dbconfig.php";

		include "header.php";

		//include "page_header.php";

		include "admin_side_bar.php";

?>

<!--sidebar end-->

    <!--main content start-->

    <section id="main-content">

        <section class="wrapper">

        <!-- page start-->



        <div class="row">

            <div class="col-sm-12">

                <section class="panel">

                    <header class="panel-heading">

                        Add New Job Type

                        

                    </header>

                    <div class="panel-body">

					
                       <div class="form form-register dark form-horizontal col-sm-12 col-xs-12">

					   <h4 class="head_back"> Business Details </h4>

                                        <div class="form-group">

                                            <label for="fullname" class="col-sm-4 col-xs-12 control-label">Company Name</label>

                                            <div class="col-sm-4 col-xs-12">

                                                <input type="text" class="form-control required" name="job_type_company_name" id="fullname" placeholder="First Name">

											

                                            </div>

                                        </div>

                                      

              

										

                                        <div class="form-group">

                                            <label for="email" class="col-sm-4 col-xs-12 control-label">Company Email *</label>

                                            <div class="col-sm-4 col-xs-12">

                                                <input type="text" class="form-control email" name="job_type_email" id="email" placeholder="Email">

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="email" class="col-sm-4 col-xs-12 control-label">Company Phone *</label>

                                            <div class="col-sm-4 col-xs-12">

                                                <input type="text" class="form-control required" name="job_type_phone" maxlength="11" id="fullname" placeholder="Phone">

                                            </div>

                                        </div>

										<div class="form-group">

                                            <label for="email" class="col-sm-4 col-xs-12 control-label">Address 1</label>

                                            <div class="col-sm-4 col-xs-12">

                                                <input type="text" class="form-control required" name="job_type_address1" id="fullname" placeholder="Address 1">

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="email" class="col-sm-4 col-xs-12 control-label">Address 2</label>

                                            <div class="col-sm-4 col-xs-12">

                                                <input type="text" class="form-control required" name="job_type_address2" id="fullname" placeholder="Address 2">

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="email" class="col-sm-4 col-xs-12 control-label">Town</label>

                                            <div class="col-sm-4 col-xs-12">

                                                <input type="text" class="form-control required" name="job_type_town" id="fullname" placeholder="Town">

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="email" class="col-sm-4 col-xs-12 control-label">Post Code*</label>

                                            <div class="col-sm-4 col-xs-12">

                                                <input type="text" class="form-control required" name="job_type_postcode" id="fullname" placeholder="AA2 2XX">

                                            </div>

                                        </div>

										<p>* - Mandatory Fields</p>





                                    </div>

									<div class="form form-register dark form-horizontal col-sm-12 col-xs-12">

									<h4 class="head_back">First Point Of Contact</h4>

                                        <div class="form-group">

                                            <label for="fullname" class="col-sm-4 col-xs-12 control-label">Contact Person Name</label>

                                            <div class="col-sm-4 col-xs-12">

                                                <input type="text" class="form-control required" name="job_type_first_contact_name" id="fullname" placeholder="Contact Name">

                                            </div>

                                        </div>



                                       

										<div class="form-group">

                                            <label for="email" class="col-sm-4 col-xs-12 control-label">Contact Designation</label>

                                            <div class="col-sm-4 col-xs-12">

                                                <input type="text" class="form-control required" name="job_type_first_contact_job_title" id="email" placeholder="Designation">

                                            </div>

                                        </div>

										

                                        <div class="form-group">

                                            <label for="email" class="col-sm-4 col-xs-12 control-label">Contact Email *</label>

                                            <div class="col-sm-4 col-xs-12">

                                                <input type="text" class="form-control required" name="job_type_first_contact_email" id="cemail" placeholder="Contact Email">

                                            </div>

                                        </div>

										

                                        <div class="form-group">

                                            <label for="email" class="col-sm-4 col-xs-12 control-label">Phone *</label>

                                            <div class="col-sm-4 col-xs-12">

                                                <input type="text" class="form-control required" name="job_type_first_contact_phone" id="fullname" maxlength="11" placeholder="Phone">

                                            </div>

                                        </div>

										 <div class="form-group">

                                            <label for="email" class="col-sm-4 col-xs-12 control-label">Mobile *</label>

                                            <div class="col-sm-4 col-xs-12">

                                                <input type="text" class="form-control required" name="job_type_first_contact_mobile" id="fullname" maxlength="11" placeholder="Phone">

                                            </div>

                                        </div>

										

                                </div>

								<div class="form form-register dark form-horizontal col-sm-12 col-xs-12">

									<h4 class="head_back"> Second point of Contact</h4>

                                       

                                        <div class="form-group">

                                            <label for="fullname" class="col-sm-4 col-xs-12 control-label">Contact Person Name</label>

                                            <div class="col-sm-4 col-xs-12">

                                                <input type="text" class="form-control required" name="job_type_second_contact_name" id="fullname" placeholder="Contact Name">

                                            </div>

                                        </div>

										

										<div class="form-group">

                                            <label for="email" class="col-sm-4 col-xs-12 control-label">Contact Designation</label>

                                            <div class="col-sm-4 col-xs-12">

                                                <input type="text" class="form-control required email" name="job_type_second_contact_job_title" id="email" placeholder="Designation">

                                            </div>

                                        </div>

   

	

										 <div class="form-group">

                                            <label for="email" class="col-sm-4 col-xs-12 control-label">Contact Email *</label>

                                            <div class="col-sm-4 col-xs-12">

                                                <input type="text" class="form-control required" name="job_type_second_contact_email" id="cemail" placeholder="Contact Email">

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="email" class="col-sm-4 col-xs-12 control-label">Phone</label>

                                            <div class="col-sm-4 col-xs-12">

                                                <input type="text" class="form-control required" name="job_type_second_contact_phone" id="fullname" maxlength="11" placeholder="Phone">

                                            </div>

                                        </div>

										 <div class="form-group">

                                            <label for="email" class="col-sm-4 col-xs-12 control-label">Mobile</label>

                                            <div class="col-sm-4 col-xs-12">

                                                <input type="text" class="form-control required" name="job_type_second_contact_mobile" id="fullname" maxlength="11" placeholder="Phone">

                                            </div>

                                        </div>

										

                                </div>

								 <div class="col-sm-offset-4">

      <button type="button" class="btn btn-primary"><i class="fa fa-times"></i> Cancel</button>

      <input type="submit" name="update" value="Create job_type" class="btn btn-success" id="newjob_type">

    </div>

    

    

                    </div>

                </section>

            </div>

        </div>

        <!-- page end-->

        </section>

    </section>

    <!--main content end-->

<!--right sidebar start-->



<!--right sidebar end-->



</section>



