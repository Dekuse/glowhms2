<?php require APPROOT . '/views/customer/inc/header.php'; ?>
<?php require APPROOT . '/views/customer/inc/aside.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
                 DAILY CARE
            <small></small>
        </h1>

        <ol class="breadcrumb">
            <li class="active"><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></a>DAILY CARE</li>
            <li class="active"></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="removeMessages"></div>
                <div class="">
                <form method="post" class="form-horizontal" id="care_form"
                                        name="care_form" action="" enctype=”multipart/form-data”>
                <div class="row">
                <div class="col-md-1">
                </div>

    
                    <div class="col-md-3">
                    <div class="box-header with-border">
                            <h4 class="box-title">Card No</h4>
                        </div>
                    <div class="row">
                            <div class="col-md-6">
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
                                        <h4 class="box-title">Care Status</h4>
                                    </div>

                                    <div class="">
                                        <select class="form-control control" name="CARE_STATUS" id="CARE_STATUS"
                                            title="">

                                            <option value="">SELECT</option>
                                                            <option value="P">PENDING</option>
                                                            
                                                            <option value="C">COMPLETED</option>
                                                            <option value="IC">IN COMPLETE</option>
                                                          
                                        </select>
                                        <span id="" class="text-danger"></span>
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
                                    <button class="btn btn-info  pull pull-left" onclick="complete_care()" id="resend">Complete care
                                        </button>

                                    <button class="btn pull pull-right"
                                        onclick="successtoaster('info','USE THIS OPERATION IF YOU WANT TO PROCESS SINGLE PAYMENT WITH SINGLE PRINTOUT.','INFORMATION')"><i
                                            class="fa fa-question-circle"></i></button>
                                </div>

                                <br>
                                <br /> <br /> <br />
                                <table class="table" id="daily_care">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>CUS ID</th>
                                            <th>CARD NO</th>
                                            <th>BED ID</th>
                                            <th>CARD GIVEN BY</th>
                                            <th>REQUIRED DOSE</th>
                                            <th>REQUIRED TIME</th>
                                            <th>TIME GIVEN</th>
                                            <th>CARE STATUS</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>ID</th>
                                            <th>CUS ID</th>
                                            <th>CARD NO</th>
                                            <th>BED ID</th>
                                            <th>CARD GIVEN BY</th>
                                            <th>REQUIRED DOSE</th>
                                            <th>REQUIRED TIME</th>
                                            <th>TIME GIVEN</th>
                                            <th>CARE STATUS</th>
                                            
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal modal-info fade" tabindex="-1" role="dialog" id="complete_modal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-check-circle-o"></i> Complete Care</h4>
	      </div>
	      <div class="modal-body">
	        <p>Are you sure ?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-outline" id="completeBtn">Save changes</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
                   
  
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
<script src="<?php echo URLROOT ?>/public/assets/system scripts/daily_care.js"></script>
</script>



</body>

</html>