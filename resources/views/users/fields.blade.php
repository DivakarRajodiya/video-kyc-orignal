@if(\Illuminate\Support\Facades\Auth::user()->tenant == 'lsv_mastertenant')

    <!-- First Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('first_name', 'First Name:') !!}
        {!! Form::text('first_name', isset($user) && $user->first_name ? $user->first_name : null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Last Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('last_name', 'Last Name:') !!}
        {!! Form::text('last_name', isset($user) && $user->last_name ? $user->last_name : null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Email Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::text('email', isset($user) && $user->email ? $user->email : null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Password Field -->
    @if(isset($user))
        <div class="form-group col-sm-6">
            {!! Form::label('password', 'Password (If left blank will not be changed):') !!}
            <input type="password" class="form-control" name="password">
        </div>
    @else
        <div class="form-group col-sm-6">
            {!! Form::label('password', 'Password:') !!}
            <input type="password" class="form-control" name="password" required>
        </div>
    @endif

    <!-- Blocked Field -->
    <div class="form-group col-sm-6">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="is_blocked" {{ isset($user) && $user->is_blocked == 1 ? 'checked' : '' }} class="custom-control-input" id="is_blocked">
            {!! Form::label('is_blocked', 'Blocked', ['class' => 'custom-control-label']) !!}
        </div>
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {{ Form::button('Save', ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
    </div>
@endif
