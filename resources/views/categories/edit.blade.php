@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>تعديل القسم</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($categories, ['route' => ['categories.update', $categories->id], 'method' => 'patch', 'files' => true]) !!}

            <div class="card-body">

                <div class="row">
                    @include('categories.fields')

                    <!-- Subject Section -->
                    <div class="col-sm-12">
                        <h4>Edit Subjects</h4>
                        <div id="subjects-list">
                            @foreach($subjects as $subject)
                                @php
                                    $checked = $categories->subjects->contains($subject->id);
                                    $semester = $checked ? $categories->subjects->find($subject->id)->pivot->semester : null;
                                @endphp
                                <div class="form-group">
                                    <label>
                                        {!! Form::checkbox('subjects['.$subject->id.'][selected]', true, $checked, ['class' => 'subject-checkbox']) !!}
                                        {{ $subject->title }}
                                    </label>
                                    <div class="semester-select" style="{{ $checked ? '' : 'display:none;' }}">
                                        {!! Form::label('subjects['.$subject->id.'][semester]', 'Select Semester:') !!}
                                        {!! Form::select('subjects['.$subject->id.'][semester]', [3 => '3rd', 4 => '4th', 5 => '5th', 6 => '6th', 7 => '7th'], $semester, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('categories.index') }}" class="btn btn-default">إلغاء</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.subject-checkbox').change(function() {
                if ($(this).is(':checked')) {
                    $(this).closest('.form-group').find('.semester-select').show();
                } else {
                    $(this).closest('.form-group').find('.semester-select').hide();
                }
            });
        });
    </script>
@endpush
