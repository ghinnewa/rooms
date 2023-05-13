
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

<!-- Category Id Field -->
<div class="col-sm-12">
    {!! Form::label('category_id', 'Category Id:') !!}
    <p>{{ $card->category_id }}</p>
</div>

<!-- Facebook Url Field -->
<div class="col-sm-12">
    {!! Form::label('facebook_url', 'Facebook Url:') !!}
    <p>{{ $card->facebook_url }}</p>
</div>

<!-- Twitter Url Field -->
<div class="col-sm-12">
    {!! Form::label('twitter_url', 'Twitter Url:') !!}
    <p>{{ $card->twitter_url }}</p>
</div>

<!-- Linkedin Url Field -->
<div class="col-sm-12">
    {!! Form::label('linkedin_url', 'Linkedin Url:') !!}
    <p>{{ $card->linkedin_url }}</p>
</div>

<!-- Company Ar Field -->
<div class="col-sm-12">
    {!! Form::label('company_ar', 'Company Ar:') !!}
    <p>{{ $card->company_ar }}</p>
</div>

<!-- Company En Field -->
<div class="col-sm-12">
    {!! Form::label('company_en', 'Company En:') !!}
    <p>{{ $card->company_en }}</p>
</div>

<!-- Company Email Field -->
<div class="col-sm-12">
    {!! Form::label('company_email', 'Company Email:') !!}
    <p>{{ $card->company_email }}</p>
</div>

<!-- Instagram Url Field -->
<div class="col-sm-12">
    {!! Form::label('instagram_url', 'Instagram Url:') !!}
    <p>{{ $card->instagram_url }}</p>
</div>

<!-- Youtube Url Field -->
<div class="col-sm-12">
    {!! Form::label('youtube_url', 'Youtube Url:') !!}
    <p>{{ $card->youtube_url }}</p>
</div>

<!-- Identity File1 Field -->
<div class="col-sm-12">
    {!! Form::label('identity_file1', 'Identity File1:') !!}
    <a class="pb-2 d-block" href="{{ route('attachments.downloadAttachment',['identity_file1',$card->identity_file1]) }}" class="d-block">{{ $card->identity_file1 }}</a>
</div>

<!-- Identity File2 Field -->
<div class="col-sm-12">
    {!! Form::label('identity_file2', 'Identity File2:') !!}
    <a class="pb-2 d-block" href="{{ route('attachments.downloadAttachment',['identity_file2',$card->identity_file2]) }}" class="d-block">{{ $card->identity_file2 }}</a>


</div>
@if($card->paid)

@endif
