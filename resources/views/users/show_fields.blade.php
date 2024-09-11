
    <div >
        <!-- Name Field -->
        <div class="form-group">
            {!! Form::label('name', 'Name:', ['class' => 'font-weight-bold']) !!}
            <p>{{ $user->name }}</p>
        </div>

        <!-- Email Field -->
        <div class="form-group">
            {!! Form::label('email', 'Email:', ['class' => 'font-weight-bold']) !!}
            <p>{{ $user->email }}</p>
        </div>

        <!-- Email Verified At Field -->
        <div class="form-group">
            {!! Form::label('email_verified_at', 'Email Verified At:', ['class' => 'font-weight-bold']) !!}
            <p>{{ $user->email_verified_at ?? 'Not Verified' }}</p>
        </div>

        <!-- Password Field -->
        <div class="form-group">
            {!! Form::label('password', 'Password:', ['class' => 'font-weight-bold']) !!}
            <p>**********</p> <!-- Never show the actual password -->
        </div>

        <!-- Remember Token Field -->
        <div class="form-group">
            {!! Form::label('remember_token', 'Remember Token:', ['class' => 'font-weight-bold']) !!}
            <p>{{ $user->remember_token ?? 'N/A' }}</p>
        </div>

        <!-- Edit Button -->
        <div class="form-group text-center mt-4">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">
                <i class="fa fa-edit"></i> Edit Profile
            </a>
        </div>
    </div>
