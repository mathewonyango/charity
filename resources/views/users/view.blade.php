@extends('layout')
@section('title','Edit User')

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-lg wide-lg">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title page-title">User Information</h4>
                        </div>
                        <div class="nk-block-head-content">
                            <ul class="nk-block-tools gx-3">
                                <li>
                                    <a href="{{ route('portal.users.index') }}" class="btn btn-primary">
                                        <em class="icon ni ni-arrow-left"></em>
                                        <span>Back</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-head">
                                <h5 class="card-title">User Details</h5>
                            </div>

                            <form action="{{ route('portal.users.edit', $user->id) }}" class="buysell-form" method="post" autocomplete="off">
                                @csrf

                                <div class="row g-4">

                                    <div class="col-lg-6">
                                        <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label for="email" class="form-label">Email (username)</label>
                                            </div>
                                            <div class="form-control-group">
                                                <input type="email" id="email" class="form-control form-control-lg" name="email" value="{{ old('email', $user->email) }}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label for="phone" class="form-label">Phone Number</label>
                                            </div>
                                            <div class="form-control-group">
                                                <input type="number" id="phone" class="form-control form-control-lg" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label for="role" class="form-label">Role</label>
                                            </div>
                                            <div class="form-control-group">
                                                <input type="text" id="role" class="form-control form-control-lg" name="role" value="{{ old('role', $user->role) }}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Events Section -->
                <div class="nk-block nk-block-lg mt-4">
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-head">
                                <h5 class="card-title">My Events</h5>
                            </div>
                            @if($events->isEmpty())
                                <p class="text-muted">No events created by this user.</p>
                            @else
                                <ul class="list-group">
                                    @foreach($events as $event)
                                        <li class="list-group-item">
                                            <strong>{{ $event->title }}</strong>
                                            <small>({{ $event->created_at->format('d M Y') }})</small>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Contributions Section -->
                <div class="nk-block nk-block-lg mt-4">
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-head">
                                <h5 class="card-title">My Contributions</h5>
                            </div>
                            @if($contributions->isEmpty())
                                <p class="text-muted">No contributions created by this user.</p>
                            @else
                                <ul class="list-group">
                                    @foreach($contributions as $contribution)
                                        <li class="list-group-item">
                                            <strong>{{ $contribution->description }}</strong>
                                            <small>({{ $contribution->created_at->format('d M Y') }})</small>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-scripts')

@endsection
