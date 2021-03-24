<?php require APPROOT . '/views/customer/inc/header.php'; ?>
<?php require APPROOT . '/views/customer/inc/aside.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
                GENERAL DETAIL
            <small></small>
        </h1>

        <ol class="breadcrumb">
            <li class="active"><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></a>GENERAL DETAIL</li>
            <li class="active"></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="removeMessages"></div>
                <div class="">
                <form method="post" class="form-horizontal" id="general_form"
                                        name="general_form" action="" enctype=”multipart/form-data”>
                <div class="row">
                <div class="col-lg-1">
                </div>    
				<div class="col-lg-3">
                      <div class="form-group">
                        <div class="box-header with-border">
                            <h6 class="box-title2">Request Date</h6>
                        </div>
                        <div class="col-md-3" id="officer_reportrange"
                            style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <input type="text" name="REQ_DATE" id="REQ_DATE" width="30" readonly
                                value=""><i
                                class="fa fa-caret-down"></i>
                        </div>
                    </div>

                  
                     <div class="form-group">
								<!--/here teh addclass has-error will appear -->
										<div class="box-header with-border">
											<h4 class="box-title2">Customer Name</h4>
										</div>
										<div clas="row">

												<div class=" col-md-9">
                        <div class="">
													<input type="text" class="form-control" id="CUSTOMER_NAME" name="CUSTOMER_NAME"
														placeholder="customer name">
													<span id="error_CUSTOMER_NAME" class="text-danger"></span>
												</div>
                        </div>
                        <label class="col-sm-1 control-label">
                            <a class=""
                                onclick="successtoaster('info','JUST PUT THE NUMBER OF THE CARD, NO NEED TO WRITE CARD','INFORMATION')"><i
                                    class="fa fa-question-circle"></i></a>
                                    </label>


										</div>

							</div>

        </div>
        <div class="col-lg-1">
                </div>  
        <div class="col-lg-3">
        <div class="form-group">
                    <div class="box-header with-border">
                            <h4 class="box-title2">Card No</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                               <div class="">
                                  <div class="input-group ">
                                     <div class="input-group-addon">
                                          <span class="">CARD</span>
                                     </div>
                                     <input type="number" class="form-control" id="CARD_ID" name="CARD_ID"
                                    placeholder="CARD ID">


                                  </div><!-- /.input group -->
                               </div>                       
                        </div>
                            <label class="col-sm-1 control-label">
                            <a class=""
                                onclick="successtoaster('info','JUST PUT THE NUMBER OF THE CARD, NO NEED TO WRITE CARD','INFORMATION')"><i
                                    class="fa fa-question-circle"></i></a>
                                    </label>
                    </div>
                    
                   </div>

              

						    <div class="form-group">
                    <div class="box-header with-border">
                            <h4 class="box-title2">Customer Id</h4>
                        </div>
                    <div class="row">
                            <div class="col-md-9">
                                                     <div class="">
                                                        <div class="input-group ">
                                                            <div class="input-group-addon">
                                                                <span class="">CUS</span>
                                                            </div>
                                                            <input type="number" class="form-control" id="CUS_ID" name="CUS_ID"
                                    placeholder="CUSTOMER ID">


                                                        </div><!-- /.input group -->
                                                    </div>
                            
                                                       
                            </div>
                            <label class="col-sm-1 control-label">
                            <a class=""
                                onclick="successtoaster('info','JUST PUT THE NUMBER OF THE CARD, NO NEED TO WRITE CARD','INFORMATION')"><i
                                    class="fa fa-question-circle"></i></a>
                                    </label>
                    </div>
    
                    </div>
        </div>
        <div class="col-lg-3">
        <div class="">
        
        </div>
        <div class="form-group">
                                    <div class="box-header with-border">
                                        <h4 class="box-title2">Request Status</h4>
                                    </div>

                                    <div class="">
                                        <select class="form-control control" name="REQ_STATUS" id="REQ_STATUS"
                                            title="">

                                            <option value="">SELECT</option>
                                                            <option value="P">PENDING</option>
                                                            <option value="IP">IN PROCESS</option>
                                                            <option value="C">COMPLETED</option>
                                        </select>
                                        <span id="" class="text-danger"></span>
                                    </div>

                      </div>
        <div class="">
                        <div class="box-header with-border">
                            <h4 class="box-title"></h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Submit </button>
                            </div>
                            <label class="col-sm-1 control-label">
                            <a class=""
                                onclick="successtoaster('info','YOU CAN GET LIST OF APPOINTMENTS, YOU CAN GET LIST OF APPOINTMENTS BY SEARCHING FROM THE LIST OF THE PARAMETERS','INFORMATION')"><i
                                    class="fa fa-question-circle"></i></a>
                                    </label>
                           
                        </div>
        </div>
    
                    </div>
                    </form>
                    </div>
                </div>
             <!-- Main table -->
                <div class="box">
                    <div class="container col-md-12">
                        <div class="row col-md-12 ">
                            <div class="col-md-12">
                               </br>
                                <div class="btn-group">
                                    <button class="btn btn-info  pull pull-left" onclick="pro_general_data()" id="resend">Record Data
                                        </button>

                                    <button class="btn pull pull-right"
                                        onclick="successtoaster('info','USE THIS OPERATION IF YOU WANT TO PROCESS SINGLE PAYMENT WITH SINGLE PRINTOUT.','INFORMATION')"><i
                                            class="fa fa-question-circle"></i></button>
                                </div>

                                <br>
                                <br /> <br /> <br />
                                <table class="table" id="general_data">
                                    <thead>
                                        <tr>
                                        <th>CUS NAME</th>
                                            <th>REQ ID</th>
                                            <th>REQ TYPE</th>
                                            <th>CUS ID</th>
                                            <th>CARD NO</th>
                                            <th>USER ID</th>
                                            <th>MAJ SER CODE</th>
                                            <th>SER CODE</th>
                                            <th>REQ DESC</th>
                                            <th>DATE CREATED</th>
                                            <th>REQ STATUS</th>
                                          
                                            <th>DONE BY</th>
                                             <th>REQ TAKE TIME</th>
                                             <th>REQ DONE TIME</th>
                                             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>CUS NAME</th>
                                            <th>REQ ID</th>
                                            <th>REQ TYPE</th>
                                            <th>CUS ID</th>
                                            <th>CARD NO</th>
                                            <th>USER ID</th>
                                            <th>MAJ SER CODE</th>
                                            <th>SER CODE</th>
                                            <th>REQ DESC</th>
                                            <th>DATE CREATED</th>
                                            <th>REQ STATUS</th>
                                           
                                            <th>DONE BY</th>
                                             <th>REQ TAKE TIME</th>
                                             <th>REQ DONE TIME</th>
                                            
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" tabindex="-1" role="dialog" id="add_gen_detail">
                        <div class="modal-dialog modal-dialog modal-dialog_style" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <button class="close" type="button"
                                        onclick="successtoaster('info','YOU CAN ADD NEW CUSTOMER TYPE WITH THIS MENU','INFORMATION')"><span
                                            aria-hidden="true">&quest;</span></button>
                                    <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span> Add
                                        Patient Detail</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="messages"></div>
                                    <p>
                                        <h4>Please note: </h4>Fields with this sign <span style="color:red">*</span> are
                                        mandatory
                                    </p>

                                    <form method="post" class="form-horizontal" id="add_gen_det_form"
                                        name="add_gen_det_form" action="" enctype=”multipart/form-data”>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label for="fname" class="col-sm-3 control-label">Patient Name
                                                        <span style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="add_CUSTOMERNAME"
                                                            name="add_CUSTOMERNAME" readonly placeholder="customer name">
                                                        <span id="error_add_CUSTOMERNAME" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','INSERT THE NAME OF THE CUSTOMER','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>

                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label for="fname" class="col-sm-3 control-label">Temprature <span
                                                            style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" min=1  id="add_temp"
                                                            name="add_temp" placeholder="">
                                                            <span id="error_add_temp" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','INSERT AGE OF CUSTOMER','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>

                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label for="fname" class="col-sm-3 control-label">Weight <span
                                                            style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" min=1  id="add_weight"
                                                            name="add_weight" placeholder="">
                                                            <span id="error_add_weight" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','INSERT WEIGHT OF A PATIENT IN KG','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>
                       

                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label for="fname" class="col-sm-3 control-label">Height <span
                                                            style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" min=1  id="add_height"
                                                            name="add_height" placeholder="">
                                                            <span id="error_add_height" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','INSERT HEIGHT OF A PATIENT IN METERS','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>

                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label for="fname" class="col-sm-3 control-label">SYSTOLICBP <span
                                                            style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control"  id="add_SYSTOLICBP"
                                                            name="add_SYSTOLICBP" placeholder="">
                                                            <span id="error_add_SYSTOLICBP" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','INSERT SYSTOLICBP OF A PATIENT ','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>

                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label for="fname" class="col-sm-3 control-label">DIASTOLICBP <span
                                                            style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control"  id="add_DIASTOLICBP"
                                                            name="add_DIASTOLICBP" placeholder="">
                                                            <span id="error_add_DIASTOLICBP" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','INSERT DIASTOLICBP OF A PATIENT ','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>

                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label for="fname" class="col-sm-3 control-label">PULSE RATE <span
                                                            style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control"  id="add_PULSE_RATE"
                                                            name="add_PULSE_RATE" placeholder="">
                                                            <span id="error_add_PULSE_RATE" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','INSERT DIASTOLICBP OF A PATIENT ','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>

                                                <div class="form-group">
                                                    <label for="lname" class="col-sm-3 control-label"> Send To <span style="color:red">*</span> </label>
                                                    <div class="col-sm-9"> 
                                                    <label class="radio-inline">
                                                      <input type="checkbox" name="M_SER_CODE" id="M_SER_CODE"  value="SR230" > Send to Medical Doctors
                                                    </label>
                                                
                                                    </div>
                                                </br>
                                                    <span id="error_send_to" class="text-danger"></span>
                                                    </div>
                                            </div>
      
                                        </div>

                                        <br>
                                       
                                       
                                        <div align="center">
                                            <div class="margin">

                                                <div class="btn-group">
                                                    <button type="submit" class="btn btn-primary">Save </button>

                                                    </button>
                                                </div>


                                            </div>


                                        </div>


                                </div>
                                </form>
                                <div align="center">


                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <!-- /add customer-->

                      <!-- user modal -->
                      <div class="modal fade" tabindex="-1" role="dialog" id="showUserModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-eye" aria-hidden="true"></i>User Information</h4>
	      </div>
	      
	      <form class="form-horizontal" action="" method="POST" id="showuserform" enctype=”multipart/form-data”>

	       <div class="modal-body">
	    
            <div class="row ">
            <div class="col-lg-10">
            <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-6 ">User Id</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="USER_ID" name="USER_ID" readonly>
             
            </div>
          </div>
          <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-12 ">Full Name</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="FULL_NAME" name="FULL_NAME" readonly>
           
            </div>
          </div>
            <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-6 ">Sex</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="SEX" name="SEX" readonly>
   
            </div>
          </div>
          <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-10 ">Phone Number</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="PHONENO" name="PHONENO" readonly>
              
            </div>
          </div>
          <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-10  ">Major Actor</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="MAJOR_ACTOR" name="MAJOR_ACTOR" readonly>
            
            </div>
          </div>
     
            <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-10 ">Profession</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="PROFESSION" name="PROFESSION" readonly>
              
            </div>
          </div>

            </div>
            </div>
</div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	       
	      </div>
	      </form> 
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
  <!-- /user modal -->
  
        <!-- customer modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="showCusModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-eye" aria-hidden="true"></i>Customer Information</h4>
	      </div>
	      
	      <form class="form-horizontal" action="" method="POST" id="showcusform" enctype=”multipart/form-data”>

	       <div class="modal-body">
	    
            <div class="row ">
            <div class="col-lg-10">
            <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-6 ">Customer Id</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="CUS_IDV" name="CUS_IDV" readonly>
             
            </div>
          </div>
          <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-12 ">Full Name</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="CUS_NAME" name="CUS_NAME" readonly>
           
            </div>
          </div>
            <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-6 ">Sex</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="SEXV" name="SEXV" readonly>
   
            </div>
          </div>
          <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-10 ">AGE</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="AGE" name="AGE" readonly>
              
            </div>
          </div>
          <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-10  ">Phone Number</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="PHONENOV" name="PHONENOV" readonly>
            
            </div>
          </div>
     
            <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-10 ">REGISTRATION DATE</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="REG_DATE" name="REG_DATE" readonly>
              
            </div>
          </div>

            </div>
            </div>
</div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	       
	      </div>
	      </form> 
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
  <!-- /customer modal -->
  
     <!-- service modal -->
     <div class="modal fade" tabindex="-1" role="dialog" id="showSerModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-eye" aria-hidden="true"></i>Service Information</h4>
	      </div>
	      
	      <form class="form-horizontal" action="" method="POST" id="showserform" enctype=”multipart/form-data”>

	       <div class="modal-body">
	    
            <div class="row ">
            <div class="col-lg-10">
            <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-6 ">Service Code</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="SERVICE_CODE" name="SERVICE_CODE" readonly>
             
            </div>
          </div>
          <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-12 ">Service Name</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="SERVICE_NAME" name="SERVICE_NAME" readonly>
           
            </div>
          </div>
            <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-6 ">Major Service Code</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="MAJOR_SER_CODE" name="MAJOR_SER_CODE" readonly>
   
            </div>
          </div>
          <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-10 ">Major Service Name</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="SER_NAME" name="SER_NAME" readonly>
              
            </div>
          </div>
          <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-10  ">Service Description</label>
            <div class="col-sm-12"> 
              <textarea cols=3 rows=2 class="form-control" id="DESCI" name="DESCI" readonly></textarea>
            
            </div>
          </div>
     
         

            </div>
            </div>
</div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	       
	      </div>
	      </form> 
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /service modal -->

                </div>
        </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php require APPROOT . '/views/customer/inc/footer.php'; ?>
<script src="<?php echo URLROOT ?>/public/assets/system scripts/general_detail.js"></script>
<script src="<?php echo URLROOT ?>/public/assets/bower_components/moment/moment.min.js"></script>
<script src="<?php echo URLROOT ?>/public/assets/bower_components/bootstrap-daterangepicker/daterangepicker.js">
</script>

</body>

</html>