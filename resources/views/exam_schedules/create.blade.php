@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Create Exam Schedule</h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    @include('adminlte-templates::common.errors')

    <div class="card">
        {!! Form::open(['route' => 'examSchedules.store']) !!}

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::label('year', 'Year:') !!}
                    {!! Form::text('year', null, ['class' => 'form-control', 'placeholder' => 'Enter year']) !!}
                </div>
            </div>
            <div id="exam-entries">
    <div class="row mt-3 exam-entry">
        <div class="col-md-3">
            {!! Form::label('exam_date', 'Exam Date:') !!}
            {!! Form::date('exams[0][exam_date]', null, ['class' => 'form-control']) !!}
        </div>

        <div class="col-md-3">
            {!! Form::label('category_id', 'Category:') !!}
            {!! Form::select('exams[0][category_id]', $categories->pluck('name_en', 'id'), null, ['class' => 'form-control category-select', 'placeholder' => 'Select category']) !!}
        </div>

        <div class="col-md-3">
            {!! Form::label('subject_id', 'Subject:') !!}
            {!! Form::select('exams[0][subject_id]', [], null, ['class' => 'form-control subject-select', 'placeholder' => 'Select subject']) !!}
        </div>

        <div class="col-md-3">
            {!! Form::label('semester', 'Semester:') !!}
            {!! Form::text('exams[0][semester]', null, ['class' => 'form-control semester-input', 'readonly' => 'readonly']) !!}
        </div>

        <div class="col-md-3 mt-2">
    {!! Form::label('start_time', 'Start Time:') !!}
    {!! Form::time('exams[0][start_time]', null, ['class' => 'form-control time-picker']) !!}
</div>

<div class="col-md-3 mt-2">
    {!! Form::label('end_time', 'End Time:') !!}
    {!! Form::time('exams[0][end_time]', null, ['class' => 'form-control time-picker']) !!}
</div>


        <div class="col-md-3 mt-2" style="display: flex; align-items: flex-end;">
       

            <button type="button" class="btn btn-danger remove-exam-entry">Remove</button>
        </div>
    </div>
</div>


            <div class="row mt-4">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary" id="add-exam-entry">Add Another Exam</button>
                </div>
            </div>

        </div>

        <div class="card-footer">
            {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('examSchedules.index') }}" class="btn btn-default">Cancel</a>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection

@push('subjects')
<script>
  let examIndex = 1;

$(document).ready(function () {
    // Dynamically add new exam entry
    $('#add-exam-entry').on('click', function () {
        const newExamEntry = $('.exam-entry:first').clone().find("input, select").each(function () {
            this.name = this.name.replace('[0]', '[' + examIndex + ']');
            this.value = '';
            if ($(this).hasClass('subject-select')) {
                $(this).html('<option value="">Select subject</option>');
            }
        }).end();

        // Append the new exam entry
        $('#exam-entries').append(newExamEntry);
        examIndex++;
    });

    // Remove an exam entry
    $(document).on('click', '.remove-exam-entry', function () {
        if ($('.exam-entry').length > 1) {
            $(this).closest('.exam-entry').remove();
        } else {
            alert('You must have at least one exam entry.');
        }
    });

    // Populate subjects based on category selection
    $(document).on('change', '.category-select', function () {
        const categoryId = $(this).val();
        const $subjectSelect = $(this).closest('.exam-entry').find('.subject-select');
        const $semesterInput = $(this).closest('.exam-entry').find('.semester-input');

        if (categoryId) {
            $.ajax({
                url: '/categories/' + categoryId + '/subjects',
                type: 'GET',
                success: function (data) {
                    $subjectSelect.empty().append('<option value="">Select subject</option>');
                    $.each(data.subjects, function (key, value) {
                        $subjectSelect.append('<option value="' + value.id + '">' + value.title + '</option>');
                    });
                }
            });
        }
    });

    // Populate semester based on subject selection
    $(document).on('change', '.subject-select', function () {
        const $semesterInput = $(this).closest('.exam-entry').find('.semester-input');
        const subjectId = $(this).val();
        const categoryId = $(this).closest('.exam-entry').find('.category-select').val();

        if (subjectId && categoryId) {
            $.ajax({
                url: '/categories/' + categoryId + '/subjects/' + subjectId,
                type: 'GET',
                success: function (data) {
                    $semesterInput.val(data.semester);
                }
            });
        }
    });

    // Validate form before submission
    $('form').on('submit', function (e) {
        let isValid = true;
        $('.exam-entry').each(function () {
            const $examDate = $(this).find('[name*="[exam_date]"]');
            const $categorySelect = $(this).find('.category-select');
            const $subjectSelect = $(this).find('.subject-select');
            const $startTime = $(this).find('[name*="[start_time]"]');
            const $endTime = $(this).find('[name*="[end_time]"]');

            // Check if all required fields are filled
            if (!$examDate.val() || !$categorySelect.val() || !$subjectSelect.val() || !$startTime.val() || !$endTime.val()) {
                isValid = false;
                alert('Please fill out all fields in each exam entry or remove the incomplete entry.');
                return false; // Break out of the loop
            }
        });

        if (!isValid) {
            e.preventDefault(); // Prevent form submission
        }
    });
});
$(document).ready(function() {
    // Function to adjust the time picker to only allow 00 or 30 minutes
    function adjustTimeToInterval($timeInput) {
        let timeValue = $timeInput.val();

        if (timeValue) {
            let [hours, minutes] = timeValue.split(':');

            if (minutes >= 0 && minutes < 30) {
                minutes = '00';
            } else {
                minutes = '30';
            }

            $timeInput.val(`${hours}:${minutes}`);
        }
    }

    // When the user changes the time, adjust the minutes to either 00 or 30
    $(document).on('change', '.time-picker', function() {
        adjustTimeToInterval($(this));
    });

    // Also apply this adjustment when the user first clicks into the time picker
    $(document).on('focusout', '.time-picker', function() {
        adjustTimeToInterval($(this));
    });
});

</script>
@endpush