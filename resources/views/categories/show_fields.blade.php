
<div class="col-sm-12">
    <p><img src="{{ asset('storage/categories/'.$categories->image) }}" style="width:150px; height:150px;object-fit:cover;" class="rounded-circle" alt=""></p>
</div>
<!-- Name Ar Field -->
<div class="col-sm-12">
    {!! Form::label('name_ar', 'الاسم بالعربي') !!}
    <p>{{ $categories->name_ar }}</p>
</div>

<!-- Name En Field -->
<div class="col-sm-12">
    {!! Form::label('name_en', 'الاسم بالإنجليزي') !!}
    <p>{{ $categories->name_en }}</p>
</div>

