<?php require APPROOT . '/views/administrator/inc/header.php'; ?>
<?php require APPROOT . '/views/administrator/inc/aside.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            SERVICES
            <small></small>
          </h1>
		  
          <ol class="breadcrumb">
            <li class="active"><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></a>SERVICES</li>
            <li class="active"></li>
          </ol>
        </section>

        <!-- Main content -->
		<section class="content">
        <div class="row">
        <div class="col-xs-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#service" data-toggle="tab" aria-expanded="true">SERVICES</a></li>
              <li class=""><a href="#mservice" data-toggle="tab" aria-expanded="false">MAJOR SERVICES CATAGORY</a></li>
            </ul>
			</div>
            <div class="tab-content">
              <!-- Font Awesome Icons -->
              <div class="tab-pane active" id="service">
         
			  <div class="box">
 <div class="container col-md-12">
		<div class="row col-md-12 ">
			<div class="col-md-12">

				 

				<div class="removeMessages"></div>
				<br>
				<div class="margin">
           
                <div class="btn-group">
								<button class="btn btn-danger  pull pull-left" onclick="DISABLESER()" id="disenmabed">Disable/Enable Service</button> 
                  </button>
                </div>
								<div class="btn-group">
								<button class="btn btn-info  pull pull-left" onclick="MODIFY()" id="edtiservice">Modify Service</button> 
                  </button>
                </div>
					
				
              </div>
			  <button class="btn pull pull-right" onclick="successtoaster('info','YOU CAN ADD SERVICE TYPE WITH THIS MENU','INFORMATION')"><i class="fa fa-question-circle"></i></button>

				<button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addservicemodal" id="addservice">
					<span class="glyphicon glyphicon-plus-sign"></span>	Add Service
				</button>

				<br /> <br /> <br />

				<table class="table" id="servicet">					
					<thead>
						<tr>
						<th>Service Id</TH>
						<th>Service Code</th>	
							<th>Service Name</th>													
												
								<th>Major Service Code</th>
								<th>Date created</th>
								<th>Date Modified</th>	
							<th>Description</th>													
												
								<th>Price</th>
								<th>Service Status</th>
								
						</tr>
					</thead>
					  <tfoot>
                <tr>
				<th>Service Id</TH>
						<th>Service Code</th>	
							<th>Service Name</th>													
												
								<th>Major Service Code</th>
								<th>Date created</th>
								<th>Date Modified</th>	
							<th>Description</th>													
												
								<th>Price</th>
								<th>Service Status</th>
                </tr>
                </tfoot>
				</table>
			</div>
		</div>
	</div>

<!-- add modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addservicemodal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<button class="close" type="button" onclick="successtoaster('info','YOU CAN ADD NEW SERVICE WITH THIS MENU','INFORMATION')"><span aria-hidden="true">&quest;</span></button>

	        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>	Add Service</h4>
	      </div>
	      
	      <form class="form-horizontal" action="" method="POST" id="CREATESERVICEFORM" enctype=”multipart/form-data”>

	      <div class="modal-body">
	      	<div class="messages"></div>
			 
					<p><h3>Please note: </h3>Fields with this sign <span style="color:red">*</span> are mandatory</p>
					<span style="color:red" id="whatever"> </span>
					
			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="fname" class="col-sm-2 control-label">Service Name <span style="color:red">*</span></label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="SERVICE_NAME" name="SERVICE_NAME" placeholder="service name">
						<span id="error_SERVICE_NAME" class=""></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','TYPE THE NAME OF THE SERVICE','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>

			  <div class="form-group radio">
			 <label for="lname" class="col-sm-2 control-label">Major Service Code<span style="color:red">*</span></label>
 
   <div class="col-sm-9">
			      <select class="form-control control" name="MAJOR_SER_CODE" id="MAJOR_SER_CODE" title="Major Service Type" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['majorservice'] as $majorser) : 
		echo '<option value="';
	echo $majorser->MAJOR_SER_CODE.'">';
												echo $majorser->SER_NAME  ; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_MAJOR_SER_CODE" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','SELECT THE TYPE OF MAJOR SERVICE CATAGORY FROM THE LIST','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
	
  </div>

				 <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="mname" class="col-sm-2 control-label">Service Description </label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="DESCI" name="DESCI" placeholder="Service Description">
						<span id="error_DESCI" class=""></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INPUT THE DESCRIPTION OF THE SERVICE, THIS IS NOT MANDATORY','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>

			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="mname" class="col-sm-2 control-label">Service Price </label>
			    <div class="col-sm-9"> 
			      <input type="number" min=0  class="form-control" id="PRICE" name="PRICE" placeholder="major bedroom address">
						<span id="error_PRICE" class=""></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INPUT THE PRICE OF THE SERVICE','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
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

	<div class=" modal modal-danger fade" tabindex="-1" role="dialog" id="disableser">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-times"></i> Disable Service</h4>
	      </div>
	      <div class="modal-body">
	        <p>Do you really want to Disable ?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-outline" id="disableserBtn">Save changes</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

		<div class="modal modal-info fade" tabindex="-1" role="dialog" id="enableser">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-check-circle-o"></i> Enable Service</h4>
	      </div>
	      <div class="modal-body">
	        <p>Do you really want to Enable ?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-outline" id="enableserBtn">Save changes</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- edit modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="editservicemodal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Modify Service</h4>
	      </div>

		<form class="form-horizontal" action="" method="POST" id="modifyserform" name="modifyserform">	      

	      <div class="modal-body">
	        	
	        <div class="edit-messages"></div>

			<div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="fname" class="col-sm-2 control-label">Service Name <span style="color:red">*</span></label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="edit_SERVICE_NAME" name="edit_SERVICE_NAME" placeholder="service name">
						<span id="error_edit_SERVICE_NAME" class=""></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','TYPE THE NAME OF THE SERVICE','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>

			  <div class="form-group radio">
			 <label for="lname" class="col-sm-2 control-label">Major Service Code<span style="color:red">*</span></label>
 
   <div class="col-sm-9">
			      <select class="form-control control" name="edit_MAJOR_SER_CODE" id="edit_MAJOR_SER_CODE" title="Major Service Type" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['majorservice'] as $majorser) : 
		echo '<option value="';
	echo $majorser->MAJOR_SER_CODE.'">';
												echo $majorser->SER_NAME  ; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_edit_MAJOR_SER_CODE" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','SELECT THE TYPE OF MAJOR SERVICE CATAGORY FROM THE LIST','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
	
  </div>

				 <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="mname" class="col-sm-2 control-label">Service Description </label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="edit_DESCI" name="edit_DESCI" placeholder="Service Description">
						<span id="error_edit_DESCI" class=""></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INPUT THE DESCRIPTION OF THE SERVICE, THIS IS NOT MANDATORY','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>

			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="mname" class="col-sm-2 control-label">Service Price </label>
			    <div class="col-sm-9"> 
			      <input type="number" min=0  class="form-control" id="edit_PRICE" name="edit_PRICE" placeholder="major bedroom address">
						<span id="error_edit_PRICE" class=""></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INPUT THE PRICE OF THE SERVICE','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>
</br>
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
              <div class="tab-pane" id="mservice">
               
			  <div class="box">
 <div class="container col-md-12">
		<div class="row col-md-12 ">
			<div class="col-md-12">

	<br>
				<table class="table" id="mservicet">					
					<thead>
						<tr>
						
						<th>ID</th>	
							<th>Major Service Code</th>	
							<th>Service Name</th>	
							<th>Date Created</th>
								<th>Service Description</th>	
								
						</tr>
					</thead>
					  <tfoot>
                <tr>
				
				<th>ID</th>	
							<th>Major Service Code</th>	
							<th>Service Name</th>	
							<th>Date Created</th>
								<th>Service Description</th>	
                </tr>
                </tfoot>
				</table>
			</div>
		</div>
	</div>

	

	





	
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
      <?php require APPROOT . '/views/administrator/inc/footer.php'; ?>
			<script src="<?php echo URLROOT ?>/public/assets/system scripts/service.js"></script>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
       
  </body>
</html>