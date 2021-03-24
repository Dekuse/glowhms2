var manageMemberTable;
var id = null;
$(document).ready(function() {
    customerdatatable = $("#reg_customerdata").DataTable({
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
    CardData = $("#cardTable").DataTable({
        data: [],
        
        columns: [
            { data: "0" },
            { data: "1" },
            { data: "2" },
            { data: "3" },
            { data: "4" },
            { data: "5" },
            { data: "6" },
            { data: "7" },
            { data: "8" },
            { data: "9" },
           
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
        "autoWidth": !0,
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
    $("#PHONENO").inputmask();
    $("#editPHONENO").inputmask();
    //customerdata();
});


function loadtextcustomer(value) {
    var column = customerdatatable.column(value);
    var select = $('<input type="text" style="width: 140px;" placeholder="Search ' + '" />').appendTo($(column.footer()).empty()).on('keyup change', function() {
        var val = $(this).val();
        customerdatatable.columns(value).search(val).draw()
    })
}

function loadselectcustomer(value) {
    var column = customerdatatable.column(value);
    var select = $('<select><option value=""></option></select>').appendTo($(column.footer()).empty()).on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', !0, !1).draw()
    });
    column.data().unique().sort().each(function(d, j) {
        select.append('<option value="' + d + '">' + d + '</option>')
    })
}

function customerdata() {
    var REGDATE = $("#REG_DATE").val();
    var CUSTOMERNAME =  $("#CUSTOMER_NAME").val();
    var CUSTOMERID = $("#CUSTOMER_ID").val();
    var USERID = $("#USER_ID").val();
    $.ajax({
        url: 'http://10.1.50.189:8001/customer/getcusdata',
        type: "post",
        data: {
            'regdate': REGDATE,
            'customername': CUSTOMERNAME,
            'customerid': CUSTOMERID,
            'userid': USERID
        },
        dataType: 'json',
        success: function(DBresponse) {
            
            if(DBresponse.data[0].OUTPUT!=false){
                customerdatatable.clear().draw();
                for (var i = 0; i < DBresponse.data['0'].SIZE; i++) {
                    customerdatatable.row.add([DBresponse.data[i].ID, DBresponse.data[i].CUS_ID, DBresponse.data[i].USER_ID, DBresponse.data[i].CUS_NAME, DBresponse.data[i].SEX, DBresponse.data[i].AGE, DBresponse.data[i].PHONENO,
                        DBresponse.data[i].REGION,DBresponse.data[i].CITY,DBresponse.data[i].NATIONALITY,
                        DBresponse.data[i].REG_DATE,DBresponse.data[i].CARD_STATUS, ]).draw()
                }
                customerdatatable.columns().every(function() {
                    var that = this;
                    $('input', this.footer()).on('keyup change', function() {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw()
                        }
                    })
                });
                loadtextcustomer(3)
                loadselectcustomer(7);
                loadselectcustomer(9);
                
            }
            else{
                customerdatatable.clear().draw();
                successtoaster('info','No data found.','Operation Successful')
            }
            
 
        }
    })
}
$("#addcus").on('click', function() {
    var customerdata = {
        "forminputs": {
            "size": "5",
            "mainerror": !1,
            "0": "CUSTOMERNAME",
            "1": "SEX",
            "2": "PHONENO",
            "3": "REGION",
            "4": "CUSTOMERCITY",
            "5": "NATIONALITY",
                     
        },
        "CUSTOMERNAME": {
            "haserror": !1,
            "formliteral": "FULL NAME",
            "inputtype": "string",
            "errorname": "error_CUSTOMERNAME",
            "errorvalue": null,
            "mandatory": !0
        },
        "SEX": {
            "haserror": !1,
            "formliteral": "SEX",
            "inputtype": "select",
            "errorname": "error_SEX",
            "errorvalue": null,
            "mandatory": !0
        },
        "PHONENO": {
            "haserror": !1,
            "formliteral": "PHONE NUMBER",
            "inputtype": "mobile",
            "errorname": "error_PHONENO",
            "errorvalue": null,
            "mandatory": !0
        },
        "REGION": {
            "haserror": !1,
            "formliteral": "REGION",
            "inputtype": "select",
            "errorname": "error_REGION",
            "errorvalue": null,
            "mandatory": !1
        },
        "CUSTOMERCITY": {
            "haserror": !1,
            "formliteral": "CUSTOMER CITY",
            "inputtype": "string",
            "errorname": "error_CUSTOMERCITY",
            "errorvalue": null,
            "mandatory": !1
        },
        "NATIONALITY": {
            "haserror": !1,
            "formliteral": "NATIONALITY",
            "inputtype": "select",
            "errorname": "error_NATIONALITY",
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
                        url: 'http://10.1.50.189:8001/customer/addcustomerdata',
                        type: "post",
                        data: formtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#addcustomerform")[0].reset();
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

$(function() {
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#REG_DATE').val(start.format('YYYY-MM-D') + ' - ' + end.format('YYYY-MM-D'))
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


function successtoaster( type, header, message){


    toastr.options.progressBar = true;
    
    var $toast = toastr[type](header, message)
  

}

function resend() {
    var count = customerdatatable.rows({
        selected: !0
    }).count();
    if (count != 0) {
        var row = customerdatatable.row({
            selected: !0
        });
        var data = row.data();
       
            $("#resend_modal").modal();
       
    } else {
        successtoaster('error','Please select an item','Operation failed')
    }
}

$("#resend_modal").on('shown.bs.modal', function() {
    var row = customerdatatable.row({
        selected: !0
    });
    var data = row.data();
   
    $("#enableBtn").unbind('click').bind('click', function() {
        $.ajax({
            url: 'http://10.1.50.189:8001/customer/resend_customer',
                        type: "post",
                        data: {
                            CUS_ID: data[1],
                            CUS_NAME: data[4],
                        },
                        dataType: 'json',
                       
            success: function(response) {
                if (response.success == !0) {
                    
                    $("#resend_modal").modal('hide')
                    successtoaster('success',response.messages,'Operation Successful')
                } else {
                    successtoaster('danger',response.messages,'Operation Failed')
                }
            }
        })
    })
});

function showCard(CUS_ID) {
    if (CUS_ID) {
        $.ajax({
            url: "http://10.1.50.189:8001/customer/getCardData",
            type: "post",
            data: { CUS_ID: CUS_ID },
            dataType: "json",
            success: function (result) {
                CardData.clear().draw();
                for (var i = 0; i < result.data["0"]["SIZE"]; i++) {
                  
                    CardData.row
                        .add([
                            result.data[i].ID,
                            result.data[i]["CARD_NO"],
                            result.data[i]["CUS_ID"],
                            result.data[i]["DATE_CREATED"],
                            result.data[i]["DURATION"],
                            result.data[i]["RENEW_DATE"],
                            result.data[i]["EXPIRY_DATE"],
                            result.data[i]["EXPIRY_STATUS"],
                            result.data[i]["CARD_TYPE"],
                            result.data[i].CARD_PR_TYPE,
                            
                        ])
                        .draw();
                }
                $("#showCardModal").modal();
               
            },
        });
     
       
    } else {
        successtoaster('danger',response.messages,'Operation Failed')
    }
}


