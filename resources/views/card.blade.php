<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/69393ee716.js" crossorigin="anonymous"></script>

</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Almarai:wght@300;700;800&display=swap');
</style>
<style>
    body {
        box-sizing: none;
        padding: 0;
        margin: 0;
        font-family: Almarai, sans-serif;
    }

    .card {
        width: 90%;
        height: 90%;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
        display: flex;
        justify-content: space-around;
        align-items: center;


    }

    .container {
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<body>

    <div class="container " >

        <div class=" card">

@if(!empty($card))
@if($card->paid)
            <div class="content" style="text-align: center;">

                {{--  {!! Form::label('name_ar', 'Name Ar:') !!}  --}}
                <h1>{{ $card->name_ar }}</h1>
                <h3>{{ $card->job_title_ar }}</h3>

                <h1>{{ $card->name_en }}</h1>
                <h3>{{ $card->job_title_en }}</h3>

                {{--  {!! Form::label('membership_number', 'Membership Number:') !!}  --}}
                <h4>mimber ship No. : {{ $card->membership_number }} :رقم العضوية </h4>

                {{--  {!! Form::label('phone1', 'Phone1:') !!}  --}}
                <p> {{ $card->phone1 }}<i class="fa fa-solid fa-phone"></i>
                </p>

                {{--  {!! Form::label('phone2', 'Phone2:') !!}  --}}
                <p>{{ $card->phone2 }}<i class="fa fa-solid fa-phone"></i>
                </p>

                {{--  {!! Form::label('email', 'Email:') !!}  --}}
                <p>{{ $card->email }}</p>
                {{--  {!! Form::label('website', 'Website:') !!}  --}}
                <p>{{ $card->website }}</p>



            </div>
            <div class="images">

                <!-- Image Field -->

                {{--  {!! Form::label('image', 'Image:') !!}  --}}
                <p><img src="{{ asset('storage/profile/' . $card->image) }}"
                        style="width:350px; height:400px; object-fit:cover;" class="img-fluid" alt=""></p>
            </div>
@else

<div> <h1> هذا العضو ليس مسجلا رسميا ضمن قائمة الاعضاء </h1></div>
@endif
@else
<div> <h1>هذا العضو غير موجود  </h1></div>
@endif
        </div>
    </div>

</body>

</html>
