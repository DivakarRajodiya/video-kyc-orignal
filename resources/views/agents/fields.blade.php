@if(\Illuminate\Support\Facades\Auth::user()->tenant == 'lsv_mastertenant')

    <!-- First Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('first_name', 'First Name:') !!}
        {!! Form::text('first_name', isset($agent) && $agent->first_name ? $agent->first_name : null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Last Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('last_name', 'Last Name:') !!}
        {!! Form::text('last_name', isset($agent) && $agent->last_name ? $agent->last_name : null, ['class' => 'form-control', 'required']) !!}
    </div>

    @if(\Auth::check() && \Illuminate\Support\Facades\Auth::user()->tenant == 'lsv_mastertenant')
        <!-- Username Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('username', 'Username:') !!}
            {!! Form::text('username', isset($agent) && $agent->username ? $agent->username : null, ['class' => 'form-control', 'required']) !!}
        </div>

        <!-- Email Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::text('email', isset($agent) && $agent->email ? $agent->email : null, ['class' => 'form-control', 'required']) !!}
        </div>

        <!-- Password Field -->
        @if(isset($agent))
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

        <!-- Tenant Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('tenant', 'Tenant:') !!}
            {!! Form::text('tenant', isset($agent) && $agent->tenant ? $agent->tenant : null, ['class' => 'form-control', 'required']) !!}
        </div>
    @else
        <input type="hidden" class="form-control" id="email">
        <input type="hidden" class="form-control" id="tenant">
        <input type="hidden" class="form-control" id="username">
    @endif
    <input type="hidden" class="form-control" id="usernamehidden">
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {{ Form::button('Save', ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <a href="{{ route('agents.index') }}" class="btn btn-light">Cancel</a>
    </div>
@endif
