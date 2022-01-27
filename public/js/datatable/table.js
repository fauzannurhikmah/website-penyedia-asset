$(document).ready( function () {
    $("#dataTable").dataTable({
        "columnDefs": [
            { "sortable": false, "targets": 3 }
        ]
    });
} );