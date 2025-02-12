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
                                                <div class="d-flex align-items-center gap-3">
                                                    @php
                                                        $avatarStyle = getUserAvatarStyle($user->email);
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
                                                            {{ getInitials($user->email) }}
                                                        </span>
                                                    </div>
                                                    <span class="text-dark">{{ $user->email ?? 'N/A' }}</span>
                                                </div>
                                            </td>                                           <td class="nk-tb-col">{{ $user->phone_number}}</td>
                                            <td class="nk-tb-col">{{ ucfirst($user->role) }}</td>
                                            <td class="nk-tb-col">
                                                <span class="badge badge-dot badge-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                                                    {{ ucfirst($user->status) }}
                                                </span>
                                            </td>
                                            <td class="nk-tb-col">{{ $user->created_at->format('d/m/Y') }}</td>
                                            <td class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1 d-flex">
                                                    <!-- Edit Button -->
                                                    <li>
                                                        <a href="{{ route('portal.users.edit', $user->id) }}" class="btn btn-icon btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit User" data-bs-custom-class="custom-tooltip">
                                                            <em class="icon ni ni-edit"></em>
                                                        </a>
                                                    </li>
                                                    <!-- Activate/Deactivate Toggle Button -->
                                                    <li>
                                                        <form action="{{ route('portal.users.toggle-status', $user->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-icon btn-sm btn-{{ $user->status === 'active' ? 'danger' : 'success' }}" data-bs-toggle="tooltip" title="{{ $user->status === 'active' ? 'Deactivate User' : 'Activate User' }}" data-bs-custom-class="custom-tooltip">
                                                                <em class="icon ni ni-shield-off"></em>
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
