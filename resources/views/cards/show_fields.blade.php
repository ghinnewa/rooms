
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p><img src="{{ asset('storage/profile/'.$card->image) }}" style="width:150px; height:150px;object-fit:cover;" class="rounded-circle" alt=""></p>
</div>

<!-- Name Ar Field -->
<div class="col-sm-12">
    {!! Form::label('name_ar', __('models/cards.fields.name_ar').':') !!}
    <p>{{ $card->name_ar }}</p>
</div>

<!-- Name En Field -->
<div class="col-sm-12">
    {!! Form::label('name_en', __('models/cards.fields.name_en').':') !!}
    <p>{{ $card->name_en }}</p>
</div>

<!-- Job Title Ar Field -->
<div class="col-sm-12">
    {!! Form::label('job_title_ar', __('models/cards.fields.job_title_ar').':') !!}
    <p>{{ $card->job_title_ar }}</p>
</div>

<!-- Job Title En Field -->
<div class="col-sm-12">
    {!! Form::label('job_title_en', __('models/cards.fields.job_title_en').':') !!}
    <p>{{ $card->job_title_en }}</p>
</div>

<!-- Membership Number Field -->
<div class="col-sm-12">
    {!! Form::label('membership_number', __('models/cards.fields.membership_number').':') !!}
    <p>{{ $card->membership_number }}</p>
</div>

<!-- Phone1 Field -->
<div class="col-sm-12">
    {!! Form::label('phone1', __('models/cards.fields.phone1').':') !!}
    <p>{{ $card->phone1 }}</p>
</div>

<!-- Phone2 Field -->
<div class="col-sm-12">
    {!! Form::label('phone2', __('models/cards.fields.phone2').':') !!}
    <p>{{ $card->phone2 }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', __('models/cards.fields.email').':') !!}
    <p>{{ $card->email }}</p>
</div>

<!-- Website Field -->
<div class="col-sm-12">
    {!! Form::label('website', __('models/cards.fields.website').':') !!}
    <p>{{ $card->website }}</p>
</div>


<!-- Qrcode Field -->
<div class="col-sm-12">
    {!! Form::label('qrcode', 'Qrcode:') !!}
    <p> <a class="pb-2 d-block" href="{{ route('attachments.downloadAttachment',['qr-code',$card->qrcode]) }}" class="d-block"><img src="{{ asset('storage/qr-code/'.$card->qrcode) }}" style="width:100px; height:100px" class="" alt=""> </a></p>
</div>



<!-- Paid Field -->
<div class="col-sm-12">
    {!! Form::label('paid', __('models/cards.fields.paid').':') !!}
    <p>{{ $card->paid }}</p>
</div>

<!-- Category Id Field -->
<div class="col-sm-12">
    {!! Form::label('category_id', __('models/cards.fields.category_id').':') !!}
    <p>{{ $card->category_id }}</p>
</div>

<!-- Facebook Url Field -->
<div class="col-sm-12">
    {!! Form::label('facebook_url', __('models/cards.fields.facebook_url').':') !!}
    <p>{{ $card->facebook_url }}</p>
</div>

<!-- Twitter Url Field -->
<div class="col-sm-12">
    {!! Form::label('twitter_url', __('models/cards.fields.twitter_url').':') !!}
    <p>{{ $card->twitter_url }}</p>
</div>

<!-- Linkedin Url Field -->
<div class="col-sm-12">
    {!! Form::label('linkedin_url', __('models/cards.fields.linkedin_url').':') !!}
    <p>{{ $card->linkedin_url }}</p>
</div>

<!-- Company Ar Field -->
<div class="col-sm-12">
    {!! Form::label('company_ar', __('models/cards.fields.company_ar').':') !!}
    <p>{{ $card->company_ar }}</p>
</div>

<!-- Company En Field -->
<div class="col-sm-12">
    {!! Form::label('company_en', __('models/cards.fields.company_en').':') !!}
    <p>{{ $card->company_en }}</p>
</div>

<!-- Company Email Field -->
<div class="col-sm-12">
    {!! Form::label('company_email', __('models/cards.fields.company_email').':') !!}
    <p>{{ $card->company_email }}</p>
</div>

<!-- Instagram Url Field -->
<div class="col-sm-12">
    {!! Form::label('instagram_url', __('models/cards.fields.instagram_url').':') !!}
    <p>{{ $card->instagram_url }}</p>
</div>

<!-- Youtube Url Field -->
<div class="col-sm-12">
    {!! Form::label('youtube_url', __('models/cards.fields.youtube_url').':') !!}
    <p>{{ $card->youtube_url }}</p>
</div>

<!-- city Url Field -->
<div class="col-sm-12">
    {!! Form::label('city', __('models/cards.fields.city').':') !!}
    <p>{{ $card->city }}</p>
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


