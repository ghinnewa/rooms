<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Cards</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap');
    </style>
    <style>
        @page {
            size: 3.5in 2in;
            marks: crop;
            bleed: 0.125in;
            margin: 0in;
        }

        body {
            line-height: 1.2;
            width: 3.5in;
            direction: rtl;
            font-family: Cairo;
            font-size: 8pt;
            box-sizing: 0;
            margin: 0;
        }

        .profile {
            margin: 0.05in;
            height: 0.75in;
            width: 0.75in;
            border: 1px solid #006ab3;
            border-radius: 10%;
        }

        .qr {
            margin: 0.05in;
            border: 1px solid #006ab3;
            border-radius: 10%;
            height: 0.71in;
            width: 0.71in;
            padding: 0.02in;
        }

        b {
            color: #006ab3;
            font-size: 1rem;
            line-height: 20px;
        }

        .head {
            display: inline-block;
            margin-bottom: .5rem;
            margin-top: .4rem;
            width: 100%;
        }

        .break {
            page-break-after: always;
        }

        .content {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            padding: 0;
            margin: 0;
            width: 3.5in;
            height: 2in;
            background-image: url('{{ asset('back1-01-01-01.jpg') }} ');
            background-size: cover;
            background-position: left;
            background-repeat: no-repeat;
        }

        .textt {
            padding: 0;
            width: 60%;
        }

        .number {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 7px;
            font-weight: 400;
            height: 0.2in;
            border-top: solid 0.01in #006ab3;
            border-bottom: solid 0.01in #006ab3;
        }

        .number p {
            padding: 5px;
        }

        .number img {
            height: 15px;
            width: 15px;
        }

        .images {
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>

    @foreach($cards as $card)
    <div class="content">
        <div class="textt">
            <span class="head">
                <b>{{ $card->name_ar }}</b>
                <br />
                <span style="color:rgb(99, 99, 99); font-style: italic;font-size:8px;">{{ $card->category->name_ar }}</span>
                <br />
                {{ $card->company_ar }}
            </span>

            <span class="number">
                <img src="{{ asset('glucc.png') }}" style="object-fit:cover;" class="img-fluid" alt="">
                <p dir="rtl">رقم القيــــــــد </p>
                <p>{{ $card->membership_number }}</p>
                <p>.Membership No</p>
                <img src="{{ asset('glucc.png') }}" style="object-fit:cover;" class="img-fluid" alt="">
            </span>

            <span class="head" dir="ltr">
                <b>{{ $card->name_en }}</b>
                <br />
                <span style="color:rgb(99, 99, 99); font-style: italic;font-size:9px;">{{$card->category->name_en }}</span>
                <br />
                {{ $card->company_en }}
            </span>
        </div>
        <div class="images">
            <img src="{{ asset('storage/profile/' . $card->image) }}" style="object-fit:cover;" class="img-fluid profile" alt="">
            <img src="{{ asset('storage/qr-code/' . $card->qrcode) }}" style="object-fit:cover;" class="img-fluid qr" alt="">
        </div>
    </div>

    <div class="break"></div> <!-- Ensure each card starts on a new page -->
    @endforeach

    <script>
        window.onload = function() {
            window.print();
            window.onafterprint = function() {
                window.close();
            };
        };
    </script>

</body>

</html>
