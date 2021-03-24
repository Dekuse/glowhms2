<?php require APPROOT . '/views/customer/inc/header.php'; ?>
<?php require APPROOT . '/views/customer/inc/aside.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
                PROCESS PAYMENTS
            <small></small>
        </h1>

        <ol class="breadcrumb">
            <li class="active"><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></a>PROCESS PAYMENTS</li>
            <li class="active"></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="removeMessages"></div>
                <div class="">
                <form method="post" class="form-horizontal" id="payment_form"
                                        name="payment_form" action="" enctype=”multipart/form-data”>
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
                              <h4 class="box-title2">Payment Type</h4>
                          </div>         

                          <div class="">
                                        <select class="form-control control" name="PAY_TYPE" id="PAY_TYPE"
                                            title="">

                                            <option value="">SELECT</option>
                                                            <option value="CAR_T">CARD REQUEST</option>
                                                            
                                                            <option value="DIFFF">OTHER SERVICES</option>


                                        </select>
                                        <span id="" class="text-danger"></span>
                           </div>

                     </div>
                     <div class="form-group">
                                    <div class="box-header with-border">
                                        <h4 class="box-title2">Payment Status</h4>
                                    </div>

                                    <div class="">
                                        <select class="form-control control" name="PAY_STATUS" id="PAY_STATUS"
                                            title="">

                                            <option value="">SELECT</option>
                                                            <option value="TNP">PENDING</option>
                                                            <option value="TP">COMPLETED</option>
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
        <div class="col-lg-3">
        <div class="">
        </br>
        </br>
        </br>
        </br>
        </br>
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
                                    <button class="btn btn-info  pull pull-left" onclick="pro_single_payment()" id="resend">Process Payment
                                        </button>

                                    <button class="btn pull pull-right"
                                        onclick="successtoaster('info','USE THIS OPERATION IF YOU WANT TO PROCESS SINGLE PAYMENT WITH SINGLE PRINTOUT.','INFORMATION')"><i
                                            class="fa fa-question-circle"></i></button>
                                </div>

                                <br>
                                <div clas="row">
                                    <button class="btn pull pull-right"
                                        onclick="successtoaster('info','YOU CAN ADD NEW PAYMENT REQUEST WITH THIS BUTTON','INFORMATION')"><i
                                            class="fa fa-question-circle"></i></button>

                                    <button class="btn btn-default pull pull-right" data-toggle="modal"
                                        data-target="#addcustomer" id="addcus">
                                        <span class="glyphicon glyphicon-plus-sign"></span> Add Payment
                                    </button>
                                </div>


                                <br /> <br /> <br />


                                <table class="table" id="payment_data">
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
                                            <th>SER PRICE</th>
                                            <th>REQ DESC</th>
                                            <th>DATE CREATED</th>
                                            <th>REQ STATUS</th>
                                            <th>PAY STATUS</th>
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
                                            <th>SER PRICE</th>
                                            <th>REQ DESC</th>
                                            <th>DATE CREATED</th>
                                            <th>REQ STATUS</th>
                                            <th>PAY STATUS</th>
                                            <th>DONE BY</th>
                                             <th>REQ TAKE TIME</th>
                                             <th>REQ DONE TIME</th>
                                            
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" tabindex="-1" role="dialog" id="addcustomer">
                        <div class="modal-dialog modal-dialog modal-dialog_style" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <button class="close" type="button"
                                        onclick="successtoaster('info','YOU CAN ADD NEW CUSTOMER TYPE WITH THIS MENU','INFORMATION')"><span
                                            aria-hidden="true">&quest;</span></button>
                                    <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span> Add
                                        Customer</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="messages"></div>
                                    <p>
                                        <h4>Please note: </h4>Fields with this sign <span style="color:red">*</span> are
                                        mandatory
                                    </p>

                                    <form method="post" class="form-horizontal" id="addcustomerform"
                                        name="addcustomerform" action="" enctype=”multipart/form-data”>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label for="fname" class="col-sm-3 control-label">Customer Name
                                                        <span style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="add_CUSTOMERNAME"
                                                            name="add_CUSTOMERNAME" placeholder="customer name">
                                                        <span id="error_add_CUSTOMERNAME" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','INSERT THE NAME OF THE CUSTOMER','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>

                                                <div class="form-group radio">
                                                    <label for="lname" class="col-sm-3 control-label">Sex<span
                                                            style="color:red">*</span></label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control control control-label" name="add_SEX"
                                                            id="add_SEX" title="Sex">
                                                            <option value="">~~SELECT~~</option>
                                                            <option value="M">Male</option>
                                                            <option value="F">Female</option>
                                                        </select>
                                                        <span id="error_add_SEX" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','SELECT GENDER TYPE','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label for="fname" class="col-sm-3 control-label">Age <span
                                                            style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" min=1 value=1 id="add_AGE"
                                                            name="add_AGE" placeholder="bedroom counter">
                                                        <span id="bedcount" class=""></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','INSERT AGE OF CUSTOMER','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>


                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label class="col-sm-3 control-label">Mobile Number <span
                                                            style="color:red">*</span></label>
                                                    <div class="col-sm-8">

                                                        <div class="input-group col-sm-8">
                                                            <div class="input-group-addon">
                                                                <span class="">+251</span>
                                                            </div>
                                                            <input type="text" class="form-control " name="add_PHONENO"
                                                                id="add_PHONENO" data-inputmask='"mask": "(99) 999-9999"'
                                                                data-mask>


                                                        </div><!-- /.input group -->
                                                        <span id="error_add_PHONENO" class=""></span>
                                                    </div><!-- /.form group -->
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','ENTER PHONE NUMBER IN THE FOLLOWING FORMAT (99) 999-9999','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>
                                                <div class="form-group radio">
                                                    <label for="lname" class="col-sm-3 control-label">Walkin Card type<span
                                                            style="color:red">*</span></label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control control control-label" name="W_CARD_PR_TYPE"
                                                            id="W_CARD_PR_TYPE" title="">
                                                            <option value="">~~SELECT~~</option>
                                                            <option value="C76">WALKIN-VIP</option>
                                                            <option value="C77">WALKIN-REG</option>
                                                        </select>
                                                        <span id="error_W_CARD_PR_TYPE" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','SELECT GENDER TYPE','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>

                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group radio">
                                                    <label for="lname" class="col-sm-3 control-label">Region</label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control control" name="add_REGION" id="add_REGION"
                                                            title="REGION">
                                                            <option value="">~~SELECT~~</option>
                                                            <?php
						
                                                                        foreach($data['region'] as $regiontype) : 
                                                                    echo '<option value="';
                                                                echo $regiontype->REGION.'">';
                                                                                                            echo $regiontype->REGION; echo '</option>';
                                                                                                            
                                                                        endforeach;                                 
                                                                ?>

                                                        </select>
                                                        <span id="error_add_REGION" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','SELECT REGION OF THE USER','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label for="fname" class="col-sm-3 control-label">Customer City
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="add_CUSTOMERCITY"
                                                            name="add_CUSTOMERCITY" placeholder="customer city">
                                                        <span id="error_add_CUSTOMERCITY" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','INSERT THE NAME OF THE CUSTOMER','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>

                                                <div class="form-group radio">
                                                    <label for="lname" class="col-sm-3 control-label">Nationality<span
                                                            style="color:red">*</span></label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control control" name="add_NATIONALITY"
                                                            id="add_NATIONALITY" title="">
                                                            <option value="">~~SELECT~~</option>
                                                            <?php
						
                                                                    foreach($data['nation'] as $nationtype) : 
                                                                      echo '<option value="';
                                                                  echo $nationtype->CountryName.'">';
                                                                    echo $nationtype->CountryName; echo '</option>';
                                                                                                              
                                                                          endforeach;                                 
                                                                  ?>

                                                        </select>
                                                        <span id="error_add_NATIONALITY" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','SELECT NATIONALITY OF THE CUSTOMER','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>

                                                <div class="form-group radio">
                                                    <label for="lname" class="col-sm-3 control-label">Services<span
                                                            style="color:red">*</span></label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control control" name="add_SERVICE"
                                                            id="add_SERVICE" title="">
                                                            <option value="">~~SELECT~~</option>
                                                            <?php
						
                                                                foreach($data['services'] as $services) : 
                                                                  echo '<option value="';
                                                              echo $services->SERVICE_CODE.'">';
                                                                  echo $services->SERVICE_NAME." with ".$services->PRICE." price"; echo '</option>';
                                                                                                          
                                                                      endforeach;                                   
                                                                    ?>

                                                        </select>
                                                        <span id="error_add_service" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','SELECT NATIONALITY OF THE CUSTOMER','INFORMATION')"><span
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
     
            <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-10 ">Price</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="PRICE" name="PRICE" readonly>
              
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

  
	<!-- card modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="pay_card_modal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<button class="close" type="button" onclick="successtoaster('info','YOU CAN PROCESS NEW CARD PAYMENTS WITH THIS FORM','INFORMATION')"><span aria-hidden="true">&quest;</span></button>

	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> NEW CARD</h4>
	      </div>

		<form class="form-horizontal" action="" method="POST" id="paycardform" name="paycardform">	      

	      <div class="modal-body">
	        	
	        <div class="edit-messages"></div>
			<p><h3>Please note: </h3>Fields with this sign <span style="color:red">*</span> are mandatory</p>
					<span style="color:red" id="whatever"> </span>
        

					<div class="form-group radio">
			 <label for="lname" class="col-sm-3 control-label">CARD TYPE<span style="color:red">*</span></label>
 
   <div class="col-sm-8">
			      <select class="form-control control" name="CARD_TYPE" id="CARD_TYPE" title="" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['card_data'] as $card_data) : 
		echo '<option value="';
	echo $card_data->CARD_PR_TYPE.'">';
												echo $card_data->CARD_PR_PRICE.' Birr with duration for '.$card_data->DURATION.' days and with priority '.$card_data->PRIORITY; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_edit_CARD_TYPE" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','SELECT CARD TYPE','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
	
  </div>
				 <br>
			
			
			 
				 <br>
			  </div>
			
			

	      <div class="modal-footer editMemberModal">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
	      </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /card modal -->

	<!-- card modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="pay_ser_modal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<button class="close" type="button" onclick="successtoaster('info','YOU CAN PROCESS NEW PAYMENT REQUESTS WITH THIS FORM','INFORMATION')"><span aria-hidden="true">&quest;</span></button>

	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> PROCESS PAYMENT</h4>
	      </div>

		<form class="form-horizontal" action="" method="POST" id="payserform" name="payserform">	      

	      <div class="modal-body">
	        	
	        <div class="edit-messages"></div>
         
          <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-10 ">PAID AMOUNT</label>
            <div class="col-sm-12"> 
              <input type="number" class="form-control" id="PAID_AMOUNT" name="PAID_AMOUNT" >
              <span id="error_PAID_AMOUNT" class="text-danger"></span>
            </div>
          </div>
          <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-10 ">LEFT AMOUNT</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="LEFT_AMOUNT" name="LEFT_AMOUNT" readonly>
              <span id="error_LEFT_AMOUNT" class="text-danger"></span>
            </div>
          </div>
        
          <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-10 ">PRICE</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="SER_PRICE" name="SER_PRICE" readonly>
              
            </div>
          </div>
				 <br>
			
         <div class="form-group radio">
                                                    <label for="" class="col-sm-10 ">PAYMENT TYPE</label>

                                                    <div class="col-sm-12">
                                                        <select class="form-control control control-label" name="PAYMENT TYPE"
                                                            id="PAYMENT_TYPE" title="PAYMENT_TYPE">
                                                            <option value="">~~SELECT~~</option>
                                                            <option value="PRE">PRE</option>
                                                            <option value="PRE-POST">PRE-POST</option>
                                                        </select>
                                                        <span id="error_PAYMENT_TYPE" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','SELECT PAYMENT TYPE, THIS OPTION IS AUTOMATICALLY CORRECTED AFTER YOU INPUT THE AMOUT OF MONEY TO BE PAID','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>
                                                <br>
			
			 
				 <br>
			  </div>
			
			

	      <div class="modal-footer editMemberModal">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
	      </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /card modal -->



                </div>
        </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php require APPROOT . '/views/customer/inc/footer.php'; ?>
<script src="<?php echo URLROOT ?>/public/assets/system scripts/process_payment.js"></script>
<script src="<?php echo URLROOT ?>/public/assets/bower_components/moment/moment.min.js"></script>
<script src="<?php echo URLROOT ?>/public/assets/bower_components/bootstrap-daterangepicker/daterangepicker.js">
</script>

</body>

</html>