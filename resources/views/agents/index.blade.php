@extends('layouts.app')
@section('title')
    Agents
@endsection
@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->tenant == 'lsv_mastertenant')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary float-left" data-localize="agents">Agents</h6>
                <div class="float-right">
                    <a href="{{ route('agents.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus text-300"></i> Agent
                    </a>
                </div>
            </div>
            <div class="card-body">
                @include('agents.table')
            </div>
        </div>
    @endif
@endsection
@section('scripts')
    <script>
        let agentsUrl = "{{ route('agents.index') }}";
    </script>
    <script src="{{ mix('assets/js/agents/agents.js') }}"></script>
@endsection
