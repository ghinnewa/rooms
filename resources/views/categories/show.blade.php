@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Category Details</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('categories.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('categories.show_fields')
                </div>
            </div>
        </div>
    </div>
    <div class="content px-3">

<div class="card">

    <div class="card-body">
        <div class="row">
            <!-- Category Details -->
            <div class="col-md-12">
                <h4>Subjects</h4>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Code</th>
                            <th>Semester</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories->subjects as $subject)
                            <tr>
                                <td>{{ $subject->title }}</td>
                                <td>{{ $subject->code }}</td>
                                <td>{{ $subject->pivot->semester }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <a href="{{ route('categories.index') }}" class="btn btn-default">Back to Categories</a>
    </div>

</div>
</div>
@endsection
