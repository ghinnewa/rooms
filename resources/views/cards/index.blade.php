@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                   @lang('models/cards.plural')
                </div>
                <div class="col-sm-6">
                    {{--  @role('admin|system admin')  --}}
                    <a class="btn btn-primary float-right"
                       href="{{ route('cards.create') }}">

                         @lang('crud.add_new')
                    </a>
                    {{--  @endrole  --}}
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body  ">
                @include('cards.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


