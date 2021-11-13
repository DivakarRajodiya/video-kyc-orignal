@extends('layouts.app')
@section('title')
    Create Room
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css"/>
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="h3 mb-2 text-gray-800" id="roomTitle" data-localize="room">New Room</h1>
            <div class="filter-container section-header-breadcrumb row justify-content-md-end">
            </div>
        </div>
        <div class="content">
            @include('stisla-templates::common.errors')
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {!! Form::open(['route' => 'rooms.store', 'id' => 'addNewForm']) !!}
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
        let agentUrl = "{{ \App\Models\Room::first()->agenturl ?? '' }}"
        let visitorUrl = "{{ \App\Models\Room::first()->visitorurl ?? '' }}";
        let viewerBroadcastLink = "{{ \App\Models\Room::first()->visitorurl_broadcast ?? '' }}"
    </script>
    <script src="{{ mix('assets/js/rooms/create_edit.js') }}"></script>
@endsection
