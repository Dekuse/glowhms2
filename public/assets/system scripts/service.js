
var id = null;
$(document).ready(function() {
    service = $("#servicet").DataTable({
        "ajax": 'http://10.1.50.189:8001/administrator/getservice',
        "columns": [
            {
                data: "ID"
            },{
            data: "SERVICE_CODE"
        }, {
            data: "SERVICE_NAME"
        }, {
            data: "MAJOR_SER_CODE"
        }, {
            data: "DATE_CREATE"
        }, 
        {
            data: "DATE_MODI"
        }, {
            data: "DESCI"
        }, {
            data: "PRICE"
        }, {
            data: "SERVICE_STATUS"
        },
     ],
        "order": [
            [0, "asc"]
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
        buttons: [{
            text: 'Reload table',
            action: function() {
                service.ajax.reload();
                loadselects(3);
                loadselects(8);
                loadtexts(1);
            }
        }, 'excel', 'pdf', 'print', 'pageLength'],
        initComplete: function() {
          
            loadselects(3);
            loadselects(8);
            
            
        },
    });
    service.columns().every(function() {
        var that = this;
        $('input', this.footer()).on('keyup change', function() {
            if (that.search() !== this.value) {
                that.search(this.value).draw()
            }
        })
    });

    majorservice = $("#mservicet").DataTable({
        "ajax": 'http://10.1.50.189:8001/administrator/getmajorservice2',
        "columns": [
            {
                data: "ID"
            },{
            data: "MAJOR_SER_CODE"
        }, {
            data: "SER_NAME"
        }, {
            data: "DATE_CREATE"
        }, {
            data: "SER_DESC"
        },  ],
        "order": [
            [0, "asc"]
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
        buttons: [{
            text: 'Reload table',
            action: function() {
                majorservice.ajax.reload();
                loadtextms(1);
                loadtextms(2);
            
            }
        }, 'excel', 'pdf', 'print', 'pageLength'],
        initComplete: function() {

        },
    });

    //loadmajorbed();
    //loadbed();
    
});


function loadtexts(value) {
    var column = service.column(value);
    var select = $('<input type="text" style="width: 140px;" placeholder="Search ' + '" />').appendTo($(column.footer()).empty()).on('keyup change', function() {
        var val = $(this).val();
        service.columns(value).search(val).draw()
    })
}

function loadselects(value) {
    var column = service.column(value);
    var select = $('<select><option value=""></option></select>').appendTo($(column.footer()).empty()).on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', !0, !1).draw()
    });
    column.data().unique().sort().each(function(d, j) {
        select.append('<option value="' + d + '">' + d + '</option>')
    })
}

function loadtextms(value) {
    var column = majorservice.column(value);
    var select = $('<input type="text" style="width: 140px;" placeholder="Search ' + '" />').appendTo($(column.footer()).empty()).on('keyup change', function() {
        var val = $(this).val();
        majorservice.columns(value).search(val).draw()
    })
}

function loadselectms(value) {
    var column = majorservice.column(value);
    var select = $('<select><option value=""></option></select>').appendTo($(column.footer()).empty()).on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', !0, !1).draw()
    });
    column.data().unique().sort().each(function(d, j) {
        select.append('<option value="' + d + '">' + d + '</option>')
    })
}





$("#addservice").on('click', function() {
    var SERVICEDATA = {
        "forminputs": {
            "size": "3",
            "mainerror": !1,
            "0": "SERVICE_NAME",
            "1": "MAJOR_SER_CODE",
            "2": "DESCI",
            "3": "PRICE",
        },
        "SERVICE_NAME": {
            "haserror": !1,
            "formliteral": "SERVICE NAME",
            "inputtype": "string",
            "errorname": "error_SERVICE_NAME",
            "errorvalue": null,
            "mandatory": !0
        },
        "MAJOR_SER_CODE": {
            "haserror": !1,
            "formliteral": "MAJOR SERVICE CODE",
            "inputtype": "select",
            "errorname": "error_MAJOR_SER_CODE",
            "errorvalue": null,
            "mandatory": !0
        },
        "DESCI": {
            "haserror": !1,
            "formliteral": "SERVICE DESCRIPTION",
            "inputtype": "stringnum",
            "errorname": "error_DESCI",
            "errorvalue": null,
            "mandatory": !1
        },
        "PRICE": {
            "haserror": !1,
            "formliteral": "SERVICE PRICE",
            "inputtype": "number",
            "errorname": "error_PRICE",
            "errorvalue": null,
            "mandatory": !0
        },
        
        
    };
    for (var i = 0; i <= SERVICEDATA.forminputs.size; i++) {
        $('#' + SERVICEDATA[SERVICEDATA.forminputs[i]].errorname).text(SERVICEDATA[SERVICEDATA.forminputs[i]].errorvalue);
        $('#' + SERVICEDATA[SERVICEDATA.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + SERVICEDATA.forminputs[i]).removeClass('has-success');
        $('#' + SERVICEDATA.forminputs[i]).removeClass('has-error')
    }
    $("#CREATESERVICEFORM")[0].reset();
    $(".messages").html("");
    $("#CREATESERVICEFORM").unbind('submit').bind('submit', function() {
        var SERVICEJSON = JSON.stringify(SERVICEDATA);
        var addForm = document.getElementById('CREATESERVICEFORM');
        var CREATESERVICEFORM = new FormData(addForm);
        var formtodb = new FormData(addForm);
        CREATESERVICEFORM.append('json', SERVICEJSON);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: CREATESERVICEFORM,
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
                        url: 'http://10.1.50.189:8001/administrator/addservicedata',
                        type: "post",
                        data: formtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#CREATESERVICEFORM")[0].reset();
                                $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + DBresponse.messages + '</div>');
                                service.ajax.reload()
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



function DISABLESER() {
    var count = service.rows({
        selected: !0
    }).count();
    if (count != 0) {
        var row = service.row({
            selected: !0
        });
        var data = row.data();
        if (data['SERVICE_STATUS'] == "EN")
            $("#disableser").modal();
        else $("#enableser").modal()
    } else {
        successtoaster('error','Please select an item','Operation failed')
    }
}



$("#disableser").on('shown.bs.modal', function() {
    var row = service.row({
        selected: !0
    });
    var data = row.data();
    $("#disableserBtn").unbind('click').bind('click', function() {
        $.ajax({
            url: 'http://10.1.50.189:8001/administrator/disableser',
            type: 'post',
            data: {
                member_id: data['ID']
            },
            dataType: 'json',
            success: function(response) {
                if (response.success == !0) {
                    $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages + '</div>');
                    service.ajax.reload()
                    $("#disableser").modal('hide');
                    successtoaster('success',response.messages,'Operation Successful')

                } else {
                    successtoaster('danger',response.messages,'Operation Failed')
                    $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages + '</div>')
                }
            }
        })
    })
});



$("#enableser").on('shown.bs.modal', function() {
    var row = service.row({
        selected: !0
    });
    var data = row.data();
    $("#enableserBtn").unbind('click').bind('click', function() {
        $.ajax({
            url: 'http://10.1.50.189:8001/administrator/enableser',
            type: 'post',
            data: {
                member_id: data['ID']
            },
            dataType: 'json',
            success: function(response) {
                if (response.success == !0) {
                    $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages + '</div>');
                    service.ajax.reload()
                    $("#enableser").modal('hide')
                    successtoaster('success',response.messages,'Operation Successful')
                } else {
                    successtoaster('danger',response.messages,'Operation Failed')
                    $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages + '</div>')
                }
            }
        })
    })
});



function MODIFY() {
    var count = service.rows({
        selected: !0
    }).count();
    if (count != 0) {
        
        $("#editservicemodal").modal()
    } else {
        successtoaster('error','Please select an item','Operation failed')
    }
}

$("#editservicemodal").on('shown.bs.modal', function() {
    $("#modifyserform")[0].reset();
    var row = service.row({
        selected: !0
    });
    var data = row.data();
    $("#edit_MAJOR_SER_CODE").val(data['MAJOR_SER_CODE']).change();
    $('#edit_SERVICE_NAME').val(data['SERVICE_NAME']);
    $('#edit_DESCI').val(data['DESCI']);
    $('#edit_PRICE').val(data['PRICE']);
    
    var editserddata = {
        "forminputs": {
            "size": "3",
            "mainerror": !1,
            "0": "edit_SERVICE_NAME",
            "1": "edit_MAJOR_SER_CODE",
            "2": "edit_DESCI",
            "3": "edit_PRICE",
        },
        "edit_SERVICE_NAME": {
            "haserror": !1,
            "formliteral": "SERVICE NAME",
            "inputtype": "string",
            "errorname": "error_edit_SERVICE_NAME",
            "errorvalue": null,
            "mandatory": !0
        },
        "edit_MAJOR_SER_CODE": {
            "haserror": !1,
            "formliteral": "MAJOR SERVICE CODE",
            "inputtype": "select",
            "errorname": "error_edit_MAJOR_SER_CODE",
            "errorvalue": null,
            "mandatory": !0
        },
        "edit_DESCI": {
            "haserror": !1,
            "formliteral": "SERVICE DESCRIPTION",
            "inputtype": "stringnum",
            "errorname": "error_edit_DESCI",
            "errorvalue": null,
            "mandatory": !1
        },
        "edit_PRICE": {
            "haserror": !1,
            "formliteral": "SERVICE PRICE",
            "inputtype": "number",
            "errorname": "error_edit_PRICE",
            "errorvalue": null,
            "mandatory": !0
        },
    };
    for (var i = 0; i <= editserddata.forminputs.size; i++) {
        $('#' + editserddata[editserddata.forminputs[i]].errorname).text(editserddata[editserddata.forminputs[i]].errorvalue);
        $('#' + editserddata[editserddata.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + editserddata.forminputs[i]).removeClass('has-success');
        $('#' + editserddata.forminputs[i]).removeClass('has-error')
    }
    
    $(".messages").html("");
    $("#modifyserform").unbind('submit').bind('submit', function() {
      
        var editserJson = JSON.stringify(editserddata);
        var editForm = document.getElementById('modifyserform');
        var editserForm = new FormData(editForm);
        var editFormtodb = new FormData(editForm);
        editFormtodb.append('ID', data['ID']);
        editserForm.append('json', editserJson);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: editserForm,
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
                        url: 'http://10.1.50.189:8001/administrator/changeser',
                        type: "post",
                        data: editFormtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#modifyserform")[0].reset();
                                $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + DBresponse.messages + '</div>');                             
                                $("#editservicemodal").modal('hide')
                                service.ajax.reload()
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




function successtoaster( type, header, message){


    toastr.options.progressBar = true;
    
    var $toast = toastr[type](header, message)
  

}

