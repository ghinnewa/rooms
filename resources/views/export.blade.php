@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detailed System Report</h1>

    <!-- Overview Section -->
    <h2>Overview</h2>
    <table class="table">
        <tr>
            <td>Total Users</td>
            <td>{{ $totalUsers }}</td>
        </tr>
        <tr>
            <td>Total Subjects</td>
            <td>{{ $totalSubjects }}</td>
        </tr>
        <tr>
            <td>Total Cards</td>
            <td>{{ $totalCardsCount }}</td>
        </tr>
        <tr>
            <td>Approved Cards</td>
            <td>{{ $approvedCardsCount }} ({{ number_format($approvedCardsPercentage, 2) }}%)</td>
        </tr>
        <tr>
            <td>Pending Requests</td>
            <td>{{ $pendingRequestsCount }}</td>
        </tr>
        <tr>
            <td>Expired Cards</td>
            <td>{{ $expiredCardsCount }}</td>
        </tr>
    </table>

    <!-- Users Breakdown by Role
    <h2>Users Breakdown by Role</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Role</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        
        </tbody>
    </table> -->

    <!-- Cards Breakdown by Category -->
    <h2>Cards Breakdown by Category</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Total Cards</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cardsByCategory as $category)
                <tr>
                    <td>{{ $category->category_id }}</td> <!-- You can replace this with the actual category name -->
                    <td>{{ $category->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Cards by Semester -->
    <h2>Cards by Semester</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Semester</th>
                <th>Total Cards</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cardsBySemester as $semester)
                <tr>
                    <td>Semester {{ $semester->semester }}</td>
                    <td>{{ $semester->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Option to Export as PDF -->
    <div class="text-center mt-4">
        <a href="{{ route('reports.export.pdf') }}" class="btn btn-primary">Download as PDF</a>
    </div>
</div>
@endsection
