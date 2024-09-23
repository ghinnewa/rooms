@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>حدد المواد</h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('student.subjects.store') }}" method="POST">
                @csrf

                @foreach($subjects as $subject)
    <div class="form-group">
        <label>
            <input type="checkbox"
                   name="subject_id[]"
                   value="{{ $subject->id }}"
                   class="subject-checkbox"
                   data-subject-id="{{ $subject->id }}"
                   data-prerequisite-id="{{ $subject->prerequisite_subject_id }}">
            {{ $subject->title }}
        </label>
    </div>
@endforeach


                <button type="submit" class="btn btn-primary">اضف مواد إلى حسابي</button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
   $(document).ready(function() {
    $('.subject-checkbox').change(function() {
        const selectedSubjectId = $(this).data('subject-id');
        const prerequisiteSubjectId = $(this).data('prerequisite-id');

        if ($(this).is(':checked')) {
            if (prerequisiteSubjectId) {
                // Disable the dependent subject
                $('.subject-checkbox[data-subject-id="' + prerequisiteSubjectId + '"]').prop('checked', false).prop('disabled', true);
            }
        } else {
            if (prerequisiteSubjectId) {
                // Enable the dependent subject
                $('.subject-checkbox[data-subject-id="' + prerequisiteSubjectId + '"]').prop('disabled', false);
            }
        }
    });

    // Pre-check already selected subjects
    const selectedSubjects = @json($studentSubjects); // Pass the subjects from the backend
    selectedSubjects.forEach(subjectId => {
        $('.subject-checkbox[data-subject-id="' + subjectId + '"]').prop('checked', true);
    });
});

</script>

@endpush
@endsection
