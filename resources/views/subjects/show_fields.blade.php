<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', __('models/subjects.fields.title').':') !!}
    <p>{{ $subjects->title }}</p>
</div>

<!-- Code Field -->
<div class="col-sm-12">
    {!! Form::label('code', __('models/subjects.fields.code').':') !!}
    <p>{{ $subjects->code }}</p>
</div>

<!-- Prerequisite Subject Field -->
<div class="col-sm-12">
    {!! Form::label('prerequisite_subject_id', __('models/subjects.fields.prerequisite_subject_id').':') !!}
    <p>{{ $subjects->prerequisiteSubject ? $subjects->prerequisiteSubject->title : 'None' }}</p>
</div>

<!-- Points Field -->
<div class="col-sm-12">
    {!! Form::label('points', __('models/subjects.fields.points').':') !!}
    <p>{{ $subjects->points }}</p>
</div>
