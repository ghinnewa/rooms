@extends('layouts.app')

@section('content')

<style>
    body {
        color: #000;
    }

    /* تنسيق الجدول العام */
    .formal-exam-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 12pt;
    }

    .formal-exam-table th, .formal-exam-table td {
        border: 1px solid #7aaede;
        padding: 10px;
    }
    text-align: center;

    .thead-dark th {
        background-color: #7aaede;
        color: #fff;
    }

    /* تنسيق مخصص للطباعة */
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

        .form-group {
            display: none;
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
                <h1>جدول الامتحانات للسنة {{ $examSchedule->year }}</h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">
        <div class="card-body">
            <h4>تفاصيل جدول الامتحانات</h4>
            <p>السنة: {{ $examSchedule->year }}</p>

            <h4>الامتحانات المجدولة</h4>

            <!-- مربع البحث -->
            <div class="form-group">
                <input type="text" id="searchInput" class="form-control" onkeyup="filterTable()" placeholder="ابحث عن الامتحانات...">
            </div>

            <!-- عرض الجدول -->
            <table id="examScheduleTable" class="table table-bordered table-striped formal-exam-table">
                <thead class="thead-dark" style="background-color: #7aaede;">
                    <tr>
                        <th style="background-color: #7aaede;">اليوم</th>
                        <th style="background-color: #7aaede;">التاريخ</th>
                        <th style="background-color: #7aaede;">الفئة</th>
                        <th style="background-color: #7aaede;">المادة</th>
                        <th style="background-color: #7aaede;">الفصل الدراسي</th>
                        <th style="background-color: #7aaede;">وقت البداية</th>
                        <th style="background-color: #7aaede;">وقت النهاية</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($examScheduleItems as $item)
                        <tr>
                            <td>{{ date('l', strtotime($item->exam_date)) }}</td> <!-- يوم الأسبوع -->
                            <td>{{ date('d M Y', strtotime($item->exam_date)) }}</td> <!-- التاريخ بالتنسيق -->
                            <td>{{ $item->category->name_ar }}</td>
                            <td>{{ $item->subject->title }}</td>
                            <td>{{ $item->semester }}</td>
                            <td>{{ date('h:i A', strtotime($item->start_time)) }}</td> <!-- وقت البداية -->
                            <td>{{ date('h:i A', strtotime($item->end_time)) }}</td> <!-- وقت النهاية -->
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- زر الطباعة -->
            <button class="btn btn-primary no-print mt-6" onclick="printTable()">طباعة الجدول</button>
            <a href="{{ route('examSchedules.edit', $examSchedule->id) }}" class="btn btn-warning no-print m-2">تعديل الجدول</a>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    // وظيفة لتصفية الصفوف بناءً على البحث
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

    // وظيفة لطباعة الجدول
    function printTable() {
        window.print();
    }
</script>
@endpush
