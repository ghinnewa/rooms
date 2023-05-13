<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @php

    @endphp
    @extends('layouts.app')

    @section('content')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Create Card</h1>
                    </div>
                </div>
            </div>
        </section>

        <div class="content px-3">

            @include('adminlte-templates::common.errors')

            <div class="card">

                {!! Form::open(['route' => 'store', 'files' => true]) !!}

                <div class="card-body">

                    <div class="row">
                        @include('cards.fields')
                    </div>

                </div>

                <div class="card-footer">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('cards.index') }}" class="btn btn-default">Cancel</a>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    @endsection

</body>
</html>
