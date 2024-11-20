@extends('layout')
@section('title', 'Reports Dashboard')

@section('content')
<div class="nk-content nk-content-fluid">
    <!-- Main Container for Reports -->
    <div class="container-fluid">

        <!-- Dashboard Header -->
        <div class="nk-content-head">
            <h2 class="nk-title">Reports Dashboard</h2>
        </div>

        <!-- Events Status Pie Chart -->
        <div class="card card-bordered">
            <div class="card-inner">
                <h5 class="card-title">Events Status</h5>
                <canvas id="eventsStatusChart"></canvas>
            </div>
        </div>

        <!-- Contributions Status Pie Chart -->
        <div class="card card-bordered">
            <div class="card-inner">
                <h5 class="card-title">Contributions Status</h5>
                <canvas id="contributionsStatusChart"></canvas>
            </div>
        </div>

        <!-- Users by Role Bar Chart -->
        <div class="card card-bordered">
            <div class="card-inner">
                <h5 class="card-title">Users by Role</h5>
                <canvas id="usersByRoleChart"></canvas>
            </div>
        </div>

        <!-- Events Summary (Upcoming, Ongoing, Past) -->
        <div class="card card-bordered">
            <div class="card-inner">
                <h5 class="card-title">Events Summary</h5>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="nk-tb-item">
                            <h6 class="nk-tb-title">Upcoming Events</h6>
                            <p>{{ $upcomingEvents }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="nk-tb-item">
                            <h6 class="nk-tb-title">Ongoing Events</h6>
                            <p>{{ $ongoingEvents }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="nk-tb-item">
                            <h6 class="nk-tb-title">Past Events</h6>
                            <p>{{ $pastEvents }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Events Status Pie Chart
    var eventsStatusCtx = document.getElementById('eventsStatusChart').getContext('2d');
    var eventsStatusData = {
        labels: @json($eventsStatus->pluck('status')),
        datasets: [{
            label: 'Events Status',
            data: @json($eventsStatus->pluck('total')),
            backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56'], // Custom colors
        }]
    };
    var eventsStatusChart = new Chart(eventsStatusCtx, {
        type: 'pie',
        data: eventsStatusData,
    });

    // Contributions Status Pie Chart
    var contributionsStatusCtx = document.getElementById('contributionsStatusChart').getContext('2d');
    var contributionsStatusData = {
        labels: @json($contributionsStatus->pluck('status')),
        datasets: [{
            label: 'Contributions Status',
            data: @json($contributionsStatus->pluck('total')),
            backgroundColor: ['#4CAF50', '#FFC107', '#F44336'], // Custom colors
        }]
    };
    var contributionsStatusChart = new Chart(contributionsStatusCtx, {
        type: 'pie',
        data: contributionsStatusData,
    });

    // Users by Role Bar Chart
    var usersByRoleCtx = document.getElementById('usersByRoleChart').getContext('2d');
    var usersByRoleData = {
        labels: @json($usersByRole->pluck('role')),
        datasets: [{
            label: 'Users by Role',
            data: @json($usersByRole->pluck('total')),
            backgroundColor: ['#3e95cd', '#8e5ea2', '#3cba9f'], // Custom colors
            borderColor: '#fff',
            borderWidth: 1,
        }]
    };
    var usersByRoleChart = new Chart(usersByRoleCtx, {
        type: 'bar',
        data: usersByRoleData,
    });
</script>
@endsection
