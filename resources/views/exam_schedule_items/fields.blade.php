<!-- Exam Schedule Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('exam_schedule_id', __('models/examScheduleItems.fields.exam_schedule_id').':') !!}
    {!! Form::number('exam_schedule_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Exam Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('exam_date', __('models/examScheduleItems.fields.exam_date').':') !!}
    {!! Form::text('exam_date', null, ['class' => 'form-control','id'=>'exam_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#exam_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', __('models/examScheduleItems.fields.category_id').':') !!}
    {!! Form::number('category_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Subject Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject_id', __('models/examScheduleItems.fields.subject_id').':') !!}
    {!! Form::number('subject_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Semester Field -->
<div class="form-group col-sm-6">
    {!! Form::label('semester', __('models/examScheduleItems.fields.semester').':') !!}
    {!! Form::text('semester', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Start Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_time', __('models/examScheduleItems.fields.start_time').':') !!}
    {!! Form::text('start_time', null, ['class' => 'form-control']) !!}
</div>

<!-- End Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_time', __('models/examScheduleItems.fields.end_time').':') !!}
    {!! Form::text('end_time', null, ['class' => 'form-control']) !!}
</div>