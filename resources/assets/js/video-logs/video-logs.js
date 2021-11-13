'use strict';

let tableName = '#videoLogsTbl';
$(tableName).DataTable({
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: videLogsUrl,
    },
    columnDefs: [
        {
            'targets': [2],
            'width': '20%',
        },
    ],
    columns: [
        {
            data: function (row) {
                return moment(row.created_at).format('Y-M-D h:mm:ss');
            },
            name: 'created_at',
        },
        {
            data: function (row) {
                return row.room_id;
            },
            name: 'room_id',
        },
        {
            data: function (row) {
                return row.message;
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
