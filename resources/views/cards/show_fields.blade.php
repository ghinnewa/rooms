<!-- Profile Image -->
<div class="container col-sm-8 " dir="rtl" lang="ar">
    <div class="card card card-outline ">
        <div class="card-body box-profile " dir="rtl" lang="ar">


           
            <ul class="list-group  list-group-unbordered mb-3" dir="rtl">
                <li class="list-group-item" dir="rtl" lang="ar">
                <h3 class="profile-username text-right" dir="rtl" lang="ar">{{ $card->name_ar }}</h3>

                    <p class="text-muted text-right">{{ $card->name_en }}</p>

                </li>
                <li class="list-group-item" dir="rtl" lang="ar">
                <a class="float-left">{{ $card->membership_number }}</a>  
                <b  class="float-right">رقم القيد</b> 
                </li>
                <li class="list-group-item">
                    <b class="float-right">رقم الهاتف الأول</b> <a class="float-left">{{ $card->phone1 }}</a>
                </li>
              


                <li class="list-group-item">
                    <b class="float-right">البريد</b> <a class="float-left">{{ $card->user->email }}</a>
                </li>

                <li class="list-group-item">
                    <b class="float-right">المدينة</b> <a class="float-left">{{ $card->city }}</a>
                </li>
                <li class="list-group-item">
                    <b class="float-right"> التخصص</b>
                    <p class="float-left">{{ $card->category->name_ar }}/{{ $card->category->name_en }}</p>
                </li>
                <li class="list-group-item">
                    <b class="float-right"> الفصل</b>
                    </li>



            </ul>
            <br>




        </div>
        <!-- /.card-body -->

    </div>
</div>
<!-- /.card -->
<div class="container   col-sm-4 ">
    <div class="card  m1 ">
        <div class="card-header">
            <h3 class="card-title text-right float-right">التفاصيل</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body row ">
            <!-- <div class="col-sm-8">

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

           


        </div> -->
            <div class="card-body box-profile ">
                <div class="text-center pb-4 ">
                    <img class="profile-user-img  img-fluid img-circle" style="width:152px; height:152px;object-fit:cover;" src="{{ asset('storage/profile/' . $card->image) }}" alt="User profile picture">
                </div>
                <div class="text-center">
                    <p> <a class="pb-2 d-block" href="{{ route('attachments.downloadAttachment', ['qr-code', $card->qrcode]) }}" class="d-block"><img src="{{ asset('storage/qr-code/' . $card->qrcode) }}" style="width:100px; height:100px" class="" alt=""> </a></p>
                </div>
                <div class="d-flex item-center justify-content-center">
                    @if (!$card->paid)
                    <p class="badge bg-warning text-center"> pending </p>
                </div>

                @else
                @if ($card->expiration < Carbon\Carbon::now() &&$card->expiration!=null)
                    <p class="badge bg-danger text-center"> expired </p>
            </div>
            <h3 class="profile-username text-center">Exp:{{date('Y-m-d ',strtotime($card->expiration))  }}</h3>
            @else
            <p class="badge bg-success text-center"> active </p>
        </div>
        <h3 class="profile-username text-center">Exp:{{date('Y-m-d ',strtotime($card->expiration))  }}</h3>
        @endif

        @endif





        <a href="{{ route('attachments.downloadAttachment', ['identity_file2', $card->identity_file2]) }}" class="btn  btn-block btn-outline-primary"><b>اثبات الهوية </b></a>
        <a href="{{ route('attachments.downloadAttachment', ['identity_file2', $card->identity_file2]) }}" class="btn  btn-outline-primary btn-block"><b>اثبات الهوية2</b></a>
        <br>

        <button onclick="window.open('/card/{{ $card->id }}')" class="btn btn-primary btn-block"><b>طباعة</b></button>

        <div class="d-flex justify-content-center mt-3">
            <!-- Facebook -->
            @if ($card->facebook_url)
            <a class="btn btn-primary border-0 m-1" style="min-width:40px; background-color: #3b5998;" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>
            @endif

            <!-- Twitter -->
            @if ($card->twitter_url)
            <a class="btn btn-primary border-0 m-1" style="min-width:40px; background-color: #55acee;" href="#!" role="button"><i class="fab fa-twitter"></i></a>
            @endif



            <!-- Instagram -->
            @if ($card->instagram_url)
            <a class="btn btn-primary border-0 m-1" style="min-width:40px; background-color: #ac2bac;" href="#!" role="button"><i class="fab fa-instagram"></i></a>
            @endif

            <!-- Linkedin -->
            @if ($card->linkedin_url)
            <a class="btn btn-primary border-0 m-1" style="min-width:40px; background-color: #0082ca;" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
            @endif


            <!-- Youtube -->
            @if ($card->youtube_url)
            <a class="btn btn-primary border-0 m-1" style="min-width:40px; background-color: #ed302f;" href="#!" role="button"><i class="fab fa-youtube"></i></a>
            @endif

        </div>
    </div>
    <!-- /.card-body -->

</div>



<!-- /.card-body -->
</div>
</div>