@extends('layouts.app')
@section('title')
    Edit User
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading m-1">Edit User</h3>
        </div>
        <div class="content">
            @include('stisla-templates::common.errors')
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch', 'id' => 'editForm']) !!}
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
