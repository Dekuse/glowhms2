var manageMemberTable;
var id = null;
$(document).ready(function() {
    appdatatable = $("#appoint_data").DataTable({
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
    
   
    //customerdata();
});


function loadtextcustomer(value) {
    var column = appdatatable.column(value);
    var select = $('<input type="text" style="width: 140px;" placeholder="Search ' + '" />').appendTo($(column.footer()).empty()).on('keyup change', function() {
        var val = $(this).val();
        appdatatable.columns(value).search(val).draw()
    })
}

function loadselectcustomer(value) {
    var column = appdatatable.column(value);
    var select = $('<select><option value=""></option></select>').appendTo($(column.footer()).empty()).on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', !0, !1).draw()
    });
    column.data().unique().sort().each(function(d, j) {
        select.append('<option value="' + d + '">' + d + '</option>')
    })
}


   
  
    
  
    $("#appoint_para_form").unbind('submit').bind('submit', function() {

        var appointdata = {
            "forminputs": {
                "size": "3",
                "mainerror": !1,
                "0": "APP_DATE",
                "1": "APP_TYPE",
                "2": "APP_STATUS",
                "3": "CARD_ID",
                    
            },
            "APP_DATE": {
                "haserror": !1,
                "formliteral": "APPOINTMENT DATE",
                "inputtype": "stringnum",
                "errorname": "error_APP_DATE",
                "errorvalue": null,
                "mandatory": !1
            },
            "APP_TYPE": {
                "haserror": !1,
                "formliteral": "appointment type",
                "inputtype": "select",
                "errorname": "error_APP_TYPE",
                "errorvalue": null,
                "mandatory": !0
            },
            "APP_STATUS": {
                "haserror": !1,
                "formliteral": "appointment status",
                "inputtype": "select",
                "errorname": "error_APP_STATUS",
                "errorvalue": null,
                "mandatory": !0
            },
            "CARD_ID": {
                "haserror": !1,
                "formliteral": "CARD ID",
                "inputtype": "number",
                "errorname": "error_CARD_ID",
                "errorvalue": null,
                "mandatory": !1
            }
          
                 
            
        };

        var appointjson = JSON.stringify(appointdata);
        var addForm = document.getElementById('appoint_para_form');
        var appointform = new FormData(addForm);
        appointform.append('json', appointjson);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: appointform,
            dataType: 'json',
            processData: !1,
            contentType: !1,
            success: function(response) {
                if (response.forminputs.mainerror == !1) {
                    
                    var APP_DATE = $("#APP_DATE").val();
                    var APP_TYPE =  $("#APP_TYPE").val();
                    var APP_STATUS =  $("#APP_STATUS").val();
                    var CARD_ID = $("#CARD_ID").val();
                    $.ajax({
                        url: 'http://10.1.50.189:8001/customer/getappdata',
                        type: "post",
                        data: {
                            'appdate': APP_DATE,
                            'apptype': APP_TYPE,
                            'cardid': CARD_ID,
                            'appstatus':APP_STATUS
                        },
                        dataType: 'json',
                        success: function(DBresponse) {
                            
                            if(DBresponse.data[0].OUTPUT!=false){
                                appdatatable.clear().draw();
                                for (var i = 0; i < DBresponse.data['0'].SIZE; i++) {
                                   
                                    appdatatable.row.add([DBresponse.data[i].APPOINT_TYPE,
                                         DBresponse.data[i].CUS_APPOINT_ID, 
                                         DBresponse.data[i].CARD_NO, 
                                         DBresponse.data[i].CUS_ID,
                                         DBresponse.data[i].USER_ID, 
                                         DBresponse.data[i].SERVICE_CODE, 
                                         DBresponse.data[i].APPOINT_DATETIME,
                                        DBresponse.data[i].APPOINT_DESCI,
                                        DBresponse.data[i].LEFT_TIME,
                                        DBresponse.data[i].PAYMENT_REQ,
                                        DBresponse.data[i].APPOINT_STATUS,
                                        DBresponse.data[i].OPTIONS, ]).draw()
                                }
                                appdatatable.columns().every(function() {
                                    var that = this;
                                    $('input', this.footer()).on('keyup change', function() {
                                        if (that.search() !== this.value) {
                                            that.search(this.value).draw()
                                        }
                                    })
                                });
                                loadtextcustomer(2)
                                loadtextcustomer(3);
                                                             
                            }
                            else{
                                appdatatable.clear().draw();
                                successtoaster('info','No data found.','Operation Successful')
                            }
                            
                 
                        }
                    })
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


$(function() {
    var start = moment().subtract(0, 'days');
    var end = moment();

    function cb(start, end) {
        $('#APP_DATE').val(start.format('YYYY-MM-D') + ' - ' + end.format('YYYY-MM-D'))
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




