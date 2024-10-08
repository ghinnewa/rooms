@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>المستخدمين</h1>
                </div>
                <div class="col-sm-6">
                    @role('admin|super admin')
                    <a class="btn btn-primary float-left"
                       href="{{ route('users.create') }}">
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
            <div class="card-body  ">
                @include('users.table')

                <div class="card-footer clearfix">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

