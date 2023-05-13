<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p><img src="{{ asset('storage/profile/'.$card->image) }}" style="width:150px; height:150px;object-fit:cover;" class="rounded-circle" alt=""></p>
</div>

<!-- Name Ar Field -->
<div class="col-sm-12">
    {!! Form::label('name_ar', 'Name Ar:') !!}
    <p>{{ $card->name_ar }}</p>
</div>

<!-- Name En Field -->
<div class="col-sm-12">
    {!! Form::label('name_en', 'Name En:') !!}
    <p>{{ $card->name_en }}</p>
</div>

<!-- Job Title Ar Field -->
<div class="col-sm-12">
    {!! Form::label('job_title_ar', 'Job Title Ar:') !!}
    <p>{{ $card->job_title_ar }}</p>
</div>

<!-- Job Title En Field -->
<div class="col-sm-12">
    {!! Form::label('job_title_en', 'Job Title En:') !!}
    <p>{{ $card->job_title_en }}</p>
</div>

<!-- Membership Number Field -->
<div class="col-sm-12">
    {!! Form::label('membership_number', 'Membership Number:') !!}
    <p>{{ $card->membership_number }}</p>
</div>

<!-- Phone1 Field -->
<div class="col-sm-12">
    {!! Form::label('phone1', 'Phone1:') !!}
    <p>{{ $card->phone1 }}</p>
</div>

<!-- Phone2 Field -->
<div class="col-sm-12">
    {!! Form::label('phone2', 'Phone2:') !!}
    <p>{{ $card->phone2 }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $card->email }}</p>
</div>

<!-- Website Field -->
<div class="col-sm-12">
    {!! Form::label('website', 'Website:') !!}
    <p>{{ $card->website }}</p>
</div>

<!-- Qrcode Field -->
<div class="col-sm-12">
    {!! Form::label('qrcode', 'Qrcode:') !!}
    <p><img src="{{ asset('storage/qr-code/'.$card->qrcode) }}" style="width:100px; height:100px" class="" alt=""></p>
</div>


<!-- Paid Field -->
<div class="col-sm-12">
    {!! Form::label('paid', 'Paid:') !!}
    <p>{{ $card->paid }}</p>
</div>

