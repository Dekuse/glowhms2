var manageMemberTable;
var id = null;
var lastused_data = {
    'REQ_DATE': "",
    'CARD_ID':"",
    'CUS_ID': "",
    'REQ_STATUS': "",
    'CUSTOMER_NAME':"",
};
$(document).ready(function() {
    general_table = $("#general_data").DataTable({
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
    var column = general_table.column(value);
    var select = $('<input type="text" style="width: 100px;" placeholder="Search ' + '" />').appendTo($(column.footer()).empty()).on('keyup change', function() {
        var val = $(this).val();
        general_table.columns(value).search(val).draw()
    })
}

function loadselectcustomer(value) {
    var column = general_table.column(value);
    var select = $('<select><option value=""></option></select>').appendTo($(column.footer()).empty()).on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', !0, !1).draw()
    });
    column.data().unique().sort().each(function(d, j) {
        select.append('<option value="' + d + '">' + d + '</option>')
    })
}

$("#general_form").unbind('submit').bind('submit', function() {

    var gendata = {
        "forminputs": {
            "size": "0",
            "mainerror": !1,
            "0": "REQ_STATUS",
            
             
        },
    
        "REQ_STATUS": {
            "haserror": !1,
            "formliteral": "request type",
            "inputtype": "select",
            "errorname": "error_REQ_STATUS",
            "errorvalue": null,
            "mandatory": !0
        },
      
   
    };

    var genjson = JSON.stringify(gendata);
    var addForm = document.getElementById('general_form');
    var genform = new FormData(addForm);
    genform.append('json', genjson);
    $.ajax({
        url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
        type: "post",
        data: genform,
        dataType: 'json',
        processData: !1,
        contentType: !1,
        success: function(response) {
            if (response.forminputs.mainerror == !1) {
                
                lastused_data['REQ_DATE']  = $("#REQ_DATE").val();
                lastused_data['REQ_STATUS'] =  $("#REQ_STATUS").val();
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
            url: 'http://10.1.50.189:8001/customer/get_gen_detail',
            type: "post",
            data: {
                'REQ_DATE': data['REQ_DATE'] ,
                'REQ_STATUS': data['REQ_STATUS'] ,
                'CARD_ID':data['CARD_ID'] ,
                'CUS_ID': data['CUS_ID'] ,
                'CUSTOMER_NAME':data['CUSTOMER_NAME'] 
            },
            dataType: 'json',
            success: function(DBresponse) {
                
                if(DBresponse.data[0].OUTPUT!=false){
                    general_table.clear().draw();
                    for (var i = 0; i < DBresponse.data['0'].SIZE; i++) {

                        general_table.row.add([DBresponse.data[i].CUS_NAME,
                             DBresponse.data[i].REQ_ID, 
                             DBresponse.data[i].REQ_TYPE, 
                             DBresponse.data[i].CUS_ID,
                             DBresponse.data[i].CARD_NO, 
                             DBresponse.data[i].USER_ID, 
                             DBresponse.data[i].MAJOR_SER_CODE,
                            DBresponse.data[i].SERVICE_CODE,
                            DBresponse.data[i].REQ_DESCI,
                            DBresponse.data[i].DATE_CREATED,
                            DBresponse.data[i].REQ_STATUS,
                          
                            DBresponse.data[i].DONEBY,
                            DBresponse.data[i].REQ_TAKE_TIME,
                            DBresponse.data[i].REQ_DONE_TIME,
                           
                         ]).draw()
                    }
                    general_table.columns().every(function() {
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
                    general_table.clear().draw();
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
            alert('Error: Refresh the page again')
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
            alert('Error: Refresh the page again')
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
                   
                
                }
            })
        } else {
            alert('Error: Refresh the page again')
        }
    }
    
    function pro_general_data() {
        var count = general_table.rows({
            selected: !0
        }).count();
        if (count != 0) {
            var row = general_table.row({
                selected: !0
            });
            var data = row.data();
            if(data[10]!='C'){
            
               
                    if(data[10]=='P'){
                        $.ajax({
                            url: 'http://10.1.50.189:8001/customer/change_status_all',
                            type: 'post',
                            data: {
                                REQ_ID: data[1],
                                MAJOR_SER_CODE:data[6],
                               
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.success == !0) {
                                    
                                    successtoaster('success',response.messages,'Operation Successful')
                                    $("#add_CUSTOMERNAME").val(data['0']);
                                        $("#add_gen_detail").modal({ backdrop: "static", keyboard: !1 });
 
                                } else {
                                    successtoaster('error',response.messages,'Operation Failed')
                                }
                            }
                        })
                    }
                    else{
                        $("#add_CUSTOMERNAME").val(data['0']);
                            $("#add_gen_detail").modal({ backdrop: "static", keyboard: !1 });
        
                    }
            }
            else{
                successtoaster('error','THE ITEM IS ALREADY PROCESSED.','Operation Failed')
            }
            
            
        } else {
            successtoaster('error','Please select an item','Operation failed')
        }
    }
    $('#add_gen_detail').on('hidden.bs.modal', function (e) {
        processData(lastused_data);
      })

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

$("#add_gen_detail").on('shown.bs.modal', function() {
    var count = general_table.rows({
        selected: !0
    }).count();
    if (count != 0) {
        var row = general_table.row({
            selected: !0
        });
        var data = row.data();
    }
    $("#add_gen_det_form")[0].reset();
  
    var patient_data = {
        "forminputs": {
            "size": "5",
            "mainerror": !1,
            "0": "add_temp",
            "1": "add_weight",
            "2": "add_height",
            "3": "add_SYSTOLICBP",
            "4": "add_DIASTOLICBP",
            "5": "add_PULSE_RATE",
        },
        "add_temp": {
            "haserror": !1,
            "formliteral": "Temprature",
            "inputtype": "number",
            "errorname": "error_add_temp",
            "errorvalue": null,
            "mandatory": !0
        },
        "add_weight": {
            "haserror": !1,
            "formliteral": "Weight",
            "inputtype": "number",
            "errorname": "error_add_weight",
            "errorvalue": null,
            "mandatory": !0
        },
        "add_height": {
            "haserror": !1,
            "formliteral": "Height",
            "inputtype": "number",
            "errorname": "error_add_height",
            "errorvalue": null,
            "mandatory": !0
        },
        "add_SYSTOLICBP": {
            "haserror": !1,
            "formliteral": "SYSTOLICBP",
            "inputtype": "stringnum",
            "errorname": "error_add_SYSTOLICBP",
            "errorvalue": null,
            "mandatory": !0
        },
        "add_DIASTOLICBP": {
            "haserror": !1,
            "formliteral": "DIASTOLICBP",
            "inputtype": "stringnum",
            "errorname": "error_add_DIASTOLICBP",
            "errorvalue": null,
            "mandatory": !0
        },
        "add_PULSE_RATE": {
            "haserror": !1,
            "formliteral": "PULSE RATE",
            "inputtype": "stringnum",
            "errorname": "error_add_PULSE_RATE",
            "errorvalue": null,
            "mandatory": !0
        },
    
             
        
    };
    for (var i = 0; i <= patient_data.forminputs.size; i++) {
        $('#' + patient_data[patient_data.forminputs[i]].errorname).text(patient_data[patient_data.forminputs[i]].errorvalue);
        $('#' + patient_data[patient_data.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + patient_data.forminputs[i]).removeClass('has-success');
        $('#' + patient_data.forminputs[i]).removeClass('has-error')
    }
 
    $(".messages").html("");
    $("#add_gen_det_form").unbind('submit').bind('submit', function() {
        var patientjson = JSON.stringify(patient_data);
        var addForm = document.getElementById('add_gen_det_form');
        var patientform = new FormData(addForm);
        var formtodb = new FormData(addForm);
        formtodb.append('REQ_ID', data[1]);
        formtodb.append('CARD_NO', data[4]);
        formtodb.append('MAJOR_SER_CODE', data[6]);
        formtodb.append('CUS_NAME', data[0]);
        formtodb.append('CUS_ID', data[3]);
        formtodb.append('REQ_TYPE', data[2]);
        patientform.append('json', patientjson);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: patientform,
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
                        url: 'http://10.1.50.189:8001/customer/add_gen_data',
                        type: "post",
                        data: formtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#add_gen_det_form")[0].reset();
                                $("#add_gen_detail").modal('hide');
                                processData(lastused_data);
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




