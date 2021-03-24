var manageMemberTable;
var id = null;
var lastused_data = {
    'REQ_DATE': "",
    'PAY_TYPE': "",
    'PAY_STATUS': "",
    'CARD_ID':"",
    'CUS_ID': "",
    'CUSTOMER_NAME':"",
};
$(document).ready(function() {
    paymenttable = $("#payment_data").DataTable({
        data: [],
        "order": [
            [0, "desc"]
        ],
        scrollX: !0,
        select: {
            style: 'single'
        },
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        "paging": !0,
        "lengthChange": !0,
        "ordering": !0,
        "info": !0,
        "autoWidth": !1,
        mark: !0,
        dom: 'Bfrtip',
        buttons: [ 'excel', {
            extend : 'pdfHtml5',
           
            orientation : 'landscape',
            pageSize : 'LEGAL',
            text : 'PDF',
            titleAttr : 'PDF'
            }, 'print', 'pageLength'],
    });
    
    $("#add_PHONENO").inputmask();
});


function loadtextcustomer(value) {
    var column = paymenttable.column(value);
    var select = $('<input type="text" style="width: 100px;" placeholder="Search ' + '" />').appendTo($(column.footer()).empty()).on('keyup change', function() {
        var val = $(this).val();
        paymenttable.columns(value).search(val).draw()
    })
}

function loadselectcustomer(value) {
    var column = paymenttable.column(value);
    var select = $('<select><option value=""></option></select>').appendTo($(column.footer()).empty()).on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', !0, !1).draw()
    });
    column.data().unique().sort().each(function(d, j) {
        select.append('<option value="' + d + '">' + d + '</option>')
    })
}

    $("#payment_form").unbind('submit').bind('submit', function() {

        var paymentdata = {
            "forminputs": {
                "size": "1",
                "mainerror": !1,
                "0": "PAY_TYPE",
                "1": "PAY_STATUS",
                 
            },
        
            "PAY_TYPE": {
                "haserror": !1,
                "formliteral": "payment type",
                "inputtype": "select",
                "errorname": "error_APP_TYPE",
                "errorvalue": null,
                "mandatory": !0
            },
            "PAY_STATUS": {
                "haserror": !1,
                "formliteral": "payment status",
                "inputtype": "select",
                "errorname": "error_PAY_STATUS",
                "errorvalue": null,
                "mandatory": !0
            },
       
        };

        var payjson = JSON.stringify(paymentdata);
        var addForm = document.getElementById('payment_form');
        var payform = new FormData(addForm);
        payform.append('json', payjson);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: payform,
            dataType: 'json',
            processData: !1,
            contentType: !1,
            success: function(response) {
                if (response.forminputs.mainerror == !1) {
                    
                    lastused_data['REQ_DATE']  = $("#REQ_DATE").val();
                    lastused_data['PAY_TYPE'] =  $("#PAY_TYPE").val();
                    lastused_data['PAY_STATUS'] =  $("#PAY_STATUS").val();
                    lastused_data['CARD_ID'] = $("#CARD_ID").val();
                    lastused_data['CUS_ID'] =  $("#CUS_ID").val();
                    lastused_data['CUSTOMER_NAME'] = $("#CUSTOMER_NAME").val();
                    processData(lastused_data);
                   
                } else {
                    for (var i = 0; i <= response.forminputs.size; i++) {
                        if (response[response.forminputs[i]].haserror == !0) {
                            successtoaster('error',response[response.forminputs[i]].errorvalue,'Operation Failed')

                        } 
                    }
                }
            }
        });
        return !1
    })

    function processData(data){
        $.ajax({
            url: 'http://10.1.50.189:8001/customer/getpayment',
            type: "post",
            data: {
                'REQ_DATE': data['REQ_DATE'] ,
                'PAY_TYPE': data['PAY_TYPE'] ,
                'PAY_STATUS': data['PAY_STATUS'] ,
                'CARD_ID':data['CARD_ID'] ,
                'CUS_ID': data['CUS_ID'] ,
                'CUSTOMER_NAME':data['CUSTOMER_NAME'] 
            },
            dataType: 'json',
            success: function(DBresponse) {
                
                if(DBresponse.data[0].OUTPUT!=false){
                    paymenttable.clear().draw();
                    for (var i = 0; i < DBresponse.data['0'].SIZE; i++) {

                        paymenttable.row.add([DBresponse.data[i].CUS_NAME,
                             DBresponse.data[i].REQ_ID, 
                             DBresponse.data[i].REQ_TYPE, 
                             DBresponse.data[i].CUS_ID,
                             DBresponse.data[i].CARD_NO, 
                             DBresponse.data[i].USER_ID, 
                             DBresponse.data[i].MAJOR_SER_CODE,
                            DBresponse.data[i].SERVICE_CODE,
                            DBresponse.data[i].SERVICE_PRICE,
                            DBresponse.data[i].REQ_DESCI,
                            DBresponse.data[i].DATE_CREATED,
                            DBresponse.data[i].REQ_STATUS,
                            DBresponse.data[i].REQ_PAYMENT_STATUS,
                            DBresponse.data[i].DONEBY,
                            DBresponse.data[i].REQ_TAKE_TIME,
                            DBresponse.data[i].REQ_DONE_TIME,
                           
                         ]).draw()
                    }
                    paymenttable.columns().every(function() {
                        var that = this;
                        $('input', this.footer()).on('keyup change', function() {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw()
                            }
                        })
                    });
                    loadtextcustomer(0)
                    loadtextcustomer(3);
                    loadtextcustomer(4);
                                                 
                }
                else{
                    paymenttable.clear().draw();
                    successtoaster('info','No data found.','Operation Successful')
                }
                
     
            }
        })
    }

    function showUser(USER_ID) {
        if (USER_ID) {
            $.ajax({
                url: 'http://10.1.50.189:8001/customer/singleUserData',
                type: 'post',
                data: {
                    USER_ID: USER_ID
                },
                dataType: 'json',
         
                success: function(response) {
                    $("#USER_ID").val(response.USER_ID);
                    $("#FULL_NAME").val(response.FULL_NAME);
                    $("#SEX").val(response.SEX);
                    $("#PHONENO").val(response.PHONENO);
                    $("#MAJOR_ACTOR").val(response.MAJOR_ACTOR);
                    $("#PROFESSION").val(response.PROFESSION);
                
                }
            })
        } else {
            successtoaster('error','Refresh the page again','Operation Failed')
        }
    }

    function get_user_data(CUS_ID) {
        if (CUS_ID) {
            $.ajax({
                url: 'http://10.1.50.189:8001/customer/singleCusData',
                type: 'post',
                data: {
                    CUS_ID: CUS_ID
                },
                dataType: 'json',
                
                success: function(response) {
                    $("#CUS_IDV").val(response.CUS_ID);
                    $("#CUS_NAME").val(response.CUS_NAME);
                    $("#SEXV").val(response.SEX);
                    $("#AGE").val(response.AGE);
                    $("#PHONENOV").val(response.PHONENO);
                    $("#REG_DATE").val(response.REG_DATE);
                
                }
            })
        } else {
            successtoaster('error','Refresh the page again','Operation Failed')
        }
    }

    function get_ser_data(SERVICE_CODE) {
        if (CUS_ID) {
            $.ajax({
                url: 'http://10.1.50.189:8001/customer/singleServiceData',
                type: 'post',
                data: {
                    SERVICE_CODE: SERVICE_CODE
                },
                dataType: 'json',
                
                success: function(response) {
                    $("#SERVICE_CODE").val(response.SERVICE_CODE);
                    $("#SERVICE_NAME").val(response.SERVICE_NAME);
                    $("#MAJOR_SER_CODE").val(response.MAJOR_SER_CODE);
                    $("#SER_NAME").val(response.SER_NAME);
                    $("#DESCI").val(response.DESCI);
                    $("#PRICE").val(response.PRICE);
                
                }
            })
        } else {
            successtoaster('error','Refresh the page again','Operation Failed')
        }
    }
    
    function pro_single_payment() {
        var count = paymenttable.rows({
            selected: !0
        }).count();
        if (count != 0) {
            var row = paymenttable.row({
                selected: !0
            });
            var data = row.data();
            if(data[11]!='C'){
            
               
                    if(data[11]=='P'){
                        $.ajax({
                            url: 'http://10.1.50.189:8001/customer/update_status',
                            type: 'post',
                            data: {
                                REQ_ID: data[1],
                                MAJOR_SER_CODE:data[6],
                                REQ_PAYMENT_STATUS:data[12]
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.success == !0) {
                                    processData(lastused_data);
                                    successtoaster('success',response.messages,'Operation Successful')
                                    if (data[6] == "CAR_T" ){
                                        $("#pay_card_modal").modal({ backdrop: "static", keyboard: !1 });
                                    }
                                    else{
                                       
                                        $("#pay_ser_modal").modal({ backdrop: "static", keyboard: !1 });
                                    }
                                    
                                   
                                } else {
                                    successtoaster('error',response.messages,'Operation Failed')
                                }
                            }
                        })
                    }
                    else{
                        if (data[6] == "CAR_T" ){
                            $("#pay_card_modal").modal({ backdrop: "static", keyboard: !1 });
                        }
                        else{
                            $("#SER_PRICE").val(data[8]);
                            $("#pay_ser_modal").modal({ backdrop: "static", keyboard: !1 });
                        }
                    }
            }
            else{
                successtoaster('error','THE ITEM IS ALREADY PROCESSED.','Operation Failed')
            }
            
            
        } else {
            successtoaster('error','Please select an item','Operation failed')
        }
    }
    $('#pay_card_modal').on('hidden.bs.modal', function (e) {
        processData(lastused_data);
      })

      $('#pay_ser_modal').on('hidden.bs.modal', function (e) {
        processData(lastused_data);
      })

      $('#addcustomer').on('hidden.bs.modal', function (e) {
        processData(lastused_data);
      })
    
    
$("#pay_card_modal").on('shown.bs.modal', function() {
    $("#paycardform")[0].reset();
    var row = paymenttable.row({
        selected: !0
    });
    var data = row.data();
    //$('#CUS_ID_NC').val(data[3]);
   // $('#CARD_NO_NC').val(data[4]);

 
    var pro_single_pay = {
        "forminputs": {
            "size": "0",
            "mainerror": !1,
            "0": "CARD_TYPE",
          
        },
        "CARD_TYPE": {
            "haserror": !1,
            "formliteral": "Card Type",
            "inputtype": "select",
            "errorname": "error_edit_CARD_TYPE",
            "errorvalue": null,
            "mandatory": !0
        }
      
    };
    for (var i = 0; i <= pro_single_pay.forminputs.size; i++) {
        $('#' + pro_single_pay[pro_single_pay.forminputs[i]].errorname).text(pro_single_pay[pro_single_pay.forminputs[i]].errorvalue);
        $('#' + pro_single_pay[pro_single_pay.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + pro_single_pay.forminputs[i]).removeClass('has-success');
        $('#' + pro_single_pay.forminputs[i]).removeClass('has-error')
    }
    
    $(".messages").html("");
    $("#paycardform").unbind('submit').bind('submit', function() {
      
        var singlepayJson = JSON.stringify(pro_single_pay);
        var editForm = document.getElementById('paycardform');
        var editsinglepayForm = new FormData(editForm);
        var editFormtodb = new FormData(editForm);
        editFormtodb.append('REQ_ID', data[1]);
        editFormtodb.append('CUS_ID', data[3]);
        editFormtodb.append('MAJOR_SER_CODE', data[6]);
        editFormtodb.append('CUS_NAME', data[0]);
        editsinglepayForm.append('json', singlepayJson);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: editsinglepayForm,
            dataType: 'json',
            processData: !1,
            contentType: !1,
            success: function(response) {
                if (response.forminputs.mainerror == !1) {
                    $(".form-group").removeClass('has-error');
                    $(".text-danger").html(" ");
                    for (var i = 0; i <= response.forminputs.size; i++) {
                        $('#' + response.forminputs[i]).removeClass('has-error');
                        $('#' + response.forminputs[i]).addClass('has-success')
                    }
                    $.ajax({
                        url: 'http://10.1.50.189:8001/customer/pro_card_payment',
                        type: "post",
                        data: editFormtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#paycardform")[0].reset();
                                $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + DBresponse.messages + '</div>');                             
                                $("#pay_card_modal").modal('hide');
                                
                                successtoaster('success',DBresponse.messages,'Operation Successful')
                            } else {
                                successtoaster('danger',DBresponse.messages,'Operation Failed')
                                $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + DBresponse.messages + '</div>')
                            }
                        }
                    })
                } else {
                    for (var i = 0; i <= response.forminputs.size; i++) {
                        if (response[response.forminputs[i]].haserror == !0) {
                            $('#' + response[response.forminputs[i]].errorname).text(response[response.forminputs[i]].errorvalue);
                            $('#' + response[response.forminputs[i]].errorname).addClass('text-danger');
                            $('#' + response.forminputs[i]).removeClass('has-success');
                            $('#' + response.forminputs[i]).addClass('has-error')
                        } else {
                            $('#' + response[response.forminputs[i]].errorname).text(response[response.forminputs[i]].errorvalue);
                            $('#' + response[response.forminputs[i]].errorname).removeClass('text-danger');
                            $('#' + response.forminputs[i]).removeClass('has-error');
                            $('#' + response.forminputs[i]).addClass('has-success')
                        }
                    }
                }
            }
        });
        return !1
    })
})

$("#pay_ser_modal").on('shown.bs.modal', function() {
    $("#payserform")[0].reset();
    
    var row = paymenttable.row({
        selected: !0
    });
    var data = row.data();
    $("#SER_PRICE").val(data[8]);
    $.ajax({
        url: 'http://10.1.50.189:8001/customer/singlePayData',
        type: 'post',
        data: {
            REQ_ID : data[1],
        },
        dataType: 'json',
 
        success: function(response) {
            if(response!=false){
                $("#LEFT_AMOUNT").val(response.LEFT_AMOUNT);
                $("#PAYMENT_TYPE").val(response.PAYMENT_TYPE).change();
            }
            else{
                $("#LEFT_AMOUNT").val(data[8]);
            }
          
        }
    })
   
    var pro_ser_pay = {
        "forminputs": {
            "size": "1",
            "mainerror": !1,
            "0": "PAID_AMOUNT",
            "1": "PAYMENT_TYPE",
          
        },
        "PAID_AMOUNT": {
            "haserror": !1,
            "formliteral": "Paid Amount",
            "inputtype": "number",
            "errorname": "error_PAID_AMOUNT",
            "errorvalue": null,
            "mandatory": !0
        },
        "PAYMENT_TYPE": {
            "haserror": !1,
            "formliteral": "Payment Type",
            "inputtype": "select",
            "errorname": "error_PAYMENT_TYPE",
            "errorvalue": null,
            "mandatory": !0
        }
      
    };
    for (var i = 0; i <= pro_ser_pay.forminputs.size; i++) {
        $('#' + pro_ser_pay[pro_ser_pay.forminputs[i]].errorname).text(pro_ser_pay[pro_ser_pay.forminputs[i]].errorvalue);
        $('#' + pro_ser_pay[pro_ser_pay.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + pro_ser_pay.forminputs[i]).removeClass('has-success');
        $('#' + pro_ser_pay.forminputs[i]).removeClass('has-error')
    }
    
    $(".messages").html("");
    $("#pay_ser_modal").unbind('submit').bind('submit', function() {
        var serpayJson = JSON.stringify(pro_ser_pay);
        var editForm = document.getElementById('payserform');
        var editserpayForm = new FormData(editForm);
       
        editserpayForm.append('json', serpayJson);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: editserpayForm,
            dataType: 'json',
            processData: !1,
            contentType: !1,
            success: function(response) {
                if (response.forminputs.mainerror == !1) {
                    $(".form-group").removeClass('has-error');
                    $(".text-danger").html(" ");
                    for (var i = 0; i <= response.forminputs.size; i++) {
                        $('#' + response.forminputs[i]).removeClass('has-error');
                        $('#' + response.forminputs[i]).addClass('has-success')
                    }
                     if(($("#LEFT_AMOUNT").val()-$("#PAID_AMOUNT").val())<0){
                        successtoaster('error','Incorrect payment amount is inserted, please check.','Operation Failed')

                    }
                    else if(data[8] == $("#PAID_AMOUNT").val() && $("#PAYMENT_TYPE").val()=='PRE' && $("#PAID_AMOUNT").val()==$("#LEFT_AMOUNT").val()){

                        process_pay();
                    }
                    else if(data[8] != $("#PAID_AMOUNT").val() && $("#PAYMENT_TYPE").val()=='PRE-POST' ){
                        process_pay();
                    }
               
                    else{
                        successtoaster('error','Payment amount and payment type is not the same please check.','Operation Failed')
                        
                    }
              
                } else {
                    for (var i = 0; i <= response.forminputs.size; i++) {
                        if (response[response.forminputs[i]].haserror == !0) {
                            $('#' + response[response.forminputs[i]].errorname).text(response[response.forminputs[i]].errorvalue);
                            $('#' + response[response.forminputs[i]].errorname).addClass('text-danger');
                            $('#' + response.forminputs[i]).removeClass('has-success');
                            $('#' + response.forminputs[i]).addClass('has-error')
                        } else {
                            $('#' + response[response.forminputs[i]].errorname).text(response[response.forminputs[i]].errorvalue);
                            $('#' + response[response.forminputs[i]].errorname).removeClass('text-danger');
                            $('#' + response.forminputs[i]).removeClass('has-error');
                            $('#' + response.forminputs[i]).addClass('has-success')
                        }
                    }
                }
            }
        });
        return !1
    })
})

function process_pay(){
    var row = paymenttable.row({
        selected: !0
    });
    var data = row.data();
    $.ajax({
        url: 'http://10.1.50.189:8001/customer/pro_req_payment',
        type: "post",
        
        data: {
            REQ_ID: data[1],
            CUS_ID:data[3],
            MAJOR_SER_CODE:data[6],
            CUS_NAME:data[0],
            SERVICE_PRICE:data[8],
            CARD_NO:data[4],
            REQ_TYPE:data[2],
            PAID_AMOUNT:$("#PAID_AMOUNT").val(),
            PAYMENT_TYPE:$("#PAYMENT_TYPE").val(),
        },
        dataType: 'json',
       
        
        success: function(DBresponse) {
            if (DBresponse.success == !0) {
                $("#payserform")[0].reset();
                $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + DBresponse.messages + '</div>');                             
                $("#pay_ser_modal").modal('hide');
                
                successtoaster('success',DBresponse.messages,'Operation Successful')
            } else {
                successtoaster('danger',DBresponse.messages,'Operation Failed')
                $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + DBresponse.messages + '</div>')
            }
        }
    });
}

$(function() {
    var start = moment().subtract(0, 'days');
    var end = moment();

    function cb(start, end) {
        $('#REQ_DATE').val(start.format('YYYY-MM-D') + ' - ' + end.format('YYYY-MM-D'))
    }
    $('#officer_reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);
    cb(start, end)
});

$("#addcus").on('click', function() {
    var customerdata = {
        "forminputs": {
            "size": "7",
            "mainerror": !1,
            "0": "add_CUSTOMERNAME",
            "1": "add_SEX",
            "2": "add_PHONENO",
            "3": "add_REGION",
            "4": "add_CUSTOMERCITY",
            "5": "add_NATIONALITY",
            "6": "add_SERVICE",
            "7": "W_CARD_PR_TYPE",       
        },
        "add_CUSTOMERNAME": {
            "haserror": !1,
            "formliteral": "FULL NAME",
            "inputtype": "string",
            "errorname": "error_add_CUSTOMERNAME",
            "errorvalue": null,
            "mandatory": !0
        },
        "add_SEX": {
            "haserror": !1,
            "formliteral": "SEX",
            "inputtype": "select",
            "errorname": "error_add_SEX",
            "errorvalue": null,
            "mandatory": !0
        },
        "add_PHONENO": {
            "haserror": !1,
            "formliteral": "PHONE NUMBER",
            "inputtype": "mobile",
            "errorname": "error_add_PHONENO",
            "errorvalue": null,
            "mandatory": !0
        },
        "add_REGION": {
            "haserror": !1,
            "formliteral": "REGION",
            "inputtype": "select",
            "errorname": "error_add_REGION",
            "errorvalue": null,
            "mandatory": !1
        },
        "add_CUSTOMERCITY": {
            "haserror": !1,
            "formliteral": "CUSTOMER CITY",
            "inputtype": "string",
            "errorname": "error_add_CUSTOMERCITY",
            "errorvalue": null,
            "mandatory": !1
        },
        "add_NATIONALITY": {
            "haserror": !1,
            "formliteral": "NATIONALITY",
            "inputtype": "select",
            "errorname": "error_add_NATIONALITY",
            "errorvalue": null,
            "mandatory": !0
        },
        "add_SERVICE": {
            "haserror": !1,
            "formliteral": "SERVICE",
            "inputtype": "select",
            "errorname": "error_add_SERVICE",
            "errorvalue": null,
            "mandatory": !0
        },
        "W_CARD_PR_TYPE": {
            "haserror": !1,
            "formliteral": "Card Type",
            "inputtype": "select",
            "errorname": "error_W_CARD_PR_TYPE",
            "errorvalue": null,
            "mandatory": !0
        },
             
        
    };
    for (var i = 0; i <= customerdata.forminputs.size; i++) {
        $('#' + customerdata[customerdata.forminputs[i]].errorname).text(customerdata[customerdata.forminputs[i]].errorvalue);
        $('#' + customerdata[customerdata.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + customerdata.forminputs[i]).removeClass('has-success');
        $('#' + customerdata.forminputs[i]).removeClass('has-error')
    }
    $("#addcustomerform")[0].reset();
    $(".messages").html("");
    $("#addcustomerform").unbind('submit').bind('submit', function() {
        var customerjson = JSON.stringify(customerdata);
        var addForm = document.getElementById('addcustomerform');
        var createcustomerform = new FormData(addForm);
        var formtodb = new FormData(addForm);
        createcustomerform.append('json', customerjson);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: createcustomerform,
            dataType: 'json',
            processData: !1,
            contentType: !1,
            success: function(response) {
                if (response.forminputs.mainerror == !1) {
                    $(".form-group").removeClass('has-error');
                    $(".text-danger").html(" ");
                    for (var i = 0; i <= response.forminputs.size; i++) {
                        $('#' + response.forminputs[i]).removeClass('has-error');
                        $('#' + response.forminputs[i]).addClass('has-success')
                    }
                    $.ajax({
                        url: 'http://10.1.50.189:8001/customer/addpaymentdata',
                        type: "post",
                        data: formtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#addcustomerform")[0].reset();
                                $("#addcustomer").modal('hide');
                                $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + DBresponse.messages + '</div>');
                                successtoaster('success',DBresponse.messages,'Operation Successful')
                            } else {
                                $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + DBresponse.messages + '</div>')
                            }
                        }
                    })
                } else {
                    for (var i = 0; i <= response.forminputs.size; i++) {
                        if (response[response.forminputs[i]].haserror == !0) {
                            $('#' + response[response.forminputs[i]].errorname).text(response[response.forminputs[i]].errorvalue);
                            $('#' + response[response.forminputs[i]].errorname).addClass('text-danger');
                            $('#' + response.forminputs[i]).removeClass('has-success');
                            $('#' + response.forminputs[i]).addClass('has-error')
                        } else {
                            $('#' + response[response.forminputs[i]].errorname).text(response[response.forminputs[i]].errorvalue);
                            $('#' + response[response.forminputs[i]].errorname).removeClass('text-danger');
                            $('#' + response.forminputs[i]).removeClass('has-error');
                            $('#' + response.forminputs[i]).addClass('has-success')
                        }
                    }
                }
            }
        });
        return !1
    })
})
function successtoaster( type, header, message){


    toastr.options.progressBar = true;
    
    var $toast = toastr[type](header, message)
  

}




