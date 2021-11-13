<div class="col-sm-6">
    <div class="p-1">

        <div class="form-group">
            <label for="roomName"><h6 data-localize="room_id">Room ID</h6></label>
            <input type="text" name="roomId" class="form-control" value="{{ isset($room) && $room->roomId ? $room->roomId : null }}" id="roomName" aria-describedby="roomName">
        </div>
        <div class="form-group">
            <label for="names"><h6 data-localize="agent_name">Agent Name</h6></label>
            <input type="text" class="form-control" name="agent" value="{{ isset($room) && $room->agent ? $room->agent : null }}" id="names" aria-describedby="names">
        </div>
        <div class="form-group">
            <label for="visitorName"><h6 data-localize="visitor_name">Visitor Name</h6></label>
            <input type="text" class="form-control" name="visitor" value="{{ isset($room) && $room->visitor ? $room->visitor : null }}" id="visitorName" aria-describedby="visitorName">
        </div>
        <div class="form-group">
            <label for="shortagent" data-localize="agent_shorturl"><h6>Agent Short URL</h6></label>
            <input type="text" name="shortagenturl" class="form-control" value="{{ isset($room) && $room->shortagenturl ? $room->shortagenturl : null }}" id="shortagent" aria-describedby="shortagent">
        </div>
        <div class="form-group">
            <label for="shortvisitor"><h6 data-localize="visitor_shorturl">Visitor Short URL</h6></label>
            <input type="text" name="shortvisitorurl" class="form-control" value="{{ isset($room) && $room->shortvisitorurl ? $room->shortvisitorurl : null }}" id="shortvisitor" aria-describedby="shortvisitor">
        </div>
        <div class="form-group">
            <label for="roomPass"><h6 data-localize="password">Password</h6></label>
            <input type="password" name="password" class="form-control" id="roomPass" aria-describedby="roomPass"
                   autocomplete="new-password">
        </div>
        <div class="form-group">
            <label for="config"><h6 data-localize="room_config">Room Configuration</h6></label>
            @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->tenant == "lsv_mastertenant")
            <select class="form-control" name="config" id="config">
                <option value="">-</option>
                <?php
                if ($handle = opendir(public_path('locales'))) {

                    while (false !== ($entry = readdir($handle))) {

                        if ($entry != "." && $entry != ".." && substr($entry, -3) != "zip") {
                            $entryValue = substr($entry, 0, -5);
                            echo '<option value="' . $entry . '">' . $entryValue . '</option>';
                        }
                    }

                    closedir($handle);
                }
                ?>
            </select>

            @else
            <input type="text" class="form-control" name="config" id="config" aria-describedby="config">
            @endif
        </div>
        <div class="form-group">
            <label for="datetime"><h6 data-localize="date_time">Date/Time</h6></label>
            <input type="text" name="datetime" value="{{ isset($room) && $room->datetime ? $room->datetime : null }}" class="form-control datetime" id="datetime" aria-describedby="datetime">
        </div>


        <div class="form-group">
            <label for="duration"><h6 data-localize="duration">Duration</h6></label>
            <select class="form-control" name="duration" id="duration">
                <option value="">-</option>
                <option value="15" {{ isset($room) && $room->duration == 15 ? 'selected' : null }}>15</option>
                <option value="30" {{ isset($room) && $room->duration == 30 ? 'selected' : null }}>30</option>
                <option value="45" {{ isset($room) && $room->duration == 45 ? 'selected' : null }}>45</option>
            </select>
            <span data-localize="or">or</span>
            <br/>
            <input type="text" class="form-control w-25" id="durationtext" aria-describedby="shortagent">
        </div>

        <div class="form-group">
            <h6 data-localize="disable">Disable</h6>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="disable_video" class="custom-control-input" id="disableVideo">
                <label class="custom-control-label" for="disableVideo"
                       data-localize="disable_video">Video</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="disable_audio" class="custom-control-input" id="disableAudio">
                <label class="custom-control-label" for="disableAudio"
                       data-localize="disable_audio">Audio</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="disable_screen_share" class="custom-control-input" id="disableScreenShare">
                <label class="custom-control-label" for="disableScreenShare"
                       data-localize="disable_screen_share">Screen Share</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="disable_white_board" class="custom-control-input" id="disableWhiteboard">
                <label class="custom-control-label" for="disableWhiteboard"
                       data-localize="disable_whiteboard">Whiteboard</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="disable_transfer" class="custom-control-input" id="disableTransfer">
                <label class="custom-control-label" for="disableTransfer"
                       data-localize="disable_file_transfer">File Transfer</label>
            </div>
        </div>
        <div class="form-group">
            <h6 data-localize="auto_accept">Auto Accept With</h6>

            <div class="custom-control custom-checkbox">

                <input type="checkbox" name="auto_accept_video" class="custom-control-input" id="autoAcceptVideo">
                <label class="custom-control-label" for="autoAcceptVideo"
                       data-localize="auto_accept_video">Video</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="auto_accept_audio" class="custom-control-input" id="autoAcceptAudio">
                <label class="custom-control-label" for="autoAcceptAudio"
                       data-localize="auto_accept_audio">Audio</label>
            </div>
        </div>
        <div class="form-group">
            <h6 data-localize="room_active">Room is active for meeting</h6>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" {{ isset($room) && $room->is_active == 1 ? 'checked' : null }} name="is_active" id="active" checked="checked">
                <label class="custom-control-label" for="active" data-localize="active">Active</label>
            </div>
        </div>

        <!-- Submit Field -->
        {{ Form::button('Save', ['type'=>'submit','class' => 'btn btn-primary btn-block','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <hr>
    </div>
</div>
<div class="col-sm-6">
    <div class="p-1">
        <h6 data-localize="room_info">
            You can start a video conference or a broadcasting session from the buttons bellow. The organizer URL
            will be opened in a new tab and the visitor URL will be stored in your clipboard.
            You can choose settings for the new video/broadcast from the left pane.
        </h6>
        <a href="javascript:void(0);" id="generateLink" class="btn btn-primary btn-user btn-block"
           data-localize="start_video">
            Start New Video
        </a>
        <hr>
        <a href="javascript:void(0);" id="generateBroadcastLink" class="btn btn-primary btn-user btn-block"
           data-localize="start_broadcast">
            Start New Broadcast
        </a>
        <hr>
    </div>
</div>


<div class="modal fade" id="generateBroadcastLinkModal" tabindex="-1" role="dialog" aria-labelledby="generateBroadcastLinkModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" data-localize="broadcasting_attendee_url">Broadcasting Attendee URL</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" data-localize="broadcasting_attendee_info">Broadcaster URL is opened in a new tab and visitor URL is stored in your clipboard, so you can send to your attendees.<br>
                You can copy it from here:</div>
            <div class="modal-footer">
                <button class="btn btn-primary mr-auto" type="button" id="copyBroadcastUrl" data-localize="copy_url">Copy URL</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal" data-localize="close">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="generateLinkModal" tabindex="-1" role="dialog" aria-labelledby="generateLinkModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" data-localize="video_attendee_url">Video Conference Attendee URL</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" data-localize="video_attendee_info">
                Agent URL is opened in a new tab and visitor URL is stored in your clipboard, so you can send to your attendees.<br>
                You can copy it from here:
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary mr-auto" type="button" id="copyAttendeeUrl" data-localize="copy_url">Copy URL</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal" data-localize="close">Close</button>
            </div>
        </div>
    </div>
</div>
