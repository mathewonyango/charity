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
                            <form action="{{ route('portal.events.update', $event->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ $event->title }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="category" class="form-label">Category</label>
                                    <input type="text" name="category" id="category" class="form-control" value="{{ $event->category }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="venue" class="form-label">Venue</label>
                                    <input type="text" name="venue" id="venue" class="form-control" value="{{ $event->venue }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($event->start_date)) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($event->end_date)) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="pending" {{ $event->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $event->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                    </select>
                                </div>

                                <div class="form-group">
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
