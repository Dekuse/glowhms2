var manageMemberTable;
var id = null;
$(document).ready(function() {
    actordata = $("#actor").DataTable({
        "ajax": 'http://10.1.50.189:8001/administrator/getactordata',
        "columns": [
            {
            data: "ID"
        }, {
            data: "ACTOR_ID"
        }, {
            data: "MAJOR_ACTOR"
        }, {
            data: "ACTOR_NAME"
        }, 
        {
            data: "ACTOR_DESCI"
        },
        {
            data: "ACTOR_STATUS"
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
                actordata.ajax.reload();
                loadselecta(1);
                loadselectc(3);
                loadselecta(5);
            }
        }, 'excel', 'pdf', 'print', 'pageLength'],
        initComplete: function() {
          
            loadselecta(1);
            loadselecta(3);
            loadselecta(5);

        },
    });
    actordata.columns().every(function() {
        var that = this;
        $('input', this.footer()).on('keyup change', function() {
            if (that.search() !== this.value) {
                that.search(this.value).draw()
            }
        })
    });

   
    
});

function loadtexta(value) {
    var column = actordata.column(value);
    var select = $('<input type="text" style="width: 140px;" placeholder="Search ' + '" />').appendTo($(column.footer()).empty()).on('keyup change', function() {
        var val = $(this).val();
        actordata.columns(value).search(val).draw()
    })
}

function loadselecta(value) {
    var column = actordata.column(value);
    var select = $('<select><option value=""></option></select>').appendTo($(column.footer()).empty()).on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', !0, !1).draw()
    });
    column.data().unique().sort().each(function(d, j) {
        select.append('<option value="' + d + '">' + d + '</option>')
    })
}


$("#adda").on('click', function() {
    var actor = {
        "forminputs": {
            "size": "2",
            "mainerror": !1,
            "0": "MAJOR_ACTOR",
            "1": "ACTOR_NAME",
            "2": "ACTOR_DESCI",
        },
        "MAJOR_ACTOR": {
            "haserror": !1,
            "formliteral": "MAJOR ACTOR TYPE",
            "inputtype": "select",
            "errorname": "error_MAJOR_ACTOR",
            "errorvalue": null,
            "mandatory": !0
        },
        "ACTOR_NAME": {
            "haserror": !1,
            "formliteral": "ACTOR NAME",
            "inputtype": "string",
            "errorname": "error_ACTOR_NAME",
            "errorvalue": null,
            "mandatory": !0
        },
        "ACTOR_DESCI": {
            "haserror": !1,
            "formliteral": "ACTOR DESCRIPTION",
            "inputtype": "string",
            "errorname": "error_ACTOR_DESCI",
            "errorvalue": null,
            "mandatory": !1
        },
        
        
    };
    for (var i = 0; i <= actor.forminputs.size; i++) {
        $('#' + actor[actor.forminputs[i]].errorname).text(actor[actor.forminputs[i]].errorvalue);
        $('#' + actor[actor.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + actor.forminputs[i]).removeClass('has-success');
        $('#' + actor.forminputs[i]).removeClass('has-error')
    }
    $("#createactorform")[0].reset();
    $(".messages").html("");
    $("#createactorform").unbind('submit').bind('submit', function() {
        var ACTORJSON = JSON.stringify(actor);
        var addForm = document.getElementById('createactorform');
        var CREATEACTORFORM = new FormData(addForm);
        var formtodb = new FormData(addForm);
        CREATEACTORFORM.append('json', ACTORJSON);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: CREATEACTORFORM,
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
                        url: 'http://10.1.50.189:8001/administrator/addactor',
                        type: "post",
                        data: formtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#createactorform")[0].reset();
                                $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + DBresponse.messages + '</div>');
                                actordata.ajax.reload()
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



function disableactor() {
    var count = actordata.rows({
        selected: !0
    }).count();
    if (count != 0) {
        var row = actordata.row({
            selected: !0
        });
        var data = row.data();
        if (data['ACTOR_STATUS'] == "EN")
            $("#disableactor").modal();
        else $("#enableactor").modal()
    } else {
        successtoaster('error','Please select an item','Operation failed')
    }
}



$("#disableactor").on('shown.bs.modal', function() {
    var row = actordata.row({
        selected: !0
    });
    var data = row.data();
    $("#disableBtn").unbind('click').bind('click', function() {
        $.ajax({
            url: 'http://10.1.50.189:8001/administrator/disableactor',
            type: 'post',
            data: {
                member_id: data['ID']
            },
            dataType: 'json',
            success: function(response) {
                if (response.success == !0) {
                    $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages + '</div>');
                    actordata.ajax.reload()
                    $("#disableactor").modal('hide');
                    successtoaster('success',response.messages,'Operation Successful')

                } else {
                    successtoaster('danger',response.messages,'Operation Failed')
                    $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages + '</div>')
                }
            }
        })
    })
});



$("#enableactor").on('shown.bs.modal', function() {
    var row = actordata.row({
        selected: !0
    });
    var data = row.data();
    $("#enableBtn").unbind('click').bind('click', function() {
        $.ajax({
            url: 'http://10.1.50.189:8001/administrator/enableactor',
            type: 'post',
            data: {
                member_id: data['ID']
            },
            dataType: 'json',
            success: function(response) {
                if (response.success == !0) {
                    $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages + '</div>');
                    actordata.ajax.reload()
                    $("#enableactor").modal('hide')
                    successtoaster('success',response.messages,'Operation Successful')
                } else {
                    successtoaster('danger',response.messages,'Operation Failed')
                    $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages + '</div>')
                }
            }
        })
    })
});


function changeactor() {
    var count = actordata.rows({
        selected: !0
    }).count();
    if (count != 0) {
        
        $("#modifyactor").modal()
    } else {
        successtoaster('error','Please select an item','Operation failed')
    }
}

$("#modifyactor").on('shown.bs.modal', function() {
    $("#modifyactorform")[0].reset();
    var row = actordata.row({
        selected: !0
    });
    var data = row.data();
    $('#edit_ACTOR_DESCI').val(data['ACTOR_DESCI']);
    $('#edit_ACTOR_NAME').val(data['ACTOR_NAME']);

    $("#edit_MAJOR_ACTOR").val(data['MAJOR_ACTOR']).change();
 
    var editactordata = {
        "forminputs": {
            "size": "1",
            "mainerror": !1,
            "0": "edit_ACTOR_DESCI",
            "1": "edit_ACTOR_NAME",
            "2": "edit_MAJOR_ACTOR",
        },
        "edit_MAJOR_ACTOR": {
            "haserror": !1,
            "formliteral": "Major Actor",
            "inputtype": "select",
            "errorname": "error_edit_MAJOR_ACTOR",
            "errorvalue": null,
            "mandatory": !0
        },
        "edit_ACTOR_NAME": {
            "haserror": !1,
            "formliteral": "Actor Name",
            "inputtype": "string",
            "errorname": "error_edit_ACTOR_NAME",
            "errorvalue": null,
            "mandatory": !0
        },
        "edit_ACTOR_DESCI": {
            "haserror": !1,
            "formliteral": "Actor Description",
            "inputtype": "string",
            "errorname": "error_edit_ACTOR_DESCI",
            "errorvalue": null,
            "mandatory": !0
        },
    };
    for (var i = 0; i <= editactordata.forminputs.size; i++) {
        $('#' + editactordata[editactordata.forminputs[i]].errorname).text(editactordata[editactordata.forminputs[i]].errorvalue);
        $('#' + editactordata[editactordata.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + editactordata.forminputs[i]).removeClass('has-success');
        $('#' + editactordata.forminputs[i]).removeClass('has-error')
    }
    
    $(".messages").html("");
    $("#modifyactorform").unbind('submit').bind('submit', function() {
      
        var editactorJson = JSON.stringify(editactordata);
        var editForm = document.getElementById('modifyactorform');
        var editactorForm = new FormData(editForm);
        var editFormtodb = new FormData(editForm);
        editFormtodb.append('ID', data['ID']);
        editactorForm.append('json', editactorJson);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: editactorForm,
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
                        url: 'http://10.1.50.189:8001/administrator/changeactor',
                        type: "post",
                        data: editFormtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#modifyactorform")[0].reset();
                                $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + DBresponse.messages + '</div>');                             
                                $("#modifyactor").modal('hide')
                                actordata.ajax.reload()
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


