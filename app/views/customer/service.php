<?php require APPROOT . '/views/customer/inc/header.php'; ?>
<?php require APPROOT . '/views/customer/inc/aside.php'; ?>

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
			<script src="<?php echo URLROOT ?>/public/assets/system scripts/servicecus.js"></script>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
       
  </body>
</html>