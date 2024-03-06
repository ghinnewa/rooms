<!-- Name Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_ar', __('models/cards.fields.name_ar').':') !!}
    {!! Form::text('name_ar', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Name En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_en', __('models/cards.fields.name_en').':') !!}
    {!! Form::text('name_en', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Job Title Ar Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('job_title_ar', __('models/cards.fields.job_title_ar').':') !!}
    {!! Form::text('job_title_ar', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div> -->

<!-- Job Title En Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('job_title_en', __('models/cards.fields.job_title_en').':') !!}
    {!! Form::text('job_title_en', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div> -->
    {!! Form::hidden('membership_number', '0000000') !!}


<!-- Phone1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone1', __('models/cards.fields.phone1').':') !!}
    {!! Form::text('phone1', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Phone2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone2', __('models/cards.fields.phone2').':') !!}
    {!! Form::text('phone2', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('models/cards.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Website Field -->
<div class="form-group col-sm-6">
    {!! Form::label('website', __('models/cards.fields.website').':') !!}
    {!! Form::text('website', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>



<style>
    #preview {
        max-width: 100px;
        //  display: none;
    }
</style>
<div class="form-group col-sm-6">
    {!! Form::label('image',__('models/cards.fields.image').':' ) !!} <br>
    {!! Form::label('image', 'Upload', ['class' => 'btn-primary btn btn-block ']) !!}
    {!! Form::file('image', ['style' => 'display:none;', 'id' => 'image', 'onchange' => 'previewImage(event)']) !!}
    <img id="preview" src={{ Route::is('cards.edit') ? asset('storage/profile/' . $card->image) : '' }}>

</div>
@push('img')
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = "block";
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endpush



<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', __('models/cards.fields.category_id').':') !!}
    {!! Form::select('category_id', $categories,null,['class' => 'form-control']) !!}
</div>
<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city', __('models/cards.fields.city').':') !!}
    {!! Form::select('city', $cities,null,['class' => 'form-control']) !!}
</div>

<!-- Company En Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('company_en', __('models/cards.fields.company_en').':') !!}
    {!! Form::text('company_en', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div> -->
<!-- Company En Field -->
<!-- <div class="form-group col-sm-6">

    {!! Form::label('company_ar', __('models/cards.fields.company_ar').':') !!}
    {!! Form::text('company_ar', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}

</div> -->

<!-- Company Email Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('company_email', __('models/cards.fields.company_email').':') !!}
    {!! Form::text('company_email', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div> -->
<!-- Company Email Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('expiration', __('models/cards.fields.expiration').':') !!}
    {!! Form::date('expiration', Route::is('cards.edit') ?  $card->expiration: null  , ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div> -->





<div class="form-group col-sm-6">
    {!! Form::label('identity_file1', __('models/cards.fields.identity_file1').':') !!}
    {!! Form::label('identity_file1', 'Upload', ['class' => 'btn-primary btn btn-block ']) !!}
    {!! Form::file('identity_file1', ['style' => 'display:none;', 'id' => 'identity_file1', 'onchange' => 'fileName1(event)']) !!}
    <span id="filename" >{{ Route::is('cards.edit') ?  $card->identity_file1: '' }} </span>

</div>
@push('filename1')
<script>
    function fileName1(event) {
        var reader = new FileReader();
        reader.onload = function() {

            var output = document.getElementById('filename');
            output.textContent = event.target.files[0].name;
            output.style.display = "block";
        }
        reader.readAsDataURL(event.target.files[0]);

    }
</script>
@endpush

<div class="form-group col-sm-6">
    {!! Form::label('identity_file2', __('models/cards.fields.identity_file2').':') !!}
    {!! Form::label('identity_file2', 'Upload', ['class' => 'btn-primary btn btn-block ']) !!}
    {!! Form::file('identity_file2', ['style' => 'display:none;', 'id' => 'identity_file2', 'onchange' => 'fileName2(event)']) !!}
    <span id="filename2" >{{ Route::is('cards.edit') ?  $card->identity_file1: '' }} </span>

</div>

<!-- Facebook Url Field -->
<div class="form-group col-sm-6">

    {!! Form::label('facebook_url', __('models/cards.fields.Social_media').':') !!}

    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width : 50px; justify-content:center; "> <i class="fa fa-facebook-f"></i></span>
        </div>
        {!! Form::text('facebook_url', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width : 50px; justify-content:center; "> <i class="fa fa-twitter"></i></span>
        </div>
        {!! Form::text('twitter_url', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width : 50px; justify-content:center; "> <i class="fa fa-linkedin"></i></span>
        </div>
        {!! Form::text('linkedin_url', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="width : 50px; justify-content:center; "> <i class="fa fa-instagram"></i></span>
        </div>
        {!! Form::text('instagram_url', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div>
    <!-- <div class="input-group mb-3">
        <div class="input-group-prepend ">
          <span class="input-group-text " style="width : 50px; justify-content:center; "> <i  class="fa fa-youtube"></i></span>
        </div>
        {!! Form::text('youtube_url', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div> -->


</div>
@push('filename2')
    <script>
        function fileName2(event) {
            var reader = new FileReader();
            reader.onload = function() {

                var output = document.getElementById('filename2');
                output.textContent = event.target.files[0].name;
                output.style.display = "block";
            }
            reader.readAsDataURL(event.target.files[0]);

        }
    </script>
@endpush






