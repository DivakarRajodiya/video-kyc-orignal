@extends('layouts.app')
@section('title')
    Edit Agent
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading m-1">Edit Agent</h3>
        </div>
        <div class="content">
            @include('stisla-templates::common.errors')
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {!! Form::model($agent, ['route' => ['agents.update', $agent->id], 'method' => 'post', 'id' => 'editForm']) !!}
                                <div class="row">
                                    @include('agents.fields')
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
    <script src="{{ mix('assets/js/agents/create_edit.js') }}"></script>
@endsection
