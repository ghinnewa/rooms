@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>التخصصات</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-left"
                       href="{{ route('categories.create') }}">
                       <i class="fas fa-plus-circle"></i> <!-- Plus Circle Icon -->
                       @lang('crud.add_new')                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body  ">
                @include('categories.table')

                <div class="card-footer clearfix">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

