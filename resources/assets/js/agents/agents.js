'use strict';

let tableName = '#agentsTbl';
let agentsTable = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    'order': [[0, 'desc']],
    ajax: {
        url: agentsUrl,
        data: function (data) {
        },
    },
    'fnInitComplete': function () {
    },
    columnDefs: [
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
                return row.username ?? 'N/A';
            },
            name: 'username',
        },
        {
            data: function (row) {
                let lastName;
                if (row.last_name == null) {
                    lastName = ' ';
                } else {
                    lastName = row.last_name;
                }
                return `${row.first_name} ${lastName}`;
            },
            name: 'first_name',
        },
        {
            data: function (row) {
                return row.tenant ?? 'N/A';
            },
            name: 'tenant',
        },
        {
            data: function (row) {
                return row.email;
            },
            name: 'email',
        },
        {
            data: function (row) {
                return `<a title="Edit" href="${agentsUrl + '/' + row.id +  '/edit'}" class='btn btn-warning action-btn btn-sm'>
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
    deleteItem(agentsUrl + '/' + id, tableName, 'Agent');
};
