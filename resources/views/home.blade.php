@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Display widgets for non-student users -->
    @if(!auth()->user()->hasRole('student'))
    <!-- Info boxes -->
    <div class="row">
        <!-- Total Users -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Users</span>
                    <span class="info-box-number">{{ $totalUsers }}</span>
                </div>
            </div>
        </div>

        <!-- Total Subjects -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Subjects</span>
                    <span class="info-box-number">{{ $totalSubjects }}</span>
                </div>
            </div>
        </div>

        <!-- Approved Cards -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Approved Cards</span>
                    <span class="info-box-number">{{ $approvedCardsCount }}</span>
                </div>
            </div>
        </div>

        <!-- Pending Requests -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-bell"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pending Requests</span>
                    <span class="info-box-number">{{ $requestsCount }}</span>
                </div>
            </div>
        </div>

        <!-- Expired Cards -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Expired Cards</span>
                    <span class="info-box-number">{{ $expiredCardsCount }}</span>
                </div>
            </div>
        </div>

        <!-- Total Cards -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-id-card"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Cards</span>
                    <span class="info-box-number">{{ $totalCardsCount }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <!-- Cards by Category -->
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cards by Category</h3>
                </div>
                <div class="card-body">
                    <canvas id="cardsByCategoryChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Cards by Semester -->
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cards by Semester</h3>
                </div>
                <div class="card-body">
                    <canvas id="cardsBySemesterChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Report Button -->
    <div class="row">
        <div class="col-md-12 text-center">
            <a href="{{ route('reports.export') }}" class="btn btn-primary">Generate Full Report</a>
        </div>
    </div>
    @endif

    <!-- Student-Specific View -->
    @if(auth()->user()->hasRole('student'))
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
                        <!-- Your card display logic here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

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
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
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
                label: 'Cards',
                data: semesterData,
                backgroundColor: '#36A2EB'
            }]
        },
        options: {
            responsive: true
        }
    });

    // Modal logic for student card display
    function showCard() {
        $('#idCardModal').modal('show');
    }
</script>
@endsection
