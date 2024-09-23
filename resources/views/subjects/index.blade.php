@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    <i class="fas fa-book"></i> <!-- Subject Icon -->
                    @lang('models/subjects.plural')
                </h1>
            </div>
            <div class="col-sm-6">
                @role('student')
                    <a class="btn btn-secondary float-right"
                       href="{{ route('student.subjects.add') }}">
                        <i class="fas fa-plus"></i> <!-- Plus Icon -->
                    إضافة مواد لحسابي
                    </a>
                @else
                    <a class="btn btn-primary float-left"
                       href="{{ route('subjects.create') }}">
                        <i class="fas fa-plus-circle"></i> <!-- Plus Circle Icon -->
                        @lang('crud.add_new')
                    </a>
                @endrole
            </div>
        </div>
    </div>
</section>


    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('subjects.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
