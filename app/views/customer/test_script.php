<?php require APPROOT . '/views/customer/inc/header.php'; ?>
<?php require APPROOT . '/views/customer/inc/aside.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
                REQUESTS
            <small></small>
        </h1>

        <ol class="breadcrumb">
            <li class="active"><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></a>REQUESTS</li>
            <li class="active"></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="removeMessages"></div>
                <div class="">
                <form method="post" class="form-horizontal" id="request_form"
                                        name="request_form" action="" enctype=”multipart/form-data”>
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
                                    <div class="box-header with-border">
                                        <h4 class="box-title2">Request Type</h4>
                                    </div>

                                    <div class="">
                                        <select class="form-control control" name="REQ_TYPE" id="REQ_TYPE"
                                            title="">

                                            <option value="">SELECT</option>
                                            <?php
						
                                                foreach($data['roles'] as $roles) : 
                                            echo '<option value="';
                                        echo $roles->MAJOR_SER_CODE.'">';
                                        echo $roles->MAJOR_SER_NAME; echo '</option>';
                                                                                    
                                                endforeach;                                 
                                        ?>
                                        </select>
                                        <span id="" class="text-danger"></span>
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
                   
                                <br>
                                <br /> <br /> <br />
                                <table class="table" id="request_data">
                                    <thead>
                                        <tr>
                                        <th>PROCESS</th>
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
                                        <th>PROCESS</th>
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
<script src="<?php echo URLROOT ?>/public/assets/system scripts/requests.js"></script>
<script src="<?php echo URLROOT ?>/public/assets/bower_components/moment/moment.min.js"></script>
<script src="<?php echo URLROOT ?>/public/assets/bower_components/bootstrap-daterangepicker/daterangepicker.js">
</script>

</body>

</html>