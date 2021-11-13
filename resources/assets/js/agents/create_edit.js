$(document).on('submit', '#addNewForm', function (event) {
    event.preventDefault();
    let loadingButton = $('#btnSave');
    loadingButton.button('loading');

    $('#addNewForm')[0].submit();
    return true;
});

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    let loadingButton = $('#btnSave');
    loadingButton.button('loading');

    $('#editForm')[0].submit();
    return true;
});

$('.select2-single').select2({
    width: '100%',
});
