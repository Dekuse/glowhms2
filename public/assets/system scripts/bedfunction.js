var manageMemberTable;
var id = null;
$(document).ready(function() {
    bedtable = $("#bed_table").DataTable({
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
    freebed_table = $("#freebed_table").DataTable({
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
    var column = bedtable.column(value);
    var select = $('<input type="text" style="width: 140px;" placeholder="Search ' + '" />').appendTo($(column.footer()).empty()).on('keyup change', function() {
        var val = $(this).val();
        bedtable.columns(value).search(val).draw()
    })
}

function loadselectcustomer(value) {
    var column = bedtable.column(value);
    var select = $('<select><option value=""></option></select>').appendTo($(column.footer()).empty()).on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', !0, !1).draw()
    });
    column.data().unique().sort().each(function(d, j) {
        select.append('<option value="' + d + '">' + d + '</option>')
    })
}

$("#bed_form").unbind('submit').bind('submit', function() {

    var beddata = {
        "forminputs": {
            "size": "0",
            "mainerror": !1,
           
            "0": "CUSTOMER_ID",
          
                
        },
            "CUSTOMER_ID": {
            "haserror": !1,
            "formliteral": "customer id",
            "inputtype": "number",
            "errorname": "error_CUSTOMER_ID",
            "errorvalue": null,
            "mandatory": !1
        }
  
    };

    var bedjson = JSON.stringify(beddata);
    var addForm = document.getElementById('bed_form');
    var bedform = new FormData(addForm);
    bedform.append('json', bedjson);
    $.ajax({
        url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
        type: "post",
        data: bedform,
        dataType: 'json',
        processData: !1,
        contentType: !1,
        success: function(response) {
            if (response.forminputs.mainerror == !1) {
                
                var CUSTOMER_NAME = $("#CUSTOMER_NAME").val();
                var CUSTOMER_ID =  $("#CUSTOMER_ID").val();
             
                $.ajax({
                    url: 'http://10.1.50.189:8001/functions/getbed_data',
                    type: "post",
                    data: {
                        'CUSTOMER_NAME': CUSTOMER_NAME,
                        'CUSTOMER_ID': CUSTOMER_ID,
                       
                    },
                    dataType: 'json',
                    success: function(DBresponse) {
                        
                        if(DBresponse.data[0].OUTPUT!=false){
                            bedtable.clear().draw();
                            for (var i = 0; i < DBresponse.data['0'].SIZE; i++) {
                         
                                bedtable.row.add([
                                    DBresponse.data[i].COUNTER,
                                    DBresponse.data[i].CUS_ID,
                                     DBresponse.data[i].CUS_NAME, 
                                     DBresponse.data[i].CARD_NO, 
                                     DBresponse.data[i].BED_ID,
                                     DBresponse.data[i].MAJOR_BDR_CODE, 
                                     DBresponse.data[i].DATE_CREATE, 
                                     DBresponse.data[i].DATE_LEAVE,
                                   ]).draw()
                            }
                            bedtable.columns().every(function() {
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
                            bedtable.clear().draw();
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

function get_bedstatus() {
    var BED_STATUS =  $("#BED_STATUS").val();


$.ajax({
    url: 'http://10.1.50.189:8001/functions/get_bedstatus',
    type: "post",
    data: {
        'BED_STATUS': BED_STATUS,
  
      
    },
    dataType: 'json',
    success: function(DBresponse) {
     
        if(DBresponse.data[0].OUTPUT!=false){
            freebed_table.clear().draw();
            for (var i = 0; i < DBresponse.data['0'].SIZE; i++) {


                freebed_table.row.add([
                    DBresponse.data[i].ID,
                     DBresponse.data[i].BEDROOM_TYPE,
                     DBresponse.data[i].BEDROOM_PRICE,
                     DBresponse.data[i].BEDROOM_AVAIBILITY,
                      DBresponse.data[i].BR_HELD_BY,
                       
                ]).draw()
            }
            freebed_table.columns().every(function() {
                var that = this;
                $('input', this.footer()).on('keyup change', function() {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw()
                    }
                })
            });
            
                         
        }
        else{
            freebed_table.clear().draw();
            successtoaster('info','No data found.','Operation Successful')
        }
        

    }
})
}



function successtoaster( type, header, message){


    toastr.options.progressBar = true;
    
    var $toast = toastr[type](header, message)
  

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
                $("#CUS_ID").val(response.CUS_ID);
                $("#CUS_NAME").val(response.CUS_NAME);
                $("#SEX").val(response.SEX);
                $("#AGE").val(response.AGE);
                $("#PHONENO").val(response.PHONENO);
                $("#REG_DATE").val(response.REG_DATE);
            
            }
        })
    } else {
        successtoaster('error','Refresh the page again','Operation Failed')
    }
}






