var manageMemberTable;
var id = null;
var lastused_data = {
    'CARD_ID': "",
   
};
$(document).ready(function() {
    care_table = $("#care_data").DataTable({
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
    var column = care_table.column(value);
    var select = $('<input type="text" style="width: 100px;" placeholder="Search ' + '" />').appendTo($(column.footer()).empty()).on('keyup change', function() {
        var val = $(this).val();
        care_table.columns(value).search(val).draw()
    })
}

function loadselectcustomer(value) {
    var column = care_table.column(value);
    var select = $('<select><option value=""></option></select>').appendTo($(column.footer()).empty()).on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', !0, !1).draw()
    });
    column.data().unique().sort().each(function(d, j) {
        select.append('<option value="' + d + '">' + d + '</option>')
    })
}

$("#input_care_form").unbind('submit').bind('submit', function() {

    var care_data = {
        "forminputs": {
            "size": "0",
            "mainerror": !1,
            "0": "CARD_ID",
            
             
        },
    
        "CARD_ID": {
            "haserror": !1,
            "formliteral": "Card number",
            "inputtype": "number",
            "errorname": "error_CARD_ID",
            "errorvalue": null,
            "mandatory": !0
        },
      
   
    };

    var carejson = JSON.stringify(care_data);
    var addForm = document.getElementById('input_care_form');
    var careform = new FormData(addForm);
    careform.append('json', carejson);
    $.ajax({
        url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
        type: "post",
        data: careform,
        dataType: 'json',
        processData: !1,
        contentType: !1,
        success: function(response) {
            if (response.forminputs.mainerror == !1) {
                
                lastused_data['CARD_ID']  = $("#CARD_ID").val();
                
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
            url: 'http://10.1.50.189:8001/customer/get_card_data',
            type: "post",
            data: {
                'CARD_ID': data['CARD_ID'] ,
              
            },
            dataType: 'json',
            success: function(DBresponse) {
                
                if(DBresponse.data[0].OUTPUT!=false){
                    care_table.clear().draw();
                    for (var i = 0; i < DBresponse.data['0'].SIZE; i++) {

                        care_table.row.add([
                             
                             DBresponse.data[i].CUS_ID,
                             DBresponse.data[i].CARD_NO, 
                             DBresponse.data[i].DATE_CREATED,

                            DBresponse.data[i].CARD_TYPE,
                            DBresponse.data[i].EXPIRY_STATUS,

                         ]).draw()
                    }
                    care_table.columns().every(function() {
                        var that = this;
                        $('input', this.footer()).on('keyup change', function() {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw()
                            }
                        })
                    });
                    loadtextcustomer(0)
               
                                                 
                }
                else{
                    care_table.clear().draw();
                    successtoaster('info','No data found.','Operation Successful')
                }
                
     
            }
        })
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

  
    
    function pro_mcare_data() {
        var count = care_table.rows({
            selected: !0
        }).count();
        if (count != 0) {
            var row = care_table.row({
                selected: !0
            });
            var data = row.data();
 
               $("#add_major_care").modal({ backdrop: "static", keyboard: !1 });
        } else {
            successtoaster('error','Please select an item','Operation failed')
        }
    }
    $('#add_gen_detail').on('hidden.bs.modal', function (e) {
        processData(lastused_data);
      })


      $(function () {
        $('#care_start_picker').datetimepicker({
            dateFormat:"YYYY-MM-DD HH:mm",
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1
        });
    });

$("#add_major_care").on('shown.bs.modal', function() {
    var count = care_table.rows({
        selected: !0
    }).count();
    if (count != 0) {
        var row = care_table.row({
            selected: !0
        });
        var data = row.data();
    }
    $("#major_care_form")[0].reset();
  
    var patient_data = {
        "forminputs": {
            "size": "6",
            "mainerror": !1,
            "0": "BED_ID",
            "1": "REQUIRE_TREAT",
            "2": "DOSE_LIST",
            "3": "CARE_START_TIME",
            "4": "DOSE_COUNT",
            "5": "DOSE_COUNT_SINGLE",
            "6": "HOUR_DIFF",
        },
        "BED_ID": {
            "haserror": !1,
            "formliteral": "BED ID",
            "inputtype": "number",
            "errorname": "error_BED_ID",
            "errorvalue": null,
            "mandatory": !0
        },
        "REQUIRE_TREAT": {
            "haserror": !1,
            "formliteral": "REQUIRED TREATMENT",
            "inputtype": "stringnum",
            "errorname": "error_REQUIRE_TREAT",
            "errorvalue": null,
            "mandatory": !1
        },
        "DOSE_LIST": {
            "haserror": !1,
            "formliteral": "DOSE LIST",
            "inputtype": "stringnum",
            "errorname": "error_DOSE_LIST",
            "errorvalue": null,
            "mandatory": !0
        },
        "CARE_START_TIME": {
            "haserror": !1,
            "formliteral": "CARE START TIME",
            "inputtype": "date",
            "errorname": "error_CARE_START_TIME",
            "errorvalue": null,
            "mandatory": !0
        },
        "DOSE_COUNT": {
            "haserror": !1,
            "formliteral": "DOSE COUNT",
            "inputtype": "number",
            "errorname": "error_DOSE_COUNT",
            "errorvalue": null,
            "mandatory": !0
        },
        "DOSE_COUNT_SINGLE": {
            "haserror": !1,
            "formliteral": "DOSE COUNT PER SINGLE",
            "inputtype": "number",
            "errorname": "error_DOSE_COUNT_SINGLE",
            "errorvalue": null,
            "mandatory": !0
        },
        "HOUR_DIFF": {
            "haserror": !1,
            "formliteral": "HOUR DIFFERENCE",
            "inputtype": "number",
            "errorname": "error_HOUR_DIFF",
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
    $("#major_care_form").unbind('submit').bind('submit', function() {
        var patientjson = JSON.stringify(patient_data);
        var addForm = document.getElementById('major_care_form');
        var patientform = new FormData(addForm);
        var formtodb = new FormData(addForm);
        formtodb.append('CARD_NO', data[1]);
        formtodb.append('CUS_ID', data[0]);
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
                        url: 'http://10.1.50.189:8001/customer/add_mcare_data',
                        type: "post",
                        data: formtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#major_care_form")[0].reset();
                                $("#add_major_care").modal('hide');
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




