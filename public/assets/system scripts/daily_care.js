var manageMemberTable;
var id = null;
var lastused_data = {
    'CARD_ID': "",
    'CARE_STATUS': "",
};
$(document).ready(function() {
    care_table = $("#daily_care").DataTable({
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

$("#care_form").unbind('submit').bind('submit', function() {

    var care_data = {
        "forminputs": {
            "size": "1",
            "mainerror": !1,
            "0": "CARD_ID",
            "1": "CARE_STATUS",
             
        },
    
        "CARD_ID": {
            "haserror": !1,
            "formliteral": "Card number",
            "inputtype": "number",
            "errorname": "error_CARD_ID",
            "errorvalue": null,
            "mandatory": !0
        },
        "CARE_STATUS": {
            "haserror": !1,
            "formliteral": "Care  status",
            "inputtype": "select",
            "errorname": "error_CARD_ID",
            "errorvalue": null,
            "mandatory": !0
        },
      
   
    };

    var carejson = JSON.stringify(care_data);
    var addForm = document.getElementById('care_form');
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
                lastused_data['CARE_STATUS']  = $("#CARE_STATUS").val();
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
            url: 'http://10.1.50.189:8001/customer/get_daily_care',
            type: "post",
            data: {
                'CARD_ID': data['CARD_ID'] ,
                'CARE_STATUS': data['CARE_STATUS'] ,
            },
            dataType: 'json',
            success: function(DBresponse) {
                
                if(DBresponse.data[0].OUTPUT!=false){
                    care_table.clear().draw();
                    for (var i = 0; i < DBresponse.data['0'].SIZE; i++) {

                        care_table.row.add([
                             DBresponse.data[i].ID,
                             DBresponse.data[i].CUS_ID,
                             DBresponse.data[i].CARD_NO, 
                             DBresponse.data[i].BED_ID,
                             DBresponse.data[i].CARE_GIVEN_BY,
                            DBresponse.data[i].REQUIRE_TREAT,
                            DBresponse.data[i].REQUIRED_TIME,
                            DBresponse.data[i].TIME_GIVEN,
                            DBresponse.data[i].CARE_STATUS,
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
                    loadtextcustomer(2)
               
                                                 
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

  
    
    function complete_care() {
        var count = care_table.rows({
            selected: !0
        }).count();
        if (count != 0) {
            var row = care_table.row({
                selected: !0
            });
            var data = row.data();
            if(data[8]!='C'){                
                $("#complete_modal").modal({ backdrop: "static", keyboard: !1 });
            }
            else{
                successtoaster('error','THE ITEM IS ALREADY PROCESSED .','Operation Failed')
            }
            
            
        } else {
            successtoaster('error','Please select an item','Operation failed')
        }
    }

      $("#complete_modal").on('shown.bs.modal', function() {
        var row = care_table.row({
            selected: !0
        });
        var data = row.data();
        $("#completeBtn").unbind('click').bind('click', function() {
            $.ajax({
                url: 'http://10.1.50.189:8001/customer/complete_care',
                type: 'post',
                data: {
                    ID: data[0]
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success == !0) {
                        processData(lastused_data);
                        $("#complete_modal").modal('hide')
                        successtoaster('success',response.messages,'Operation Successful')
                    } else {
                        successtoaster('danger',response.messages,'Operation Failed')
                    }
                }
            })
        })
    });
  


function successtoaster( type, header, message){


    toastr.options.progressBar = true;
    
    var $toast = toastr[type](header, message)
  

}




