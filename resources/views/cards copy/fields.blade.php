<!-- Name Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_ar', 'Name Ar:') !!}
    {!! Form::text('name_ar', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Name En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_en', 'Name En:') !!}
    {!! Form::text('name_en', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Job Title Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('job_title_ar', 'Job Title Ar:') !!}
    {!! Form::text('job_title_ar', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Job Title En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('job_title_en', 'Job Title En:') !!}
    {!! Form::text('job_title_en', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Membership Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('membership_number', 'Membership Number:') !!}
    {!! Form::text('membership_number', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Phone1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone1', 'Phone1:') !!}
    {!! Form::text('phone1', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Phone2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone2', 'Phone2:') !!}
    {!! Form::text('phone2', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Website Field -->
<div class="form-group col-sm-6">
    {!! Form::label('website', 'Website:') !!}
    {!! Form::text('website', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<style>
    #preview
    {
        max-width: 100px;
      //  display: none;
    }
</style>
<div class="form-group col-sm-6">
    {!! Form::label('image','profile image:') !!} <br>
    {!! Form::label('image','Upload' , ['class' => 'btn-primary btn btn-block ']) !!}
    {!! Form::file('image' ,['style'=>'display:none;','id'=>'image','onchange'=>'previewImage(event)']); !!}
    <img id="preview" src={{Route::is('services.edit')? asset('storage/images/'.$card->image) : ''}} >

</div>
@push('img')
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = "block";
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush


<!-- Paid Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('paid', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('paid', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('paid', 'Paid', ['class' => 'form-check-label']) !!}
    </div>
</div>
