<?php require APPROOT . '/views/administrator/inc/header.php'; ?>
<?php require APPROOT . '/views/administrator/inc/aside.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            ACTOR
            <small></small>
          </h1>
		  
          <ol class="breadcrumb">
            <li class="active"><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></a>ACTOR</li>
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

				 

				<div class="removeMessages"></div>
				<br>
				<div class="margin">
           
                <div class="btn-group">
								<button class="btn btn-danger  pull pull-left" onclick="disableactor()" id="disenactor">Disable/Enable Actor</button> 
                  </button>
                </div>
				
								<div class="btn-group">
								<button class="btn btn-info  pull pull-left" onclick="changeactor()" id="modactor">Modify Actor 	 </button> 
                  </button>
                </div>
							
          
              </div>
			  <button class="btn pull pull-right" onclick="successtoaster('info','YOU CAN ADD ACTOR TYPE WITH THIS MENU','INFORMATION')"><i class="fa fa-question-circle"></i></button>

				<button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addactor" id="adda">
					<span class="glyphicon glyphicon-plus-sign"></span>	Add Actor Type
				</button>

				<br /> <br /> <br />

				<table class="table" id="actor">					
					<thead>
						<tr>
						<th>Actor Id</th>
						<th>Actor Code</th>	
							<th>Major Actor</th>													
							<th>Actor Name</th>
							<th>Actor Description</th>
							<th>Actor Status</th>
								
						</tr>
					</thead>
					  <tfoot>
                <tr>
				<th>Actor Id</th>
						<th>Actor Code</th>	
							<th>Major Actor</th>													
							<th>Actor Name</th>
							<th>Actor Description</th>
							<th>Actor Status</th>
                </tr>
                </tfoot>
				</table>
			</div>
		</div>
	</div>

<!-- add modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addactor">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<button class="close" type="button" onclick="successtoaster('info','YOU CAN ADD NEW ACTOR TYPE WITH THIS MENU','INFORMATION')"><span aria-hidden="true">&quest;</span></button>

	        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>	Add Bed</h4>
	      </div>
	      
	      <form class="form-horizontal" action="" method="POST" id="createactorform" enctype=”multipart/form-data”>

	      <div class="modal-body">
	      	<div class="messages"></div>
					<p><h3>Please note: </h3>Fields with this sign <span style="color:red">*</span> are mandatory</p>
					<span style="color:red" id="whatever"> </span>
					<div class="form-group radio">
			 <label for="lname" class="col-sm-3 control-label">Major Actor<span style="color:red">*</span></label>
 
   <div class="col-sm-8">
			      <select class="form-control control" name="MAJOR_ACTOR" id="MAJOR_ACTOR" title="Major actor type" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['majoractor'] as $majorbed) : 
		echo '<option value="';
	echo $majorbed->MAJOR_ACTOR.'">';
												echo $majorbed->DESCI; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_MAJOR_ACTOR" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','SELECT THE TYPE MAJOR ACTOR FROM THE LIST','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
	
  </div>
				 <br>
			
			
			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="fname" class="col-sm-3 control-label">Actor Name <span style="color:red">*</span></label>
			    <div class="col-sm-8"> 
			      <input type="text" class="form-control"  id="ACTOR_NAME" name="ACTOR_NAME" placeholder="actor name">
				  <span id="error_ACTOR_NAME" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INSERT THE NAME OF THE ACTOR TYPE','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>

			  <div class="form-group radio">
			 <label for="lname" class="col-sm-3 control-label">Actor Description<span style="color:red">*</span></label>
 
   <div class="col-sm-8">
   <input type="text" class="form-control" id="ACTOR_DESCI" name="ACTOR_DESCI" placeholder="actor description">

						<span id="error_ACTOR_DESCI" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INSERT ACTOR FUNCTION AND DESCRIPTION IN SHORT','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
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
	
	
	<div class=" modal modal-danger fade" tabindex="-1" role="dialog" id="disableactor">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-times"></i> Disable Actor Type</h4>
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

		<div class="modal modal-info fade" tabindex="-1" role="dialog" id="enableactor">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-check-circle-o"></i> Enable Actor Type</h4>
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
	<div class="modal fade" tabindex="-1" role="dialog" id="modifyactor">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<button class="close" type="button" onclick="successtoaster('info','YOU CAN MODIFY EXISTING ACTORS WITH THIS MENU','INFORMATION')"><span aria-hidden="true">&quest;</span></button>

	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Modify Actors</h4>
	      </div>

		<form class="form-horizontal" action="" method="POST" id="modifyactorform" name="modifyactorform">	      

	      <div class="modal-body">
	        	
	        <div class="edit-messages"></div>
			<p><h3>Please note: </h3>Fields with this sign <span style="color:red">*</span> are mandatory</p>
					<span style="color:red" id="whatever"> </span>
					<div class="form-group radio">
			 <label for="lname" class="col-sm-3 control-label">Major Actor<span style="color:red">*</span></label>
 
   <div class="col-sm-8">
			      <select class="form-control control" name="edit_MAJOR_ACTOR" id="edit_MAJOR_ACTOR" title="Major actor type" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['majoractor'] as $majorbed) : 
		echo '<option value="';
	echo $majorbed->MAJOR_ACTOR.'">';
												echo $majorbed->DESCI; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_edit_MAJOR_ACTOR" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','SELECT THE TYPE MAJOR ACTOR FROM THE LIST','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
	
  </div>
				 <br>
			
			
			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="fname" class="col-sm-3 control-label">Actor Name <span style="color:red">*</span></label>
			    <div class="col-sm-8"> 
			      <input type="text" class="form-control"  id="edit_ACTOR_NAME" name="edit_ACTOR_NAME" placeholder="actor name">
				  <span id="error_edit_ACTOR_NAME" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INSERT THE NAME OF THE ACTOR TYPE','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>

			  <div class="form-group radio">
			 <label for="lname" class="col-sm-3 control-label">Actor Description<span style="color:red">*</span></label>
 
   <div class="col-sm-8">
   <input type="text" class="form-control" id="edit_ACTOR_DESCI" name="edit_ACTOR_DESCI" placeholder="actor description">

						<span id="error_edit_ACTOR_DESCI" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INSERT ACTOR FUNCTION AND DESCRIPTION IN SHORT','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
	
  </div>
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
	<!-- /edit modal -->




		


              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php require APPROOT . '/views/administrator/inc/footer.php'; ?>
			<script src="<?php echo URLROOT ?>/public/assets/system scripts/actor.js"></script>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
       
  </body>
</html>