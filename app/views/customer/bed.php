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
              <li class="active"><a href="#bedmajor" data-toggle="tab" aria-expanded="true">MAJOR BED</a></li>
              <li class=""><a href="#allbed" data-toggle="tab" aria-expanded="false">BEDS</a></li>
            </ul>
			</div>
            <div class="tab-content">
              <!-- Font Awesome Icons -->
              <div class="tab-pane active" id="bedmajor">
         
			  <div class="box">
 <div class="container col-md-12">
		<div class="row col-md-12 ">
			<div class="col-md-12">

				 

				<div class="removeMessages"></div>
				<br>
				<div class="margin">
           
                <div class="btn-group">
								<button class="btn btn-danger  pull pull-left" onclick="DISABLEMA()" id="disenmabed">Disable/Enable Catagory</button> 
                  </button>
                </div>
								<div class="btn-group">
								<button class="btn btn-info  pull pull-left" onclick="MODIFY()" id="modifymabed">Modify Catagory</button> 
                  </button>
                </div>
					
				
              </div>
			  <button class="btn pull pull-right" onclick="successtoaster('info','YOU CAN ADD NEW CATAGORY WITH THIS MENU','INFORMATION')"><i class="fa fa-question-circle"></i></button>

				<button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addcatagory" id="addmacatagory">
					<span class="glyphicon glyphicon-plus-sign"></span>	Add Catagory
				</button>

				<br /> <br /> <br />

				<table class="table" id="major_bed_table">					
					<thead>
						<tr>
						<th>NO</TH>
						<th>Major bed code</th>	
							<th>Major Bed Price</th>													
												
								<th>Major Bed Address</th>
								<th>Major Bed Status</th>
								
						</tr>
					</thead>
					  <tfoot>
                <tr>
				<th>NO</TH>
				<th>Major Bed Code</th>	
							<th>Major Bed Price</th>													
												
								<th>Major Bed Address</th>
								<th>Major Bed Status</th>
                </tr>
                </tfoot>
				</table>
			</div>
		</div>
	</div>

	<!-- add modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="addcatagory">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<button class="close" type="button" onclick="successtoaster('info','YOU CAN ADD NEW CATAGORY WITH THIS MENU','INFORMATION')"><span aria-hidden="true">&quest;</span></button>

	        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>	Add CATAGORY</h4>
	      </div>
	      
	      <form class="form-horizontal" action="" method="POST" id="CREATEMAJORBEDFORM" enctype=”multipart/form-data”>

	      <div class="modal-body">
	      	<div class="messages"></div>
			 
					<p><h3>Please note: </h3>Fields with this sign <span style="color:red">*</span> are mandatory</p>
					<span style="color:red" id="whatever"> </span>
					
			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="fname" class="col-sm-2 control-label">Major Bedroom Price <span style="color:red">*</span></label>
			    <div class="col-sm-9"> 
			      <input type="number" class="form-control" id="bdprice" name="bdprice" placeholder="major bedroom price">
						<span id="error_bdprice" class=""></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','ADD NEW PRICE RATE FOR BEDS','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>

				 <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="mname" class="col-sm-2 control-label">Major Bedroom Address </label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="bdaddress" name="bdaddress" placeholder="major bedroom address">
						<span id="error_bdaddress" class=""></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','ADD ADDRESS FOR BED CATAGORY, THIS IS NOT MANDATORY','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>
				 <br>
			  </div>
			

		
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save </button>
	      </div>
	      </form> 
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /add modal -->

	

	<div class=" modal modal-danger fade" tabindex="-1" role="dialog" id="disablemabed">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-times"></i> Disable Major Bedroom catagory</h4>
	      </div>
	      <div class="modal-body">
	        <p>Do you really want to Disable ?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-outline" id="disableBtn">Save changes</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

		<div class="modal modal-info fade" tabindex="-1" role="dialog" id="enablemabed">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-check-circle-o"></i> Enable Major Bedroom Catagory</h4>
	      </div>
	      <div class="modal-body">
	        <p>Do you really want to Enable ?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-outline" id="enableBtn">Save changes</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


	<!-- edit modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="modifymabedmodal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<button class="close" type="button" onclick="successtoaster('info','YOU CAN MODIFY EXISTING CATAGORY WITH THIS MENU','INFORMATION')"><span aria-hidden="true">&quest;</span></button>

	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Modify Major Bedroom</h4>
	      </div>

		<form class="form-horizontal" action="" method="POST" id="modifymabedform" name="modifymabedform">	      

	      <div class="modal-body">
	        	
	        <div class="edit-messages"></div>

			<div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="fname" class="col-sm-2 control-label">New Price</label>
			    <div class="col-sm-10"> 
			      <input type="number" class="form-control" id="newprice" name="newprice" placeholder="New Price">
						<span id="error_newprice" name="error_newprice" class=""></span>
			    </div>
			  </div>
			    <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="name" class="col-sm-2 control-label">New Address</label>
			    <div class="col-sm-10"> 
			      <input type="text" class="form-control" id="newaddress" name="newaddress" placeholder="New Address">
						<span id="error_newaddress" name="error_newaddress" class=""></span>
			    </div>
			  </div>
	      </div>
	      <div class="modal-footer editMemberModal">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
	      </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /edit modal -->
              </div><!-- /.box -->
              </div>
              <!-- END FOR BED MAJOR TAB -->
	
              <!-- START FOR BEDS TAB-->
              <div class="tab-pane" id="allbed">
               
			  <div class="box">
 <div class="container col-md-12">
		<div class="row col-md-12 ">
			<div class="col-md-12">

				 

				<div class="removeMessages"></div>
				<br>
				<div class="margin">
				
				
                <div class="btn-group">
								<button class="btn btn-danger  pull pull-left" onclick="DISABLEbed()" id="disenbed">Disable/Enable Bed</button> 
                  </button>
                </div>
								<div class="btn-group">
								<button class="btn btn-info  pull pull-left" onclick="MODIFYbed()" id="modifybed">Modify Bed</button> 
                  </button>
                </div>
					
				
              </div>
			  <button class="btn pull pull-right" onclick="successtoaster('info','YOU CAN ADD NEW BEDS WITH THIS MENU','INFORMATION')"><i class="fa fa-question-circle"></i></button>
				<button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addbed" id="addbedform">
					<span class="glyphicon glyphicon-plus-sign"></span>	Add Bed
					
				</button>
				

				<br /> <br /> <br />

				<table class="table" id="bed_table">					
					<thead>
						<tr>
						
						<th>Bedroom Id</th>	
							<th>Bedroom Price</th>	
							<th>Bed Type</th>	
							<th>Bed Status</th>
								<th>Bed availability</th>	
								
						</tr>
					</thead>
					  <tfoot>
                <tr>
				
				<th>Bedroom Id</th>	
							<th>Bedroom Price</th>	
							<th>Bed Type</th>	
							<th>Bed Status</th>
								<th>Bed availability</th>	
                </tr>
                </tfoot>
				</table>
			</div>
		</div>
	</div>

	<!-- add modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="addbed">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<button class="close" type="button" onclick="successtoaster('info','YOU CAN ADD NEW BEDS WITH THIS MENU','INFORMATION')"><span aria-hidden="true">&quest;</span></button>

	        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>	Add Bed</h4>
	      </div>
	      
	      <form class="form-horizontal" action="" method="POST" id="CREATEBEDFORM" enctype=”multipart/form-data”>

	      <div class="modal-body">
	      	<div class="messages"></div>
					<p><h3>Please note: </h3>Fields with this sign <span style="color:red">*</span> are mandatory</p>
					<span style="color:red" id="whatever"> </span>
			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="fname" class="col-sm-3 control-label">Bed Room Counter <span style="color:red">*</span></label>
			    <div class="col-sm-8"> 
			      <input type="number" class="form-control" min=1 value=1 id="bedcount" name="bedcount" placeholder="bedroom counter">
						<span id="bedcount" class=""></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INSERT HOW MUCH BEDS YOU WANT TO ADD','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>

			  <div class="form-group radio">
			 <label for="lname" class="col-sm-3 control-label">Type of Bedroom<span style="color:red">*</span></label>
 
   <div class="col-sm-8">
			      <select class="form-control control" name="mabedtype" id="mabedtype" title="Major bed type" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['majorbed'] as $majorbed) : 
		echo '<option value="';
	echo $majorbed->MAJOR_BDR_CODE.'">';
												echo $majorbed->MAJOR_BDR_CODE ." "."with price " .$majorbed->MAJOR_BDR_PRICE; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_mabedtype" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','SELECT THE TYPE OF BED CATAGORY FROM THE LIST','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
	
  </div>
				 <br>
			  </div>
			

		
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save </button>
	      </div>
	      </form> 
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /add modal -->

	

	<div class=" modal modal-danger fade" tabindex="-1" role="dialog" id="disablebed">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-times"></i> Disable Bedroom</h4>
	      </div>
	      <div class="modal-body">
	        <p>Do you really want to Disable ?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-outline" id="disableBedBtn">Save changes</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

		<div class="modal modal-info fade" tabindex="-1" role="dialog" id="enablebedroom">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-check-circle-o"></i> Enable Bedroom</h4>
	      </div>
	      <div class="modal-body">
	        <p>Do you really want to Enable ?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-outline" id="enableBedroomBtn">Save changes</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


	<!-- edit modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="modifybedmodal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Modify Bedroom</h4>
	      </div>

		<form class="form-horizontal" action="" method="POST" id="modifybedform" name="modifybedform">	      

	      <div class="modal-body">
	        	
	        <div class="edit-messages"></div>

		
			<div class="form-group radio">
			 <label for="lname" class="col-sm-2 control-label">Type of Bedroom<span style="color:red">*</span></label>
 
   <div class="col-sm-10">
			      <select class="form-control control" name="editbedtype" id="editbedtype" title="Major bed type" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['majorbed'] as $majorbed) : 
		echo '<option value="';
	echo $majorbed->MAJOR_BDR_CODE.'">';
	echo $majorbed->MAJOR_BDR_CODE ." "."with price " .$majorbed->MAJOR_BDR_PRICE; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_editbedtype" class="text-danger"></span>
			    </div>
	
  </div>

	      </div>
	      <div class="modal-footer editMemberModal">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
	      </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /edit modal -->
              </div><!-- /.box -->
              </div>
              <!-- /#ion-icons -->

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
 

    </section>

      </div><!-- /.content-wrapper -->
      <?php require APPROOT . '/views/customer/inc/footer.php'; ?>
			<script src="<?php echo URLROOT ?>/public/assets/system scripts/"></script>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
       
  </body>
</html>