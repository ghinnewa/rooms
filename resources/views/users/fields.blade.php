<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'الاسم:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'البريد الإلكتروني:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

@if(!auth()->user()->hasRole('student'))
<div class="form-group col-sm-6">
    {!! Form::label('role', 'الدور:') !!}
    {!! Form::select('role', $roles, isset($selectedRole) ? $selectedRole : null, ['class' => 'form-control']) !!}
</div>
@endif

<!-- Password Field -->
@if (isset($user))
    <!-- Button to show password fields (only for edit) -->
    <div class="form-group col-sm-6">
        {!! Form::label('password', 'كلمة المرور:') !!}
        <br>
        <button type="button" class="btn btn-warning" id="reset-password-btn">إعادة تعيين كلمة المرور</button>
    </div>

    <!-- Hidden password fields (only for edit) -->
    <div class="form-group col-sm-6" id="password-fields" style="display: none;">
        {!! Form::label('password', 'كلمة المرور:') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}

        {!! Form::label('password_confirmation', 'تأكيد كلمة المرور:') !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    </div>
@else 
<div class="form-group col-sm-6">
    {!! Form::label('password', 'كلمة المرور:') !!}
    {!! Form::password('password', ['class' => 'form-control', 'required', 'minlength' => '8']) !!}
</div>

<!-- Password Confirmation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', 'تأكيد كلمة المرور:') !!}
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
