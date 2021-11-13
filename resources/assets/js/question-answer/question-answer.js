'use strict';

let tableName = '#questionAnswersTbl';
$(tableName).DataTable({
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: questionAnswersUrl,
    },
    columnDefs: [
        {
            'targets': [0],
            'width': '20%',
        },
        {
            'targets': [1],
            'orderable': false,
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
                return row.question;
            },
            name: 'question',
        },
        {
            data: function (row) {
                let status = '';
                if (row.status == 1) {
                    status = '<label class="btn btn-sm btn-success">Active</label>';
                }else{
                    status = '<label class="btn btn-sm btn-warning">Inactive</label>';
                }

                return status;
            },
            name: 'status',
        },
        {
            data: function (row) {
                return moment(row.created_at).format('Y-M-D h:mm:ss');
            },
            name: 'created_at',
        },
        {
            data: function (row) {
                return moment(row.updated_at).format('Y-M-D h:mm:ss');
            },
            name: 'updated_at',
        },
        {
            data: function (row) {
                return `<a title="Edit" href="javascript:void(0)" class="btn btn-warning btn-sm action-btn edit-btn" data-id="${row.id}" >
                            <i class="fa fa-edit"></i>
                       </a>
                        <a title="Delete" class="btn btn-danger action-btn btn-sm delete-btn" onclick="deleteData(${row.id})" data-id="${row.id}" href="javascript:void(0)">
                            <i class="fa fa-trash"></i>
                        </a>`;
            },
            name: 'id',
        },
    ],
});

$('.addQuestionAnswerModal').click(function () {
    resetModalForm('#addNewForm', '#validationErrorsBox');
    $('#addModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addNewForm', function (e) {
    e.preventDefault();
    processingBtn('#addNewForm', '#btnSave', 'loading');
    let url = $(this).attr('action');
    $.ajax({
        url: url,
        type: 'POST',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                $('#questionAnswersTbl').DataTable().ajax.reload(null, false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addNewForm', '#btnSave');
        },
    });
});

$(document).on('click', '.edit-btn', function (event) {
    let id = $(event.currentTarget).data('id');
    renderData(id);
});

window.renderData = function (id) {
    $.ajax({
        url: questionAnswersUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#editId').val(result.data.id);
                $('.question').val(result.data.question);
                $('.status').val(result.data.status).trigger('change');
                $('#editModal').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    processingBtn('#editForm', '#btnSave', 'loading');
    const id = $('#editId').val();
    let data = $(this).serialize();
    $.ajax({
        url: questionAnswersUrl + '/' + id,
        type: 'PATCH',
        data : data,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $('#questionAnswersTbl').DataTable().ajax.reload(null, false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#editForm', '#btnSave');
        },
    });
});

window.deleteData = function (id) {
    deleteItem(questionAnswersUrl + '/' + id, tableName, 'QuestionAnswer');
};

$('#addModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewForm', '#validationErrorsBox');
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#validationErrorsBox');
});
