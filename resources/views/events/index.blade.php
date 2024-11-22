@extends('layout')

@section('title', 'Events Management')

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title page-title">Events List</h4>
                            <div class="nk-block-des text-soft">
                                <p>{{ number_format($events_count) }} Event{{ $events_count === 1 ? '' : 's' }}</p>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="nk-block-tools">
                                <a href="{{ route('portal.Pevents.create') }}" class="btn btn-primary">
                                    <em class="icon ni ni-plus-circle"></em> Add Event
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
                                <a href="{{ route('portal.Pevents.index', ['status' => 'pending']) }}"
                                   class="btn {{ $status === 'pending' && $filter === '' ? 'btn-warning' : 'btn-outline-warning' }}">Pending Events</a>
                                <a href="{{ route('portal.Pevents.index', ['status' => 'approved']) }}"
                                   class="btn {{ $status === 'approved' && $filter === '' ? 'btn-success' : 'btn-outline-success' }}">Approved Events</a>
                                <a href="{{ route('portal.Pevents.index', ['status' => 'approved', 'filter' => 'ongoing']) }}"
                                   class="btn {{ $filter === 'ongoing' ? 'btn-info' : 'btn-outline-info' }}">Ongoing Events</a>
                                <a href="{{ route('portal.Pevents.index', ['status' => 'approved', 'filter' => 'past']) }}"
                                   class="btn {{ $filter === 'past' ? 'btn-dark' : 'btn-outline-dark' }}">Past Events</a>

                                   <a href="{{ route('portal.Pevents.index', ['status' => 'upcoming', 'filter' => 'past']) }}"
                                    class="btn {{ $filter === 'past' ? 'btn-success' : 'btn-outline-primary' }}">Upcoming Events</a>


                            </div>

                            <!-- Events Table -->
                            <table class="datatable-init nowrap nk-tb-list nk-tb-ulist dataTable">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">


                                        <th class="nk-tb-col"><span class="sub-text">Organizer Email</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Title</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Category</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Venue</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Start Date</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">End Date</span></th>
                                        <th class="nk-tb-col nk-tb-col-tools text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr class="nk-tb-item">
                                            <td class="nk-tb-col">
                                                <div class="d-flex align-items-center gap-3">
                                                    @php
                                                        $avatarStyle = getUserAvatarStyle($event->user->email);
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
                                                            {{ getInitials($event->user->email) }}
                                                        </span>
                                                    </div>
                                                    <span class="text-dark">{{ $event->user->email ?? 'N/A' }}</span>
                                                </div>
                                            </td>

                                            <td class="nk-tb-col">{{ $event->title }}</td>

                                            <td class="nk-tb-col">{{ $event->category }}</td>
                                            <td class="nk-tb-col">{{ $event->venue }}</td>

                                            <td class="nk-tb-col">
                                                <span class="badge badge-dot badge-{{ $event->status === 'pending' ? 'warning' : 'success' }}">
                                                    {{ ucfirst($event->status) }}
                                                </span>
                                            </td>

                                            <td class="nk-tb-col">{{$event->start_date ?? 'N/A' }}</td>
                                            <td class="nk-tb-col">{{$event->end_date ?? 'N/A' }}</td>
                                            <td class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    <li>
                                                        <a href="{{ route('portal.events.edit', $event->id) }}" class="btn btn-sm btn-primary">
                                                            <em class="icon ni ni-edit"></em> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('portal.events.toggle-status', $event->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-{{ $event->status === 'pending' ? 'success' : 'warning' }}">
                                                                <em class="icon ni ni-check-circle"></em>
                                                                {{ $event->status === 'pending' ? 'Approve' : 'Pending' }}
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
