<!-- Name Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_ar', 'Name Ar:') !!}
    {!! Form::text('name_ar', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Name En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_en', 'Name En:') !!}
    {!! Form::text('name_en', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Job Title Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('job_title_ar', 'Job Title Ar:') !!}
    {!! Form::text('job_title_ar', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Job Title En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('job_title_en', 'Job Title En:') !!}
    {!! Form::text('job_title_en', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>
    {!! Form::hidden('membership_number', '0000000') !!}


<!-- Phone1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone1', 'Phone1:') !!}
    {!! Form::text('phone1', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Phone2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone2', 'Phone2:') !!}
    {!! Form::text('phone2', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Website Field -->
<div class="form-group col-sm-6">
    {!! Form::label('website', 'Website:') !!}
    {!! Form::text('website', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>



<style>
    #preview {
        max-width: 100px;
        //  display: none;
    }
</style>
<div class="form-group col-sm-6">
    {!! Form::label('image', 'profile image:') !!} <br>
    {!! Form::label('image', 'Upload', ['class' => 'btn-primary btn btn-block ']) !!}
    {!! Form::file('image', ['style' => 'display:none;', 'id' => 'image', 'onchange' => 'previewImage(event)']) !!}
    <img id="preview" src={{ Route::is('cards.edit') ? asset('storage/images/' . $card->image) : '' }}>

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
    {!! Form::label('category_id', __('models/facilities.fields.category_id').':') !!}
    {!! Form::select('category_id', $categories,null,['class' => 'form-control']) !!}
</div>

<!-- Facebook Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('facebook_url', 'Facebook Url:') !!}
    {!! Form::text('facebook_url', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Twitter Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('twitter_url', 'Twitter Url:') !!}
    {!! Form::text('twitter_url', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Linkedin Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('linkedin_url', 'Linkedin Url:') !!}
    {!! Form::text('linkedin_url', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Company Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('company_ar', 'Company Ar:') !!}
    {!! Form::text('company_ar', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Company En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('company_en', 'Company En:') !!}
    {!! Form::text('company_en', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Company Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('company_email', 'Company Email:') !!}
    {!! Form::text('company_email', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Instagram Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('instagram_url', 'Instagram Url:') !!}
    {!! Form::text('instagram_url', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Youtube Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('youtube_url', 'Youtube Url:') !!}
    {!! Form::text('youtube_url', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('identity_file1', 'profile identity_file1:') !!} <br>
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
    {!! Form::label('identity_file2', 'profile identity_file2:') !!} <br>
    {!! Form::label('identity_file2', 'Upload', ['class' => 'btn-primary btn btn-block ']) !!}
    {!! Form::file('identity_file2', ['style' => 'display:none;', 'id' => 'identity_file2', 'onchange' => 'fileName2(event)']) !!}
    <span id="filename2" >{{ Route::is('cards.edit') ?  $card->identity_file1: '' }} </span>

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

 {!! Form::hidden('paid', 0) !!}


