@extends('layout')
@section('title', 'Users')

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title page-title">Users List</h4>

                            @if ($user_count > 1)
                                <div class="nk-block-des text-soft">
                                    <p>{{ number_format($user_count) }} System Users</p>
                                </div>
                            @else
                                <div class="nk-block-des text-soft">
                                    <p>{{ number_format($user_count) }} System User</p>
                                </div>
                            @endif
                        </div>
                        <div class="nk-block-head-content">
                            <div class="nk-block-tools">
                                <a href="{{ route('portal.users.create') }}" class="btn btn-primary">
                                    <em class="icon ni ni-user-add"></em> Add User
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nk-block nk-block-lg">
                    <div class="card">
                        <div class="card-inner">
                            <table class="datatable-init nowrap nk-tb-list nk-tb-ulist dataTable">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th class="nk-tb-col"><span class="sub-text">Email</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Phone Number</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Role</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Created At</span></th>
                                        <th class="nk-tb-col nk-tb-col-tools text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="nk-tb-item">
                                            <td class="nk-tb-col">
                                                <div class="d-flex align-items-center">
                                                    <!-- Avatar with initials -->
                                                    <div class="user-avatar bg-dim-primary d-none d-sm-flex me-2">
                                                        <span>{{ emailInitials($user->email) ?? 'N/A' }}</span>
                                                    </div>
                                                    <!-- Email -->
                                                    {{ $user->email ?? 'N/A' }}
                                                </div>
                                            </td>                                            <td class="nk-tb-col">{{ $user->phone_number}}</td>
                                            <td class="nk-tb-col">{{ ucfirst($user->role) }}</td>
                                            <td class="nk-tb-col">
                                                <span class="badge badge-dot badge-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                                                    {{ ucfirst($user->status) }}
                                                </span>
                                            </td>
                                            <td class="nk-tb-col">{{ $user->created_at->format('d/m/Y') }}</td>
                                            <td class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    <li>
                                                        <a href="{{ route('portal.users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                                            <em class="icon ni ni-edit"></em> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('portal.users.toggle-status', $user->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-{{ $user->status === 'active' ? 'danger' : 'success' }}">
                                                                <em class="icon ni ni-shield-off"></em>
                                                                {{ $user->status === 'active' ? 'Deactivate' : 'Activate' }}
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
@endsection
