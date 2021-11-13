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

let date = new Date();
$('.datetime').datetimepicker({
    format: 'MM/DD/YYYY HH:mm',
    minDate: new Date(date.getFullYear(), date.getMonth(), date.getDate(), date.getHours(), 0),
    icons: {
        time: 'fas fa-clock',
        date: 'fas fa-calendar',
        up: 'fas fa-chevron-up',
        down: 'fas fa-chevron-down',
        previous: 'fas fa-chevron-left',
        next: 'fas fa-chevron-right',
        today: 'fas fa-check',
        clear: 'fas fa-trash',
        close: 'fas fa-times'
    }
});

let copyUrl = function (url) {
    let aux = document.createElement("input");
    aux.setAttribute("value", url);
    document.body.appendChild(aux);
    aux.select();
    document.execCommand("copy");
    document.body.removeChild(aux);
};

$('#generateLink').on('click', function () {
    // generateLink(false);
    window.open(agentUrl);
    let text = $('#generateLinkModal').html();
    $('#generateLinkModal').html(text.replace('[generateLink]', visitorUrl));
    $('#generateLinkModal').modal('toggle');
    $('#copyAttendeeUrl').off();
    $('#copyAttendeeUrl').on('click', function () {
        $('#generateLinkModal').modal('hide');
        copyUrl(visitorUrl);
    });
});

$('#generateBroadcastLink').on('click', function () {
    // generateLink(true);
    window.open(agentUrl);
    let text = $('#generateBroadcastLinkModal').html();
    $('#generateBroadcastLinkModal').html(text.replace('[generateBroadcastLink]', viewerBroadcastLink));
    $('#generateBroadcastLinkModal').modal('toggle');
    $('#copyBroadcastUrl').off();
    $('#copyBroadcastUrl').on('click', function () {
        $('#generateBroadcastLinkModal').modal('hide');
        copyUrl(viewerBroadcastLink);
    });
});
