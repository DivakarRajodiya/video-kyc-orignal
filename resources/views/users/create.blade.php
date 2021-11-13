@extends('layouts.app')
@section('title')
    Create User
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading m-1 text-gray-800" id="userTitle" data-localize="user">New User</h3>
            <div class="filter-container section-header-breadcrumb row justify-content-md-end">
            </div>
        </div>
        <div class="content">
            @include('stisla-templates::common.errors')
            @include('flash::message')
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {!! Form::open(['route' => 'users.store', 'id' => 'addNewForm']) !!}
                                <div class="row">
                                    @include('users.fields')
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
    <script src="{{ mix('assets/js/users/create_edit.js') }}"></script>
@endsection
