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
@if(!auth()->user()->hasRole('student'))
<div class="form-group col-sm-6">
    {!! Form::label('role', 'Role:') !!}
    {!! Form::select('role', $roles, isset($selectedRole) ? $selectedRole : null, ['class' => 'form-control']) !!}
</div>

@endif


<!-- Password Field -->

@if (isset($user))
    <!-- Button to show password fields (only for edit) -->
    <div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    <br>
        <button type="button" class="btn btn-warning" id="reset-password-btn">Reset Password</button>
    </div>

    <!-- Hidden password fields (only for edit) -->
    <div class="form-group col-sm-6" id="password-fields" style="display: none;">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}

        {!! Form::label('password_confirmation', 'Confirm Password:') !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    </div>
@else 
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control', 'required', 'minlength' => '8']) !!}
</div>

<!-- Password Confirmation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', 'Confirm Password:') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'required', 'minlength' => '8']) !!}
</div>
@endif
<script>
    document.getElementById('reset-password-btn').addEventListener('click', function() {
        var passwordFields = document.getElementById('password-fields');
        if (passwordFields.style.display === 'none') {
            passwordFields.style.display = 'block'; // Show the password fields
        } else {
            passwordFields.style.display = 'none'; // Hide the password fields
        }
    });
</script>
