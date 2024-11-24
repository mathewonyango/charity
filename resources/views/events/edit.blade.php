@extends('layout')

@section('title', 'Edit Event')

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title page-title">Edit Event</h4>
                            <div class="nk-block-des text-soft">
                                <p>Update the details of the event below.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner">
                            <form action="{{ route('portal.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">
                                    <div class="col-md-6 form-group">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ $event->title }}" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="category" class="form-label">Category</label>
                                        <input type="text" name="category" id="category" class="form-control" value="{{ $event->category }}" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="venue" class="form-label">Venue</label>
                                        <input type="text" name="venue" id="venue" class="form-control" value="{{ $event->venue }}" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($event->start_date)) }}" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($event->end_date)) }}" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="time" class="form-label">Time</label>
                                        <input type="time" name="time" id="time" class="form-control" value="{{ $event->time }}" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="map_link" class="form-label">Map Link</label>
                                        <input type="url" name="map_link" id="map_link" class="form-control" value="{{ $event->map_link }}">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="organizer_name" class="form-label">Organizer Name</label>
                                        <input type="text" name="organizer_name" id="organizer_name" class="form-control" value="{{ $event->organizer_name }}" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="ticket_price" class="form-label">Ticket Price</label>
                                        <input type="number" step="0.01" name="ticket_price" id="ticket_price" class="form-control" value="{{ $event->ticket_price }}">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="registration_deadline" class="form-label">Registration Deadline</label>
                                        <input type="datetime-local" name="registration_deadline" id="registration_deadline" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($event->registration_deadline)) }}">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="event_capacity" class="form-label">Event Capacity</label>
                                        <input type="number" name="event_capacity" id="event_capacity" class="form-control" value="{{ $event->event_capacity }}">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="pending" {{ $event->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved" {{ $event->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="cancelled" {{ $event->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="banner_image" class="form-label">Banner Image</label>
                                        <input type="file" name="banner_image" id="banner_image" class="form-control">
                                    </div>

                                    {{-- <div class="col-md-6 form-group">
                                        <label for="event_coordinators" class="form-label">Event Coordinators</label>
                                        <textarea name="event_coordinators" id="event_coordinators" class="form-control" rows="1">{{ json_encode($event->event_coordinators) }}</textarea>
                                    </div> --}}

                                    {{-- <div class="col-md-6 form-group">
                                        <label for="organizer_contact_info" class="form-label">Organizer Contact Info</label>
                                        <textarea name="organizer_contact_info" id="organizer_contact_info" class="form-control" rows="1">{{ json_encode($event->organizer_contact_info) }}</textarea>
                                    </div> --}}
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <em class="icon ni ni-save"></em> Update Event
                                    </button>
                                    <a href="{{ route('portal.events.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
