@extends('layouts.app')
@section('title')
    Edit Room
@endsection
@section('css')
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="h3 mb-2 text-gray-800" id="roomTitle" data-localize="room">Edit Room</h1>
        </div>
        <div class="content">
            @include('stisla-templates::common.errors')
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {!! Form::model($room, ['route' => ['rooms.update', $room->id], 'method' => 'patch', 'id' => 'editForm']) !!}
                                    <div class="row">
                                        @include('rooms.fields')
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        let agentUrl = "{{ $room->agenturl }}"
        let visitorUrl = "{{ $room->visitorurl }}";
        let viewerBroadcastLink = "{{ $room->visitorurl_broadcast }}"
    </script>
    <script src="{{ mix('assets/js/rooms/create_edit.js') }}"></script>
@endsection
