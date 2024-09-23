<div >
    <!-- Name Field -->
    <div class="form-group">
        {!! Form::label('name', 'الاسم:', ['class' => 'font-weight-bold']) !!}
        <p>{{ $user->name }}</p>
    </div>

    <!-- Email Field -->
    <div class="form-group">
        {!! Form::label('email', 'البريد الإلكتروني:', ['class' => 'font-weight-bold']) !!}
        <p>{{ $user->email }}</p>
    </div>

    <!-- Email Verified At Field -->
    <div class="form-group">
        {!! Form::label('email_verified_at', 'تاريخ التحقق من البريد الإلكتروني:', ['class' => 'font-weight-bold']) !!}
        <p>{{ $user->email_verified_at ?? 'غير مُحقق' }}</p>
    </div>

    <!-- Password Field -->
    <div class="form-group">
        {!! Form::label('password', 'كلمة المرور:', ['class' => 'font-weight-bold']) !!}
        <p>**********</p> <!-- Never show the actual password -->
    </div>

    <!-- Remember Token Field -->
    <div class="form-group">
        {!! Form::label('remember_token', 'رمز التذكير:', ['class' => 'font-weight-bold']) !!}
        <p>{{ $user->remember_token ?? 'غير متاح' }}</p>
    </div>

    <!-- Edit Button -->
    <div class="form-group text-center mt-4">
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">
            <i class="fa fa-edit"></i> تعديل الملف الشخصي
        </a>
    </div>
</div>
