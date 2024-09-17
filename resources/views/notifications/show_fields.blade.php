<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', __('models/notifications.fields.type').':') !!}
    <p>{{ $notification->type }}</p>
</div>

<!-- Notifiable Type Field -->
<div class="col-sm-12">
    {!! Form::label('notifiable_type', __('models/notifications.fields.notifiable_type').':') !!}
    <p>{{ $notification->notifiable_type }}</p>
</div>

<!-- Notifiable Id Field -->
<div class="col-sm-12">
    {!! Form::label('notifiable_id', __('models/notifications.fields.notifiable_id').':') !!}
    <p>{{ $notification->notifiable_id }}</p>
</div>

<!-- Data Field -->
<div class="col-sm-12">
    {!! Form::label('data', __('models/notifications.fields.data').':') !!}
    <p>{{ $notification->data }}</p>
</div>

<!-- Read At Field -->
<div class="col-sm-12">
    {!! Form::label('read_at', __('models/notifications.fields.read_at').':') !!}
    <p>{{ $notification->read_at }}</p>
</div>

