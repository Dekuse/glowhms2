var manageMemberTable;
var id = null;
$(document).ready(function() {
    MAJORBED = $("#major_bed_table").DataTable({
        "ajax": 'http://10.1.50.189:8001/administrator/getmajorbeddata',
        "columns": [
            {
                data: "COUNTER"
            },{
            data: "MAJOR_BDR_CODE"
        }, {
            data: "MAJOR_BDR_PRICE"
        }, {
            data: "MAJOR_BDR_ADDRESS"
        }, {
            data: "MAJOR_BDR_STATUS"
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
                MAJORBED.ajax.reload();
                loadselectma(3);
                loadselectma(4);
            }
        }, 'excel', 'pdf', 'print', 'pageLength'],
        initComplete: function() {
          
            loadselectma(3);
            loadselectma(4);
            //loadmajorbed();
            
            
        },
    });
    MAJORBED.columns().every(function() {
        var that = this;
        $('input', this.header()).on('keyup change', function() {
            if (that.search() !== this.value) {
                that.search(this.value).draw()
            }
        })
    });

    BED = $("#bed_table").DataTable({
        "ajax": 'http://10.1.50.189:8001/administrator/getbeddata',
        "columns": [
            {
                data: "ID"
            },{
            data: "BEDROOM_TYPE"
        }, {
            data: "BEDROOM_PRICE"
        }, {
            data: "BEDROOM_STATUS"
        }, {
            data: "BEDROOM_AVAIBILITY"
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
                BED.ajax.reload();
                loadselectbed(1);
            loadselectbed(3);
            loadselectbed(4);
            }
        }, 'excel', 'pdf', 'print', 'pageLength'],
        initComplete: function() {
            loadselectbed(1);
            loadselectbed(3);
            loadselectbed(4);
          
            
            
        },
    });

    //loadmajorbed();
    //loadbed();
    
});
function loadmajorbed() {
    $.ajax({
        url: 'http://10.1.50.189:8001/administrator/getmajorbeddata',
        type: "post",
        data: {},
        dataType: 'json',
        success: function(DBresponse) {
            MAJORBED.clear();
            for (var i = 0; i < DBresponse.data['0'].SIZE; i++) {
                MAJORBED.row.add([DBresponse.data[i].COUNTER,DBresponse.data[i].MAJOR_BDR_CODE, DBresponse.data[i].MAJOR_BDR_PRICE, DBresponse.data[i].MAJOR_BDR_ADDRESS, DBresponse.data[i].MAJOR_BDR_STATUS ]).draw()
            }
        }
    })
}

function loadtextma(value) {
    var column = MAJORBED.column(value);
    var select = $('<input type="text" style="width: 140px;" placeholder="Search ' + '" />').appendTo($(column.footer()).empty()).on('keyup change', function() {
        var val = $(this).val();
        MAJORBED.columns(value).search(val).draw()
    })
}

function loadselectma(value) {
    var column = MAJORBED.column(value);
    var select = $('<select><option value=""></option></select>').appendTo($(column.footer()).empty()).on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', !0, !1).draw()
    });
    column.data().unique().sort().each(function(d, j) {
        select.append('<option value="' + d + '">' + d + '</option>')
    })
}

function loadtextbed(value) {
    var column = BED.column(value);
    var select = $('<input type="text" style="width: 140px;" placeholder="Search ' + '" />').appendTo($(column.footer()).empty()).on('keyup change', function() {
        var val = $(this).val();
        BED.columns(value).search(val).draw()
    })
}

function loadselectbed(value) {
    var column = BED.column(value);
    var select = $('<select><option value=""></option></select>').appendTo($(column.footer()).empty()).on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', !0, !1).draw()
    });
    column.data().unique().sort().each(function(d, j) {
        select.append('<option value="' + d + '">' + d + '</option>')
    })
}



function loadbed() {
    $.ajax({
        url: 'http://10.1.50.189:8001/administrator/getbeddata',
        type: "post",
        data: {},
        dataType: 'json',
        success: function(DBresponse) {
            BED.clear();
            if(DBresponse == false){
                return;
            }
            for (var i = 0; i < DBresponse.data['0'].SIZE; i++) {
                BED.row.add([DBresponse.data[i].COUNTER,  DBresponse.data[i].BEDROOM_PRICE,DBresponse.data[i].BEDROOM_TYPE, DBresponse.data[i].BEDROOM_STATUS, DBresponse.data[i].BEDROOM_AVAIBILITY ]).draw()
            }
        }
    })
}

$("#addmacatagory").on('click', function() {
    var MAJORBEDDATA = {
        "forminputs": {
            "size": "1",
            "mainerror": !1,
            "0": "bdprice",
            "1": "bdaddress",
        },
        "bdprice": {
            "haserror": !1,
            "formliteral": "MAJOR BED PRICE",
            "inputtype": "number",
            "errorname": "error_bdprice",
            "errorvalue": null,
            "mandatory": !0
        },
        "bdaddress": {
            "haserror": !1,
            "formliteral": "MAJOR BED ADDRESS",
            "inputtype": "string",
            "errorname": "error_bdaddress",
            "errorvalue": null,
            "mandatory": !1
        },
        
        
    };
    for (var i = 0; i <= MAJORBEDDATA.forminputs.size; i++) {
        $('#' + MAJORBEDDATA[MAJORBEDDATA.forminputs[i]].errorname).text(MAJORBEDDATA[MAJORBEDDATA.forminputs[i]].errorvalue);
        $('#' + MAJORBEDDATA[MAJORBEDDATA.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + MAJORBEDDATA.forminputs[i]).removeClass('has-success');
        $('#' + MAJORBEDDATA.forminputs[i]).removeClass('has-error')
    }
    $("#CREATEMAJORBEDFORM")[0].reset();
    $(".messages").html("");
    $("#CREATEMAJORBEDFORM").unbind('submit').bind('submit', function() {
        var MAJORBEDJSON = JSON.stringify(MAJORBEDDATA);
        var addForm = document.getElementById('CREATEMAJORBEDFORM');
        var CREATEMAJORBEDFORM = new FormData(addForm);
        var formtodb = new FormData(addForm);
        CREATEMAJORBEDFORM.append('json', MAJORBEDJSON);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: CREATEMAJORBEDFORM,
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
                        url: 'http://10.1.50.189:8001/administrator/addmabeddata',
                        type: "post",
                        data: formtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#CREATEMAJORBEDFORM")[0].reset();
                                $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + DBresponse.messages + '</div>');
                                MAJORBED.ajax.reload()
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

$("#addbedform").on('click', function() {
    var BEDDATA = {
        "forminputs": {
            "size": "0",
            "mainerror": !1,
            "0": "mabedtype",
       
        },
     
        "mabedtype": {
            "haserror": !1,
            "formliteral": "BED TYPE",
            "inputtype": "select",
            "errorname": "error_mabedtype",
            "errorvalue": null,
            "mandatory": !0
        },
        
        
    };
    for (var i = 0; i <= BEDDATA.forminputs.size; i++) {
        $('#' + BEDDATA[BEDDATA.forminputs[i]].errorname).text(BEDDATA[BEDDATA.forminputs[i]].errorvalue);
        $('#' + BEDDATA[BEDDATA.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + BEDDATA.forminputs[i]).removeClass('has-success');
        $('#' + BEDDATA.forminputs[i]).removeClass('has-error')
    }
    $("#CREATEBEDFORM")[0].reset();
    $(".messages").html("");
    $("#CREATEBEDFORM").unbind('submit').bind('submit', function() {
        var BEDJSON = JSON.stringify(BEDDATA);
        var addForm = document.getElementById('CREATEBEDFORM');
        var CREATEBEDFORM = new FormData(addForm);
        var formtodb = new FormData(addForm);
        CREATEBEDFORM.append('json', BEDJSON);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: CREATEBEDFORM,
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
                        url: 'http://10.1.50.189:8001/administrator/addbeddata',
                        type: "post",
                        data: formtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#CREATEMAJORBEDFORM")[0].reset();
                                $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + DBresponse.messages + '</div>');
                                BED.ajax.reload()
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

function DISABLEMA() {
    var count = MAJORBED.rows({
        selected: !0
    }).count();
    if (count != 0) {
        var row = MAJORBED.row({
            selected: !0
        });
        var data = row.data();
        if (data['MAJOR_BDR_STATUS'] == "EN")
            $("#disablemabed").modal();
        else $("#enablemabed").modal()
    } else {
        successtoaster('error','Please select an item','Operation failed')
    }
}

function DISABLEbed() {
    var count = BED.rows({
        selected: !0
    }).count();
    if (count != 0) {
        var row = BED.row({
            selected: !0
        });
        var data = row.data();
      
        if (data['BEDROOM_STATUS'] == "EN")
            $("#disablebed").modal();
        else $("#enablebedroom").modal()
    } else {
        successtoaster('error','Please select an item','Operation failed')
    }
}

$("#disablemabed").on('shown.bs.modal', function() {
    var row = MAJORBED.row({
        selected: !0
    });
    var data = row.data();
    $("#disableBtn").unbind('click').bind('click', function() {
        $.ajax({
            url: 'http://10.1.50.189:8001/administrator/disablemabed',
            type: 'post',
            data: {
                member_id: data['MAJOR_BDR_CODE']
            },
            dataType: 'json',
            success: function(response) {
                if (response.success == !0) {
                    $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages + '</div>');
                    MAJORBED.ajax.reload()
                    $("#disablemabed").modal('hide');
                    successtoaster('success',response.messages,'Operation Successful')

                } else {
                    successtoaster('danger',response.messages,'Operation Failed')
                    $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages + '</div>')
                }
            }
        })
    })
});

$("#disablebed").on('shown.bs.modal', function() {
    var row = BED.row({
        selected: !0
    });
    
    var data = row.data();
   
    $("#disableBedBtn").unbind('click').bind('click', function() {
       
        $.ajax({
            url: 'http://10.1.50.189:8001/administrator/disablebed',
            type: 'post',
            data: {
                bedid: data['ID']
            },
            dataType: 'json',
            success: function(response) {
                if (response.success == !0) {
                    $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages + '</div>');
                    
                    $("#disablebed").modal('hide');
                    successtoaster('success',response.messages,'Operation Successful')
                    BED.ajax.reload()

                } else {
                    successtoaster('danger',response.messages,'Operation Failed')
                    $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages + '</div>')
                }
            }
        })
    })
});

$("#enablemabed").on('shown.bs.modal', function() {
    var row = MAJORBED.row({
        selected: !0
    });
    var data = row.data();
    $("#enableBtn").unbind('click').bind('click', function() {
        $.ajax({
            url: 'http://10.1.50.189:8001/administrator/enablemabed',
            type: 'post',
            data: {
                member_id: data['MAJOR_BDR_CODE']
            },
            dataType: 'json',
            success: function(response) {
                if (response.success == !0) {
                    $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages + '</div>');
                    MAJORBED.ajax.reload()
                    $("#enablemabed").modal('hide')
                    successtoaster('success',response.messages,'Operation Successful')
                } else {
                    successtoaster('danger',response.messages,'Operation Failed')
                    $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages + '</div>')
                }
            }
        })
    })
});

$("#enablebedroom").on('shown.bs.modal', function() {
    
    var row = BED.row({
        selected: !0
    });
    var data = row.data();
    $("#enableBedroomBtn").unbind('click').bind('click', function() {
        $.ajax({
            url: 'http://10.1.50.189:8001/administrator/enablebed',
            type: 'post',
            data: {
                bedid: data['ID']
            },
            dataType: 'json',
            success: function(response) {
                if (response.success == !0) {
                    $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages + '</div>');
                    
                    $("#enablebedroom").modal('hide');
                    successtoaster('success',response.messages,'Operation Successful')
                    BED.ajax.reload()

                } else {
                    successtoaster('danger',response.messages,'Operation Failed')
                    $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages + '</div>')
                }
            }
        })
    })
});

function MODIFY() {
    var count = MAJORBED.rows({
        selected: !0
    }).count();
    if (count != 0) {
        
        $("#modifymabedmodal").modal()
    } else {
        successtoaster('error','Please select an item','Operation failed')
    }
}

$("#modifymabedmodal").on('shown.bs.modal', function() {
    $("#modifymabedform")[0].reset();
    var row = MAJORBED.row({
        selected: !0
    });
    var data = row.data();
    $('#newprice').val(data['MAJOR_BDR_PRICE']);
    var editmabeddata = {
        "forminputs": {
            "size": "1",
            "mainerror": !1,
            "0": "newprice",
            "1": "newaddress",
        },
        "newprice": {
            "haserror": !1,
            "formliteral": "Major bedroom price",
            "inputtype": "number",
            "errorname": "error_newprice",
            "errorvalue": null,
            "mandatory": !0
        },
        "newaddress": {
            "haserror": !1,
            "formliteral": "Major bedroom address",
            "inputtype": "string",
            "errorname": "error_newaddress",
            "errorvalue": null,
            "mandatory": !1
        },
    };
    for (var i = 0; i <= editmabeddata.forminputs.size; i++) {
        $('#' + editmabeddata[editmabeddata.forminputs[i]].errorname).text(editmabeddata[editmabeddata.forminputs[i]].errorvalue);
        $('#' + editmabeddata[editmabeddata.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + editmabeddata.forminputs[i]).removeClass('has-success');
        $('#' + editmabeddata.forminputs[i]).removeClass('has-error')
    }
    
    $(".messages").html("");
    $("#modifymabedform").unbind('submit').bind('submit', function() {
      
        var editmabedJson = JSON.stringify(editmabeddata);
        var editForm = document.getElementById('modifymabedform');
        var editMabedForm = new FormData(editForm);
        var editFormtodb = new FormData(editForm);
        editFormtodb.append('MAJOR_BDR_CODE', data['MAJOR_BDR_CODE']);
        editMabedForm.append('json', editmabedJson);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: editMabedForm,
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
                        url: 'http://10.1.50.189:8001/administrator/changeMabed',
                        type: "post",
                        data: editFormtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#modifymabedform")[0].reset();
                                $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + DBresponse.messages + '</div>');                             
                                $("#modifymabedmodal").modal('hide')
                                MAJORBED.ajax.reload()
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

function MODIFYbed() {
    var count = BED.rows({
        selected: !0
    }).count();
    if (count != 0) {
        
        $("#modifybedmodal").modal()
    } else {
        successtoaster('error','Please select an item','Operation failed')
    }
}

$("#modifybedmodal").on('shown.bs.modal', function() {
    $("#modifybedform")[0].reset();
    var row = BED.row({
        selected: !0
    });
    var data = row.data();
    
    var editbeddata = {
        "forminputs": {
            "size": "0",
            "mainerror": !1,
            "0": "editbedtype",
          
        },
        "editbedtype": {
            "haserror": !1,
            "formliteral": "Major bedroom type",
            "inputtype": "select",
            "errorname": "error_editbedtype",
            "errorvalue": null,
            "mandatory": !0
        },
        
    };
    for (var i = 0; i <= editbeddata.forminputs.size; i++) {
        $('#' + editbeddata[editbeddata.forminputs[i]].errorname).text(editbeddata[editbeddata.forminputs[i]].errorvalue);
        $('#' + editbeddata[editbeddata.forminputs[i]].errorname).removeClass('text-danger');
        $('#' + editbeddata.forminputs[i]).removeClass('has-success');
        $('#' + editbeddata.forminputs[i]).removeClass('has-error')
    }
    
    $(".messages").html("");
    $("#modifybedform").unbind('submit').bind('submit', function() {
      
        var editbedJson = JSON.stringify(editbeddata);
        var editForm = document.getElementById('modifybedform');
        var editbedForm = new FormData(editForm);
        var editFormtodb = new FormData(editForm);
        editFormtodb.append('id', data['ID']);
        editbedForm.append('json', editbedJson);
        $.ajax({
            url: 'http://10.1.50.189:8001/validator/Jsonvalidate',
            type: "post",
            data: editbedForm,
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
                        url: 'http://10.1.50.189:8001/administrator/editbed',
                        type: "post",
                        data: editFormtodb,
                        dataType: 'json',
                        processData: !1,
                        contentType: !1,
                        success: function(DBresponse) {
                            if (DBresponse.success == !0) {
                                $("#modifymabedform")[0].reset();
                                $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + DBresponse.messages + '</div>');                            
                                $("#modifybedmodal").modal('hide')
                                BED.ajax.reload()
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

