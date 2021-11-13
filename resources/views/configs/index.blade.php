@extends('layouts.app')
@section('title')
    Config
@endsection
@section('content')
    <h1 class="h3 mb-2 text-gray-800" id="configTitle"><span data-localize="configurations"></span> -
        @php
            if(isset($_GET['file'])){
                $fileConfig = $_GET['file'] . '.json';
            }else{
                $fileConfig = asset('json/config.json');
            }
            $fileConfig = substr($fileConfig, 0, -5);
            echo $fileConfig;
        @endphp
    </h1>
    <div id="error" style="display:none;" class="alert alert-danger"></div>
    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->tenant == 'lsv_mastertenant')

        <div class="row">
            <div class="col-sm-6">
                <div class="p-1">
                    <h6 data-localize="config_info">From this section you make changes to the configuration options of
                        your video sessions. Please be careful when changing the options and make sure you have read
                        here their meanings</h6>
                    <br/>
                    <form class="user" method="post" id="configForm">
                        @csrf
                        <div class="form-group">
                            <label for="roomName"><h6 data-localize="config_server_url">Server URL (needs to be like
                                    this https://domain_name:9001/)</h6></label>
                            <input type="text" class="form-control" id="appWss" name="appWss" aria-describedby="appWss">
                        </div>
                        <div class="form-group">
                            <label for="roomName"><h6 data-localize="config_agent_name">Agent Name (if specified, it
                                    will appear in your visitor video and chat panes)</h6></label>
                            <input type="text" class="form-control" id="agentName" name="agentName" aria-describedby="agentName">
                        </div>
                        <div class="form-group">
                            <label for="names"><h6 data-localize="config_language">Language locale (you need to have the
                                    same locale files in /locales folder)</h6></label>
                            <select class="form-control" name="smartVideoLanguage" id="smartVideoLanguage">
                                <?php
                                    if ($handle = opendir(public_path('locales'))) {
                                        while (false !== ($entry = readdir($handle))) {
                                            if ($entry != "." && $entry != ".." && substr($entry, -3) != "zip") {
                                                $entry = substr($entry, 0, -5);
                                                echo '<option value="' . $entry . '">' . $entry . '</option>';
                                            }
                                        }
                                        closedir($handle);
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="names"><h6 data-localize="config_anon_user">Anonymous user (how the anonymous
                                    user appears)</h6></label>
                            <input type="text" class="form-control" id="anonVisitor" name="anonVisitor" aria-describedby="anonVisitor">
                        </div>
                        <div class="form-group">
                            <h6 data-localize="config_entry_form">Entry Form</h6>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="entryForm_enabled" value="1" id="entryForm_enabled">
                                <label class="custom-control-label" for="entryForm_enabled"
                                       data-localize="config_enabled">Enabled</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="entryForm_required" value="1" id="entryForm_required">
                                <label class="custom-control-label" for="entryForm_required"
                                       data-localize="config_required">Required</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="entryForm_private" value="1" id="entryForm_private">
                                <label class="custom-control-label" for="entryForm_private"
                                       data-localize="config_private">Private (enable only if you have specified user
                                    credentials or using password field for a room)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="entryForm_showEmail" id="entryForm_showEmail">
                                <label class="custom-control-label" for="entryForm_showEmail"
                                       data-localize="config_email">Show Email (enable only if you have specified user
                                    credentials or using password field for a room)</label>
                            </div>
                            <div class="custom-control">
                                <label for="entryForm_terms" data-localize="config_terms">Terms & Conditions URL (if
                                    filled in, checkbox will appear in the Entry form and will be mandatory)</label>
                                <input type="text" class="form-control" name="entryForm_terms" id="entryForm_terms" aria-describedby="terms">
                            </div>
                        </div>
                        <div class="form-group">
                            <h6 data-localize="config_recordings">Recordings</h6>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="recording_enabled" id="recording_enabled">
                                <label class="custom-control-label" for="recording_enabled"
                                       data-localize="config_enabled">Enabled</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="recording_download" id="recording_download">
                                <label class="custom-control-label" for="recording_download"
                                       data-localize="config_download">Download (recorded file is directly downloaded
                                    after video session is finished)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="recording_saveServer" id="recording_saveServer">
                                <label class="custom-control-label" for="recording_saveServer"
                                       data-localize="config_saveserver">Save on server (recorded file is saved into
                                    /server/recordings folder)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="recording_autoStart" id="recording_autoStart">
                                <label class="custom-control-label" for="recording_autoStart"
                                       data-localize="config_autostart">Auto start (recording is started on video
                                    session starts)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="recording_screen" id="recording_screen">
                                <label class="custom-control-label" for="recording_screen"
                                       data-localize="config_screen">Save whole screen (starts a screenshare stream and
                                    will use it as a recording)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="recording_oneWay" id="recording_oneWay">
                                <label class="custom-control-label" for="recording_oneWay"
                                       data-localize="config_oneway">One way (only visitor stream will be
                                    recorded)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="recording_transcode" id="recording_transcode">
                                <label class="custom-control-label" for="recording_transcode"
                                       data-localize="config_transcode">Transcode (check here how to enable this
                                    option)</label>
                            </div>
                            <hr>
                            <div class="custom-control">
                                <label for="recording_filename" data-localize="config_filename">Filename pattern. %room%
                                    will be replaced with room name and %datetime% with the current date and
                                    time</label>
                                <input type="text" class="form-control" name="recording_filename" id="recording_filename"
                                       aria-describedby="recording_filename">
                            </div>
                            <hr>
                            <div class="custom-control">
                                <label for="recording_recordingConstraints" data-localize="config_recordingconstraints">Height/Width
                                    of recorded video. For reference, you can check this graphic</label>
                                <textarea class="form-control" name="recording_recordingConstraints" id="recording_recordingConstraints"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <h6 data-localize="config_whiteboard">Whiteboard</h6>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="whiteboard_enabled" id="whiteboard_enabled">
                                <label class="custom-control-label" for="whiteboard_enabled"
                                       data-localize="config_enabled">Enabled</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="whiteboard_allowAnonymous"
                                       id="whiteboard_allowAnonymous">
                                <label class="custom-control-label" for="whiteboard_allowAnonymous"
                                       data-localize="config_allowanon">Allow Anonymous (visitors are also allowed to
                                    draw on the whiteboard)</label>
                            </div>

                        </div>
                        <div class="form-group">
                            <h6 data-localize="config_videopanel">Video Panel</h6>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="videoScreen_greenRoom"
                                       id="videoScreen_greenRoom">
                                <label class="custom-control-label" for="videoScreen_greenRoom"
                                       data-localize="config_greenroom">Green room (pre-meeting room, where you can
                                    check your video and audio preferences)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="videoScreen_videoConference"
                                       id="videoScreen_videoConference">
                                <label class="custom-control-label" for="videoScreen_videoConference"
                                       data-localize="config_conferencestyle">Conference style of video panes (it is
                                    checked by default. If not checked, only organizer of the meeting will be present in
                                    the big video pane)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="videoScreen_onlyAgentButtons"
                                       id="videoScreen_onlyAgentButtons">
                                <label class="custom-control-label" for="videoScreen_onlyAgentButtons"
                                       data-localize="config_onlyagents">Only agent enabled buttons</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="videoScreen_getSnapshot"
                                       id="videoScreen_getSnapshot">
                                <label class="custom-control-label" for="videoScreen_getSnapshot"
                                       data-localize="config_snapshot">Snapshot</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="videoScreen_separateScreenShare"
                                       id="videoScreen_separateScreenShare">
                                <label class="custom-control-label" for="videoScreen_separateScreenShare"
                                       data-localize="config_separatescreenshare">Screen share is on separate stream
                                    (screen share session is replacing the video stream. If checked, screenshare and
                                    video will be on different streams. This may cause network outage and delay)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="videoScreen_broadcastAttendeeVideo"
                                       id="videoScreen_broadcastAttendeeVideo">
                                <label class="custom-control-label" for="videoScreen_broadcastAttendeeVideo"
                                       data-localize="config_broadcastattendeevideo">Attendee in a broadcast can join
                                    with video, not only audio</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="videoScreen_allowOtherSee"
                                       id="videoScreen_allowOtherSee">
                                <label class="custom-control-label" for="videoScreen_allowOtherSee"
                                       data-localize="config_allowothersee">Other attendees in broadcasting will
                                    see/hear the speaking attendee, not only the organizer</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="videoScreen_localFeedMirrored"
                                       id="videoScreen_localFeedMirrored">
                                <label class="custom-control-label" for="videoScreen_localFeedMirrored"
                                       data-localize="config_localfeedmirrored">Local video feed is shown as
                                    mirrored</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="videoScreen_exitMeetingOnTime"
                                       id="videoScreen_exitMeetingOnTime">
                                <label class="custom-control-label" for="videoScreen_exitMeetingOnTime"
                                       data-localize="config_exitmeetingontime">Meeting is auto stopped on time end.
                                    This applies on scheduled meetings.</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="videoScreen_meetingTimer"
                                       id="videoScreen_meetingTimer">
                                <label class="custom-control-label" for="videoScreen_meetingTimer"
                                       data-localize="config_meetingtimer">Time left for the meeting is shown as a
                                    label. This applies on scheduled meetings and can be combined with Meeting auto
                                    stopped.</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="videoScreen_waitingRoom"
                                       id="videoScreen_waitingRoom">
                                <label class="custom-control-label" for="videoScreen_waitingRoom"
                                       data-localize="config_systemmessages">System messages are shown in video panel,
                                    not in the chat</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="videoScreen_admit" id="videoScreen_admit">
                                <label class="custom-control-label" for="videoScreen_admit"
                                       data-localize="config_admit">Enable admission. Host needs to admit attendees in
                                    the meeting.</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="videoScreen_pipEnabled"
                                       id="videoScreen_pipEnabled">
                                <label class="custom-control-label" for="videoScreen_pipEnabled"
                                       data-localize="config_pip">Picture-in-picture (PiP) mode enabled.</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="videoScreen_enableLogs"
                                       id="videoScreen_enableLogs">
                                <label class="custom-control-label" for="videoScreen_enableLogs"
                                       data-localize="config_logs">Enable console logs (enable only for debugging. Not
                                    recommended)</label>
                            </div>
                            <hr>
                            <div class="custom-control">
                                <label for="videoScreen_videoFileStream" data-localize="config_videofilestream">Video
                                    URL. If set, the broadcasting will stream from this file. Accepted format: mp4,
                                    webm, mov, ogg</label>
                                <input type="text" class="form-control" name="videoScreen_videoFileStream" id="videoScreen_videoFileStream"
                                       aria-describedby="videoScreen_videoFileStream">
                            </div>
                            <hr>
                            <div class="custom-control">
                                <label for="videoScreen_exitMeetingDrop" data-localize="config_exitMeeting">Location on
                                    exit meeting</label>
                                <select class="form-control" name="videoScreen_exitMeetingDrop"
                                        id="videoScreen_exitMeetingDrop">
                                    <option value="1">Show entry form</option>
                                    <option value="2">Go to home page</option>
                                    <option value="3">Go to specific URL</option>
                                </select>
                                <input type="text" class="form-control" id="videoScreen_exitMeeting"
                                       aria-describedby="videoScreen_exitMeeting">
                            </div>
                            <hr>
                            <div class="custom-control">
                                <label for="videoScreen_primaryCamera" data-localize="config_primarycamera">Primary
                                    camera for mobile</label>
                                <select class="form-control" name="videoScreen_primaryCamera"
                                        id="videoScreen_primaryCamera">
                                    <option value="user">Front</option>
                                    <option value="environment">Back</option>
                                </select>
                            </div>
                            <hr>
                            <div class="custom-control">
                                <label for="videoScreen_dateFormat" data-localize="config_dateformat">Date/time
                                    format</label>
                                <select class="form-control" name="videoScreen_dateFormat" id="videoScreen_dateFormat">
                                    <option value="default"><?php echo date('d-m-Y G:i'); ?></option>
                                    <option value="isoDate"><?php echo date('Y-m-d G:i'); ?></option>
                                    <option value="shortDate"><?php echo date('m/d/y G:i'); ?></option>
                                    <option value="longDate"><?php echo date('F j, Y G:i'); ?></option>
                                    <option value="fullDate"><?php echo date('D, F j, Y G:i'); ?></option>
                                </select>
                            </div>
                            <hr>
                            <div class="custom-control">
                                <label for="videoScreen_videoConstraint" data-localize="config_videoconstraint">Video
                                    Constraints. For more information about the constraints check here. If you expect
                                    meeting with more participants, you can lower your camera resolution like
                                    this</label>
                                <textarea class="form-control" id="videoScreen_videoConstraint" name="videoScreen_videoConstraint"></textarea>
                            </div>
                            <hr>
                            <div class="custom-control">
                                <label for="videoScreen_audioConstraint" data-localize="config_audioconstraint">Audio
                                    Constraints.</label>
                                <textarea class="form-control" id="videoScreen_audioConstraint" name="videoScreen_audioConstraint"></textarea>
                            </div>
                            <hr>
                            <div class="custom-control">
                                <label for="videoScreen_screenConstraint" data-localize="config_screenshareconstraint">Screen
                                    Share Constraint</label>
                                <textarea class="form-control" id="videoScreen_screenConstraint" name="videoScreen_screenConstraint"></textarea>
                            </div>

                        </div>

                        <div class="form-group">
                            <h6 data-localize="config_serverside">Server Side</h6>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="serverSide_loginForm" id="serverSide_loginForm">
                                <label class="custom-control-label" for="serverSide_loginForm"
                                       data-localize="config_loginform">Login form (enable only if you have specified
                                    user credentials from the Users section, together with the Entry form)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="serverSide_chatHistory"
                                       id="serverSide_chatHistory">
                                <label class="custom-control-label" for="serverSide_chatHistory"
                                       data-localize="config_chathistory">Chat history</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="serverSide_feedback" id="serverSide_feedback">
                                <label class="custom-control-label" for="serverSide_feedback"
                                       data-localize="config_feedbackform">Feedback form</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="serverSide_checkRoom" id="serverSide_checkRoom">
                                <label class="custom-control-label" for="serverSide_checkRoom"
                                       data-localize="config_roomaccess">Access only rooms in the list</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="serverSide_videoLogs" id="serverSide_videoLogs">
                                <label class="custom-control-label" for="serverSide_videoLogs"
                                       data-localize="config_videologs">Enable video session logs</label>
                            </div>

                        </div>
                        <hr>
                        <div class="form-group">
                            <h6 data-localize="config_social">Social login. Entry form also should be enabled and
                                Facebook and/or Google API IDs be provided</h6>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="social_enabled" id="social_enabled">
                                <label class="custom-control-label" for="social_enabled" data-localize="config_enabled">Enabled</label>
                            </div>

                            <div class="custom-control">
                                <label for="social_facebookId" data-localize="config_facebookId">Facebook application
                                    ID, necessary for Facebook login. Follow this tutorial on how to get ID</label>
                                <input type="text" class="form-control" name="social_facebookId" id="social_facebookId"
                                       aria-describedby="social_facebookId">
                            </div>
                            <div class="custom-control">
                                <label for="social_googleId" data-localize="config_googleId">Google API ID. Check the
                                    tutorial on how to get Google client ID.</label>
                                <input type="text" class="form-control" name="social_googleId" id="social_googleId"
                                       aria-describedby="social_googleId">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <h6 data-localize="config_speechtranslate">Speech to text and translate</h6>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="transcribe_enabled" value="1" id="transcribe_enabled">
                                <label class="custom-control-label" for="transcribe_enabled"
                                       data-localize="config_enabled">Enabled</label>
                            </div>
                            <hr>
                            <div class="custom-control">
                                <label for="transcribe_enabled" data-localize="config_language_from">Language</label>
                                <select class="form-control" name="transcribe_language"  id="transcribe_language">
                                    <option value="af">Afrikaans (af)</option>
                                    <option value="sq">Albanian (sq)</option>
                                    <option value="am">Amharic (am)</option>
                                    <option value="ar">Arabic (ar)</option>
                                    <option value="hy">Armenian (hy)</option>
                                    <option value="az">Azerbaijani (az)</option>
                                    <option value="eu">Basque (eu)</option>
                                    <option value="be">Belarusian (be)</option>
                                    <option value="bn">Bengali (bn)</option>
                                    <option value="bs">Bosnian (bs)</option>
                                    <option value="bg">Bulgarian (bg)</option>
                                    <option value="ca">Catalan (ca)</option>
                                    <option value="ceb">Cebuano (ceb)</option>
                                    <option value="ny">Chichewa (ny)</option>
                                    <option value="zh">Chinese (Simplified) (zh)</option>
                                    <option value="zh-TW">Chinese (Traditional) (zh-TW)</option>
                                    <option value="co">Corsican (co)</option>
                                    <option value="hr">Croatian (hr)</option>
                                    <option value="cs">Czech (cs)</option>
                                    <option value="da">Danish (da)</option>
                                    <option value="nl">Dutch (nl)</option>
                                    <option value="en" selected="selected">English (en)</option>
                                    <option value="eo">Esperanto (eo)</option>
                                    <option value="et">Estonian (et)</option>
                                    <option value="tl">Filipino (tl)</option>
                                    <option value="fi">Finnish (fi)</option>
                                    <option value="fr">French (fr)</option>
                                    <option value="fy">Frisian (fy)</option>
                                    <option value="gl">Galician (gl)</option>
                                    <option value="ka">Georgian (ka)</option>
                                    <option value="de">German (de)</option>
                                    <option value="el">Greek (el)</option>
                                    <option value="gu">Gujarati (gu)</option>
                                    <option value="ht">Haitian Creole (ht)</option>
                                    <option value="ha">Hausa (ha)</option>
                                    <option value="haw">Hawaiian (haw)</option>
                                    <option value="iw">Hebrew (iw)</option>
                                    <option value="hi">Hindi (hi)</option>
                                    <option value="hmn">Hmong (hmn)</option>
                                    <option value="hu">Hungarian (hu)</option>
                                    <option value="is">Icelandic (is)</option>
                                    <option value="ig">Igbo (ig)</option>
                                    <option value="id">Indonesian (id)</option>
                                    <option value="ga">Irish (ga)</option>
                                    <option value="it">Italian (it)</option>
                                    <option value="ja">Japanese (ja)</option>
                                    <option value="jw">Javanese (jw)</option>
                                    <option value="kn">Kannada (kn)</option>
                                    <option value="kk">Kazakh (kk)</option>
                                    <option value="km">Khmer (km)</option>
                                    <option value="ko">Korean (ko)</option>
                                    <option value="ku">Kurdish (Kurmanji) (ku)</option>
                                    <option value="ky">Kyrgyz (ky)</option>
                                    <option value="lo">Lao (lo)</option>
                                    <option value="la">Latin (la)</option>
                                    <option value="lv">Latvian (lv)</option>
                                    <option value="lt">Lithuanian (lt)</option>
                                    <option value="lb">Luxembourgish (lb)</option>
                                    <option value="mk">Macedonian (mk)</option>
                                    <option value="mg">Malagasy (mg)</option>
                                    <option value="ms">Malay (ms)</option>
                                    <option value="ml">Malayalam (ml)</option>
                                    <option value="mt">Maltese (mt)</option>
                                    <option value="mi">Maori (mi)</option>
                                    <option value="mr">Marathi (mr)</option>
                                    <option value="mn">Mongolian (mn)</option>
                                    <option value="my">Myanmar (Burmese) (my)</option>
                                    <option value="ne">Nepali (ne)</option>
                                    <option value="no">Norwegian (no)</option>
                                    <option value="ps">Pashto (ps)</option>
                                    <option value="fa">Persian (fa)</option>
                                    <option value="pl">Polish (pl)</option>
                                    <option value="pt">Portuguese (pt)</option>
                                    <option value="pa">Punjabi (pa)</option>
                                    <option value="ro">Romanian (ro)</option>
                                    <option value="ru">Russian (ru)</option>
                                    <option value="sm">Samoan (sm)</option>
                                    <option value="gd">Scots Gaelic (gd)</option>
                                    <option value="sr">Serbian (sr)</option>
                                    <option value="st">Sesotho (st)</option>
                                    <option value="sn">Shona (sn)</option>
                                    <option value="sd">Sindhi (sd)</option>
                                    <option value="si">Sinhala (si)</option>
                                    <option value="sk">Slovak (sk)</option>
                                    <option value="sl">Slovenian (sl)</option>
                                    <option value="so">Somali (so)</option>
                                    <option value="es">Spanish (es)</option>
                                    <option value="su">Sundanese (su)</option>
                                    <option value="sw">Swahili (sw)</option>
                                    <option value="sv">Swedish (sv)</option>
                                    <option value="tg">Tajik (tg)</option>
                                    <option value="ta">Tamil (ta)</option>
                                    <option value="te">Telugu (te)</option>
                                    <option value="th">Thai (th)</option>
                                    <option value="tr">Turkish (tr)</option>
                                    <option value="uk">Ukrainian (uk)</option>
                                    <option value="ur">Urdu (ur)</option>
                                    <option value="uz">Uzbek (uz)</option>
                                    <option value="vi">Vietnamese (vi)</option>
                                    <option value="cy">Welsh (cy)</option>
                                    <option value="xh">Xhosa (xh)</option>
                                    <option value="yi">Yiddish (yi)</option>
                                    <option value="yo">Yoruba (yo)</option>
                                    <option value="zu">Zulu (zu)</option>
                                </select>
                            </div>
                            <hr>
                            <div class="custom-control">
                                <label for="transcribe_languageTo" data-localize="config_secondlanguage">Second language
                                    (when direction is set to Both, than this option is valid for the visitor)</label>
                                <select class="form-control" name="transcribe_languageTo" id="transcribe_languageTo">
                                    <option value="af">Afrikaans (af)</option>
                                    <option value="sq">Albanian (sq)</option>
                                    <option value="am">Amharic (am)</option>
                                    <option value="ar">Arabic (ar)</option>
                                    <option value="hy">Armenian (hy)</option>
                                    <option value="az">Azerbaijani (az)</option>
                                    <option value="eu">Basque (eu)</option>
                                    <option value="be">Belarusian (be)</option>
                                    <option value="bn">Bengali (bn)</option>
                                    <option value="bs">Bosnian (bs)</option>
                                    <option value="bg">Bulgarian (bg)</option>
                                    <option value="ca">Catalan (ca)</option>
                                    <option value="ceb">Cebuano (ceb)</option>
                                    <option value="ny">Chichewa (ny)</option>
                                    <option value="zh">Chinese (Simplified) (zh)</option>
                                    <option value="zh-TW">Chinese (Traditional) (zh-TW)</option>
                                    <option value="co">Corsican (co)</option>
                                    <option value="hr">Croatian (hr)</option>
                                    <option value="cs">Czech (cs)</option>
                                    <option value="da">Danish (da)</option>
                                    <option value="nl">Dutch (nl)</option>
                                    <option value="en" selected="selected">English (en)</option>
                                    <option value="eo">Esperanto (eo)</option>
                                    <option value="et">Estonian (et)</option>
                                    <option value="tl">Filipino (tl)</option>
                                    <option value="fi">Finnish (fi)</option>
                                    <option value="fr">French (fr)</option>
                                    <option value="fy">Frisian (fy)</option>
                                    <option value="gl">Galician (gl)</option>
                                    <option value="ka">Georgian (ka)</option>
                                    <option value="de">German (de)</option>
                                    <option value="el">Greek (el)</option>
                                    <option value="gu">Gujarati (gu)</option>
                                    <option value="ht">Haitian Creole (ht)</option>
                                    <option value="ha">Hausa (ha)</option>
                                    <option value="haw">Hawaiian (haw)</option>
                                    <option value="iw">Hebrew (iw)</option>
                                    <option value="hi">Hindi (hi)</option>
                                    <option value="hmn">Hmong (hmn)</option>
                                    <option value="hu">Hungarian (hu)</option>
                                    <option value="is">Icelandic (is)</option>
                                    <option value="ig">Igbo (ig)</option>
                                    <option value="id">Indonesian (id)</option>
                                    <option value="ga">Irish (ga)</option>
                                    <option value="it">Italian (it)</option>
                                    <option value="ja">Japanese (ja)</option>
                                    <option value="jw">Javanese (jw)</option>
                                    <option value="kn">Kannada (kn)</option>
                                    <option value="kk">Kazakh (kk)</option>
                                    <option value="km">Khmer (km)</option>
                                    <option value="ko">Korean (ko)</option>
                                    <option value="ku">Kurdish (Kurmanji) (ku)</option>
                                    <option value="ky">Kyrgyz (ky)</option>
                                    <option value="lo">Lao (lo)</option>
                                    <option value="la">Latin (la)</option>
                                    <option value="lv">Latvian (lv)</option>
                                    <option value="lt">Lithuanian (lt)</option>
                                    <option value="lb">Luxembourgish (lb)</option>
                                    <option value="mk">Macedonian (mk)</option>
                                    <option value="mg">Malagasy (mg)</option>
                                    <option value="ms">Malay (ms)</option>
                                    <option value="ml">Malayalam (ml)</option>
                                    <option value="mt">Maltese (mt)</option>
                                    <option value="mi">Maori (mi)</option>
                                    <option value="mr">Marathi (mr)</option>
                                    <option value="mn">Mongolian (mn)</option>
                                    <option value="my">Myanmar (Burmese) (my)</option>
                                    <option value="ne">Nepali (ne)</option>
                                    <option value="no">Norwegian (no)</option>
                                    <option value="ps">Pashto (ps)</option>
                                    <option value="fa">Persian (fa)</option>
                                    <option value="pl">Polish (pl)</option>
                                    <option value="pt">Portuguese (pt)</option>
                                    <option value="pa">Punjabi (pa)</option>
                                    <option value="ro">Romanian (ro)</option>
                                    <option value="ru">Russian (ru)</option>
                                    <option value="sm">Samoan (sm)</option>
                                    <option value="gd">Scots Gaelic (gd)</option>
                                    <option value="sr">Serbian (sr)</option>
                                    <option value="st">Sesotho (st)</option>
                                    <option value="sn">Shona (sn)</option>
                                    <option value="sd">Sindhi (sd)</option>
                                    <option value="si">Sinhala (si)</option>
                                    <option value="sk">Slovak (sk)</option>
                                    <option value="sl">Slovenian (sl)</option>
                                    <option value="so">Somali (so)</option>
                                    <option value="es">Spanish (es)</option>
                                    <option value="su">Sundanese (su)</option>
                                    <option value="sw">Swahili (sw)</option>
                                    <option value="sv">Swedish (sv)</option>
                                    <option value="tg">Tajik (tg)</option>
                                    <option value="ta">Tamil (ta)</option>
                                    <option value="te">Telugu (te)</option>
                                    <option value="th">Thai (th)</option>
                                    <option value="tr">Turkish (tr)</option>
                                    <option value="uk">Ukrainian (uk)</option>
                                    <option value="ur">Urdu (ur)</option>
                                    <option value="uz">Uzbek (uz)</option>
                                    <option value="vi">Vietnamese (vi)</option>
                                    <option value="cy">Welsh (cy)</option>
                                    <option value="xh">Xhosa (xh)</option>
                                    <option value="yi">Yiddish (yi)</option>
                                    <option value="yo">Yoruba (yo)</option>
                                    <option value="zu">Zulu (zu)</option>
                                </select>
                            </div>
                            <hr>
                            <div class="custom-control">
                                <label for="transcribe_direction" data-localize="config_secondlanguage"
                                       data-localize="config_direction">Second language (when direction is set to Both,
                                    than this option is valid for the visitor)</label>
                                <select class="form-control" name="transcribe_direction" id="transcribe_direction">
                                    <option value="agent" data-localize="config_fromagent"></option>
                                    <option value="visitor" data-localize="config_fromvisitor"></option>
                                    <option value="both" data-localize="config_both"></option>
                                </select>
                            </div>
                            <hr>
                            <div class="custom-control">
                                <label for="transcribe_apiKey" data-localize="config_apikey">API key (necessary for the
                                    translation demo. This is the Google key for translation API)</label>
                                <input type="text" class="form-control" name="transcribe_apiKey" id="transcribe_apiKey"
                                       aria-describedby="transcribe_apiKey">
                            </div>


                        </div>
                        <hr>
                        <div class="form-group">
                            <h6 data-localize="config_stunturn">STUN/TURN (for more information about STUN/TURN servers,
                                check here) </h6>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="1" name="iceServers_requirePass"
                                       id="iceServers_requirePass">
                                <label class="custom-control-label" for="iceServers_requirePass"
                                       data-localize="config_encrypted">Username and password are encrypted. Please read
                                    here how to encrypt your username and password
                                </label>
                            </div>
                            <br/>
                            <label for="videoScreen_screenConstraint" data-localize="config_stunvalues">STUN/TURN
                                Values</label>

                            <div class="custom-control">
                                <textarea class="form-control" id="iceServers" name="iceServers" rows="8"></textarea>
                            </div>

                        </div>

                        {{ Form::button('Save', ['type'=>'submit','class' => 'btn btn-primary btn-block','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                        <hr>
                    </form>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="p-1">
                    <h6 data-localize="config_desc">
                        Choose a configuration from the list below. The default one is config and is loaded initially.
                        If you need to add another configuration set, choose a name and click on Add button.
                        <br>
                        For example if you need a separate configuration with whiteboard enabled, add configuration with
                        name config_whiteboard and click on Add button. Then you can edit it from from the left form by
                        enabling the Whiteboard option.
                        <br>
                        Then the specific whiteboard configuration can be chosed in the Room management form.
                    </h6>
                    <br/>

                    <form class="user" method="post" action="{{ route('configs.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="roomName"><h6 data-localize="config_name">Configuration name</h6></label>
                            <input type="text" class="form-control" id="fileName" name="fileName"
                                   aria-describedby="fileName">
                        </div>
                        {{ Form::button('Add', ['type'=>'submit','class' => 'btn btn-primary btn-block','id'=>'btnAdd','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                        <br/>
                    </form>

                    <?php
                    if ($handle = opendir(public_path('json'))) {
                        echo '<a href="/configs" class="btn btn-light">config</a><hr>';
                        while (false !== ($entry = readdir($handle))) {
                            if ($entry != "." && $entry != ".." && $entry != "config.json" && substr($entry, -3) != "zip") {
                                $entry = substr($entry, 0, -5);
                                $delete = '| <a href="javascript:void(0)" data-file="' . $entry.'"  id="deleteConfig' . $entry . '" class="btn btn-light delete-config">Delete</a>';
                                echo '<a href="/configs?file=' . $entry.'.json' . '" class="btn btn-light">' . $entry . '</a>' . $delete . '<hr>';
                            }
                        }

                        closedir($handle);
                    }
                    ?>

                </div>
            </div>

        </div>

    @endif
@endsection
@section('scripts')
    <?php
        $jsonString = file_get_contents(public_path('json/'.$fileName));
        $data = json_decode($jsonString);
    ?>
    <script>
        let configIndexUrl = "{{ route('configs.index') }}";
        let configUpdateUrl = "{{ route('configs.update') }}";
        let  fileName = "{{ $fileName }}";

        $('#appWss').val('<?php echo @$data->appWss; ?>');
        $('#agentName').val('<?php echo @$data->agentName; ?>');
        $('#agentAvatar').val('<?php echo @$data->agentAvatar; ?>');
        $('#smartVideoLanguage').val('<?php echo @$data->smartVideoLanguage; ?>');
        $('#anonVisitor').val('<?php echo @$data->anonVisitor; ?>');
        $('#entryForm_enabled').prop('checked', <?php echo @$data->entryForm->enabled; ?>);
        $('#entryForm_required').prop('checked', <?php echo @$data->entryForm->required; ?>);
        $('#entryForm_private').prop('checked', <?php echo @$data->entryForm->private; ?>);
        $('#entryForm_showEmail').prop('checked', <?php echo @$data->entryForm->showEmail; ?>);
        $('#entryForm_showAvatar').prop('checked', <?php echo @$data->entryForm->showAvatar; ?>);
        $('#entryForm_terms').val('<?php echo @$data->entryForm->terms; ?>');
        $('#recording_enabled').prop('checked', <?php echo @$data->recording->enabled; ?>);
        $('#recording_download').prop('checked', <?php echo @$data->recording->download; ?>);
        $('#recording_saveServer').prop('checked', <?php echo @$data->recording->saveServer; ?>);
        $('#recording_autoStart').prop('checked', <?php echo @$data->recording->autoStart; ?>);
        $('#recording_screen').prop('checked', <?php echo @$data->recording->screen; ?>);
        $('#recording_oneWay').prop('checked', <?php echo @$data->recording->oneWay; ?>);
        $('#recording_transcode').prop('checked', <?php echo @$data->recording->transcode; ?>);
        $('#recording_filename').val('<?php echo @$data->recording->filename; ?>');
        $('#recording_recordingConstraints').val('<?php echo (isset($data->recording->recordingConstraints)) ? json_encode($data->recording->recordingConstraints, JSON_FORCE_OBJECT) : ''; ?>');
        $('#whiteboard_enabled').prop('checked', <?php echo @$data->whiteboard->enabled; ?>);
        $('#whiteboard_allowAnonymous').prop('checked', <?php echo @$data->whiteboard->allowAnonymous; ?>);
        $('#videoScreen_greenRoom').prop('checked', <?php echo @$data->videoScreen->greenRoom; ?>);
        $('#videoScreen_waitingRoom').prop('checked', <?php echo @$data->videoScreen->waitingRoom; ?>);
        $('#videoScreen_videoConference').prop('checked', <?php echo @$data->videoScreen->videoConference; ?>);
        $('#videoScreen_onlyAgentButtons').prop('checked', <?php echo @$data->videoScreen->onlyAgentButtons; ?>);
        $('#videoScreen_getSnapshot').prop('checked', <?php echo @$data->videoScreen->getSnapshot; ?>);
        $('#videoScreen_separateScreenShare').prop('checked', <?php echo @$data->videoScreen->separateScreenShare; ?>);
        $('#videoScreen_broadcastAttendeeVideo').prop('checked', <?php echo @$data->videoScreen->broadcastAttendeeVideo; ?>);
        $('#videoScreen_allowOtherSee').prop('checked', <?php echo @$data->videoScreen->allowOtherSee; ?>);
        $('#videoScreen_localFeedMirrored').prop('checked', <?php echo @$data->videoScreen->localFeedMirrored; ?>);
        $('#videoScreen_exitMeetingOnTime').prop('checked', <?php echo @$data->videoScreen->exitMeetingOnTime; ?>);
        $('#videoScreen_meetingTimer').prop('checked', <?php echo @$data->videoScreen->meetingTimer; ?>);
        $('#videoScreen_admit').prop('checked', <?php echo @$data->videoScreen->admit; ?>);
        $('#videoScreen_pipEnabled').prop('checked', <?php echo @$data->videoScreen->pipEnabled; ?>);
        $('#videoScreen_primaryCamera').val('<?php echo @$data->videoScreen->primaryCamera; ?>');
        $('#videoScreen_dateFormat').val('<?php echo @$data->videoScreen->dateFormat; ?>');
        $('#videoScreen_videoFileStream').val('<?php echo @$data->videoScreen->videoFileStream; ?>');
        $('#videoScreen_videoConstraint').val('<?php echo (isset($data->videoScreen->videoConstraint)) ? json_encode($data->videoScreen->videoConstraint, JSON_FORCE_OBJECT) : ''; ?>');
        $('#videoScreen_audioConstraint').val('<?php echo (isset($data->videoScreen->audioConstraint)) ? json_encode($data->videoScreen->audioConstraint, JSON_FORCE_OBJECT) : ''; ?>');
        $('#videoScreen_screenConstraint').val('<?php echo (isset($data->videoScreen->screenConstraint)) ? json_encode($data->videoScreen->screenConstraint, JSON_FORCE_OBJECT) : ''; ?>');
            let exitMeeting = '<?php echo (isset($data->videoScreen->exitMeeting)) ? addslashes($data->videoScreen->exitMeeting) : false; ?>';
            if (exitMeeting == false) {
                $('#videoScreen_exitMeetingDrop').val(1);
                $('#videoScreen_exitMeeting').hide();
            } else if (exitMeeting == '/') {
                $('#videoScreen_exitMeetingDrop').val(2);
                $('#videoScreen_exitMeeting').hide();
            } else {
                $('#videoScreen_exitMeetingDrop').val(3);
                $('#videoScreen_exitMeeting').show();
                $('#videoScreen_exitMeeting').val(exitMeeting);
            }

            $('#serverSide_loginForm').prop('checked', <?php echo @$data->serverSide->loginForm; ?>);
            $('#serverSide_chatHistory').prop('checked', <?php echo @$data->serverSide->chatHistory; ?>);
            $('#serverSide_feedback').prop('checked', <?php echo @$data->serverSide->feedback; ?>);
            $('#serverSide_checkRoom').prop('checked', <?php echo @$data->serverSide->checkRoom; ?>);
            $('#serverSide_videoLogs').prop('checked', <?php echo @$data->serverSide->videoLogs; ?>);
            $('#iceServers').val('<?php echo (isset($data->iceServers->iceServers)) ? json_encode($data->iceServers->iceServers) : ''; ?>');
            $('#iceServers_requirePass').prop('checked', <?php echo @$data->iceServers->requirePass; ?>);
            $('#videoScreen_enableLogs').prop('checked', <?php echo @$data->videoScreen->enableLogs; ?>);
            $('#transcribe_enabled').prop('checked', <?php echo @$data->transcribe->enabled; ?>);
            $('#transcribe_language').val('<?php echo @$data->transcribe->language; ?>');
            $('#transcribe_languageTo').val('<?php echo @$data->transcribe->languageTo; ?>');
            $('#transcribe_direction').val('<?php echo @$data->transcribe->direction; ?>');
            $('#transcribe_apiKey').val('<?php echo @$data->transcribe->apiKey; ?>');
            $('#social_enabled').prop('checked', <?php echo @$data->social->enabled; ?>);
            $('#social_facebookId').val('<?php echo @$data->social->facebookId; ?>');
            $('#social_googleId').val('<?php echo @$data->social->googleId; ?>');
    </script>
    <script src="{{ asset('assets/js/configs/configs.js') }}"></script>
@endsection
