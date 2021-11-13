@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Dashboard</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" data-localize="visitors">Visitors</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="visitorsCount">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <a class="text-xs font-weight-bold text-success text-uppercase mb-1" href="{{ route('rooms.index') }}" data-localize="rooms">Rooms</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="roomsCount">{{ $room }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-video fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-1">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a class="text-xs font-weight-bold text-success text-uppercase mb-1" href="{{ route('rooms.create') }}" data-localize="room_management">Room Management</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->tenant == 'lsv_mastertenant')
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                <a class="text-xs font-weight-bold text-info text-uppercase mb-1" href="{{ route('agents.index') }}" data-localize="agents">Agents</a></div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="agentsCount">{{ $agent }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users-cog fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a class="text-xs font-weight-bold text-info text-uppercase mb-1" href="{{ route('agents.create') }}" data-localize="add_agent">Add New Agent</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                <a class="text-xs font-weight-bold text-warning text-uppercase mb-1" href="{{ route('users.index') }}" data-localize="users">Users</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="usersCount">{{ $user }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a class="text-xs font-weight-bold text-warning text-uppercase mb-1" href="{{ route('users.create') }}" data-localize="add_user">Add New User</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl col-lg-7">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary" data-localize="news_livesmart">News from AccuraScan</h6>
                        </div>
                        <div class="card-body">
                            @php
                                $file = public_path('assets/files/pages/version.txt');

                                $versionFile = fopen($file, 'r') or die("Unable to open file!");
                                $currentVersion = fread($versionFile, filesize($file));
                                echo '<span data-localize="version">Version</span>: ' . $currentVersion;
                                echo '<br/>';
                                echo '<br/>';
                                $curNumber = explode('.', $currentVersion);
                                fclose($versionFile);
                            @endphp
                            <span id="remoteVersion">
                                There is a new version of LiveSmart Video Chat: 2.0.33<
                            </span>
                            <br>
                            <br>
                            <span>New features:</span><br>
                            <span>- Text to speech module. Chat and translated messages are converted to voice messages;</span><br>
                            <span>- Feature request - password recovery facility;</span><br>
                            <span>- DocTreat v.1.4.8 integration;</span><br>
                            <br>
                            <br>
                            <span>Click here to update to the latest release</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        let xhr = new XMLHttpRequest();
        $(document).ready(function() {
        {{--    $.ajax({--}}
        {{--        url: 'https://www.new-dev.com/version/version.json',--}}
        {{--        type: 'GET',--}}
        {{--        headers: {  "Access-Control-Allow-Origin": "*",--}}
        {{--                    "Access-Control-Allow-Methods": "GET,HEAD,OPTIONS,POST,PUT",--}}
        {{--                    "Access-Control-Allow-Headers": "Origin, X-Requested-With, Content-Type, Accept, x-client-key, x-client-token, x-client-secret, Authorization"--}}
        {{--                },--}}
        {{--        dataType: 'json',--}}
        {{--        success: function() { alert('hello!'); },--}}
        {{--        error: function() { alert('boo!'); },--}}
        {{--    });--}}
        {{--    function setHeader(xhr) {--}}
        {{--        xhr.setRequestHeader('Authorization', 'Basic faskd52352rwfsdfs');--}}
        {{--        xhr.setRequestHeader('X-PartnerKey', '3252352-sdgds-sdgd-dsgs-sgs332fs3f');--}}
        {{--    }--}}
        {{--});--}}

        {{--$.getJSON('https://www.new-dev.com/version/version.json', function (data) {--}}
        {{--    if (data) {--}}
        {{--        var currentVersion = '<?php echo $currentVersion; ?>';--}}
        {{--        var currentVersion = '<?php echo '2.0.3' ?>';--}}
        {{--        var newNumber = data.version.split('.');--}}
        {{--        var curNumber = currentVersion.split('.');--}}
        {{--        var isNew = false;--}}
        {{--        if (parseInt(curNumber[0]) < parseInt(newNumber[0])) {--}}
        {{--            isNew = true;--}}
        {{--        }--}}
        {{--        if (parseInt(curNumber[0]) == parseInt(newNumber[0]) && parseInt(curNumber[1]) < parseInt(newNumber[1])) {--}}
        {{--            isNew = true;--}}
        {{--        }--}}
        {{--        if (parseInt(curNumber[0]) == parseInt(newNumber[0]) && parseInt(curNumber[1]) == parseInt(newNumber[1]) && parseInt(curNumber[2]) < parseInt(newNumber[2])) {--}}
        {{--            isNew = true;--}}
        {{--        }--}}

        {{--        if (isNew) {--}}
        {{--            <?php if (@$_SESSION["tenant"] == 'lsv_mastertenant') { ?>--}}
        {{--            $('#remoteVersion').html('<span data-localize="new_lsv_version"></span>' + data.version + '<br/><br/><span data-localize="new_lsv_features"></span><br/>' + data.text + '<br/><br/><span data-localize="update_location"></span>');--}}
        {{--            <?php } else { ?>--}}
        {{--            $('#remoteVersion').html('<span data-localize="new_lsv_version"></span>' + data.version + '<br/><br/><span data-localize="new_lsv_features"></span><br/>' + data.text);--}}
        {{--            <?php } ?>--}}
        {{--        } else {--}}
        {{--            $('#remoteVersion').html('<span data-localize="version_uptodate"></span>');--}}
        {{--        }--}}

        {{--    } else {--}}
        {{--        $('#remoteVersion').html('<span data-localize="cannot_connect"></span>');--}}
        {{--    }--}}
        });
    </script>
@endsection
