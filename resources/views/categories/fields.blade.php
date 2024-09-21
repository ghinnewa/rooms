<!-- Name Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_ar', 'Name Ar:') !!}
    {!! Form::text('name_ar', isset($category) ? $category->name_ar : null, ['class' => 'form-control','maxlength' => 255]) !!}
</div>

<!-- Name En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_en', 'Name En:') !!}
    {!! Form::text('name_en', isset($category) ? $category->name_en : null, ['class' => 'form-control','maxlength' => 255]) !!}
</div>

<!-- Image Upload Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', __('models/cards.fields.image').':' ) !!} <br>
    {!! Form::label('image', 'Upload', ['class' => 'btn-primary btn btn-block ']) !!}
    {!! Form::file('image', ['style' => 'display:none;', 'id' => 'image', 'onchange' => 'previewImage(event)']) !!}


    <!-- Image preview, show only if editing an existing category -->
    @if(isset($categories) && !empty($categories->image))
        <img id="preview" src="{{  asset('storage/categories/'.$categories->image)}}" style="max-width: 100px;">
     
    @else
        <img id="preview" style="max-width: 100px; display: none;">
    @endif
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
