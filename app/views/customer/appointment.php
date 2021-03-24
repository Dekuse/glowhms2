<?php require APPROOT . '/views/customer/inc/header.php'; ?>
<?php require APPROOT . '/views/customer/inc/aside.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
                APPOINTMENT
            <small></small>
        </h1>

        <ol class="breadcrumb">
            <li class="active"><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></a>WORKFLOW</li>
            <li class="active"></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="removeMessages"></div>
                <form method="post" class="form-horizontal" id="appoint_para_form"
                                        name="appoint_para_form" action="" enctype=”multipart/form-data”>
                <div class="row">
                <div class="col-md-3">
                        <div class="box-header with-border">
                            <h4 class="box-title">Appointment Date</h4>
                        </div>
                        <div class="col-md-3" id="officer_reportrange"
                            style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <input type="text" name="APP_DATE" id="APP_DATE" width="30" readonly
                                value=""><i
                                class="fa fa-caret-down"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">Appointment Type</h4>
                                    </div>

                                    <div class="">
                                        <select class="form-control control" name="APP_TYPE" id="APP_TYPE"
                                            title="Visa Type">

                                            <option value="">SELECT</option>
                                                            <option value="DOC">APPOINTMENT WITH DOCTORS</option>
                                                            <option value="TEST">APPOINTMENT WITH IMAGING OR LAB DOCTORS</option>


                                        </select>
                                        <span id="" class="text-danger"></span>
                                    </div>

                                </div>

                                <div class="col-md-2">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">App Status</h4>
                                    </div>

                                    <div class="">
                                        <select class="form-control control" name="APP_STATUS" id="APP_STATUS"
                                            title="Visa Type">

                                            <option value="">SELECT</option>
                                                            <option value="P">PENDING</option>
                                                            <option value="IC">IN COMPLETE</option>
                                                            <option value="C">COMPLETED</option>
                                                            <option value="C">IN PROCESS</option>
                                        </select>
                                        <span id="" class="text-danger"></span>
                                    </div>

                                </div>


                    <div class="col-md-2">
                    <div class="box-header with-border">
                            <h4 class="box-title">Card No</h4>
                        </div>
                    <div class="row">
                            <div class="col-md-8">
                                                     <div class="form-group">
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
    
                    
                    <div class="col-md-2">
                        <div class="box-header with-border">
                            <h4 class="box-title"></h4>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                            <button type="submit" class="btn btn-primary">Submit </button>
                            </div>
                            <label class="col-sm-1 control-label">
                            <a class=""
                                onclick="successtoaster('info','YOU CAN GET LIST OF APPOINTMENTS, YOU CAN GET LIST OF APPOINTMENTS BY SEARCHING FROM THE LIST OF THE PARAMETERS','INFORMATION')"><i
                                    class="fa fa-question-circle"></i></a>
                                    </label>
                           
                        </div>

                    </div>
                    </form>
                </div>
             <!-- Main table -->
                <div class="box">
                    <div class="container col-md-12">
                        <div class="row col-md-12 ">
                            <div class="col-md-12">
                               </br>
                               

                                <table class="table" id="appoint_data">
                                    <thead>
                                        <tr>

                                            <th>APPOINTMENT TYPE</th>
                                            <th>APPOINTMENT ID</th>
                                            <th>CARD NO</th>
                                            <th>CUSTOMER ID</th>
                                            <th>USER ID</th>
                                            <th>SERVICE CODE</th>
                                            <th>APPOINTMENT DATE</th>
                                            <th>APPOINTMENT DESC</th>
                                            <th>LEFT TIME</th>
                                            <th>PAYMENT REQUIRED</th>
                                            <th>APPOINTMENT STATUS</th>
                                             <th>OPTIONS</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>APPOINTMENT TYPE</th>
                                            <th>APPOINTMENT ID</th>
                                            <th>CARD NO</th>
                                            <th>CUSTOMER ID</th>
                                            <th>USER ID</th>
                                            <th>SERVICE CODE</th>
                                            <th>APPOINTMENT DATE</th>
                                            <th>APPOINTMENT DESC</th>
                                            <th>LEFT TIME</th>
                                            <th>PAYMENT REQUIRED</th>
                                            <th>APPOINTMENT STATUS</th>
                                             <th>OPTIONS</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                      <!-- foreign modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="showUserModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-eye" aria-hidden="true"></i>User Information</h4>
	      </div>
	      
	      <form class="form-horizontal" action="" method="POST" id="createMemberForm" enctype=”multipart/form-data”>

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
	<!-- /foreign modal -->


                </div>
        </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php require APPROOT . '/views/customer/inc/footer.php'; ?>
<script src="<?php echo URLROOT ?>/public/assets/system scripts/appointment.js"></script>
<script src="<?php echo URLROOT ?>/public/assets/bower_components/moment/moment.min.js"></script>
<script src="<?php echo URLROOT ?>/public/assets/bower_components/bootstrap-daterangepicker/daterangepicker.js">
</script>

</body>

</html>