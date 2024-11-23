@extends('layout')

@section('title', 'Contributions')

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title page-title">Contributions List</h4>

                            @if ($contribution_count > 1)
                                <div class="nk-block-des text-soft">
                                    <p>{{ number_format($contribution_count) }} Contributions</p>
                                </div>
                            @else
                                <div class="nk-block-des text-soft">
                                    <p>{{ number_format($contribution_count) }} Contribution</p>
                                </div>
                            @endif
                        </div>
                        <div class="nk-block-head-content">
                            <div class="nk-block-tools">
                                <a href="{{ route('portal.Pcontribution.index') }}" class="btn btn-primary">
                                    <em class="icon ni ni-plus-circle"></em> Add Contribution
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nk-block nk-block-lg">
                    <div class="card">
                        <div class="card-inner">
                            <!-- Filter Buttons -->
                            <div class="mb-4">
                                <!-- Pending Contributions Filter -->
                                <a href="{{ route('portal.Pcontributions.index', ['status' => 'pending']) }}" class="btn btn-warning">Pending Contributions</a>

                                <!-- Approved Contributions Filter -->
                                <a href="{{ route('portal.Pcontributions.index', ['status' => 'approved']) }}" class="btn btn-success">Approved Contributions</a>

                                <!-- Active Contributions Filter -->
                                <a href="{{ route('portal.Pcontributions.index', ['open' => '1']) }}" class="btn btn-info">Active Contributions</a>

                                <!-- Closed Contributions Filter -->

                                <!-- Open Contributions Filter -->
                                {{-- <a href="{{ route('portal.Pcontributions.index', ['open' => 'yes']) }}" class="btn btn-primary">Open Contributions</a> --}}

                                <!-- Closed Contributions Filter by Open status -->
                                <a href="{{ route('portal.Pcontributions.index', ['open' => '0']) }}" class="btn btn-secondary">Closed Contributions</a>
                            </div>

                            <!-- Contributions Table -->
                            <div class="table-responsive-custom">
                            <table class="datatable-init nowrap nk-tb-list nk-tb-ulist dataTable">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        {{-- <th class="nk-tb-col"><span class="sub-text">Organizer Email</span></th> --}}
                                        <th class="nk-tb-col"><span class="sub-text">Title</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Category</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Goal Amount</span></th>
                                        <th class="nk-tb-col"><span class="sub-text"> Amount Raised</span></th>

                                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                                        {{-- <th class="nk-tb-col"><span class="sub-text">Created At</span></th> --}}
                                        <th class="nk-tb-col nk-tb-col-tools text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contributions as $contribution)
                                        <tr class="nk-tb-item">
                                            {{-- <td class="nk-tb-col">
                                                <div class="d-flex align-items-center gap-3">
                                                    @php
                                                        // Assign a default email if user or email is not set
                                                        $userEmail = $contribution->user->email ?? 'default@example.com';

                                                        // Generate avatar style based on the email
                                                        $avatarStyle = getUserAvatarStyle($userEmail);

                                                        // Generate initials based on the email
                                                        $initials = getInitials($userEmail);
                                                    @endphp
                                                    <div class="user-avatar rounded-circle d-none d-sm-flex align-items-center justify-content-center"
                                                         style="
                                                            width: 42px;
                                                            height: 42px;
                                                            font-weight: 600;
                                                            background-color: {{ $avatarStyle['background'] }};
                                                            color: {{ $avatarStyle['color'] }};
                                                         ">
                                                        <span class="text-uppercase">
                                                            {{ $initials }}
                                                        </span>
                                                    </div>
                                                    <span class="text-dark">{{ $contribution->user->email ?? 'N/A' }}</span>
                                                </div>

                                            </td> --}}
                                            <td class="nk-tb-col">
                                                <div class="d-flex align-items-center gap-3">
                                                    @php
                                                        $avatarStyle = getUserAvatarStyle($contribution->title);
                                                    @endphp
                                                    <div class="user-avatar rounded-circle d-none d-sm-flex align-items-center justify-content-center"
                                                         style="
                                                            width: 42px;
                                                            height: 42px;
                                                            font-weight: 600;
                                                            background-color: {{ $avatarStyle['background'] }};
                                                            color: {{ $avatarStyle['color'] }};
                                                         ">
                                                        <span class="text-uppercase">
                                                            {{ getInitials($contribution->title) }}
                                                        </span>
                                                    </div>
                                                    <span class="text-dark">{{ $contribution->title?? 'N/A' }}</span>
                                                </div>
                                            </td>
                                                                                        <td class="nk-tb-col">{{ $contribution->category }}</td>
                                            <td class="nk-tb-col">{{ number_format($contribution->goal_amount, 2) }}</td>
                                            <td class="nk-tb-col">{{ number_format($contribution->currentAmount(), 2) }}</td>

                                            <td class="nk-tb-col">
                                                <span class="badge badge-dot badge-{{ $contribution->status === 'pending' ? 'warning' : 'success' }}">
                                                    {{ ucfirst($contribution->status) }}
                                                </span>
                                            </td>
                                            {{-- <td class="nk-tb-col">{{ $contribution->created_at->format('d/m/Y') }}</td> --}}
                                            <td class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    <li>
                                                        <a href="{{ route('portal.Pcontributions.edit', $contribution->id) }}" class="btn btn-sm btn-primary">
                                                            <em class="icon ni ni-edit"></em> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('portal.contributions.toggle-status', $contribution->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-{{ $contribution->status === 'pending' ? 'success' : 'warning' }}">
                                                                <em class="icon ni ni-check-circle"></em>
                                                                {{ $contribution->status === 'pending' ? 'Approve' : 'Pending' }}
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
