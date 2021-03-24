<?php require APPROOT . '/views/customer/inc/header.php'; ?>
<?php require APPROOT . '/views/customer/inc/aside.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            REGISTER CUSTOMER
            <small></small>
        </h1>

        <ol class="breadcrumb">
            <li class="active"><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></a>REGISTER</li>
            <li class="active"></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="removeMessages"></div>
                <div class="row">

                    <div class="col-md-3">
                        <div class="box-header with-border">
                            <h4 class="box-title">Registration Date</h4>
                        </div>
                        <div class="col-md-3" id="officer_reportrange"
                            style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <input type="text" name="REG_DATE" id="REG_DATE" width="30" readonly
                                value="<?php echo date_format(date_sub(date_create(date('Y-m-d')), date_interval_create_from_date_string('15 days')), 'Y-m-d')." - ".date('Y-m-d') ?>"><i
                                class="fa fa-caret-down"></i>
                        </div>
                    </div>

                    <div class="form-group col-md-2">
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

                    <div class="col-md-2">
                        <div class="box-header with-border">
                            <h4 class="box-title">Customer Id</h4>
                        </div>

                        <div class="">
                            <input type="text" class="form-control" id="CUSTOMER_ID" name="CUSTOMER_ID"
                                placeholder="Customer Id">
                            <span id="error_CUSTOMER_ID" class="text-danger"></span>
                        </div>

                    </div>
                    <div class="col-md-2">
                        <div class="box-header with-border">
                            <h4 class="box-title">User Id</h4>
                        </div>

                        <div class="">
                            <input type="text" class="form-control" id="USER_ID" name="USER_ID" placeholder="User Id">
                            <span id="error_USER_ID" class="text-danger"></span>
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

                <div class="box">
                    <div class="container col-md-12">
                        <div class="row col-md-12 ">
                            <div class="col-md-12">

                                <br>

                                <div class="btn-group">
                                    <button class="btn btn-info  pull pull-left" onclick="resend()" id="resend">Re-send
                                        to cashier</button>

                                    <button class="btn pull pull-right"
                                        onclick="successtoaster('info','IF THE CUSTOMER IS ALREADY REGISTERED CUSTOMER NO NEED TO RE-REGISTER.','INFORMATION')"><i
                                            class="fa fa-question-circle"></i></button>
                                </div>

                                <br>
                                <div clas="row">
                                    <button class="btn pull pull-right"
                                        onclick="successtoaster('info','YOU CAN ADD NEW CUSTOMER WITH THIS MENU','INFORMATION')"><i
                                            class="fa fa-question-circle"></i></button>

                                    <button class="btn btn-default pull pull-right" data-toggle="modal"
                                        data-target="#addcustomer" id="addcus">
                                        <span class="glyphicon glyphicon-plus-sign"></span> Add Customer
                                    </button>
                                </div>


                                <br /> <br /> <br />

                                <table class="table" id="reg_customerdata">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer ID</th>
                                            <th>User Id</th>
                                            <th>Customer Name</th>
                                            <th>Sex</th>
                                            <th>Age</th>
                                            <th>Phone No</th>
                                            <th>Region</th>
                                            <th>City</th>
                                            <th>Nationality</th>
                                            <th>Reg Date</th>
                                            <th>Card Detail</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer ID</th>
                                            <th>User Id</th>
                                            <th>Customer Name</th>
                                            <th>Sex</th>
                                            <th>Age</th>
                                            <th>Phone No</th>
                                            <th>Region</th>
                                            <th>City</th>
                                            <th>Nationality</th>
                                            <th>Reg Date</th>
                                            <th>Card Detail</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- add modal -->

                    <div class="modal fade" tabindex="-1" role="dialog" id="addcustomer">
                        <div class="modal-dialog modal-dialog modal-dialog_style" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <button class="close" type="button"
                                        onclick="successtoaster('info','YOU CAN ADD NEW CUSTOMER TYPE WITH THIS MENU','INFORMATION')"><span
                                            aria-hidden="true">&quest;</span></button>
                                    <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span> Add
                                        Customer</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="messages"></div>
                                    <p>
                                        <h4>Please note: </h4>Fields with this sign <span style="color:red">*</span> are
                                        mandatory
                                    </p>

                                    <form method="post" class="form-horizontal" id="addcustomerform"
                                        name="addcustomerform" action="" enctype=”multipart/form-data”>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label for="fname" class="col-sm-3 control-label">Customer Name
                                                        <span style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="CUSTOMERNAME"
                                                            name="CUSTOMERNAME" placeholder="customer name">
                                                        <span id="error_CUSTOMERNAME" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','INSERT THE NAME OF THE CUSTOMER','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>

                                                <div class="form-group radio">
                                                    <label for="lname" class="col-sm-3 control-label">Sex<span
                                                            style="color:red">*</span></label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control control control-label" name="SEX"
                                                            id="SEX" title="Sex">
                                                            <option value="">~~SELECT~~</option>
                                                            <option value="M">Male</option>
                                                            <option value="F">Female</option>
                                                        </select>
                                                        <span id="error_SEX" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','SELECT GENDER TYPE','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label for="fname" class="col-sm-3 control-label">Age <span
                                                            style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" min=1 value=1 id="AGE"
                                                            name="AGE" placeholder="bedroom counter">
                                                        <span id="bedcount" class=""></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','INSERT AGE OF CUSTOMER','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>


                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label class="col-sm-3 control-label">Mobile Number <span
                                                            style="color:red">*</span></label>
                                                    <div class="col-sm-8">

                                                        <div class="input-group col-sm-8">
                                                            <div class="input-group-addon">
                                                                <span class="">+251</span>
                                                            </div>
                                                            <input type="text" class="form-control " name="PHONENO"
                                                                id="PHONENO" data-inputmask='"mask": "(99) 999-9999"'
                                                                data-mask>


                                                        </div><!-- /.input group -->
                                                        <span id="error_PHONENO" class=""></span>
                                                    </div><!-- /.form group -->
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','ENTER PHONE NUMBER IN THE FOLLOWING FORMAT (99) 999-9999','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>


                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group radio">
                                                    <label for="lname" class="col-sm-3 control-label">Region</label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control control" name="REGION" id="REGION"
                                                            title="REGION">
                                                            <option value="">~~SELECT~~</option>
                                                            <?php
						
                                                                        foreach($data['region'] as $regiontype) : 
                                                                    echo '<option value="';
                                                                echo $regiontype->REGION.'">';
                                                                                                            echo $regiontype->REGION; echo '</option>';
                                                                                                            
                                                                        endforeach;                                 
                                                                ?>


                                                        </select>
                                                        <span id="error_REGION" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','SELECT REGION OF THE USER','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <!--/here teh addclass has-error will appear -->
                                                    <label for="fname" class="col-sm-3 control-label">Customer City
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="CUSTOMERCITY"
                                                            name="CUSTOMERCITY" placeholder="customer city">
                                                        <span id="error_CUSTOMERCITY" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','INSERT THE NAME OF THE CUSTOMER','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>

                                                <div class="form-group radio">
                                                    <label for="lname" class="col-sm-3 control-label">Nationality<span
                                                            style="color:red">*</span></label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control control" name="NATIONALITY"
                                                            id="NATIONALITY" title="">
                                                            <option value="">~~SELECT~~</option>
                                                            <?php
						
                                                                            foreach($data['nation'] as $nationtype) : 
                                                                        echo '<option value="';
                                                                    echo $nationtype->CountryName.'">';
                                                                                                                echo $nationtype->CountryName; echo '</option>';
                                                                                                                
                                                                            endforeach;                                 
                                                                    ?>


                                                        </select>
                                                        <span id="error_NATIONALITY" class="text-danger"></span>
                                                    </div>
                                                    <label class="col-sm-1 control-label"> <button class="close"
                                                            type="button"
                                                            onclick="successtoaster('info','SELECT NATIONALITY OF THE CUSTOMER','INFORMATION')"><span
                                                                aria-hidden="true">&quest;</span></button>
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <br>

                                        <div align="center">






                                            <div class="margin">

                                                <div class="btn-group">
                                                    <button type="submit" class="btn btn-primary">Save </button>

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
                <!-- /add customer-->


                <div class="modal modal-info fade" tabindex="-1" role="dialog" id="resend_modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"><i class="fa fa-check-circle-o"></i> Re-send customer to cashier
                                </h4>
                            </div>
                            <div class="modal-body">
                                <p>Send this customer to cashier ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left"
                                    data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-outline" id="enableBtn">Save changes</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <!-- show visa modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="showCardModal">
                    <div class="modal-dialog modal-dialog_style" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"><i class="fa fa-eye" aria-hidden="true"></i>Card Information
                                </h4>
                            </div>



                            <div class="modal-body">

                                <table class="table" id="cardTable">
                                    <thead>
                                        <tr>

                                            <th>Id</th>
                                            <th>Card No</th>
                                            <th>Customer Id</th>
                                            <th>Date created</th>
                                            <th>Duration</th>
                                            <th>Renew date</th>
                                            <th>Expiry date</th>
                                            <th>Expiry status</th>
                                            <th>Card type</th>
                                            <th>Card priority</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>

                                            <th>Id</th>
                                            <th>Card No</th>
                                            <th>Customer Id</th>
                                            <th>Date created</th>
                                            <th>Duration</th>
                                            <th>Renew date</th>
                                            <th>Expiry date</th>
                                            <th>Expiry status</th>
                                            <th>Card type</th>
                                            <th>Card priority</th>
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
                <!-- /show  modal -->

           
        </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php require APPROOT . '/views/customer/inc/footer.php'; ?>
<script src="<?php echo URLROOT ?>/public/assets/system scripts/regcustomer.js"></script>
<script src="<?php echo URLROOT ?>/public/assets/bower_components/moment/moment.min.js"></script>
<script src="<?php echo URLROOT ?>/public/assets/bower_components/bootstrap-daterangepicker/daterangepicker.js">
</script>

</body>

</html>