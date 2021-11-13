<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Question Answer</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id' => 'editForm']) }}
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="editId" value="">
                        @include('question-answer.fields')
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>




