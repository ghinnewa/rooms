@extends('layouts.app')

@section('content')

<style>
    body {
        /* font-family: 'Times New Roman', Times, serif; */
        color: #000;
    }

    /* General Table Styling */
    .formal-exam-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 12pt;
    }

    .formal-exam-table th, .formal-exam-table td {
        border: 1px solid #000;
        padding: 10px;
        text-align: center;
    }

    .thead-dark th {
        background-color: #343a40;
        color: #fff;
    }

    /* Print-specific Styling */
    @media print {
        .navbar, .btn, .footer, .sidebar, .no-print {
            display: none !important;
        }

        .content-wrapper {
            margin: 0;
            padding: 0;
        }

        h1, h2, h3, h4 {
            margin: 0;
            padding: 0;
            text-align: center;
            font-weight: bold;
        }

        .formal-exam-table {
            margin-top: 40px;
            width: 100%;
            border-collapse: collapse;
            font-size: 12pt;
            page-break-inside: avoid;
        }

        .formal-exam-table th, .formal-exam-table td {
            border: 1px solid #000;
            padding: 12px;
        }

        .page-break {
            page-break-before: always;
        }

        @page {
            margin: 20mm;
        }
    }
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>{{ $examSchedule->year }} Exam Schedule</h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">
        <div class="card-body">
            <h4>Exam Schedule Details</h4>
            <p>Year: {{ $examSchedule->year }}</p>

            <h4>Scheduled Exams</h4>

            <!-- Search Filter -->
            <div class="form-group">
                <input type="text" id="searchInput" class="form-control" onkeyup="filterTable()" placeholder="Search for exams...">
            </div>

            <!-- Table Display -->
            <table id="examScheduleTable" class="table table-bordered table-striped formal-exam-table">
                <thead class="thead-dark">
                    <tr>
                        <th>Day</th>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Subject</th>
                        <th>Semester</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($examScheduleItems as $item)
                        <tr>
                            <td>{{ date('l', strtotime($item->exam_date)) }}</td> <!-- Day of the week -->
                            <td>{{ date('d M Y', strtotime($item->exam_date)) }}</td> <!-- Formatted date -->
                            <td>{{ $item->category->name_en }}</td>
                            <td>{{ $item->subject->title }}</td>
                            <td>{{ $item->semester }}</td>
                            <td>{{ date('h:i A', strtotime($item->start_time)) }}</td> <!-- Formatted start time -->
                            <td>{{ date('h:i A', strtotime($item->end_time)) }}</td> <!-- Formatted end time -->
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Print Button -->
            <button class="btn btn-primary no-print mt-6 " onclick="printTable()">Print Schedule</button>
            <a href="{{ route('examSchedules.edit', $examSchedule->id) }}" class="btn btn-warning no-print m-2">Edit Schedule</a>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    // Function to filter table rows based on search input
    function filterTable() {
        let input = document.getElementById('searchInput');
        let filter = input.value.toLowerCase();
        let table = document.getElementById('examScheduleTable');
        let tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) {
            let td = tr[i].getElementsByTagName('td');
            let match = false;
            for (let j = 0; j < td.length; j++) {
                if (td[j].innerHTML.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }
            tr[i].style.display = match ? "" : "none";
        }
    }

    // Function to print the table
    function printTable() {
        window.print();
    }
</script>
@endpush
