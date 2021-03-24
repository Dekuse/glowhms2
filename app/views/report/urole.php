<?php require APPROOT . '/views/administrator/inc/header for user.php'; ?>
<?php require APPROOT . '/views/administrator/inc/aside.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Users & Roles
            <small></small>
          </h1>
		  
          <ol class="breadcrumb">
            <li class="active"><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></a>Users & Roles</li>
            <li class="active"></li>
          </ol>
        </section>

        <!-- Main content -->
		<section class="content">
        <div class="row">
        <div class="col-xs-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#userstab" data-toggle="tab" aria-expanded="true">USERS</a></li>
              <li class=""><a href="#rolestab" data-toggle="tab" aria-expanded="false">ROLES</a></li>
            </ul>
			</div>
            <div class="tab-content">
              <!-- Font Awesome Icons -->
              <div class="tab-pane active" id="userstab">
         
			  <div class="box">
 <div class="container col-md-12">
		<div class="row col-md-12 ">
			<div class="col-md-12">

				 

				<div class="removeMessages"></div>
				<br>
				<div class="margin">
           
                <div class="btn-group">
								<button class="btn btn-danger  pull pull-left" onclick="disableuser()" id="disableuserbut">Disable/Enable User</button> 
                  </button>
                </div>
								<div class="btn-group">
								<button class="btn btn-info  pull pull-left" onclick="modifyuser()" id="modifyuserbut">Modify User</button> 
                  </button>
                </div>
				<div class="btn-group">
								<button class="btn btn-info  pull pull-left" onclick="changePass()" id="changepasswordbtn">Change Password 	 </button> 
                  </button>
                </div>
					
				
              </div>
			  <button class="btn pull pull-right" onclick="successtoaster('info','YOU CAN ADD NEW USER WITH THIS MENU','INFORMATION')"><i class="fa fa-question-circle"></i></button>

				<button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addusermodal" id="adduser">
					<span class="glyphicon glyphicon-plus-sign"></span>	Add User
				</button>

				<br /> <br /> <br />

				<table class="table" id="usertable">					
					<thead>
						<tr>
						<th>ID</TH>
						<th>User Id</th>	
							<th>Full Name</th>													
												
								<th>Sex</th>
								<th>PhoneNo</th>
								<th>City</TH>
						<th>Email</th>	
							<th>Nationality</th>													
												
								<th>Major Actor</th>
								<th>Profession</th>
								<th>Account Status</th>													
												
								<th>Active Status</th>
								<th>Date Created</TH>
						<th>Date Modified</th>	
						
							
								
						</tr>
					</thead>
					  <tfoot>
                <tr>
				<th>ID</TH>
						<th>User Id</th>	
							<th>Full Name</th>													
												
								<th>Sex</th>
								<th>PhoneNo</th>
								<th>City</TH>
						<th>Email</th>	
							<th>Nationality</th>													
												
								<th>Major Actor</th>
								<th>Profession</th>
								<th>Account Status</th>													
												
								<th>Active Status</th>
								<th>Date Created</TH>
						<th>Date Modified</th>	
							
                </tr>
                </tfoot>
				</table>
			</div>
		</div>
	</div>

	<!-- add modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="addusermodal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<button class="close" type="button" onclick="successtoaster('info','YOU CAN ADD NEW USER WITH THIS MENU','INFORMATION')"><span aria-hidden="true">&quest;</span></button>

	        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>	Add USER</h4>
	      </div>
	      
	      <form class="form-horizontal" action="" method="POST" id="createuserform" enctype=”multipart/form-data”>

	      <div class="modal-body">
	      	<div class="messages"></div>
			 
					<p><h3>Please note: </h3>Fields with this sign <span style="color:red">*</span> are mandatory</p>
					<span style="color:red" id="whatever"> </span>
					
			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="fname" class="col-sm-2 control-label">Full Name <span style="color:red">*</span></label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="FULL_NAME" name="FULL_NAME" placeholder="full name of the user">
						<span id="error_FULL_NAME" class=""></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INSERT THE FULL NAME OF THE USER','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>

			  <div class="form-group radio">
			 <label for="lname" class="col-sm-2 control-label">Sex<span style="color:red">*</span></label>
 
   <div class="col-sm-9">
			      <select class="form-control control control-label" name="SEX" id="SEX" title="Sex" >
			      	<option value="">~~SELECT~~</option>
							<option value="M">Male</option>
			      	<option value="F">Female</option>
			      </select>
						<span id="error_SEX" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','SELECT GENDER TYPE','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
  </div>
		<br>
  <div class="form-group"> <!--/here teh addclass has-error will appear -->
				<label class="col-sm-2 control-label">Mobile Number   <span style="color:red">*</span></label>
			    <div class="col-sm-9"> 
			     
					<div class="input-group col-sm-9">
                      <div class="input-group-addon">
                       <span class="">+251</span>
                      </div>
                      <input type="text" class="form-control " name="PHONENO" id="PHONENO" data-inputmask='"mask": "(99) 999-9999"' data-mask>
		
					<span id="error_PHONENO" class=""></span>
                    </div><!-- /.input group -->
                  </div><!-- /.form group --> 
				  <label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','ENTER PHONE NUMBER IN THE FOLLOWING FORMAT (99) 999-9999','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
				  </div>
				<!-- here the text will apper  -->
			
				<div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="fname" class="col-sm-2 control-label">City</label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="CITY" name="CITY" placeholder="city of the user">
						<span id="error_CITY" class=""></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INSERT THE CITY OF THE USER, THIS IS NOT MANDATORY','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>

				<div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="email" class="col-sm-2 control-label">Email </label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="EMAIL" name="EMAIL" placeholder="Email">
						<span id="error_EMAIL" class=""></span>
			
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INSERT EMAIL OF THE USER, THIS IS NOT MANDATORY','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>

			
					<div class="form-group radio">
			 <label for="lname" class="col-sm-2 control-label">Nationality<span style="color:red">*</span></label>
 
   <div class="col-sm-9">
			      <select class="form-control control" name="NATIONALITY" id="NATIONALITY" title="Visa Type" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['nation'] as $nationtype) : 
		echo '<option value="';
	echo $nationtype->CountryName.'">';
												echo $nationtype->CountryCode; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_NATIONALITY" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','SELECT NATIONALITY OF THE USER','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
  </div>

  <div class="form-group radio">
			 <label for="lname" class="col-sm-2 control-label">Major Actor Catagory<span style="color:red">*</span></label>
 
   <div class="col-sm-9">
			      <select class="form-control control" name="MAJOR_ACTOR" id="MAJOR_ACTOR" title="Visa Type" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['majoractor'] as $actortype) : 
		echo '<option value="';
	echo $actortype->MAJOR_ACTOR.'">';
												echo $actortype->DESCI; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_MAJOR_ACTOR" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','SELECT MAJOR ROLE OF THE USER','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
  </div>

  <div class="form-group radio">
			 <label for="lname" class="col-sm-2 control-label">Profession<span style="color:red">*</span></label>
 
   <div class="col-sm-9">
			      <select class="form-control control" name="PROFESSION" id="PROFESSION" title="Visa Type" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['prof'] as $proftype) : 
		echo '<option value="';
	echo $proftype->ACTOR_ID.'">';
												echo $proftype->ACTOR_NAME; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_PROFESSION" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','SELECT SPECIFIC ROLE OF THE USER','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
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

	

	<div class=" modal modal-danger fade" tabindex="-1" role="dialog" id="disableuser">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-times"></i> Disable User</h4>
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

		<div class="modal modal-info fade" tabindex="-1" role="dialog" id="enableuser">
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
	<div class="modal fade" tabindex="-1" role="dialog" id="modifyusersmodal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<button class="close" type="button" onclick="successtoaster('info','YOU CAN MODIFY USER WITH THIS MENU','INFORMATION')"><span aria-hidden="true">&quest;</span></button>

	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Modify User</h4>
	      </div>

		<form class="form-horizontal" action="" method="POST" id="modifyuserform" name="modifyuserform">	      

	      <div class="modal-body">
	        	
	        <div class="edit-messages"></div>

			<p><h3>Please note: </h3>Fields with this sign <span style="color:red">*</span> are mandatory</p>
					<span style="color:red" id="whatever"> </span>
					
			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="fname" class="col-sm-2 control-label">Full Name <span style="color:red">*</span></label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="editFULL_NAME" name="editFULL_NAME" placeholder="full name of the user">
						<span id="error_editFULL_NAME" class=""></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INSERT THE FULL NAME OF THE USER','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>

			  <div class="form-group radio">
			 <label for="lname" class="col-sm-2 control-label">Sex<span style="color:red">*</span></label>
 
   <div class="col-sm-9">
			      <select class="form-control control control-label" name="editSEX" id="editSEX" title="Sex" >
			      	<option value="">~~SELECT~~</option>
							<option value="M">Male</option>
			      	<option value="F">Female</option>
			      </select>
						<span id="error_editSEX" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','SELECT GENDER TYPE','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
  </div>
		<br>
  <div class="form-group"> <!--/here teh addclass has-error will appear -->
				<label class="col-sm-2 control-label">Mobile Number   <span style="color:red">*</span></label>
			    <div class="col-sm-9"> 
			     
					<div class="input-group col-sm-9">
                      <div class="input-group-addon">
                       <span class="">+251</span>
                      </div>
                      <input type="text" class="form-control " name="editPHONENO" id="editPHONENO" data-inputmask='"mask": "(99) 999-9999"' data-mask>
		
					<span id="error_editPHONENO" class=""></span>
                    </div><!-- /.input group -->
                  </div><!-- /.form group --> 
				  <label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','ENTER PHONE NUMBER IN THE FOLLOWING FORMAT (99) 999-9999','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
				  </div>
				<!-- here the text will apper  -->
			
				<div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="fname" class="col-sm-2 control-label">City</label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="editCITY" name="editCITY" placeholder="city of the user">
						<span id="editerror_CITY" class=""></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INSERT THE CITY OF THE USER, THIS IS NOT MANDATORY','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>

				<div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="email" class="col-sm-2 control-label">Email </label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="editEMAIL" name="editEMAIL" placeholder="Email">
						<span id="error_editEMAIL" class=""></span>
			
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INSERT EMAIL OF THE USER, THIS IS NOT MANDATORY','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>

			
					<div class="form-group radio">
			 <label for="lname" class="col-sm-2 control-label">Nationality<span style="color:red">*</span></label>
 
   <div class="col-sm-9">
			      <select class="form-control control" name="editNATIONALITY" id="editNATIONALITY" title="Visa Type" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['nation'] as $nationtype) : 
		echo '<option value="';
	echo $nationtype->CountryName.'">';
												echo $nationtype->CountryCode; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_editNATIONALITY" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','SELECT NATIONALITY OF THE USER','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
  </div>

  <div class="form-group radio">
			 <label for="lname" class="col-sm-2 control-label">Major Actor Catagory<span style="color:red">*</span></label>
 
   <div class="col-sm-9">
			      <select class="form-control control" name="editMAJOR_ACTOR" id="editMAJOR_ACTOR" title="Visa Type" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['majoractor'] as $actortype) : 
		echo '<option value="';
	echo $actortype->MAJOR_ACTOR.'">';
												echo $actortype->DESCI; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_editMAJOR_ACTOR" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','SELECT MAJOR ROLE OF THE USER','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
  </div>

  <div class="form-group radio">
			 <label for="lname" class="col-sm-2 control-label">Profession<span style="color:red">*</span></label>
 
   <div class="col-sm-9">
			      <select class="form-control control" name="editPROFESSION" id="editPROFESSION" title="Visa Type" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['prof'] as $proftype) : 
		echo '<option value="';
	echo $proftype->ACTOR_ID.'">';
												echo $proftype->ACTOR_NAME; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_editPROFESSION" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','SELECT SPECIFIC ROLE OF THE USER','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
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

		<!-- update password modal -->
		<div class="modal fade" tabindex="-1" role="dialog" id="changepasswordmodal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Change Password</h4>
	      </div>

		<form class="form-horizontal" action="" method="POST" id="changepasswordForm">	      

	      <div class="modal-body">
	        	
	        <div class="edit-messages"></div>

			<div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="fname" class="col-sm-2 control-label">New Password</label>
			    <div class="col-sm-10"> 
			      <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
						<span id="error_newPassword" name="error_newPassword" class=""></span>
			    </div>
			  </div>
			    <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="name" class="col-sm-2 control-label">Repeat Password</label>
			    <div class="col-sm-10"> 
			      <input type="password" class="form-control" id="repeatPassword" name="repeatPassword" placeholder="Repeat Password">
						<span id="error_repeatPassword" name="error_repeatPassword" class=""></span>
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
	<!-- /update password modal -->
              </div><!-- /.box -->
              </div>
              <!-- END FOR BED MAJOR TAB -->
	
              <!-- START FOR BEDS TAB-->
              <div class="tab-pane" id="rolestab">
               
			  <div class="box">
 <div class="container col-md-12">
		<div class="row col-md-12 ">
			<div class="col-md-12">

				 

				<div class="removeMessages"></div>
				<br>
				<div class="margin">
				
				
                <div class="btn-group">
								<button class="btn btn-danger  pull pull-left" onclick="disablerole()" id="disenbed">Disable/Enable Role</button> 
                  </button>
                </div>
								<div class="btn-group">
								<button class="btn btn-info  pull pull-left" onclick="modifyrole()" id="modifybed">Modify Role</button> 
                  </button>
                </div>
					
				
              </div>
			  <button class="btn pull pull-right" onclick="successtoaster('info','YOU CAN ADD NEW ROLE WITH THIS MENU, PLEASE REFRESH THE PAGE IF YOU CANNOT FIND NEW USERS LIST','INFORMATION')"><i class="fa fa-question-circle"></i></button>
				<button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addrole" id="addrolebtn">
					<span class="glyphicon glyphicon-plus-sign"></span>	Add Role
					
				</button>
				

				<br /> <br /> <br />

				<table class="table" id="roletable">					
					<thead>
						<tr>
						
						<th>Id</th>	
							<th>User Id</th>	
							<th>Major Service Code</th>	
							<th>Major Service Name</th>	
							<th>Date Created</th>
								<th>Date Modified</th>	
								<th>Role Status</th>
								
						</tr>
					</thead>
					  <tfoot>
                <tr>
				
				<th>Id</th>	
							<th>User Id</th>	
							<th>Major Service Code</th>	
							<th>Major Service Name</th>	
							<th>Date Created</th>
								<th>Date Modified</th>	
								<th>Role Status</th>	
                </tr>
                </tfoot>
				</table>
			</div>
		</div>
	</div>

	<!-- add modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="addrole">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<button class="close" type="button" onclick="successtoaster('info','YOU CAN ADD NEW ROLE WITH THIS MENU, PLEASE REFRESH THE PAGE IF YOU CANNOT FIND NEW USERS LIST,'INFORMATION')"><span aria-hidden="true">&quest;</span></button>

	        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>	Add Role</h4>
	      </div>
	      
	      <form class="form-horizontal" action="" method="POST" id="createroleform" enctype=”multipart/form-data”>

	      <div class="modal-body">
	      	<div class="messages"></div>
					<p><h3>Please note: </h3>Fields with this sign <span style="color:red">*</span> are mandatory</p>
					<span style="color:red" id="whatever"> </span>
					<div class="form-group radio">
			 <label for="lname" class="col-sm-2 control-label">User<span style="color:red">*</span></label>
 
   <div class="col-sm-9">
			      <select class="form-control control" name="userid" id="userid" title="" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['users'] as $users) : 
		echo '<option value="';
	echo $users->USER_ID.'">';
												echo $users->FULL_NAME.' with '.$users->MAJOR_ACTOR.' actor'; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_userid" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','SELECT THE USER ID FOR THE NEW ROLE','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
  </div>

					<div class="form-group radio">
			 <label for="lname" class="col-sm-2 control-label">Role Type<span style="color:red">*</span></label>
 
   <div class="col-sm-9">
			      <select class="form-control control" name="role_MAJOR_ACTOR" id="role_MAJOR_ACTOR" title="" >
			      	<option value="">~~SELECT~~</option>
			      	 <?php
						
            foreach($data['majorservice'] as $majorservice) : 
		echo '<option value="';
	echo $majorservice->MAJOR_SER_CODE.'">';
												echo $majorservice->SER_NAME; echo '</option>';
												
            endforeach;                                 
	?>
               
			      	
			      </select>
						<span id="error_role_MAJOR_ACTOR" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','SELECT MAJOR ROLE OF THE USER','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
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
      <?php require APPROOT . '/views/administrator/inc/footer.php'; ?>
			<script src="<?php echo URLROOT ?>/public/assets/system scripts/user_role.js"></script>
			<script src="<?php echo URLROOT ?>/public/assets/system scripts/active-status.js"></script>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
       
  </body>
</html>