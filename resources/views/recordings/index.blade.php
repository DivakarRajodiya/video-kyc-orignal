@extends('layouts.app')
@section('title')
    Recordings
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left" data-localize="recordings">Recordings</h6>
        </div>
        <div class="card-body">
            @include('recordings.table')
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let recordingsUrl = "{{ route('recordings.index') }}";
    </script>
    <script src="{{ mix('assets/js/recordings/recordings.js')}}"></script>
@endsection
