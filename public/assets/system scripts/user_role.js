var manageMemberTable;
var id = null;
$(document).ready(function() {
    users = $("#usertable").DataTable({
        "ajax": 'http://10.1.50.189:8001/administrator/getusersdata',
        "columns": [
            {
                data: "ID"
            },{
            data: "USER_ID"
        }, {
            data: "FULL_NAME"
        }, {
            data: "SEX"
        }, {
            data: "PHONENO"
        }, 
        {
            data: "CITY"
        },{
        data: "EMAIL"
        }, {
        data: "NATIONALITY"
        }, {
        data: "MAJOR_ACTOR"
        }, {
        data: "PROFESSION"
        }, 
        {
            data: "ACCOUNT_STATUS"
            }, {
            data: "ACTIVE_STATUS"
            }, 
        {
        data: "DATE_CREATED"
        },{
        data: "DATE_MODIFIED"
        },   ],
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
                users.ajax.reload();
                loadtextuser(2)
                loadselectuser(8);
                loadselectuser(9);
                loadselectuser(10);
                loadselectuser(11);
                
            }
        }, 'excel', {
            extend : 'pdfHtml5',
           
            orientation : 'landscape',
            pageSize : 'LEGAL',
            text : 'PDF',
            titleAttr : 'PDF'
            }, 'print', 'pageLength'],
        initComplete: function() {
          
            loadtextuser(2)
            loadselectuser(8);
            loadselectuser(9);
            loadselectuser(10);
            loadselectuser(11);
            
            
        },
        
    });

    roles = $("#roletable").DataTable({
        "ajax": 'http://10.1.50.189:8001/administrator/getroledata',
        "columns": [
            {
                data: "ID"
            },{
            data: "USER_ID"
        }, {
            data: "MAJOR_SER_CODE"
        }, {
            data: "MAJOR_SER_NAME"
        }, {
            data: "DATE_CREATED"
        }, 
        {
            data: "DATE_MODIFIED"
        },{
        data: "ROLE_STATUS"
        },   ],
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
                roles.ajax.reload();
                loadtextrole(1)
                loadtextrole(3);
                
            }
        }, 'excel', {
            extend : 'pdfHtml5',
           
            orientation : 'landscape',
            pageSize : 'LEGAL',
            text : 'PDF',
            titleAttr : 'PDF'
            }, 'print', 'pageLength'],
        initComplete: function() {
          
            loadtextrole(1)
            loadtextrole(3);
           
            
            
        },
        
    });
    users.columns().every(function() {
        var that = this;
        $('input', this.footer()).on('keyup change', function() {
            if (that.search() !== this.value) {
                that.search(this.value).draw()
            }
        })
    });

    roles.columns().every(function() {
        var that = this;
        $('input', this.footer()).on('keyup change', function() {
            if (that.search() !== this.value) {
                that.search(this.value).draw()
            }
        })
    });

    $("#PHONENO").inputmask();
    $("#editPHONENO").inputmask();
    
});


function loadtextuser(value) {
    var column = users.column(value);
    var select = $('<input type="text" style="width: 140px;" placeholder="Search ' + '" />').appendTo($(column.footer()).empty()).on('keyup change', function() {
        var val = $(this).val();
        users.columns(value).search(val).draw()
    })
}

function loadselectuser(value) {
    var column = users.column(value);
    var select = $('<select><option value=""></option></select>').appendTo($(column.footer()).empty()).on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', !0, !1).draw()
    });
    column.data().unique().sort().each(function(d, j) {
        select.append('<option value="' + d + '">' + d + '</option>')
    })
}

function loadtextrole(value) {
    var column = roles.column(value);
    var select = $('<input type="text" style="width: 140px;" placeholder="Search ' + '" />').appendTo($(column.footer()).empty()).on('keyup change', function() {
        var val = $(this).val();
        roles.columns(value).search(val).draw()
    })
}

function loadselectrole(value) {
    var column = roles.column(value);
    var select = $('<select><option value=""></option></select>').appendTo($(column.footer()).empty()).on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', !0, !1).draw()
    });
    column.data().unique().sort().each(function(d, j) {
        select.append('<option value="' + d + '">' + d + '</option>')
    })
}



$("#adduser").on('click', function() {
    var userdata = {
        "forminputs": {
            "size": "7",
            "mainerror": !1,
            "0": "FULL_NAME",
            "1": "SEX",
            "2": "PHONENO",
            "3": "CITY",
            "4": "EMAIL",
            "5": "NATIONALITY",
            "6": "MAJOR_ACTOR",
            "7": "PROFESSION",
           
        },
        "FULL_NAME": {
            "haserror": !1,
            "formliteral": "FULL NAME",
            "inputtype": "string",
            "errorname": "error_FULL_NAME",
            "errorvalue": null,
            "mandatory": !0
        },
        "SEX": {
            "haserror": !1,
            "formliteral": "SEX",
            "inputtype": "select",
            "errorname": "error_SEX",
            "errorvalue": null,
            "mandatory": !0
        },
        "PHONENO": {
            "haserror": !1,
            "formliteral": "PHONE NUMBER",
            "inputtype": "mobile",
            "errorname": "error_PHONENO",
            "errorvalue": null,
            "mandatory": !0
        },
        "CITY": {
            "haserror": !1,
            "formliteral": "CITY",
            "inputtype": "string",
            "errorname": "error_CITY",
            "errorvalue": null,
            "mandatory": !1
        },
        "EMAIL": {
            "haserror": !1,
            "formliteral": "EMAIL",
            "inputtype": "email",
            "errorname": "error_EMAIL",
            "errorvalue": null,
            "mandatory": !1
        },
        "NATIONALITY": {
            "haserror": !1,
            "formliteral": "NATIONALITY",
            "inputtype": "select",
            "errorname": "error_NATIONALITY",
            "errorvalue": null,
            "mandatory": !0
        },
        "MAJOR_ACTOR": {
            "haserror": !1,
            "formliteral": "MAJOR ACTOR",
            "inputtype": "select",
            "errorname": "error_MAJOR_ACTOR",
            "errorvalue": null,
            "mandatory": !0
        },
        "PROFESSION": {
            "haserror": !1,
            "formliteral": "PROFESSION",
            "inputtype": "select",
            "errorname": "error_PROFESSION",
            "errorvalue": null,
            "mandatory": !0
        },
        
        
    };
    for (var i = 0; i <= userdata.forminputs.size; i++) {
        $('#' + userdata[userdata.forminputs[i]].errorname).text(userdata[userdata.forminputs[i]].errorvalue);
        $('#' + userdata[userdata.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + userdata.forminputs[i]).removeClass('has-success');
        $('#' + userdata.forminputs[i]).removeClass('has-error')
    }
    $("#createuserform")[0].reset();
    $(".messages").html("");
    $("#createuserform").unbind('submit').bind('submit', function() {
        var userjson = JSON.stringify(userdata);
        var addForm = document.getElementById('createuserform');
        var createuserform = new FormData(addForm);
        var formtodb = new FormData(addForm);
        createuserform.append('json', userjson);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: createuserform,
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
                        url: 'http://10.1.50.189:8001/administrator/adduserdata',
                        type: "post",
                        data: formtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#createuserform")[0].reset();
                                $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + DBresponse.messages + '</div>');
                                users.ajax.reload()
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

$("#addrolebtn").on('click', function() {
    var roledata = {
        "forminputs": {
            "size": "1",
            "mainerror": !1,
            "0": "userid",
            "1": "role_MAJOR_ACTOR",
         
           
        },
    
        "userid": {
            "haserror": !1,
            "formliteral": "userid",
            "inputtype": "select",
            "errorname": "error_userid",
            "errorvalue": null,
            "mandatory": !0
        },
    
        "role_MAJOR_ACTOR": {
            "haserror": !1,
            "formliteral": "ROLE",
            "inputtype": "select",
            "errorname": "error_role_MAJOR_ACTOR",
            "errorvalue": null,
            "mandatory": !0
        },
       
        
        
    };
    for (var i = 0; i <= roledata.forminputs.size; i++) {
        $('#' + roledata[roledata.forminputs[i]].errorname).text(roledata[roledata.forminputs[i]].errorvalue);
        $('#' + roledata[roledata.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + roledata.forminputs[i]).removeClass('has-success');
        $('#' + roledata.forminputs[i]).removeClass('has-error')
    }
    $("#createroleform")[0].reset();
    $(".messages").html("");
    $("#createroleform").unbind('submit').bind('submit', function() {
        var rolejson = JSON.stringify(roledata);
        var addForm = document.getElementById('createroleform');
        var createroleform = new FormData(addForm);
        var formtodb = new FormData(addForm);
        createroleform.append('json', rolejson);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: createroleform,
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
                        url: 'http://10.1.50.189:8001/administrator/addrole',
                        type: "post",
                        data: formtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#createroleform")[0].reset();
                                $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + DBresponse.messages + '</div>');
                                roles.ajax.reload()
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


function disableuser() {
    var count = users.rows({
        selected: !0
    }).count();
    if (count != 0) {
        var row = users.row({
            selected: !0
        });
        var data = row.data();
        if (data['ACCOUNT_STATUS'] == "EN")
            $("#disableuser").modal();
        else $("#enableuser").modal()
    } else {
        successtoaster('error','Please select an item','Operation failed')
    }
}


$("#disableuser").on('shown.bs.modal', function() {
    var row = users.row({
        selected: !0
    });
    var data = row.data();
    $("#disableBtn").unbind('click').bind('click', function() {
        $.ajax({
            url: 'http://10.1.50.189:8001/administrator/disableuser',
            type: 'post',
            data: {
                ID: data['ID']
            },
            dataType: 'json',
            success: function(response) {
                if (response.success == !0) {
                    $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages + '</div>');
                    users.ajax.reload()
                    $("#disableuser").modal('hide');
                    successtoaster('success',response.messages,'Operation Successful')

                } else {
                    successtoaster('danger',response.messages,'Operation Failed')
                    $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages + '</div>')
                }
            }
        })
    })
});


$("#enableuser").on('shown.bs.modal', function() {
    var row = users.row({
        selected: !0
    });
    var data = row.data();
    $("#enableBtn").unbind('click').bind('click', function() {
        $.ajax({
            url: 'http://10.1.50.189:8001/administrator/enableuser',
            type: 'post',
            data: {
                ID: data['ID']
            },
            dataType: 'json',
            success: function(response) {
                if (response.success == !0) {
                    $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages + '</div>');
                    users.ajax.reload()
                    $("#enableuser").modal('hide')
                    successtoaster('success',response.messages,'Operation Successful')
                } else {
                    successtoaster('danger',response.messages,'Operation Failed')
                    $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages + '</div>')
                }
            }
        })
    })
});

function changePass() {
    var count = users.rows({
        selected: !0
    }).count();
    if (count != 0) {
        $("#changepasswordmodal").modal()
    } else {
        successtoaster('error','Please select an item','Operation failed')
    }
}

$("#changepasswordmodal").on('shown.bs.modal', function() {
    var row = users.row({
        selected: !0
    });
    var data = row.data();
    var changeuserpass = {
        "forminputs": {
            "size": "1",
            "mainerror": !1,
            "0": "newPassword",
            "1": "repeatPassword",
        },
        "newPassword": {
            "haserror": !1,
            "formliteral": "New Password",
            "inputtype": "password",
            "errorname": "error_newPassword",
            "errorvalue": null,
            "mandatory": !0
        },
        "repeatPassword": {
            "haserror": !1,
            "formliteral": "Repeat Password",
            "matchto": "newPassword",
            "inputtype": "passwordmatch",
            "errorname": "error_repeatPassword",
            "errorvalue": null,
            "mandatory": !0
        },
    };
    for (var i = 0; i <= changeuserpass.forminputs.size; i++) {
        $('#' + changeuserpass[changeuserpass.forminputs[i]].errorname).text(changeuserpass[changeuserpass.forminputs[i]].errorvalue);
        $('#' + changeuserpass[changeuserpass.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + changeuserpass.forminputs[i]).removeClass('has-success');
        $('#' + changeuserpass.forminputs[i]).removeClass('has-error')
    }
    $("#changepasswordForm")[0].reset();
    $(".edit-messages").html("");
    $("#changepasswordForm").unbind('submit').bind('submit', function() {
        var edituserjson = JSON.stringify(changeuserpass);
        var editForm = document.getElementById('changepasswordForm');
        var edituserForm = new FormData(editForm);
        var editFormtodb = new FormData(editForm);
        editFormtodb.append('ID', data['ID']);

        edituserForm.append('json', edituserjson);
        alert(edituserForm);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: {
                json:edituserjson,
                newPassword: $('#newPassword').val(),
                repeatPassword: $('#repeatPassword').val(),
            },
            dataType: 'json',
           
            success: function(response) {
                if (response.forminputs.mainerror == !1) {
                    $(".form-group").removeClass('has-error');
                    $(".text-danger").html(" ");
                    for (var i = 0; i <= response.forminputs.size; i++) {
                        $('#' + response.forminputs[i]).removeClass('has-error');
                        $('#' + response.forminputs[i]).addClass('has-success')
                    }
                    $.ajax({
                        url: 'http://10.1.50.189:8001/administrator/changeuserpass',
                        type: "post",
                        data: editFormtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#changepasswordForm")[0].reset();
                                $(".edit-messages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + DBresponse.messages + '</div>');
                                
                            } else {
                                $(".edit-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + DBresponse.messages + '</div>')
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
});

function modifyuser() {
    var count = users.rows({
        selected: !0
    }).count();
    if (count != 0) {
        
        $("#modifyusersmodal").modal()
    } else {
        successtoaster('error','Please select an item','Operation failed')
    }
}

$("#modifyusersmodal").on('shown.bs.modal', function() {
    $("#modifyuserform")[0].reset();
    var row = users.row({
        selected: !0
    });
    var data = row.data();
    $("#editFULL_NAME").val(data['FULL_NAME']);
    $('#editSEX').val(data['SEX']);
    $('#editPHONENO').val(data['PHONENO']);
    $("#editCITY").val(data['CITY']);
    $('#editEMAIL').val(data['EMAIL']);
    $('#editNATIONALITY').val(data['NATIONALITY']).change();
    $('#editMAJOR_ACTOR').val(data['MAJOR_ACTOR']).change();
    $('#editPROFESSION').val(data['PROFESSION']).change();
    var edituserdata =  {
        "forminputs": {
            "size": "7",
            "mainerror": !1,
            "0": "editFULL_NAME",
            "1": "editSEX",
            "2": "editPHONENO",
            "3": "editCITY",
            "4": "editEMAIL",
            "5": "editNATIONALITY",
            "6": "editMAJOR_ACTOR",
            "7": "editPROFESSION",
           
        },
        "editFULL_NAME": {
            "haserror": !1,
            "formliteral": "FULL NAME",
            "inputtype": "string",
            "errorname": "error_editFULL_NAME",
            "errorvalue": null,
            "mandatory": !0
        },
        "editSEX": {
            "haserror": !1,
            "formliteral": "SEX",
            "inputtype": "select",
            "errorname": "error_editSEX",
            "errorvalue": null,
            "mandatory": !0
        },
        "editPHONENO": {
            "haserror": !1,
            "formliteral": "PHONE NUMBER",
            "inputtype": "mobile",
            "errorname": "error_editPHONENO",
            "errorvalue": null,
            "mandatory": !0
        },
        "editCITY": {
            "haserror": !1,
            "formliteral": "CITY",
            "inputtype": "string",
            "errorname": "error_editCITY",
            "errorvalue": null,
            "mandatory": !1
        },
        "editEMAIL": {
            "haserror": !1,
            "formliteral": "EMAIL",
            "inputtype": "email",
            "errorname": "error_editEMAIL",
            "errorvalue": null,
            "mandatory": !1
        },
        "editNATIONALITY": {
            "haserror": !1,
            "formliteral": "NATIONALITY",
            "inputtype": "select",
            "errorname": "error_editNATIONALITY",
            "errorvalue": null,
            "mandatory": !0
        },
        "editMAJOR_ACTOR": {
            "haserror": !1,
            "formliteral": "MAJOR ACTOR",
            "inputtype": "select",
            "errorname": "error_editMAJOR_ACTOR",
            "errorvalue": null,
            "mandatory": !0
        },
        "editPROFESSION": {
            "haserror": !1,
            "formliteral": "PROFESSION",
            "inputtype": "select",
            "errorname": "error_editPROFESSION",
            "errorvalue": null,
            "mandatory": !0
        },
        
        
    };
    for (var i = 0; i <= edituserdata.forminputs.size; i++) {
        $('#' + edituserdata[edituserdata.forminputs[i]].errorname).text(edituserdata[edituserdata.forminputs[i]].errorvalue);
        $('#' + edituserdata[edituserdata.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + edituserdata.forminputs[i]).removeClass('has-success');
        $('#' + edituserdata.forminputs[i]).removeClass('has-error')
    }
    
    $(".messages").html("");
    $("#modifyuserform").unbind('submit').bind('submit', function() {
      
        var edituserJson = JSON.stringify(edituserdata);
        var editForm = document.getElementById('modifyuserform');
        var edituserForm = new FormData(editForm);
        var editFormtodb = new FormData(editForm);
        editFormtodb.append('ID', data['ID']);
        edituserForm.append('json', edituserJson);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: edituserForm,
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
                        url: 'http://10.1.50.189:8001/administrator/changeuser',
                        type: "post",
                        data: editFormtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#modifyuserform")[0].reset();
                                $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + DBresponse.messages + '</div>');                             
                                $("#modifyusersmodal").modal('hide')
                                users.ajax.reload()
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

