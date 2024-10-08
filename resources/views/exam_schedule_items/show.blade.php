@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/examScheduleItems.singular')</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-left
                       href="{{ route('examScheduleItems.index') }}">
                         @lang('crud.back')
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('exam_schedule_items.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
