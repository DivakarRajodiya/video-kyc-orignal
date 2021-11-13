<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Question Answer</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {!! Form::open(['route' => 'question-answers.store', 'id'=>'addNewForm']) !!}
                <div class="modal-body">
                    <div class="row">
                        @include('question-answer.fields')
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

