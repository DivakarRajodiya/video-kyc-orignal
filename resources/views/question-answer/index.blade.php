@extends('layouts.app')
@section('title')
    Question Answers
@endsection
@section('content')
    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->tenant == 'lsv_mastertenant')
        @include('flash::message')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary float-left" data-localize="question-answers">Question Answers</h6>
                <div class="float-right">
                    <a class="btn btn-primary btn-sm addQuestionAnswerModal" href="javascript:void(0);"> <i class="fas fa-plus"></i> Question Answer</a>
                </div>
            </div>
            <div class="card-body">
                @include('question-answer.table')
            </div>
        </div>
        @include('question-answer.create')
        @include('question-answer.edit')
    @endif
@endsection
@section('scripts')
    <script>
        let questionAnswersUrl = "{{ route('question-answers.index') }}";
    </script>
    <script src="{{ mix('assets/js/question-answer/question-answer.js')}}"></script>
@endsection
