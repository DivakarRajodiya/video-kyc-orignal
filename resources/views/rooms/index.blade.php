@extends('layouts.app')
@section('title')
    Rooms
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left" data-localize="rooms">Rooms</h6>
            <div class="float-right">
                <a href="{{ route('rooms.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus text-300"></i>  Room
                </a>
            </div>
        </div>
        <div class="card-body">
            @include('rooms.table')
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let roomsUrl = "{{ route('rooms.index') }}";
    </script>
    <script src="{{ mix('assets/js/rooms/rooms.js') }}"></script>
@endsection

