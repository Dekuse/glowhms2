var manageMemberTable;
var id = null;
$(document).ready(function() {
    CARDPRIORITY = $("#cpriority").DataTable({
        "ajax": 'http://10.1.50.189:8001/administrator/getcardpdata',
        "columns": [
            {
            data: "ID"
        }, {
            data: "CARD_PR_TYPE"
        }, {
            data: "CARD_PR_DES"
        }, {
            data: "CARD_PR_PRICE"
        }, 
        {
            data: "CARD_PR_STATUS"
        }, ],
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
                CARDPRIORITY.ajax.reload();
                loadselectcp(1);
                loadselectcp(4);
                
            }
        }, 'excel', 'pdf', 'print', 'pageLength'],
        initComplete: function() {
          
            loadselectcp(1);
            loadselectcp(4);

        },
    });
    CARDPRIORITY.columns().every(function() {
        var that = this;
        $('input', this.footer()).on('keyup change', function() {
            if (that.search() !== this.value) {
                that.search(this.value).draw()
            }
        })
    });

   
    
});

function loadtextcp(value) {
    var column = CARDPRIORITY.column(value);
    var select = $('<input type="text" style="width: 140px;" placeholder="Search ' + '" />').appendTo($(column.footer()).empty()).on('keyup change', function() {
        var val = $(this).val();
        CARDPRIORITY.columns(value).search(val).draw()
    })
}

function loadselectcp(value) {
    var column = CARDPRIORITY.column(value);
    var select = $('<select><option value=""></option></select>').appendTo($(column.footer()).empty()).on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', !0, !1).draw()
    });
    column.data().unique().sort().each(function(d, j) {
        select.append('<option value="' + d + '">' + d + '</option>')
    })
}


$("#addcp").on('click', function() {
    var cardp = {
        "forminputs": {
            "size": "1",
            "mainerror": !1,
            "0": "CARD_PR_DES",
            "1": "CARD_PR_PRICE",
        },
        "CARD_PR_DES": {
            "haserror": !1,
            "formliteral": "CARD PRIORITY DESCRIPTION",
            "inputtype": "string",
            "errorname": "error_CARD_PR_DES",
            "errorvalue": null,
            "mandatory": !0
        },
        "CARD_PR_PRICE": {
            "haserror": !1,
            "formliteral": "CARD PRIORITY PRICE",
            "inputtype": "number",
            "errorname": "error_CARD_PR_PRICE",
            "errorvalue": null,
            "mandatory": !0
        },
        
        
    };
    for (var i = 0; i <= cardp.forminputs.size; i++) {
        $('#' + cardp[cardp.forminputs[i]].errorname).text(cardp[cardp.forminputs[i]].errorvalue);
        $('#' + cardp[cardp.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + cardp.forminputs[i]).removeClass('has-success');
        $('#' + cardp.forminputs[i]).removeClass('has-error')
    }
    $("#createcardform")[0].reset();
    $(".messages").html("");
    $("#createcardform").unbind('submit').bind('submit', function() {
        var CARDPJSON = JSON.stringify(cardp);
        var addForm = document.getElementById('createcardform');
        var CREATECARDPFORM = new FormData(addForm);
        var formtodb = new FormData(addForm);
        CREATECARDPFORM.append('json', CARDPJSON);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: CREATECARDPFORM,
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
                        url: 'http://10.1.50.189:8001/administrator/addcardpr',
                        type: "post",
                        data: formtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#createcardform")[0].reset();
                                $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + DBresponse.messages + '</div>');
                                CARDPRIORITY.ajax.reload()
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



function disablecardp() {
    var count = CARDPRIORITY.rows({
        selected: !0
    }).count();
    if (count != 0) {
        var row = CARDPRIORITY.row({
            selected: !0
        });
        var data = row.data();
        if (data['CARD_PR_STATUS'] == "EN")
            $("#disablecardp").modal();
        else $("#enablecardp").modal()
    } else {
        successtoaster('error','Please select an item','Operation failed')
    }
}



$("#disablecardp").on('shown.bs.modal', function() {
    var row = CARDPRIORITY.row({
        selected: !0
    });
    var data = row.data();
    $("#disableBtn").unbind('click').bind('click', function() {
        $.ajax({
            url: 'http://10.1.50.189:8001/administrator/disablecardp',
            type: 'post',
            data: {
                member_id: data['ID']
            },
            dataType: 'json',
            success: function(response) {
                if (response.success == !0) {
                    $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages + '</div>');
                    CARDPRIORITY.ajax.reload()
                    $("#disablecardp").modal('hide');
                    successtoaster('success',response.messages,'Operation Successful')

                } else {
                    successtoaster('danger',response.messages,'Operation Failed')
                    $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages + '</div>')
                }
            }
        })
    })
});



$("#enablecardp").on('shown.bs.modal', function() {
    var row = CARDPRIORITY.row({
        selected: !0
    });
    var data = row.data();
    $("#enableBtn").unbind('click').bind('click', function() {
        $.ajax({
            url: 'http://10.1.50.189:8001/administrator/enablecardp',
            type: 'post',
            data: {
                member_id: data['ID']
            },
            dataType: 'json',
            success: function(response) {
                if (response.success == !0) {
                    $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages + '</div>');
                    CARDPRIORITY.ajax.reload()
                    $("#enablecardp").modal('hide')
                    successtoaster('success',response.messages,'Operation Successful')
                } else {
                    successtoaster('danger',response.messages,'Operation Failed')
                    $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages + '</div>')
                }
            }
        })
    })
});


function changecardp() {
    var count = CARDPRIORITY.rows({
        selected: !0
    }).count();
    if (count != 0) {
        
        $("#modifycardp").modal()
    } else {
        successtoaster('error','Please select an item','Operation failed')
    }
}

$("#modifycardp").on('shown.bs.modal', function() {
    $("#modifycardpform")[0].reset();
    var row = CARDPRIORITY.row({
        selected: !0
    });
    var data = row.data();
    $('#editCARD_PR_PRICE').val(data['CARD_PR_PRICE']);
    $('#editCARD_PR_DES').val(data['CARD_PR_DES']);
    var editcardpdata = {
        "forminputs": {
            "size": "1",
            "mainerror": !1,
            "0": "editCARD_PR_PRICE",
            "1": "editCARD_PR_DES",
        },
        "editCARD_PR_PRICE": {
            "haserror": !1,
            "formliteral": "Major bedroom price",
            "inputtype": "number",
            "errorname": "error_editCARD_PR_PRICE",
            "errorvalue": null,
            "mandatory": !0
        },
        "editCARD_PR_DES": {
            "haserror": !1,
            "formliteral": "Major bedroom address",
            "inputtype": "string",
            "errorname": "error_editCARD_PR_DES",
            "errorvalue": null,
            "mandatory": !0
        },
    };
    for (var i = 0; i <= editcardpdata.forminputs.size; i++) {
        $('#' + editcardpdata[editcardpdata.forminputs[i]].errorname).text(editcardpdata[editcardpdata.forminputs[i]].errorvalue);
        $('#' + editcardpdata[editcardpdata.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + editcardpdata.forminputs[i]).removeClass('has-success');
        $('#' + editcardpdata.forminputs[i]).removeClass('has-error')
    }
    
    $(".messages").html("");
    $("#modifycardpform").unbind('submit').bind('submit', function() {
      
        var editcardpJson = JSON.stringify(editcardpdata);
        var editForm = document.getElementById('modifycardpform');
        var editcardpForm = new FormData(editForm);
        var editFormtodb = new FormData(editForm);
        editFormtodb.append('ID', data['ID']);
        editcardpForm.append('json', editcardpJson);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: editcardpForm,
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
                        url: 'http://10.1.50.189:8001/administrator/changecardp',
                        type: "post",
                        data: editFormtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#modifycardpform")[0].reset();
                                $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + DBresponse.messages + '</div>');                             
                                $("#modifycardp").modal('hide')
                                CARDPRIORITY.ajax.reload()
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


