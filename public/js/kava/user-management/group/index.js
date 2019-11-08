$(document).ready(function () {
    $('#groupTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/data/group',
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'group_name',
                name: 'group_name'
            },
            {
                data: 'action',
                name: 'action'
            }
        ],
        columnDefs: [{
            orderable: false,
            targets: 2
        }],
        language: {
            search: "",
            searchPlaceholder: "Search..."
        },
    });
    $('#groupTable_filter input').removeClass('form-control-sm');
});
