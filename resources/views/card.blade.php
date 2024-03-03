<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{--  <script src="https://unpkg.com/pagedjs/dist/paged.polyfill.js"></script>  --}}
    {{--  <link href="path/to/file/interface.css" rel="stylesheet" type="text/css" />  --}}
    {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-toggle/3.6.1/bootstrap4-toggle.min.css"
        integrity="sha512-EzrsULyNzUc4xnMaqTrB4EpGvudqpetxG/WNjCpG6ZyyAGxeB6OBF9o246+mwx3l/9Cn838iLIcrxpPHTiygAA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css"
        integrity="sha512-mxrUXSjrxl8vm5GwafxcqTrEwO1/oBNU25l20GODsysHReZo4uhVISzAKzaABH6/tTfAxZrY2FprmeAP5UZY8A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
        integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg=="
        crossorigin="anonymous" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw=="
        crossorigin="anonymous" />  --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap');
    </style>
    <style>
        @page {
            size: 3.5in 2in;
            marks: crop;
            bleed: 0.125in;
            margin: 0in;
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
            {{--  padding: 0.1in;  --}}

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
            break-after: always;
        }

        .first-page {

            display: block;
            page-break-after: always;
            background: rgb(188, 11, 6);
            background: radial-gradient(circle, rgba(89, 89, 91, 1) 0%, rgba(0, 106, 179, 1) 100%);
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            height: 2in;
            width: 3.5in;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;


        }

        .number {
            display: flex;
            justify-content: space-between;
            align-items: center;
             font-size: 7px;
            font-weight: 400;
            height:0.2in;
            border-top: solid 0.01in #006ab3;
            border-bottom: solid 0.01in #006ab3;
        }

        .number p {
            padding: 5px;
        }
        .number img {
        height: 15px;
        wedith: 15px;
        }

        .textt {
            padding: 0;
            {{--  margin-right: 0.5in;  --}}
            {{--  border: 1px solid #006ab3;  --}}
            width: 60%;

        }

        .images {
            padding: 0;
            margin: 0;
            {{--  border: 1px solid #006ab3;  --}}
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height:100%;
        }

        .content {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            padding: 0;
            margin: 0;
            width: 3.5in;
            height: 2in;
            background-image: url('{{ asset('cardback1.png') }} ');
            background-size: cover;
            background-repeat: no-repeat;


        }

        .logo {
            width: 60%;
            height: 60%;

        }

        .exp {
            padding: 10px;
            color: white;
            font-weight: 500;

        }

        @media print {
            .first-page {
                display: block;
                page-break-after: always;
                background: rgb(188, 11, 6);
                background: radial-gradient(circle, rgba(89, 89, 91, 1) 0%, rgba(0, 106, 179, 1) 100%);
                background-position: center;
                background-repeat: no-repeat;
                margin: 0;
                padding: 0;
                height: 100vh;
                width: 100vw;
                display: flex;
                flex-direction: column;
                justify-content: space-around;
                align-items: center;

            }

            .logo {
                width: 60%;
                height: 60%;

            }


            .exp {
                padding: 2px;
                color: white;
                font-weight: 500;
                font-size: 7px;

            }


        }
    </style>
    {{--  <div class="first-page">
        <img class="logo" src="{{ asset('Glucc_logo4.svg') }}" alt="Logo">

    </div>  --}}

    <div class="content ">
        <div class="textt">
            <span class="head">
                <b>{{ $card->name_ar }}</b>

                <br />
                <span style="color:rgb(99, 99, 99); font-style: italic;font-size:8px;">{{ $card->job_title_ar }}</span>

                <br />
                {{ $card->company_ar }}
            </span>

            <span class="number">

                <img src="{{ asset('glucc.png') }}" style=" object-fit:cover;"
                class="img-fluid " alt="">
                <p dir="rtl">رقم العضويــــــة </p>
                <p>{{ $card->membership_number }}</p>
                <p>.Membership No</p>
                <img src="{{ asset('glucc.png') }}" style=" object-fit:cover;"
                class="img-fluid " alt="">
            </span>

            <span class="head" dir="ltr">

                <b>{{ $card->name_en }}</b>
                <br />
                <span style="color:rgb(99, 99, 99); font-style: italic;font-size:9px;">{{ $card->job_title_en }}</span>

                <br />
                {{ $card->company_en }}



            </span>

        </div>
        <div class="images">
            <img src="{{ asset('storage/profile/' . $card->image) }}" style=" object-fit:cover;"
                class="img-fluid profile" alt="">
            <img src="{{ asset('storage/qr-code/' . $card->qrcode) }}" style=" object-fit:cover;"
                class="img-fluid qr" alt="">
        </div>
    </div>


    <script>
        window.onload = function() {
            var arabicCompany = document.querySelector('.boxy:nth-child(2) div:nth-child(1)');
            var englishCompany = document.querySelector('.boxy:nth-child(2) div:nth-child(2)');
            var arabicCompanyHeight = arabicCompany.offsetHeight;
            var arabicCompanyLineHeight = parseFloat(window.getComputedStyle(arabicCompany, null).getPropertyValue(
                'line-height'));
            var englishCompanyHeight = englishCompany.offsetHeight;
            var englishCompanyLineHeight = parseFloat(window.getComputedStyle(englishCompany, null).getPropertyValue(
                'line-height'));

            if (arabicCompanyHeight > arabicCompanyLineHeight) {
                arabicCompany.style.textAlign = 'right';
            } else {
                arabicCompany.style.textAlign = 'center';
            }

            if (englishCompanyHeight > englishCompanyLineHeight) {
                englishCompany.style.textAlign = 'left';
            } else {
                englishCompany.style.textAlign = 'center';
            }
            var arabicName = document.querySelector('.name .head:nth-child(1) b');
            var englishName = document.querySelector('.name .head:nth-child(2) b');
            var arabicNameWidth = arabicName.offsetWidth;
            var englishNameWidth = englishName.offsetWidth;
            var englishNameFontSize = parseFloat(window.getComputedStyle(englishName, null).getPropertyValue(
                'font-size'));

            while (englishNameWidth < arabicNameWidth && englishNameFontSize < 50) {
                englishNameFontSize += 0.5;
                englishName.style.fontSize = englishNameFontSize + 'px';
                englishNameWidth = englishName.offsetWidth;
            }

            while (englishNameWidth > arabicNameWidth && englishNameFontSize > 5) {
                englishNameFontSize -= 0.5;
                englishName.style.fontSize = englishNameFontSize + 'px';
                englishNameWidth = englishName.offsetWidth;
            }
            window.print();
            window.onafterprint = function() {
                window.close();
            }
        }
    </script>

</body>

</html>
