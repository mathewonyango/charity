@extends('layout')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid"
        style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; overflow-y: auto; padding: 30px; background-color: #f7f9fc;">
        <div class="container" style="margin-left:22%; margin-right:22%;">
            <div class="nk-content nk-content-fluid">
                <div class="container-xl wide-lg">
                    <div class="nk-content-body">
                        <!-- Welcome Section with Encouragement -->
                        <div class="nk-block-head">
                            <div class="nk-block-head-sub">
                                <span style="font-family: 'Poppins', sans-serif; font-size: 16px;">Welcome!</span>
                            </div>
                            <div class="nk-block-between-md g-4">
                                <div class="nk-block-head-content">
                                    <h2 class="nk-block-title fw-normal">
                                        {{ auth()->user()->email }}
                                    </h2>
                                    <div class="nk-block-des">
                                        <p style="font-family: 'Poppins', sans-serif; font-size: 14px;">Your portal overview
                                            at a glance.</p>
                                    </div>
                                    <div class="alert alert-primary" role="alert"
                                        style="margin-top: 15px; font-family: 'Amiri', serif; font-size: 18px; line-height: 1.6;">
                                        Together, we can make a difference! <br>
                                        <strong style="font-size: 20px; color: #4CAF50;">"Small acts of kindness can
                                            transform lives."</strong> <br>
                                        <span style="font-size: 16px;">
                                            This platform helps us raise funds and organize events for vulnerable
                                            communities, uniting people of all faiths and beliefs in the spirit of charity
                                            and hope.
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Dashboard Metrics -->
                        <div class="nk-block">
                            <div class="row gy-gs">
                                <!-- Contributions Section -->
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="nk-wgw sm">
                                            <a class="nk-wgw-inner" href="{{ route('portal.Pcontributions.index') }}">
                                                <div class="nk-wgw-name">
                                                    <div class="nk-wgw-icon">
                                                        <em class="icon ni ni-money"></em>
                                                    </div>
                                                    <h5 class="nk-wgw-title title">Total Contributions Created</h5>
                                                </div>
                                                <div class="nk-wgw-balance">
                                                    <div class="amount">{{ number_format($totalContributions) }}</div>
                                                    <span class="currency"></span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Events Section -->
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="nk-wgw sm">
                                            <a class="nk-wgw-inner" href="{{ route('portal.events.index') }}">
                                                <div class="nk-wgw-name">
                                                    <div class="nk-wgw-icon">
                                                        <em class="icon ni ni-calendar"></em>
                                                    </div>
                                                    <h5 class="nk-wgw-title title">Upcoming Events</h5>
                                                </div>
                                                <div class="nk-wgw-balance">
                                                    <div class="amount">{{ $ongoingEvents }}</div>
                                                    <span>Events</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Users Section -->
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="nk-wgw sm">
                                            <a class="nk-wgw-inner" href="{{ route('portal.users.index') }}">
                                                <div class="nk-wgw-name">
                                                    <div class="nk-wgw-icon">
                                                        <em class="icon ni ni-users"></em>
                                                    </div>
                                                    <h5 class="nk-wgw-title title">Total Users</h5>
                                                </div>
                                                <div class="nk-wgw-balance">
                                                    <div class="amount">{{ $totalUsers }}</div>
                                                    <span>Users</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Charts Section -->
                        <div class="nk-block">
                            <div class="row g-4">
                                <!-- Contributions Chart -->
                                <div class="col-lg-4 col-md-6">
                                    <div class="card" style="background-color: transparent; box-shadow: none;">
                                        <div class="card-inner p-3">
                                            <h6 class="text-muted mb-2">Contributions Overview</h6>
                                            <div class="chart-container">
                                                <canvas id="contributionsChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Users Overview Chart -->
                                <div class="col-lg-4 col-md-6">
                                    <div class="card" style="background-color: transparent; box-shadow: none;">
                                        <div class="card-inner p-3">
                                            <h6 class="text-muted mb-2">Users Overview</h6>
                                            <div class="chart-container">
                                                <canvas id="users"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Events Participation Chart -->
                                <div class="col-lg-4 col-md-12">
                                    <div class="card" style="background-color: transparent; box-shadow: none;">
                                        <div class="card-inner p-3">
                                            <h6 class="text-muted mb-2">Event Participation</h6>
                                            <div class="chart-container">
                                                <canvas id="eventsChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
                            .chart-container {
                                width: 100%;
                                max-width: 400px;
                                height: 300px;
                                margin: auto;
                                margin-top: 20px;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const contributionsData = @json($contributions_data);
        const eventsData = @json($events_data);
        const usersData = @json($users_data);

        if (contributionsData.values.every(value => value === 0)) {
            const chartContainer = document.getElementById('contributionsChart').parentNode;
            chartContainer.innerHTML =
                '<p style="text-align: center; color: #888; font-size: 14px;">No contributions data to display</p>';
        } else {
            new Chart(document.getElementById('contributionsChart'), {
                type: 'pie',
                data: {
                    labels: contributionsData.labels,
                    datasets: [{
                        data: contributionsData.values,
                        backgroundColor: ['#4bc0c0', '#9966ff', '#ff9f40']
                    }]
                },
            });
        }

        new Chart(document.getElementById('users'), {
            type: 'pie',
            data: {
                labels: usersData.labels,
                datasets: [{
                    data: usersData.values,
                    backgroundColor: ['#798bff', '#e5effe', '#6576ff']
                }]
            }
        });

        new Chart(document.getElementById('eventsChart'), {
            type: 'pie',
            data: {
                labels: eventsData.labels,
                datasets: [{
                    data: eventsData.values,
                    backgroundColor: ['#ff6384', '#36a2eb', '#ffce56']
                }]
            }
        });
    </script>
@endsection
