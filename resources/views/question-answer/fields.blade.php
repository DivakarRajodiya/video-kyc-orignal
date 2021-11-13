<!-- Question Field -->
<div class="form-group col-sm-12">
    {!! Form::label('question', 'Question:') !!}<br>
    {!! Form::text('question', old('question'), ['class' => 'form-control question'. ($errors->has('question') ? 'is-invalid':''), 'required']) !!}
    <div class="invalid-feedback">{{ $errors->first('question') }}</div>
</div>

<!-- Status Field -->
<div class="form-group col-sm-12">
    {{ Form::label('status','Status'.':') }}
    <select class="form-control status" name="status" aria-describedby="status">
        <option value="1" selected="selected">Active</option>
        <option value="0">Inactive</option>
    </select>
</div>

<!-- Submit Field -->
<div class="col-sm-12">
    {{ Form::button('Save', ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
    <button type="button"  class="btn btn-secondary ml-1" data-dismiss="modal">
        Cancel
    </button>
</div>
