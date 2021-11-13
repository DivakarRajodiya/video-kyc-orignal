@extends('layouts.app')
@section('title')
    Chats
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" data-localize="chats">Chats</h6>
        </div>
        <div class="card-body">
            @include('chats.table')
        </div>
    </div>
    @include('chats.message')
@endsection
@section('scripts')
    <script>
        let chatsUrl = "{{ route('chats.index') }}";
    </script>
    <script src="{{ mix('assets/js/chats/chats.js') }}"></script>
@endsection
