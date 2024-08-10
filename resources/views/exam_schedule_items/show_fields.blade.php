<!-- Exam Schedule Id Field -->
<div class="col-sm-12">
    {!! Form::label('exam_schedule_id', __('models/examScheduleItems.fields.exam_schedule_id').':') !!}
    <p>{{ $examScheduleItem->exam_schedule_id }}</p>
</div>

<!-- Exam Date Field -->
<div class="col-sm-12">
    {!! Form::label('exam_date', __('models/examScheduleItems.fields.exam_date').':') !!}
    <p>{{ $examScheduleItem->exam_date }}</p>
</div>

<!-- Category Id Field -->
<div class="col-sm-12">
    {!! Form::label('category_id', __('models/examScheduleItems.fields.category_id').':') !!}
    <p>{{ $examScheduleItem->category_id }}</p>
</div>

<!-- Subject Id Field -->
<div class="col-sm-12">
    {!! Form::label('subject_id', __('models/examScheduleItems.fields.subject_id').':') !!}
    <p>{{ $examScheduleItem->subject_id }}</p>
</div>

<!-- Semester Field -->
<div class="col-sm-12">
    {!! Form::label('semester', __('models/examScheduleItems.fields.semester').':') !!}
    <p>{{ $examScheduleItem->semester }}</p>
</div>

<!-- Start Time Field -->
<div class="col-sm-12">
    {!! Form::label('start_time', __('models/examScheduleItems.fields.start_time').':') !!}
    <p>{{ $examScheduleItem->start_time }}</p>
</div>

<!-- End Time Field -->
<div class="col-sm-12">
    {!! Form::label('end_time', __('models/examScheduleItems.fields.end_time').':') !!}
    <p>{{ $examScheduleItem->end_time }}</p>
</div>

