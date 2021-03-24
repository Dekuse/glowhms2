var manageMemberTable;
var id = null;
$(document).ready(function() {
    customerdatatable = $("#cutomer_data").DataTable({
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
    workflow_datatable = $("#workflow_data").DataTable({
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
        var CUSTOMERNAME =  $("#CUSTOMER_NAME").val();
    var CUSTOMERID = $("#CUSTOMER_ID").val();
 
    $.ajax({
        url: 'http://10.1.50.189:8001/customer/getcusdata2',
        type: "post",
        data: {
            'customername': CUSTOMERNAME,
            'customerid': CUSTOMERID
          
        },
        dataType: 'json',
        success: function(DBresponse) {
         
            if(DBresponse.data[0].OUTPUT!=false){
                customerdatatable.clear().draw();
                for (var i = 0; i < DBresponse.data['0'].SIZE; i++) {
                    customerdatatable.row.add([
                        DBresponse.data[i].CUS_NAME,
                         DBresponse.data[i].CUS_ID,
                         DBresponse.data[i].SEX,
                         DBresponse.data[i].AGE,
                          DBresponse.data[i].PHONENO,
                           DBresponse.data[i].REGION,
                          DBresponse.data[i].CITY,
                        DBresponse.data[i].NATIONALITY,
                        DBresponse.data[i].CARD_NO,
                        DBresponse.data[i].DATE_CREATED,
                        DBresponse.data[i].DURATION,
                        DBresponse.data[i].EXPIRY_DATE,
                        DBresponse.data[i].WORKFLOW]).draw()
                }
                customerdatatable.columns().every(function() {
                    var that = this;
                    $('input', this.footer()).on('keyup change', function() {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw()
                        }
                    })
                });
                loadtextcustomer(8)
                             
            }
            else{
                customerdatatable.clear().draw();
                successtoaster('info','No data found.','Operation Successful')
            }
            
 
        }
    })
}

function showFLOW(CARD_NO) {
    if (CARD_NO) {
        $.ajax({
            url: "http://10.1.50.189:8001/customer/getFlowData",
            type: "post",
            data: { CARD_NO: CARD_NO },
            dataType: "json",
            success: function (result) {

                        workflow_datatable.clear().draw();
                for (var i = 0; i < result.data["0"]["SIZE"]; i++) {
                  
                    workflow_datatable.row
                        .add([
                            result.data[i]["REQ_ID"],
                            result.data[i]["REQ_CODE"],
                            result.data[i]["CARD_NO"],
                            result.data[i]["CUS_ID"],
                            result.data[i]["REQ_STATUS"],
                            result.data[i]["DATE_CREATED"],
                            result.data[i]["DATE_MODIFIED"],
                            result.data[i]["FLOW_FROM"],
                            result.data[i].FLOW_SENDER,
                            result.data[i].FLOW_TO,
                            result.data[i].FLOW_RECEIVER,
                            
                        ])
                        .draw();
                }
                $("tbody").on("click", "td.visadetail", function () {
                    var tr = $(this).closest("tr");
                    var row = workflow_datatable.row(tr);
                    if (row.child.isShown()) {
                        row.child.hide();
                        tr.removeClass("shown");
                    } else {
                        row.child(formatpass(row.data())).show();
                        tr.addClass("shown");
                    }
                });

                function formatpass(d) {
                    var attr = d[1] + "loading";
                    var div = $("<div/>").addClass(attr).text("Loading...");
                    $.ajax({
                        url: "http://127.0.0.1:8002/administrator/getVisaRemark",
                        type: "post",
                        data: { member_id: d[1], person_id: d[1] },
                        success: function (json) {
                            $("." + attr).html(json);
                        },
                    });
                    return div;
                }
               
            },
        });
     
       
    } else {
        successtoaster('danger',response.messages,'Operation Failed')
    }
}




function successtoaster( type, header, message){


    toastr.options.progressBar = true;
    
    var $toast = toastr[type](header, message)
  

}



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


