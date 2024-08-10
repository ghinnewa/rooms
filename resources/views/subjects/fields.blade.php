<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', __('models/subjects.fields.title').':') !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Points Field -->
<div class="form-group col-sm-6">
    {!! Form::label('points', __('models/subjects.fields.points').':') !!}
    {!! Form::text('points', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>
<!-- Points Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', __('models/subjects.fields.code').':') !!}
    {!! Form::text('code', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>
<!-- Prerequisite Subject Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prerequisite_subject_id', __('models/subjects.fields.prerequisite_subject_id').':') !!}
    {!! Form::select('prerequisite_subject_id', $subjects, null, ['class' => 'form-control', 'placeholder' => 'Select Prerequisite Subject']) !!}
</div>
