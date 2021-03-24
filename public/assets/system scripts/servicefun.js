
var id = null;
$(document).ready(function() {
    service = $("#servicet").DataTable({
        "ajax": 'http://10.1.50.189:8001/functions/getservice',
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
        "ajax": 'http://10.1.50.189:8001/functions/getmajorservice2',
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

function successtoaster( type, header, message){


    toastr.options.progressBar = true;
    
    var $toast = toastr[type](header, message)
  

}

