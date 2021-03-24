<?php require APPROOT . '/views/administrator/inc/header.php'; ?>
<?php require APPROOT . '/views/administrator/inc/aside.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            CARD
            <small></small>
          </h1>
		  
          <ol class="breadcrumb">
            <li class="active"><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></a>CARD</li>
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
								<button class="btn btn-danger  pull pull-left" onclick="disablecardp()" id="updateVisaModalBtn">Disable/Enable Account</button> 
                  </button>
                </div>
				
								<div class="btn-group">
								<button class="btn btn-info  pull pull-left" onclick="changecardp()" id="updatePassportModalBtn">Modify Card 	 </button> 
                  </button>
                </div>
							
          
              </div>
			  <button class="btn pull pull-right" onclick="successtoaster('info','YOU CAN ADD CARD PRIORITY TYPE WITH THIS MENU','INFORMATION')"><i class="fa fa-question-circle"></i></button>

				<button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addcard" id="addcp">
					<span class="glyphicon glyphicon-plus-sign"></span>	Add Card Priority
				</button>

				<br /> <br /> <br />

				<table class="table" id="cpriority">					
					<thead>
						<tr>
						<th>Card Priority Id</th>
						<th>Card Priority Type</th>	
							<th>Card Priority Description</th>													
							<th>Card Priority Price</th>
							<th>Card Priority Status</th>
								
						</tr>
					</thead>
					  <tfoot>
                <tr>
				<th>Card Priority Id</th>
						<th>Card Priority Type</th>	
							<th>Card Priority Description</th>													
							<th>Card Priority Price</th>
							<th>Card Priority Status</th>
                </tr>
                </tfoot>
				</table>
			</div>
		</div>
	</div>

<!-- add modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addcard">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<button class="close" type="button" onclick="successtoaster('info','YOU CAN ADD NEW CARD PRIORITY TYPE WITH THIS MENU','INFORMATION')"><span aria-hidden="true">&quest;</span></button>

	        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>	Add Bed</h4>
	      </div>
	      
	      <form class="form-horizontal" action="" method="POST" id="createcardform" enctype=”multipart/form-data”>

	      <div class="modal-body">
	      	<div class="messages"></div>
					<p><h3>Please note: </h3>Fields with this sign <span style="color:red">*</span> are mandatory</p>
					<span style="color:red" id="whatever"> </span>
			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="fname" class="col-sm-3 control-label">Card Description <span style="color:red">*</span></label>
			    <div class="col-sm-8"> 
			      <input type="text" class="form-control" cols="45" rows="4" id="CARD_PR_DES" name="CARD_PR_DES" placeholder="card priority description">
				  <span id="error_CARD_PR_DES" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INSERT THE DESCRIPTION OF THE CARD PRIORITY TYPE','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>

			  <div class="form-group radio">
			 <label for="lname" class="col-sm-3 control-label">Card Price<span style="color:red">*</span></label>
 
   <div class="col-sm-8">
   <input type="number" class="form-control" min=1 value=1 id="CARD_PR_PRICE" name="CARD_PR_PRICE" placeholder="Card Price">

						<span id="error_CARD_PR_PRICE" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INSERT THE PRICE OF THE CARD PRIORITY TYPE','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
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
	
	
	<div class=" modal modal-danger fade" tabindex="-1" role="dialog" id="disablecardp">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-times"></i> Disable Card Priority Type</h4>
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

		<div class="modal modal-info fade" tabindex="-1" role="dialog" id="enablecardp">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-check-circle-o"></i> Enable Card Priority Type</h4>
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
	<div class="modal fade" tabindex="-1" role="dialog" id="modifycardp">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<button class="close" type="button" onclick="successtoaster('info','YOU CAN MODIFY EXISTING CARD PRIORITY WITH THIS MENU','INFORMATION')"><span aria-hidden="true">&quest;</span></button>

	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Modify Major Bedroom</h4>
	      </div>

		<form class="form-horizontal" action="" method="POST" id="modifycardpform" name="modifycardpform">	      

	      <div class="modal-body">
	        	
	        <div class="edit-messages"></div>

			<p><h3>Please note: </h3>Fields with this sign <span style="color:red">*</span> are mandatory</p>
					<span style="color:red" id="whatever"> </span>
			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="fname" class="col-sm-3 control-label">Card Description <span style="color:red">*</span></label>
			    <div class="col-sm-8"> 
			      <input type="text" class="form-control"  id="editCARD_PR_DES" name="editCARD_PR_DES" placeholder="card priority description">
				  <span id="error_editCARD_PR_DES" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INSERT THE DESCRIPTION OF THE CARD PRIORITY TYPE','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
</label>
			  </div>

			  <div class="form-group radio">
			 <label for="lname" class="col-sm-3 control-label">Card Price<span style="color:red">*</span></label>
 
   <div class="col-sm-8">
   <input type="number" class="form-control" min=1 value=1 id="editCARD_PR_PRICE" name="editCARD_PR_PRICE" placeholder="Card Price">

						<span id="error_editCARD_PR_PRICE" class="text-danger"></span>
			    </div>
				<label class="col-sm-1 control-label">		  <button class="close" type="button" onclick="successtoaster('info','INSERT THE PRICE OF THE CARD PRIORITY TYPE','INFORMATION')"><span aria-hidden="true">&quest;</span></button>
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
			<script src="<?php echo URLROOT ?>/public/assets/system scripts/card.js"></script>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
       
  </body>
</html>