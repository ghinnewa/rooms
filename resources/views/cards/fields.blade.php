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
<div class="form-group col-sm-6">
    {!! Form::label('membership_number', 'Membership Number:') !!}
    {!! Form::text('membership_number', null, ['class' => 'form-control']) !!}
    @if ($errors->has('membership_number'))
        <span class="text-danger">{{ $errors->first('membership_number') }}</span>
    @endif
</div>

<!-- National Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('national_number', 'National Number:') !!}
    {!! Form::text('national_number', null, ['class' => 'form-control']) !!}
    @if ($errors->has('national_number'))
        <span class="text-danger">{{ $errors->first('national_number') }}</span>
    @endif
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



<!-- Phone1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone1', __('models/cards.fields.phone1').':') !!}
    {!! Form::text('phone1', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>







<style>
    #preview {
        max-width: 100px;
         /* display: none; */
    }
   
    /* Custom Select2 Styles */
    .select2-container--bootstrap4 .select2-selection--single {
        height: calc(2.25rem + 2px); /* Match Bootstrap 4 input height */
        padding: .375rem .75rem; /* Add padding to match input fields */
        border: 1px solid #ced4da; /* Border like other inputs */
        border-radius: .25rem; /* Rounded borders */
    }

    .select2-container--bootstrap4 .select2-selection__rendered {
        font-size: 1rem; /* Match font size to inputs */
        color: #495057; /* Text color */
    }

    .select2-container--bootstrap4 .select2-selection__arrow {
        height: calc(2.25rem + 2px); /* Align arrow with the input */
    }
    .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: unset !important;
    /* user-select: none; */
    -webkit-user-select: none;
}
    /* Style the clear (x) button */
    .select2-container--bootstrap4 .select2-selection__clear {
        color: #dc3545; /* Make the clear button red */
        margin-right: 10px;
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
<!-- User Selection Field (only for admin/super admin | admin) -->
@hasanyrole('super admin|admin')
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/cards.fields.user_id').':') !!}
    {!! Form::select('user_id', $students, null, ['class' => 'form-control', 'id' => 'user-select']) !!}
    @if ($errors->has('user_id'))
        <span class="text-danger">{{ $errors->first('user_id') }}</span>
    @endif
</div>
@endhasanyrole


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
@push('scripts1')
<!-- Include Select2 CSS and JS from CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Apply Select2 to the user dropdown
        $('#user-select').select2({
    theme: 'bootstrap4', // Use Bootstrap 4 theme
    placeholder: 'Select a user',
    allowClear: true,
    width: '100%'
});
    });
</script>


@endpush





