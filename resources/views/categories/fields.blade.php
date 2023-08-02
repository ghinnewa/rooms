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
