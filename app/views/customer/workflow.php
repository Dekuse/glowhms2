<?php require APPROOT . '/views/customer/inc/header.php'; ?>
<?php require APPROOT . '/views/customer/inc/aside.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
                WORKFLOW
            <small></small>
        </h1>

        <ol class="breadcrumb">
            <li class="active"><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></a>WORKFLOW</li>
            <li class="active"></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="removeMessages"></div>
                <div class="row">

                     <div class="form-group col-md-4">
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
                                <button type="btn" onclick="customerdata()" id="customer_submit" name="customer_submit"
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
             <!-- Main table -->
                <div class="box">
                    <div class="container col-md-12">
                        <div class="row col-md-12 ">
                            <div class="col-md-12">
                                <h4>CUSTOMER INFORMATION</h4>
                               

                                <table class="table" id="cutomer_data">
                                    <thead>
                                        <tr>

                                            <th>Customer Name</th>
                                            <th>Customer ID</th>
                                            <th>Sex</th>
                                            <th>Age</th>
                                            <th>Phone No</th>
                                            <th>Region</th>
                                            <th>City</th>
                                            <th>Nationality</th>
                                            <th>Card No</th>
                                            <th>Card Reg Date</th>
                                            <th>Duration</th>
                                            <th>Exp Date</th>
                                            <th>Show Work-flow</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Customer Name</th>
                                            <th>Customer ID</th>
                                            <th>Sex</th>
                                            <th>Age</th>
                                            <th>Phone No</th>
                                            <th>Region</th>
                                            <th>City</th>
                                            <th>Nationality</th>
                                            <th>Card No</th>
                                            <th>Card Reg Date</th>
                                            <th>Duration</th>
                                            <th>Exp Date</th>
                                            <th>Show Work-flow</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                   
                 <!-- information content -->
                <div class="box2"> </div>
                 <div class="">
                    <div class="container col-md-12">
                        <div class="row col-md-12 ">
                            <div class="col-md-12">
                                <h4>WORK-FLOW</h4>
                              

                                <table class="table" id="workflow_data">
                                    <thead>
                                        <tr>
                                            <th>REQUEST ID</th>
                                            <th>REQUEST CODE</th>
                                            <th>CARD NO</th>
                                            <th>CUSTOMER ID</th>
                                            <th>REQUEST STATUS</th>
                                            <th>DATE CREATED</th>
                                            <th>DATE MODIFIED</th>
                                            <th>FLOW FROM</th>
                                            <th>FLOW SENDER</th>
                                            <th>FLOW TO</th>
                                            <th>FLOW RECEIVER</th>
                                          </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>REQUEST ID</th>
                                            <th>REQUEST CODE</th>
                                            <th>CARD NO</th>
                                            <th>CUSTOMER ID</th>
                                            <th>REQUEST STATUS</th>
                                            <th>DATE CREATED</th>
                                            <th>DATE MODIFIED</th>
                                            <th>FLOW FROM</th>
                                            <th>FLOW SENDER</th>
                                            <th>FLOW TO</th>
                                            <th>FLOW RECEIVER</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
             
         
           
        </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php require APPROOT . '/views/customer/inc/footer.php'; ?>
<script src="<?php echo URLROOT ?>/public/assets/system scripts/workflow.js"></script>
<script src="<?php echo URLROOT ?>/public/assets/bower_components/moment/moment.min.js"></script>
<script src="<?php echo URLROOT ?>/public/assets/bower_components/bootstrap-daterangepicker/daterangepicker.js">
</script>

</body>

</html>