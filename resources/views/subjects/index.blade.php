@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                   @lang('models/subjects.plural')
                </div>
                <div class="col-sm-6">
                    @role('student')
                        <a class="btn btn-secondary float-right"
                           href="{{ route('student.subjects.add') }}">
                             Add Subject to My Profile
                        </a>
                    @else
                        <a class="btn btn-primary float-right"
                           href="{{ route('subjects.create') }}">
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
