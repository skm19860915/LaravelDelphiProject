$(document).ready(function() {
    $('#orders').DataTable({
        language: {
            searchPlaceholder: 'Search Orders',
            sSearch: '',
            sLengthMenu: 'Show _MENU_',
            sLength: 'dataTables_length',
            oPaginate: {
                sFirst: '<i class="material-icons">chevron_left</i>',
                sPrevious: '<i class="material-icons">chevron_left</i>',
                sNext: '<i class="material-icons">chevron_right</i>',
                sLast: '<i class="material-icons">chevron_right</i>'
            }
        },
        aaSorting: [[0,'desc']]
    });
    $('.dataTables_length select').addClass('browser-default');
});
