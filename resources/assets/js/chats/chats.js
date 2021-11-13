'use strict';

let tableName = '#chatsTbl';
let chatsTable = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    'order': [[0, 'desc']],
    ajax: {
        url: chatsUrl,
    },
    columnDefs: [
        {
            'targets': [0],
            'width': '120px',
        },
        {
            'targets': [2],
            'className': 'text-center',
            'width': '120px',
        },
    ],
    columns: [
        {
            data: function (row) {
                return row.date_created ?? 'N/A';
            },
            name: 'date_created',
        },
        {
            data: function (row) {
                return row.room_id;
            },
            name: 'room_id',
        },
        {
            data: function (row) {
                return `<a class="show-message" href="#" data-id="${row.room_id}">
                        <i class="fas fa-fw fa-list"> </i></a>`;
            },
            name: 'message',
        },
        {
            data: function (row) {
                return row.agent;
            },
            name: 'agent',
        },
    ],
});

$(document).on('click', '.show-message', function (e){
    e.preventDefault();
    let roomId = $(this).data('id');
    $.ajax({
        type: 'POST',
        url: chatsUrl + '/get-messages',
        data: { roomId: roomId },
        success: function (data) {
            if(data.success){
                $('.display-message').empty();
                $.each(data.data, function (i, v){
                    $('.display-message').append(`
                        <tr>
                            <td>
                                <small>${v.date_created}</small>
                            </td>
                            <td>
                                ${v.from} : ${v.message}
                            </td>
                        </tr>`);
                });
                $('#MessagesModal').appendTo('body').modal('show');
            }
        },
    });
});
