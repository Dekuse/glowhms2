<?php require APPROOT . '/views/officer/inc/header.php'; ?>
<?php require APPROOT . '/views/officer/inc/aside.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Passport Data
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li class="active"><a href=""><i class="fa fa-dashboard"></i> New Customer</a></li>
            <li><a href="#"></a></li>
            <li class="active"></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
          

              <div class="box">
 <div class="container col-md-12">
		<div class="row col-md-12 ">
			<div class="col-md-12">

				 <br />
				 <div class="MAINPAGEmessages"></div>
				<div class="removeMessages"></div>

	<button class="btn btn-info  pull pull-left" onclick="addcus()" id="updatePassportModalBtn">New Customer	 </button> 
				
				</button>

				<br /> <br /> <br />

				<table class="table" id="CompanyForeign">					
					<thead>
						<tr>
						
						<th>Person ID</th>	
							<th>Full Name</th>		
							<th>Birth Day</th>	
							<th>Sex</th>												
							<th>Registration Date</th>
							
							<th>Passport </th>
							<th>Visa</th>
				
							
							
						</tr>
						
					</thead>
					  <tfoot>
						<tr>
					
						<th>Person ID</th>	
							<th>Full Name</th>	
							
							<th>Birth Day</th>		
							<th>Sex</th>											
							<th>Registration Date</th>
							
							<th>Passport </th>
							<th>Visa</th>
					
							
							
						</tr>
                </tfoot>
				</table>
			</div>
		</div>
	</div>


			  
			  <!-- update visa modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="updateVisaModal">
	  <div class="modal-dialog modal-dialog modal-dialog_style" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>	Update Visa File</h4>
	      </div>
				<div class="modal-body">
	      	<div class="messages"></div>
					<p><h4>Please note: </h4>Fields with this sign <span style="color:red">*</span> are mandatory</p>
                   
	      <form method="post" class="form-horizontal" id="visa_form" name="visa_form" action=""  enctype=”multipart/form-data”>
				<div class="row">
				<div class="col-lg-6">
				<div class="form-group"> <!--/here teh addclass has-error will appear -->
				 <label for="" class="col-sm-3 control-label">Date Of Issue <span style="color:red">*</span></label>
				 <div class="col-sm-9"> 
					 <input type="text" class="form-control" id="vdofi" name="vdofi" readonly placeholder="<?php echo date('d-m-Y')?>">
					 <span id="error_vdofi" name="error_vdofi" class=""></span>
				 </div>
			 </div>
			
			 <div class="form-group radio">
			 <label for="lname" class="col-sm-3 control-label">Date of Expiry<span style="color:red">*</span></label>
 
   <div class="col-sm-9">
			      <select class="form-control control" name="vdofe" id="vdofe" title="Visa Type" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['duration'] as $durationtype) : 
		echo '<option value="';
	echo $durationtype->visaDuration.'">';
												echo $durationtype->DurationCode; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_vdofe" class="text-danger"></span>
			    </div>
		  
  </div>
				 <br>

			 <div class="form-group radio">
			 <label for="lname" class="col-sm-3 control-label">Place Of Issue<span style="color:red">*</span></label>
 
   <div class="col-sm-9">
			      <select class="form-control control" name="vpoi" id="vpoi" title="Visa Type" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['place'] as $placetype) : 
		echo '<option value="';
	echo $placetype->ShortCode.'">';
												echo $placetype->Desci; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_vpoi" class="text-danger"></span>
			    </div>
	
  </div>
				 <br>
			
				<div class="form-group"> <!--/here teh addclass has-error will appear -->
				 <label for="lname" class="col-sm-3 control-label">Visa Number<span style="color:red">*</span></label>
				 <div class="col-sm-9"> 
					 <input type="text" class="form-control" id="visano"  name="visano" placeholder="">
					 <span id="error_visano" name="error_visano" class=""></span>
				 </div>
			 </div>
			 <div class="form-group radio">
			 <label for="lname" class="col-sm-3 control-label">Visa Type<span style="color:red">*</span></label>
 
   <div class="col-sm-9">
			      <select class="form-control control" name="vt" id="vt" title="Visa Type" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['visa'] as $visatype) : 
		echo '<option value="';
	echo $visatype->ShortCode.'">';
												echo $visatype->Desci; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_vt" class="text-danger"></span>
			    </div>
		  
  </div>
				 <br>
			
			 <div class="form-group radio">
			 <label for="lname" class="col-sm-3 control-label">No. Entries<span style="color:red">*</span></label>

   <div class="col-sm-9">
			      <select class="form-control control" name="ver" id="ver" title="Visa Type" >
			      	<option value="">~~SELECT~~</option>
							<option value="S">Single</option>
							<option value="M">Multiple</option>
               
			      	
			      </select>
						<span id="error_ver" class="text-danger"></span>
			    </div>
		  
	</div>
	<br>
	<div class="form-group radio">
			 <label for="lname" class="col-sm-3 control-label">Select Print Section<span style="color:red">*</span></label>
 
   <div class="col-sm-9">
			      <select class="form-control control" name="section" id="section" title="Visa Type" >
							<option value="">~~SELECT~~</option>
							<option value="1">Section 1</option>
							<option value="2">Section 2</option>
							<option value="3">Section 3</option>
			      </select>
						<span id="error_section" class="text-danger"></span>
			    </div>
		  
  </div>
	
				</div>
				<div class="col-lg-6">
				<div class="form-group"> <!--/here teh addclass has-error will appear -->
				 <label for="lname" class="col-sm-3 control-label">Full Data</label>
				 <div class="col-sm-9"> 
				 <textarea name="data" id="data" rows="10"  cols="50"  ></textarea>
					 <span id="error_data" name="error_data" class=""></span>
				 </div>
			 </div>
			 <div class="form-group"> <!--/here teh addclass has-error will appear -->
				 <label for="lname" class="col-sm-3 control-label">Passport Given Date <span style="color:red">*</span></label>
				 <div class="col-sm-9"> 
					 <input type="text"  class="form-control" id="pgivendate" name="pgivendate" placeholder="">
					 <span id="error_pgivendate" name="error_pgivendate" class=""></span>
				 </div>
			 </div>
				</div>
				</div>
				
				 <br>
	
			 <div align="center">
			 
	 

 

	 
 <div class="margin">
           
					 <div class="btn-group">
					 <button type="submit" name="submitVisa" id="submitVisa" class="btn btn-info ">Add & Print</button>

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
	<!-- /update visa modal -->
			
			
<!-- show passport modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="showPassportModal">
	  <div class="modal-dialog modal-dialog_style" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-eye" aria-hidden="true"></i>Passport Information</h4>
	      </div>
	      
	     

	       <div class="modal-body">
         
				<table class="table" id="passportTable">					
					<thead>
						<tr>
                        	
							<th>Person Id</th>													
							<th>Passport No</th>
                            <th>Issue Date</th>
                            <th>Expiry Date</th>
						
                            <th>Days Left</th>
							 <th>Expiry Status</th>
                            <th>Active Status</th>
                           <th>Is Valid</th>
                            
						</tr>
					</thead>
					  <tfoot>
                <tr>
                           
                            <th>Person Id</th>													
							<th>Passport No</th>
                            <th>Issue Date</th>
                            <th>Expiry Date</th>
							
                            <th>Days Left</th>
							 <th>Expiry Status</th>
                            <th>Active Status</th>
					<th>Is Valid</th>
                           
                </tr>
                </tfoot>
				</table>
</div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	       
	      </div>
	      
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
    <!-- /show passport modal -->
			  
			      <!-- show visa modal -->
			 <div class="modal fade" tabindex="-1" role="dialog" id="showVisaModal">
	  <div class="modal-dialog modal-dialog_style" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-eye" aria-hidden="true"></i>Visa Information</h4>
	      </div>
	      
	     

	       <div class="modal-body">
         
				<table class="table" id="visaTable">					
					<thead>
						<tr>
                        	
							<th>Person Id</th>													
							<th>Visa No</th>
                            <th>Issue Date</th>
                            <th>Expiry Date</th>
														<th>Place Of Issue</th>
														<th>Visa Type</th>
                            <th>No. Entries</th>
														<th>No. Applicants</th>
                            <th>Days Left</th>
							 <th>Expiry Status</th>
                            <th>Active Status</th>
                           <th>Is Valid</th>
                            
						</tr>
					</thead>
					  <tfoot>
                <tr>
                        
								<th>Person Id</th>													
							<th>Visa No</th>
                            <th>Issue Date</th>
                            <th>Expiry Date</th>
														<th>Place Of Issue</th>
														<th>Visa Type</th>
                            <th>No. Entries</th>
														<th>No. Applicants</th>
                            <th>Days Left</th>
							 <th>Expiry Status</th>
                            <th>Active Status</th>
                           <th>Is Valid</th>
                </tr>
                </tfoot>
				</table>
</div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	       
	      </div>
	      
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
    <!-- /show visa modal -->
			
    
	
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php require APPROOT . '/views/officer/inc/footer.php'; ?>
			<script src="<?php echo URLROOT ?>/public/assets/system scripts/compForeign.js"></script>

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
					 

  </body>
</html>