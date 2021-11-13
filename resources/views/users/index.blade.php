@extends('layouts.app')
@section('title')
    Users
@endsection
@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->tenant == 'lsv_mastertenant')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary float-left" data-localize="users">Users</h6>
                <div class="float-right">
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus text-300"></i> Users
                    </a>
                </div>
            </div>
            <div class="card-body">
                @include('users.table')
            </div>
        </div>
    @endif
@endsection
@section('scripts')
    <script>
        let usersUrl = "{{ route('users.index') }}";
    </script>
    <script src="{{ mix('assets/js/users/users.js') }}"></script>
@endsection
