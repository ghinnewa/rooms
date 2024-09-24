@extends('layouts.app')

@section('content')
    <div class="container text-center mt-5">
        <img src="{{ asset('locked.png') }}" alt="مغلق" style="max-width: 200px; margin-bottom: 20px;">
        <h2>حسابك مقفل</h2>
        <p class="lead">تحتاج إلى إنشاء بطاقتك قبل الوصول إلى هذا القسم</p>
        <a href="{{ route('cards.create') }}" class="btn btn-primary btn-lg mt-4">أنشئ بطاقتك الآن</a>
    </div>
@endsection
