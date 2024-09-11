@extends('layouts.app')

@section('content')

<div class="container">
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

    .content {
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
<div class="text-center">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
    <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span style="background:#006ab3;"class="info-box-icon text-white elevation-1"><i class="fas fa-check"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">عدد البطاقات الفعالة</span>
                  <span class="info-box-number">
                    {{ $approvedCardsCount }}
                    <small></small>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span style="background:#006ab3;"class="info-box-icon text-white elevation-1"><i class="fas fas fa-bell"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">عدد طلبات البطاقات</span>
                  <span class="info-box-number">{{ $requestsCount }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span style="background:#006ab3;"class="info-box-icon text-white elevation-1"><i class="fas fas fa-calendar"></i></span>
                {{--  <i class="fa-solid fa-calendar-xmark"></i>  --}}
                <div class="info-box-content">
                  <span class="info-box-text">عدد البطاقات المنتهية الصلاحية</span>
                  <span class="info-box-number">{{ $expiredCardsCount }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span style="background:#006ab3;"class="info-box-icon text-white elevation-1"><i class="fas fa-users "></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">عدد جميع البطاقات</span>
                  <span class="info-box-number">{{ $totalCardsCount }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          {{--  <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Monthly Recap Report</h5>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <div class="btn-group">
                      <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-wrench"></i>
       
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <!-- /.card-body -->
          </div>  --}}
          <div class="card card-success">
            <div style="background:#006ab3;" class="card-header" >
              <h3 class="card-title">البطاقات لكل قسم</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.row -->
        </div>
      </section>
      @endif
</div>
@endsection

<!-- jQuery -->
@if(!auth()->user()->hasRole('student'))
@push('chart')

    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>

<!-- Page specific script -->

<script src="{{ asset("assets/plugins/jquery/jquery.min.js") }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset("assets/plugins/jquery-ui/jquery-ui.min.js") }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
       $.widget.bridge('uibutton', $.ui.button)

</script>

<!-- Bootstrap 4 -->
<script src="{{ asset("assets/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<!-- ChartJS -->
<script src="{{ asset("assets/plugins/chart.js/Chart.min.js") }}"></script>
<!-- Sparkline -->
<script src="{{ asset("assets/plugins/sparklines/sparkline.js") }}"></script>
<!-- JQVMap -->
<script src="{{ asset("assets/plugins/jqvmap/jquery.vmap.min.js") }}"></script>
<script src="{{ asset("assets/plugins/jqvmap/maps/jquery.vmap.usa.js") }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset("assets/plugins/jquery-knob/jquery.knob.min.js") }}"></script>
<!-- daterangepicker -->
<script src="{{ asset("assets/plugins/moment/moment.min.js") }}"></script>
<script src="{{ asset("assets/plugins/daterangepicker/daterangepicker.js") }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset("assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js") }}"></script>
<!-- Summernote -->
<script src="{{ asset("assets/plugins/summernote/summernote-bs4.min.js") }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset("assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("assets/dist/js/adminlte.js") }}"></script>
<script >

    $(function () {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */

      //--------------
      //- AREA CHART -
      //--------------

      // Get context with jQuery - using jQuery's .get() method.
        // var areaChartCanvas = $('#areaChart').get(0).getContext('2d')  
        console.log({!! json_encode($data) !!});
      var areaChartData = {
labels  : {!! json_encode($labels) !!},
        datasets: [
          {
            label               : 'members',
            backgroundColor     : '#006ab3',
            borderColor         : '#006ab3',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data:{!! json_encode($data) !!},
          }
        ]
      };

      var areaChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
          display: false
        },
        scales: {
          xAxes: [{
            gridLines : {
              display : false,
            },
            ticks: {
              display: false // this will remove the labels under the chart
            }
          }],
          yAxes: [{
            gridLines : {
              display : false,
            }
          }]
        }
      }

      // This will get the first returned node in the jQuery collection.
      {{--  new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: areaChartOptions
      })

      //-------------
      //- LINE CHART -
      //--------------
      var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
      var lineChartOptions = $.extend(true, {}, areaChartOptions)
      var lineChartData = $.extend(true, {}, areaChartData)
      lineChartData.datasets[0].fill = false;
      lineChartData.datasets[1].fill = false;
      lineChartOptions.datasetFill = false

      var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
      })  --}}

      {{--  //-------------
      //- DONUT CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      // var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
      // var donutData        = {
      //   labels:{!! json_encode($labels) !!},
      //   datasets: [
      //     {
      //       data: [700,500,600,300,100],
      //       backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
      //     }
      //   ]
      // }
      // var donutOptions     = {
      //   maintainAspectRatio : false,
      //   responsive : true,
      // }
      // //Create pie or douhnut chart
      // // You can switch between pie and douhnut using the method below.
      // new Chart(donutChartCanvas, {
      //   type: 'doughnut',
      //   data: donutData,
      //   options: donutOptions
      // })

      //-------------
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      var pieData        = donutData;
      var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
      })  --}}

      //-------------
      //- BAR CHART -
      //-------------
      var barChartCanvas = $('#barChart').get(0).getContext('2d')
      var barChartData = $.extend(true, {}, areaChartData)


      var barChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
          display: false
        },
        scales: {
          xAxes: [{
            gridLines : {
              display : true,
            },
            ticks: {
              display: false // this will remove the labels under the chart
            }
          }],
          yAxes: [{
            gridLines : {
              display : true,
            }
          }]
        },
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
      }

      new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      })

      //---------------------
      //- STACKED BAR CHART -
      //---------------------
      var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
      var stackedBarChartData = $.extend(true, {}, barChartData)

      var stackedBarChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        scales: {
          xAxes: [{
            stacked: true,
          }],
          yAxes: [{
            stacked: true
          }]
        }
      }

      new Chart(stackedBarChartCanvas, {
        type: 'bar',
        data: stackedBarChartData,
        options: stackedBarChartOptions
      })
    });
   
  </script>
@endpush
@else
@push('scripts')
<script>
    function showCard() {
        $('#idCardModal').modal('show');
    }
</script>
@endpush
@endif