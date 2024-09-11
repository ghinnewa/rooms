@extends('layouts.app')

@section('content')
    <div class="container text-center mt-5">
        <img src="{{ asset('locked.png') }}" alt="Locked" style="max-width: 200px; margin-bottom: 20px;">
        <h2>Your Account is Locked</h2>
        <p class="lead">You need to create your card before accessing this section </p>
        <a href="{{ route('cards.create') }}" class="btn btn-primary btn-lg mt-4">Create Your Card Now</a>
    </div>
@endsection
