<?php require APPROOT . '/views/customer/inc/header.php'; ?>
<?php require APPROOT . '/views/customer/inc/aside.php'; ?>

<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          GENERAL TEST
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> GENERAL TEST</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
          <div class="removeMessages"></div>
                <div class="box box-solid col-lg-10">
              
                <div class="row ">
                    <!--customer detail-->
                <div class="col-lg-6">
                  <div>
                  <h4 class="">Customer Detail </h4>
                  </div>
                <div class="col-lg-6">
               
                <table class="table">
                      <tbody>
                <tr>
                          <td class=""><b>Patient Name</b></td>
                          <td >  <span class="badge "> <?php echo $data['cus_data']->CUS_NAME?></span></td>
                        </tr>
                        <tr>
                          <td class=""><b>Customer Id</b></td>
                          <td >  <span class="badge "> <?php echo $data['cus_data']->CUS_ID?></span></td>
                        </tr>
                        <tr>
                          <td class=""><b>Sex </b></td>
                          <td >  <span class="badge "> <?php echo $data['cus_data']->SEX?></span></td>
                        </tr>
</tbody>
</table>

        </div>
        <div class="col-lg-6">
        
             
        <table class="table ">
                      <tbody>
                <tr>
                          <td class=""><b>Age</b></td>
                          <td >  <span class="badge "> <?php echo $data['cus_data']->AGE?></span></td>
                        </tr>
                        <tr>
                          <td class=""><b>Phone Number</b></td>
                          <td >  <span class="badge "> <?php echo $data['cus_data']->PHONENO?></span></td>
                        </tr>
                        <tr>
                          <td class=""><b>Reg Date </b></td>
                          <td >  <span class="badge "> <?php echo $data['cus_data']->REG_DATE?></span></td>
                        </tr>
</tbody>
</table>

        </div>
                 </div>
                   <!--general detail-->
                <div class="col-lg-6">
                <div>
                  <h4>General Detail </h4>
                  </div>
                <div class="col-lg-6">
                <table class="table  ">
                      <tbody>
                <tr>
                          <td class=""><b>Temprature</b></td>
                          <td >  <span class="badge "> <?php echo $data['general_detail']->TEMPRATURE?></span></td>
                        </tr>
                        <tr>
                          <td class=""><b>Pulse Rate</b></td>
                          <td >  <span class="badge "> <?php echo $data['general_detail']->PULSE_RATE?></span></td>
                        </tr>
                        <tr>
                          <td class=""><b>Weight </b></td>
                          <td >  <span class="badge "> <?php echo $data['general_detail']->WEIGHT?></span></td>
                        </tr>
                </tbody>
                </table>

            
          
        </div>
        <div class="col-lg-6">
       
        <table class="table  ">
                      <tbody>
                <tr>
                          <td class=""><b>Height</b></td>
                          <td >  <span class="badge "> <?php echo $data['general_detail']->HEIGHT?></span></td>
                        </tr>
                        <tr>
                          <td class=""><b>SYSTOLICBP</b></td>
                          <td >  <span class="badge "> <?php echo $data['general_detail']->SYSTOLICBP?></span></td>
                        </tr>
                        <tr>
                          <td class=""><b>DIASTOLICBP </b></td>
                          <td >  <span class="badge "> <?php echo $data['general_detail']->DIASTOLICBP?></span></td>
                        </tr>
                </tbody>
                </table>
     </div>
                </div>
			
                </div>
                </div>
            <div class="col-md-3">
             
              <div class="box box-solid">
                <div class="row">
                   
                    <div class="col-md-12">
                    <div class="box-header with-border">
                  <h3 class="box-title">Legned</h3>
                  <ul class="nav nav-pills nav-stacked">
                   
                    <li><a href="#"> <span>Total Request -> </span><span class="label label-primary pull-right">T</span></a></li>
                    <li><a href="#"> Completed Request -> <span class="label label-warning pull-right">C</span></a></li>
                    <li><a href="#"> Pending Request -><span class="label pull-right bg-red">P</span></a></li>

                  </ul>
                </div>
                    </div>
                </div>
                
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li class=""><a onclick="general_test()" href="#"><i class="fa fa-inbox"></i> General Test</a></li>
                    <li><a onclick="lab_test()" href="#"><i class="fa fa-envelope-o"></i> Lab Test<span class="label pull-right bg-red" id="lab_p"></span><span class="label label-warning pull-right" id="lab_c"></span><span class="label label-primary pull-right" id="lab_t"></span></a></li>
                    <li><a onclick="imi_test()" href="#"><i class="fa fa-file-text-o"></i> Imaging Test<span class="label pull-right bg-red" id="imi_p"></span><span class="label label-warning pull-right" id="imi_c"></span><span class="label label-primary pull-right" id="imi_t"></span></a></li>
                    <li><a onclick="processdata()" href="#"><i class="fa fa-filter"></i> Bed Information</a></li>
                    <li><a onclick="processdata()" href="#"><i class="fa fa-trash-o"></i> Daily care</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
          
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Patient related Informations</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                   
                    <div class="btn-group">
                  
                    </div><!-- /.btn-group -->
                    <button class="btn btn-default btn-sm">add test result</button>
                      <button class="btn btn-default btn-sm">update test result</button>
                      <button class="btn btn-default btn-sm">add lab request</button>
                      <button class="btn btn-default btn-sm">add image request</button>
                    <button class="btn btn-default btn-sm">transfer case</button>
                    <button class="btn btn-default btn-sm">close case</button>
                  
                  </div>
                  <div class="table-responsive mailbox-messages" id='show_page'>
                  
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
               
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php require APPROOT . '/views/customer/inc/footer.php'; ?>
<script src="<?php echo URLROOT ?>/public/assets/system scripts/general_test.js"></script>
<script src="<?php echo URLROOT ?>/public/assets/bower_components/moment/moment.min.js"></script>
<script src="<?php echo URLROOT ?>/public/assets/bower_components/bootstrap-daterangepicker/daterangepicker.js">
</script>

</body>

</html>