@extends('layouts.app')
@section('title')
    Visitors
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left" data-localize="visitors">Visitors</h6>
        </div>
        <div class="card-body">
            <div id="visitors"></div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let visitorsUrl = "{{ route('visitors.index') }}";
    </script>
    <script src="{{ mix('assets/js/visitors/visitors.js') }}"></script>
@endsection
