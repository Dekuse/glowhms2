var manageMemberTable;
var id = null;
var lastused_data = {
    'REQ_DATE': "",
    'CARD_ID':"",
    'CUS_ID': "",
    'REQ_TYPE': "",
    'REQ_STATUS': ""
    
};
$(document).ready(function() {
    request_table = $("#request_data").DataTable({
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
    

});


function loadtextcustomer(value) {
    var column = request_table.column(value);
    var select = $('<input type="text" style="width: 100px;" placeholder="Search ' + '" />').appendTo($(column.footer()).empty()).on('keyup change', function() {
        var val = $(this).val();
        request_table.columns(value).search(val).draw()
    })
}

function loadselectcustomer(value) {
    var column = request_table.column(value);
    var select = $('<select><option value=""></option></select>').appendTo($(column.footer()).empty()).on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', !0, !1).draw()
    });
    column.data().unique().sort().each(function(d, j) {
        select.append('<option value="' + d + '">' + d + '</option>')
    })
}

$("#request_form").unbind('submit').bind('submit', function() {

    var req_data = {
        "forminputs": {
            "size": "1",
            "mainerror": !1,
            "0": "REQ_STATUS",
            "1": "REQ_TYPE",
             
        },
    
        "REQ_STATUS": {
            "haserror": !1,
            "formliteral": "request status",
            "inputtype": "select",
            "errorname": "error_REQ_STATUS",
            "errorvalue": null,
            "mandatory": !0
        },
        "REQ_TYPE": {
            "haserror": !1,
            "formliteral": "request type",
            "inputtype": "select",
            "errorname": "error_REQ_TYPE",
            "errorvalue": null,
            "mandatory": !0
        },
      
      
   
    };

    var genjson = JSON.stringify(req_data);
    var addForm = document.getElementById('request_form');
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
                lastused_data['REQ_TYPE'] =  $("#REQ_TYPE").val();
                lastused_data['CARD_ID'] = $("#CARD_ID").val();
                lastused_data['CUS_ID'] =  $("#CUS_ID").val();
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
            url: 'http://10.1.50.189:8001/customer/get_requests',
            type: "post",
            data: {
                'REQ_DATE': data['REQ_DATE'] ,
                'REQ_STATUS': data['REQ_STATUS'] ,
                'CARD_ID':data['CARD_ID'] ,
                'CUS_ID': data['CUS_ID'] ,
                'REQ_TYPE':data['REQ_TYPE'] 
            },
            dataType: 'json',
            success: function(DBresponse) {
                
                if(DBresponse.data[0].OUTPUT!=false){
                    request_table.clear().draw();
                    for (var i = 0; i < DBresponse.data['0'].SIZE; i++) {

                        request_table.row.add([
                            DBresponse.data[i].PROCESS, 
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
                    request_table.columns().every(function() {
                        var that = this;
                        $('input', this.footer()).on('keyup change', function() {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw()
                            }
                        })
                    });
                    loadtextcustomer(0)
                    loadtextcustomer(2);
                    loadtextcustomer(3);                
                }
                else{
                    request_table.clear().draw();
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

    function processdata(LINK) {
        if (LINK) {
            window.open(LINK,'_blank')
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
                   
                
                }
            })
        } else {
            successtoaster('error','Refresh the page again','Operation Failed')
        }
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


function successtoaster( type, header, message){
    toastr.options.progressBar = true; 
    var $toast = toastr[type](header, message)
}




