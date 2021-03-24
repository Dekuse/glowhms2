<?php require APPROOT . '/views/customer/inc/header.php'; ?>
<?php require APPROOT . '/views/customer/inc/aside.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            BED
            <small></small>
          </h1>
		  
          <ol class="breadcrumb">
            <li class="active"><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></a>BED</li>
            <li class="active"></li>
          </ol>
        </section>

        <!-- Main content -->
		<section class="content">
        <div class="row">
        <div class="col-xs-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#beds" data-toggle="tab" aria-expanded="true">BEDS </a></li>
              <li class=""><a href="#freebed" data-toggle="tab" aria-expanded="false">AVAILABLE BEDS</a></li>
            </ul>
			</div>
            <div class="tab-content">
              <!-- Font Awesome Icons -->
              <div class="tab-pane active" id="beds">
         
			  <div class="box">
 <div class="container col-md-12">
		<div class="row col-md-12 ">
			<div class="col-md-12">

				 

				<div class="removeMessages"></div>
				<form method="post" class="form-horizontal" id="bed_form"
                                        name="bed_form" action="" enctype=”multipart/form-data”>
				<div class="row">



							<div class="form-group col-md-3">
								<!--/here teh addclass has-error will appear -->
										<div class="box-header with-border">
											<h4 class="box-title">Customer Name</h4>
										</div>
										<div clas="row">

												<div class="col-md-9">
													<input type="text" class="form-control" id="CUSTOMER_NAME" name="CUSTOMER_NAME"
														placeholder="customer name">
													<span id="error_CUSTOMER_NAME" class="text-danger"></span>
												</div>

												<button class="btn pull pull-right col-md-3"
													onclick="successtoaster('info','YOU CAN USE % SIGN AFTER OR BEFORE WRITING THE NAME OF THE CUSTOMER','INFORMATION')"><i
														class="fa fa-question-circle"></i></button>


										</div>

							</div>

						    <div class="col-md-4">
                    <div class="box-header with-border">
                            <h4 class="box-title">Customer Id</h4>
                        </div>
                    <div class="row">
                            <div class="col-md-9">
                                                     <div class="form-group">
                                                        <div class="input-group ">
                                                            <div class="input-group-addon">
                                                                <span class="">CUS</span>
                                                            </div>
                                                            <input type="number" class="form-control" id="CUSTOMER_ID" name="CUSTOMER_ID"
                                    placeholder="CUSTOMER ID">


                                                        </div><!-- /.input group -->
                                                    </div>
                            
                                                       
                            </div>
                            <button class="btn pull pull-right col-md-3"
                                onclick="successtoaster('info','JUST PUT THE NUMBER OF THE CUSTOMER, NO NEED TO WRITE CUS','INFORMATION')"><i
                                    class="fa fa-question-circle"></i></button>
                    </div>
    
                    </div>

							<div class="col-md-3">
										<div class="box-header with-border">
											<h4 class="box-title"></h4>
										</div>
										<div class="row">
												<div class="col-md-10">
													<button type="btn" onclick="beddata()" id="customer_submit" name="customer_submit"
														class="btn btn-primary pull pull-right">Submit</button>
												</div>
												<div class="col-md-2">
													<button class="btn "
														onclick="successtoaster('info','YOU CAN SEARCH FOR A CUSTOMER WITH THIS SET OF FORM IF YOU DO NOT KNOW THE ID OF THE CUSTOMER IT IS BETTER TO SEARCH USING THE DATE ONLY.','INFORMATION')"><i
															class="fa fa-question-circle"></i></button>
												</div>
										</div>
							</div>
				</div>
				
			</form>
		

						<table class="table" id="bed_table">					
								<thead>
										<tr>
												<th>NO</TH>
												<th>CUSTOMER ID</th>	
												<th>CUSTOMER NAME</th>	
												<th>CARD NUMBER</th>													
																
												<th>BED ID</th>
												<th>MAJOR BED CATAGORY</th>
												<th>DATE CREATE</th>
												<th>DATE LEAVE</th>
												
										</tr>
								</thead>
								<tfoot>
										<tr>
												<th>NO</TH>
												<th>CUSTOMER ID</th>
												<th>CUSTOMER NAME</th>		
												<th>CARD NUMBER</th>													
																
												<th>BED ID</th>
												<th>MAJOR BED CATAGORY</th>
												<th>DATE CREATE</th>
												<th>DATE LEAVE</th>
										</tr>
								</tfoot>
							</table>
			</div>
		</div>
	</div>


              </div><!-- /.box -->
              </div>
              <!-- END FOR BED MAJOR TAB -->
	
              <!-- START FOR BEDS TAB-->
              <div class="tab-pane" id="freebed">
               
			  <div class="box">
 <div class="container col-md-12">
		<div class="row col-md-12 ">
			<div class="col-md-12">

				 

				<div class="removeMessages"></div>
			
				<div class="row">

				<div class="col-md-3">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">Bed Status</h4>
                                    </div>

                                    <div class="">
                                        <select class="form-control control" name="BED_STATUS" id="BED_STATUS"
                                            title="Visa Type">

                                            <option value="">SELECT</option>
                                                            <option value="F">FREE</option>
                                                            <option value="NF">NOT FREE</option>
                                                         
                                        </select>
                                        <span id="" class="text-danger"></span>
                                    </div>

                                </div>

							<div class="col-md-3">
										<div class="box-header with-border">
											<h4 class="box-title"></h4>
										</div>
										<div class="row">
												<div class="col-md-10">
													<button type="btn" onclick="get_bedstatus()" id="customer_submit" name="customer_submit"
														class="btn btn-primary pull pull-right">Submit</button>
												</div>
												<div class="col-md-2">
													<button class="btn "
														onclick="successtoaster('info','YOU CAN SEARCH FOR A CUSTOMER WITH THIS SET OF FORM IF YOU DO NOT KNOW THE ID OF THE CUSTOMER IT IS BETTER TO SEARCH USING THE DATE ONLY.','INFORMATION')"><i
															class="fa fa-question-circle"></i></button>
												</div>
										</div>
							</div>
				</div>
	
</br>
				<table class="table" id="freebed_table">					
					<thead>
						<tr>
						
						<th>Bedroom Id</th>
							<th>Bed Type</th>	
							<th>Bedroom Price</th>	
							<th>Bed availability</th>	
							<th>Bed Held by</th>
								
								
						</tr>
					</thead>
					  <tfoot>
                <tr>
				
				<th>Bedroom Id</th>
							<th>Bed Type</th>	
							<th>Bedroom Price</th>	
							<th>Bed availability</th>	
							<th>Bed Held by</th>
                </tr>
                </tfoot>
				</table>
			</div>
		</div>
	</div>


              </div><!-- /.box -->
              </div>

			           <!-- foreign modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="showCusModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-eye" aria-hidden="true"></i>Customer Information</h4>
	      </div>
	      
	      <form class="form-horizontal" action="" method="POST" id="createMemberForm" enctype=”multipart/form-data”>

	       <div class="modal-body">
	    
            <div class="row ">
            <div class="col-lg-10">
            <div class="form-group"> <!--/here teh addclass has-error will appear -->
            <label for="name" class="col-sm-6 ">Customer Id</label>
            <div class="col-sm-12"> 
              <input type="text" class="form-control" id="CUS_ID" name="CUS_ID" readonly>
             
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
              <input type="text" class="form-control" id="SEX" name="SEX" readonly>
   
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
              <input type="text" class="form-control" id="PHONENO" name="PHONENO" readonly>
            
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
	<!-- /foreign modal -->
              <!-- /#ion-icons -->

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      
 

    </section>

      </div><!-- /.content-wrapper -->
      <?php require APPROOT . '/views/administrator/inc/footer.php'; ?>
			<script src="<?php echo URLROOT ?>/public/assets/system scripts/bedfunction.js"></script>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
       
  </body>
</html>