@extends('layouts.app')

@section('content')

<style>
    .card-header{
        background-color: #4387c1 !important;
    }
    
</style>
<style>
    body {
    direction: rtl;
    text-align: right;
    
}
.card-header {
    text-align: right !important;
    padding-right: 1rem !important;
    padding-left: 20px !important;
    display: flex;
}
.info-box-content {
    text-align: right;
}
canvas {
    height: 350px !important;
}

.card-title {
    text-align: right;
}

.modal-title, .modal-footer button {
    text-align: right;
}

</style>



@if(auth()->user()->hasRole('student'))

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap');

    body {
        font-family: 'Cairo', sans-serif;
    }

    .profile {
        margin: 0.05in;
        height: 1in;
        width: 1in;
        border: 1px solid #006ab3;
        border-radius: 10%;
    }

    .qr {
        margin: 0.05in;
        border: 1px solid #006ab3;
        border-radius: 10%;
        height: 1in;
        width: 1in;
        padding: 0.02in;
    }

    b {
        color: #006ab3;
        font-size: 1.5rem;
        line-height: 1.2;
    }

    .head {
        display: inline-block;
        margin-bottom: .5rem;
        margin-top: .4rem;
        width: 100%;
    }

    .number {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
        font-weight: 400;
        height: 0.3in;
        border-top: solid 0.01in #006ab3;
        border-bottom: solid 0.01in #006ab3;
    }

    .number p {
        padding: 5px;
    }

    .number img {
        height: 20px;
        width: 20px;
    }

    .textt {
        padding: 0;
        width: 60%;
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

    .content1 {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        padding: 0;
        margin: 0;
        width: 100%;
        height: 100%;
        background-image: url('{{ asset('back1-01-01-01.jpg') }}');
        background-size: cover;
        background-position: left;
        background-repeat: no-repeat;
    }

    .modal-body {
        padding: 0;
        margin: 0;
        width: 100%;
        height: 100%;
    }

    @media (max-width: 768px) {
        .modal-dialog {
            max-width: 100vw;
            margin: 0;
        }

        .modal-content {
            height: 100vh;
            border-radius: 0;
        }

        .profile, .qr {
            height: 1.5in;
            width: 1.5in;
        }

        b {
            font-size: 2rem;
        }

        .number {
            font-size: 14px;
            height: 0.4in;
        }

        .number img {
            height: 25px;
            width: 25px;
        }
    }
</style>
@endpush
@endif
    <!-- Display widgets for non-student users -->
    <div class="container-fluid" dir="rtl">
    @if(!auth()->user()->hasRole('student'))
    <!-- Info boxes -->
    <div class="row">
        <!-- Total Users -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon elevation-1" style="background-color: #B9D9EB;"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">إجمالي المستخدمين</span>
                    <span class="info-box-number">{{ $totalUsers }}</span>
                </div>
            </div>
        </div>

        <!-- Total Subjects -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon elevation-1" style="background-color: #B9D9EB;"><i class="fas fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">إجمالي المواد</span>
                    <span class="info-box-number">{{ $totalSubjects }}</span>
                </div>
            </div>
        </div>

        <!-- Approved Cards -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon elevation-1" style="background-color: #B9D9EB;"><i class="fas fa-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">البطاقات المعتمدة</span>
                    <span class="info-box-number">{{ $approvedCardsCount }}</span>
                </div>
            </div>
        </div>

        <!-- Pending Requests -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon elevation-1" style="background-color: #B9D9EB;"><i class="fas fa-bell"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">طلبات قيد الانتظار</span>
                    <span class="info-box-number">{{ $requestsCount }}</span>
                </div>
            </div>
        </div>

        <!-- Expired Cards -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon elevation-1" style="background-color: #B9D9EB;"><i class="fas fa-times-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">البطاقات المنتهية</span>
                    <span class="info-box-number">{{ $expiredCardsCount }}</span>
                </div>
            </div>
        </div>

        <!-- Total Cards -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon elevation-1" style="background-color: #B9D9EB;"><i class="fas fa-id-card"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">إجمالي البطاقات</span>
                    <span class="info-box-number">{{ $totalCardsCount }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <!-- Cards by Category -->
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">البطاقات حسب الفئة</h3>
                </div>
                <div class="card-body">
                    <canvas id="cardsByCategoryChart"style="height:300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Cards by Semester -->
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">البطاقات حسب الفصل الدراسي</h3>
                </div>
                <div class="card-body">
                    <canvas id="cardsBySemesterChart"style="height:400px;"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

    <!-- Student-Specific View -->
    @if(auth()->user()->hasRole('student'))
    <div class="text-center" style="display:flex; flex-direction : column; align-items:center;justify-content:center">
    <img src="{{ asset('assets/88.png') }}" alt="" width="350px">
        <button id="showIdCard" class="btn btn-primary" onclick="showCard()">عرض بطاقتي</button>
    </div>
    <!-- Modal for displaying the ID card -->
    <div id="idCardModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
           
            <div class="modal-content">
                <div class="modal-header">
               
                    <h5 class="modal-title">بطاقتي</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Card Display -->
                    <div class="content ">
                    <div class="content1 ">
                            <div class="textt">
                                <span class="head">
                                    <b>{{ $card->name_ar }}</b>

                                    <br />
                                    <span style="color:rgb(99, 99, 99); font-style: italic;font-size:8px;">
                                        {{ $card->category->name_ar }}
                                    </span>

                                    <br />
                                    {{ $card->company_ar }}
                                </span>

                                <span class="number">

                                    <img src="{{ asset('glucc.png') }}" style="object-fit:cover;" class="img-fluid " alt="">
                                    <p dir="rtl">رقم القيــــــــد </p>
                                    <p>{{ $card->membership_number }}</p>
                                    <p>.Membership No</p>
                                    <img src="{{ asset('glucc.png') }}" style="object-fit:cover;" class="img-fluid " alt="">
                                </span>

                                <span class="head" dir="ltr">

                                    <b>{{ $card->name_en }}</b>
                                    <br />
                                    <span style="color:rgb(99, 99, 99); font-style: italic;font-size:9px;">
                                        {{ $card->category->name_en }}
                                    </span>

                                    <br />
                                    {{ $card->company_en }}

                                </span>

                            </div>
                            <div class="images">
                                <img src="{{ asset('storage/profile/' . $card->image) }}" style="object-fit:cover;" class="img-fluid profile" alt="">
                                <img src="{{ asset('storage/qr-code/' . $card->qrcode) }}" style="object-fit:cover;" class="img-fluid qr" alt="">
                            </div>
                        </div>
                        <!-- Your card display logic here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button " class="btn btn-primary  bg-primary" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@role('admin|super admin')
<!-- Include Chart.js for displaying charts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data for Cards by Category
    var categoryLabels = @json($labels);
    var categoryData = @json($data);

    // Data for Cards by Semester
    var semesterLabels = @json($cardsBySemester->pluck('semester'));
    var semesterData = @json($cardsBySemester->pluck('total'));

    // Render Pie Chart for Cards by Category
    var ctxCategory = document.getElementById('cardsByCategoryChart').getContext('2d');
    var cardsByCategoryChart = new Chart(ctxCategory, {
        type: 'pie',
        data: {
            labels: categoryLabels,
            datasets: [{
                data: categoryData,
                backgroundColor: ['#7aaede', '#36A2EB', '#FFCE56', '#4BC0C0']
            }]
        },
        options: {
            responsive: true
        }
    });

    // Render Bar Chart for Cards by Semester
    var ctxSemester = document.getElementById('cardsBySemesterChart').getContext('2d');
    var cardsBySemesterChart = new Chart(ctxSemester, {
        type: 'bar',
        data: {
            labels: semesterLabels,
            datasets: [{
                label: 'البطاقات',
                data: semesterData,
                backgroundColor: '#7aaede'
            }]
        },
        options: {
            responsive: true
        }
    });

    
    
    </script>
    @endrole
    
    <script>
    // Modal logic for student card display
    function showCard() {
        $('#idCardModal').modal('show');
    }
</script>

@endsection
