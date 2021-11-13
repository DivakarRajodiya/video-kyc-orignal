@extends('layouts.app')
@section('title')
    Video session logs
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" data-localize="videologs">Video session logs</h6>
        </div>
        <div class="card-body">
            @include('video-logs.table')
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let videLogsUrl = "{{ route('videoLogs.index') }}";
    </script>
    <script src="{{ mix('assets/js/video-logs/video-logs.js')}}"></script>
@endsection
