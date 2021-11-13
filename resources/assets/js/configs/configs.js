'use strict';

$(document).on('submit', '#configForm', function (event) {
    event.preventDefault();
    let loadingButton = $('#btnSave');
    loadingButton.button('loading');

    if ($('#videoScreen_exitMeetingDrop').val() == 1) {
        let exitMeeting = false;
    } else if ($('#videoScreen_exitMeetingDrop').val() == 2) {
        exitMeeting = '/';
    } else if ($('#videoScreen_exitMeetingDrop').val() == 3) {
        exitMeeting = $('#videoScreen_exitMeeting').val()
    }
    let dataObj = {'fileName': fileName,
        'data': {
            'appWss': $('#appWss').val(),
            'agentName': $('#agentName').val(),
            'agentAvatar': $('#agentAvatar').val(),
            'smartVideoLanguage': $('#smartVideoLanguage').val(),
            'anonVisitor': $('#anonVisitor').val(),
            'entryForm.enabled': $('#entryForm_enabled').prop('checked'),
            'entryForm.required': $('#entryForm_required').prop('checked'),
            'entryForm.private': $('#entryForm_private').prop('checked'),
            'entryForm.showEmail': $('#entryForm_showEmail').prop('checked'),
            'entryForm.showAvatar': $('#entryForm_showAvatar').prop('checked'),
            'entryForm.terms': $('#entryForm_terms').val(),
            'recording.enabled': $('#recording_enabled').prop('checked'),
            'recording.download': $('#recording_download').prop('checked'),
            'recording.saveServer': $('#recording_saveServer').prop('checked'),
            'recording.autoStart': $('#recording_autoStart').prop('checked'),
            'recording.screen': $('#recording_screen').prop('checked'),
            'recording.oneWay': $('#recording_oneWay').prop('checked'),
            'recording.transcode': $('#recording_transcode').prop('checked'),
            'recording.filename': $('#recording_filename').val(),
            'recording.recordingConstraints': ($('#recording_recordingConstraints').val()) ? JSON.parse($('#recording_recordingConstraints').val()) : '',
            'whiteboard.enabled': $('#whiteboard_enabled').prop('checked'),
            'whiteboard.allowAnonymous': $('#whiteboard_allowAnonymous').prop('checked'),
            'videoScreen.greenRoom': $('#videoScreen_greenRoom').prop('checked'),
            'videoScreen.waitingRoom': $('#videoScreen_waitingRoom').prop('checked'),
            'videoScreen.videoConference': $('#videoScreen_videoConference').prop('checked'),
            'videoScreen.onlyAgentButtons': $('#videoScreen_onlyAgentButtons').prop('checked'),
            'videoScreen.getSnapshot': $('#videoScreen_getSnapshot').prop('checked'),
            'videoScreen.separateScreenShare': $('#videoScreen_separateScreenShare').prop('checked'),
            'videoScreen.enableLogs': $('#videoScreen_enableLogs').prop('checked'),
            'videoScreen.broadcastAttendeeVideo': $('#videoScreen_broadcastAttendeeVideo').prop('checked'),
            'videoScreen.allowOtherSee': $('#videoScreen_allowOtherSee').prop('checked'),
            'videoScreen.localFeedMirrored': $('#videoScreen_localFeedMirrored').prop('checked'),
            'videoScreen.exitMeetingOnTime': $('#videoScreen_exitMeetingOnTime').prop('checked'),
            'videoScreen.meetingTimer': $('#videoScreen_meetingTimer').prop('checked'),
            'videoScreen.admit': $('#videoScreen_admit').prop('checked'),
            'videoScreen.pipEnabled': $('#videoScreen_pipEnabled').prop('checked'),
            'videoScreen.primaryCamera': $('#videoScreen_primaryCamera').val(),
            'videoScreen.dateFormat': $('#videoScreen_dateFormat').val(),
            'videoScreen.videoFileStream': $('#videoScreen_videoFileStream').val(),
            'videoScreen.videoConstraint': ($('#videoScreen_videoConstraint').val()) ? JSON.parse($('#videoScreen_videoConstraint').val()) : '',
            'videoScreen.audioConstraint': ($('#videoScreen_audioConstraint').val()) ? JSON.parse($('#videoScreen_audioConstraint').val()) : '',
            'videoScreen.screenConstraint': ($('#videoScreen_screenConstraint').val()) ? JSON.parse($('#videoScreen_screenConstraint').val()) : '',
            'videoScreen.exitMeeting': exitMeeting,
            'serverSide.loginForm': $('#serverSide_loginForm').prop('checked'),
            'serverSide.chatHistory': $('#serverSide_chatHistory').prop('checked'),
            'serverSide.feedback': $('#serverSide_feedback').prop('checked'),
            'serverSide.checkRoom': $('#serverSide_checkRoom').prop('checked'),
            'serverSide.videoLogs': $('#serverSide_videoLogs').prop('checked'),
            'iceServers.iceServers': ($('#iceServers').val()) ? JSON.parse($('#iceServers').val()) : '',
            'iceServers.requirePass': $('#iceServers_requirePass').prop('checked'),
            'transcribe.languageTo': $('#transcribe_languageTo').val(),
            'transcribe.language': $('#transcribe_language').val(),
            'transcribe.direction': $('#transcribe_direction').val(),
            'transcribe.apiKey': $('#transcribe_apiKey').val(),
            'transcribe.enabled': $('#transcribe_enabled').prop('checked'),
            'social.facebookId': $('#social_facebookId').val(),
            'social.googleId': $('#social_googleId').val(),
            'social.enabled': $('#social_enabled').prop('checked')
        }};
    $.ajax({
        url: configUpdateUrl,
        type: 'POST',
        dataType: 'json',
        data: dataObj,
        cache: false,
        success: function (obj) {
            if (obj) {
                location.href = configIndexUrl+'?file='+fileName;
            }
        },
        error: function (data) {
            console.log(data);
        },
    });
});

$(document).on('click', '.delete-config', function (event) {
    event.preventDefault();
    let fileName = $(this).attr('data-file');
    swal({
            title: 'Delete !',
            text: 'Are you sure want to delete this "' + 'Config' + '" ?',
            type: 'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#6777ef',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
        },
        function () {
            $.ajax({
                type: 'POST',
                url: configIndexUrl + '/delete',
                data: {fileName : fileName},
                success: function (data) {
                    swal({
                        title: 'Deleted!',
                        text: 'Config' + ' has been deleted.',
                        type: 'success',
                        confirmButtonColor: '#6777ef',
                        timer: 2000,
                    });
                    if (data.success) {
                        setTimeout(function (){
                            location.reload();
                        },1000);
                    }
                },
                error: function (data) {
                    swal({
                        title: '',
                        text: data.responseJSON.message,
                        type: 'error',
                        confirmButtonColor: '#6777ef',
                        timer: 5000,
                    });
                },
            });
        });
});
