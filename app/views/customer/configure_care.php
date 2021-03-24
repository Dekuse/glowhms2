<?php require APPROOT . '/views/customer/inc/header for c_care.php'; ?>
<?php require APPROOT . '/views/customer/inc/aside.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
                CONFIGURE DAILY CARE
            <small></small>
        </h1>

        <ol class="breadcrumb">
            <li class="active"><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></a>CONFIGURE</li>
            <li class="active"></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="removeMessages"></div>
                <div class="">
                <form method="post" class="form-horizontal" id="input_care_form"
                                        name="input_care_form" action="" enctype=”multipart/form-data”>
                <div class="row">
                <div class="col-md-1">
                </div>

    
                    <div class="col-md-3">
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
                </div>
             <!-- Main table -->
                <div class="box">
                    <div class="container col-md-12">
                        <div class="row col-md-12 ">
                            <div class="col-md-12">
                               </br>
                                <div class="btn-group">
                                    <button class="btn btn-info  pull pull-left" onclick="pro_mcare_data()" id="resend">Configure
                                        </button>

                                    <button class="btn pull pull-right"
                                        onclick="successtoaster('info','USE THIS OPERATION IF YOU WANT TO PROCESS SINGLE PAYMENT WITH SINGLE PRINTOUT.','INFORMATION')"><i
                                            class="fa fa-question-circle"></i></button>
                                </div>

                                <br>
                                <br /> <br /> <br />
                                <table class="table" id="care_data">
                                    <thead>
                                        <tr>
                                      
                                            <th>CUS ID</th>
                                            <th>CARD NO</th>
                                            <th>DATE CREATED</th>
                                            <th>CARD TYPE</th>
                                            <th>CARD STATUS</th>
                                          
   
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>CUS ID</th>
                                            <th>CARD NO</th>
                                            <th>DATE CREATED</th>
                                            <th>CARD TYPE</th>
                                            <th>CARD STATUS</th>
                                            
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" tabindex="-1" role="dialog" id="add_major_care">
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

                                    <form method="post" class="form-horizontal" id="major_care_form"
                                        name="major_care_form" action="" enctype=”multipart/form-data”>
                                        <div class="row">
                                            <div class="col-lg-6">

                                            <div class="form-group">
                                                    <label for="fname" class="col-sm-3 control-label">CARE START TIME <span
                                                            style="color:red">*</span></label>
                                                            <div class="form-group">
                                                            <div class='input-group date col-sm-6' id='care_start_picker'>
                                                                <input type='text' id="CARE_START_TIME" name="CARE_START_TIME" class="form-control" />
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </span>
                                                               
                                                            </div>
                                                            <div>
                                                                <span id="error_CARE_START_TIME" class="text-danger"></span>
                                                                </div>
                                                        </div>
                                               </div>
                                          

                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label for="fname" class="col-sm-3 control-label">REQUIRED TREATMENT <span
                                                            style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                    <textarea cols=3 rows=2 class="form-control" id="REQUIRE_TREAT" name="REQUIRE_TREAT" ></textarea>
                                                            <span id="error_REQUIRE_TREAT" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','INSERT AGE OF CUSTOMER','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>

                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label for="fname" class="col-sm-3 control-label">DOSE LIST <span
                                                            style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                    <textarea cols=3 rows=2 class="form-control" id="DOSE_LIST" name="DOSE_LIST" ></textarea>

                                                            <span id="error_DOSE_LIST" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','INSERT AGE OF CUSTOMER','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>

                                                <div class="form-group">
                                                  
                                                  <!--/here teh addclass has-error will appear -->
                                                  <label for="fname" class="col-sm-3 control-label">Bed Id
                                                      <span style="color:red">*</span></label>
                                                  <div class="col-sm-8">
                                                      <input type="number" class="form-control" id="BED_ID"
                                                          name="BED_ID"  placeholder="">
                                                      <span id="error_BED_ID" class="text-danger"></span>
                                                  </div>
                                                  <label class="col-sm-1 control-label"> <button class="close"
                                                          type="button"
                                                          onclick="successtoaster('info','INSERT THE NAME OF THE CUSTOMER','INFORMATION')"><span
                                                              aria-hidden="true">&quest;</span></button>
                                                  </label>
                                              </div>
                                              

                                            </div>
                                            <div class="col-lg-6">
                                            
                                                 
                                            <div class="form-group">
                                                  
                                                  <!--/here teh addclass has-error will appear -->
                                                  <label for="fname" class="col-sm-3 control-label">DOSE AMOUNT ON SINGLE TAKE
                                                      <span style="color:red">*</span></label>
                                                  <div class="col-sm-8">
                                                      <input type="number" class="form-control" id="DOSE_COUNT_SINGLE"
                                                          name="DOSE_COUNT_SINGLE"  placeholder="">
                                                      <span id="error_DOSE_COUNT_SINGLE" class="text-danger"></span>
                                                  </div>
                                                  <label class="col-sm-1 control-label"> <button class="close"
                                                          type="button"
                                                          onclick="successtoaster('info','INSERT THE NAME OF THE CUSTOMER','INFORMATION')"><span
                                                              aria-hidden="true">&quest;</span></button>
                                                  </label>
                                              </div>
                                              
                                               <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label for="fname" class="col-sm-3 control-label">HOW MANY DOSE ALLOWED <span
                                                            style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" min=1  id="DOSE_COUNT"
                                                            name="DOSE_COUNT" placeholder="">
                                                            <span id="error_DOSE_COUNT" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','INSERT WEIGHT OF A PATIENT IN KG','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>

                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label for="fname" class="col-sm-3 control-label">HOUR DIFFERENCE BETWEEN EVERY DOSE <span
                                                            style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" min=1  id="HOUR_DIFF"
                                                            name="HOUR_DIFF" placeholder="">
                                                            <span id="error_HOUR_DIFF" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','INSERT HEIGHT OF A PATIENT IN METERS','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
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
  
     

                </div>
        </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php require APPROOT . '/views/customer/inc/footer.php'; ?>
<script src="<?php echo URLROOT ?>/public/assets/system scripts/setup_care.js"></script>
<script src="<?php echo URLROOT ?>/public/assets/bower_components/moment/moment.min.js"></script>
<script src="<?php echo URLROOT ?>/public/home assests/vendors/bootstrap-datepicker/bootstrap-datetimepicker.js"></script>
<script src="<?php echo URLROOT ?>/public/assets/bower_components/bootstrap/js/collapse.js"></script>
<script src="<?php echo URLROOT ?>/public/assets/bower_components/bootstrap/js/transition.js"></script>

</script>

</body>

</html>