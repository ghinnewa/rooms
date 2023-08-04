







<!-- Profile Image -->
<div class="container col-sm-4 ">
<div class="card card card-outline ">
    <div class="card-body box-profile ">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" style="width:152px; height:152px;object-fit:cover;"
                src="{{ asset('storage/profile/' . $card->image) }}" alt="User profile picture">
        </div>

        <h3 class="profile-username text-center">{{ $card->name_ar }}</h3>

        <p class="text-muted text-center">{{ $card->name_en }}</p>

        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>No.</b> <a class="float-right">{{ $card->membership_number }}</a>
            </li>
            <li class="list-group-item">
                <b>Phone 1</b> <a class="float-right">{{ $card->phone1 }}</a>
            </li>
            <li class="list-group-item">
                <b>Phone 2</b> <a class="float-right">{{ $card->phone2 }}</a>
            </li>


            <li class="list-group-item">
                <b>Email</b> <a class="float-right">{{ $card->email }}</a>
            </li>

            <li class="list-group-item">
                <b>City</b> <a class="float-right">{{ $card->city }}</a>
            </li>

        </ul>
<br>

            <button onclick="window.open('/card/{{ $card->id }}')"
            class="btn btn-primary btn-block"><b>Print</b></button>


    </div>
    <!-- /.card-body -->

</div>
</div>
<!-- /.card -->
<div class="container   col-sm-8 ">
<div class="card  m1 ">
    <div class="card-header">
        <h3 class="card-title">Details</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body row ">
        <div class="col-sm-8">

            {!! Form::label('job_title_ar', __('models/cards.fields.job_title_ar') . '') !!}
            <p>{{ $card->job_title_ar }}</p>

            <hr>
            {!! Form::label('job_title_ar', __('models/cards.fields.job_title_ar') . '') !!}
            <p>{{ $card->job_title_ar }}</p>
            <hr>

            {!! Form::label('company_ar', __('models/cards.fields.company_ar') . '') !!}
            <p>{{ $card->company_ar }}</p>

            <hr>
            {!! Form::label('company_en', __('models/cards.fields.company_en') . '') !!}
            <p>{{ $card->company_en }}</p>

            <hr>
            @if ($card->website)
                <strong><a href="{{ $card->website }}"><i class="fas fa-link mr-1"></i> Website<p></p></a></strong>



                <hr>
            @endif
            <strong>Company Email </strong>
            <p>{{ $card->company_email }}</p>

            <hr>
            {!! Form::label('Category', __('models/cards.fields.category_id') . '') !!}
            <p>{{ $card->category->name_ar }}/{{ $card->category->name_en }}</p>



        </div>
        <div class="card-body box-profile col-sm-4">
            <div class="text-center">
                <p> <a class="pb-2 d-block"
                        href="{{ route('attachments.downloadAttachment', ['qr-code', $card->qrcode]) }}"
                        class="d-block"><img src="{{ asset('storage/qr-code/' . $card->qrcode) }}"
                            style="width:100px; height:100px" class="" alt=""> </a></p>
            </div>
            <div class="d-flex item-center justify-content-center">
                @if (!$card->paid)
                    <p class="badge bg-warning text-center"> pending </p>
                @else
                    @if ($card->expiration < Carbon\Carbon::now())
                        <p class="badge bg-danger text-center"> expired </p>
                    @else
                        <p class="badge bg-success text-center"> active </p>
                    @endif
                @endif
            </div>
            <h3 class="profile-username text-center">Exp:{{date('Y-m-d ', strtotime($card->expiration))  }}</h3>



            <a href="{{ route('attachments.downloadAttachment', ['identity_file2', $card->identity_file2]) }}"
                class="btn  btn-block btn-outline-primary"><b>identity file 1</b></a>
            <a href="{{ route('attachments.downloadAttachment', ['identity_file2', $card->identity_file2]) }}"
                class="btn  btn-outline-primary btn-block"><b>identity file 2</b></a>

            @if ($card->paid)
                <a href="#" class="btn btn-primary btn-block"><b>Print</b></a>
            @endif
            <div class="d-flex justify-content-center mt-3">
                <!-- Facebook -->
                @if ($card->facebook_url)
                    <a class="btn btn-primary border-0 m-1" style="min-width:40px; background-color: #3b5998;"
                        href="#!" role="button"><i class="fab fa-facebook-f"></i></a>
                @endif

                <!-- Twitter -->
                @if ($card->twitter_url)
                    <a class="btn btn-primary border-0 m-1" style="min-width:40px; background-color: #55acee;"
                        href="#!" role="button"><i class="fab fa-twitter"></i></a>
                @endif



                <!-- Instagram -->
                @if ($card->instagram_url)
                    <a class="btn btn-primary border-0 m-1" style="min-width:40px; background-color: #ac2bac;"
                        href="#!" role="button"><i class="fab fa-instagram"></i></a>
                @endif

                <!-- Linkedin -->
                @if ($card->linkedin_url)
                    <a class="btn btn-primary border-0 m-1" style="min-width:40px; background-color: #0082ca;"
                        href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
                @endif


                <!-- Youtube -->
                @if ($card->youtube_url)
                    <a class="btn btn-primary border-0 m-1" style="min-width:40px; background-color: #ed302f;"
                        href="#!" role="button"><i class="fab fa-youtube"></i></a>
                @endif

            </div>
        </div>
        <!-- /.card-body -->

    </div>



    <!-- /.card-body -->
</div>
</div>
