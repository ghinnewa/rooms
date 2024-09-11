<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

@if(!auth()->user()->hasRole('student') )
    <!-- Roles Field (only visible if hideRole is not set or is false) -->
    <div class="form-group col-sm-6">
        {!! Form::label('roles', 'Roles:') !!}
        {!! Form::select('roles[]', $roles, $selectedRoles, ['class' => 'form-control', 'multiple']) !!}
    </div>
@endif

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control', 'required', 'minlength' => '8']) !!}
</div>

<!-- Password Confirmation Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', 'Confirm Password:') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'required', 'minlength' => '8']) !!}
</div> -->
