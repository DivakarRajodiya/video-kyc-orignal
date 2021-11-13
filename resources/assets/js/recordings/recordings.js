'use strict';

let tableName = '#recordingsTbl';
$(tableName).DataTable({
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: recordingsUrl,
    },
    columnDefs: [
        {
            'targets': [0],
            'width': '20%',
        },
        {
            'targets': [4],
            'orderable': false,
            'className': 'text-center',
            'width': '120px',
        },
    ],
    columns: [
        {
            data: function (row) {
                return `<a href="${row.filename}" target="_blank">
                            ${row.filename}
                       </a>`;
            },
            name: 'filename',
        },
        {
            data: function (row) {
                return row.room_id;
            },
            name: 'room_id',
        },
        {
            data: function (row) {
                return row.agent_id;
            },
            name: 'agent_id',
        },
        {
            data: function (row) {
                return moment(row.created_at).format('Y-M-D h:mm:ss');
            },
            name: 'created_at',
        },
        {
            data: function (row) {
                return `<a title="Show" href="${row.filename}" target="_blank" class="btn btn-warning btn-sm action-btn edit-btn">
                            <i class="fa fa-eye"></i>
                       </a>
                        <a title="Delete" class="btn btn-danger action-btn btn-sm delete-btn" onclick="deleteData(${row.id})" data-id="${row.id}" href="javascript:void(0)">
                            <i class="fa fa-trash"></i>
                        </a>`;
            },
            name: 'id',
        },
    ],
});

window.deleteData = function (id) {
    deleteItem(recordingsUrl + '/' + id, tableName, 'Recording');
};
