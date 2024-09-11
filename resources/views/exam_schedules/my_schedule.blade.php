@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>{{ $examSchedule ? $examSchedule->year . ' Exam Schedule' : 'No Exam Schedule Available' }}</h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">
        <div class="card-body">
            @if($examSchedule && $examScheduleItems->isNotEmpty())
                <h4>My Scheduled Exams</h4>

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
                            <th>Subject</th>
                            <th>Semester</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($examScheduleItems as $item)
                            <tr>
                                <td>{{ date('l', strtotime($item->exam_date)) }}</td>
                                <td>{{ date('d M Y', strtotime($item->exam_date)) }}</td>
                                <td>{{ $item->subject->title }}</td>
                                <td>{{ $item->semester }}</td>
                                <td>{{ date('h:i A', strtotime($item->start_time)) }}</td>
                                <td>{{ date('h:i A', strtotime($item->end_time)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Print Button -->
                
            @else
                <div class="alert alert-info">
                    No exams are scheduled yet.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
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

    
</script>
@endpush
