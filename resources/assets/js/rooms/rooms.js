'use strict';

let tableName = '#roomsTbl';
let roomsTable = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    'order': [[0, 'desc']],
    ajax: {
        url: roomsUrl,
        data: function (data) {
        },
    },
    'fnInitComplete': function () {
    },
    columnDefs: [
        {
            'targets': [7],
            'orderable': false,
            'className': 'text-center',
            'width': '120px',
        },
    ],
    columns: [
        {
            data: function (row) {
                return row.roomId ?? 'N/A';
            },
            name: 'roomId',
        },
        {
            data: function (row) {
                return row.agent ?? 'N/A';
            },
            name: 'agent',
        },
        {
            data: function (row) {
                return row.visitor ?? 'N/A';
            },
            name: 'visitor',
        },
        {
            data: function (row) {
                return `<a href="${row.agenturl}" target="_blank">${row.agenturl}</a>
                         <br>
                         <a href="${row.agenturl_broadcast}" target="_blank">${row.agenturl_broadcast}</a>`
            },
            name: 'agenturl',
        },
        {
            data: function (row) {
                return `<a href="${row.visitorurl}" target="_blank">${row.visitorurl}</a>
                         <br>
                         <a href="${row.visitorurl_broadcast}" target="_blank">${row.visitorurl_broadcast}</a>`;
            },
            name: 'visitorurl',
        },
        {
            data: function (row) {
                return moment(row.datetime).format('Y-M-D h:mm:ss') + '  /  ' + row.duration ?? 'N/A';
            },
            name: 'datetime',
        },
        {
            data: function (row) {
                return row.is_active == 1 ? 'Yes' : 'No';
            },
            name: 'is_active',
        },
        {
            data: function (row) {
                return `<a title="Edit" href="${roomsUrl + '/' + row.id +  '/edit'}" class='btn btn-warning action-btn btn-sm'>
                        <i class="fas fa-edit"></i>
                    </a>
                    <a title='Delete' href="javascript:void(0)" class='btn btn-danger action-btn btn-sm' id="${row.id}" onclick="deleteData(${row.id})">
                        <i class="fa fa-trash"></i>
                    </a>`;
            },
            name: 'id',
        },
    ],
    'drawCallback': function () {
    }
});

window.deleteData = function (id) {
    deleteItem(roomsUrl + '/' + id, tableName, 'Room');
};
