@extends('layout')

@section('title', 'Create Event')

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title page-title">Create Event</h4>
                            <div class="nk-block-des text-soft">
                                <p>Fill in the form below to create a new event.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nk-block nk-block-lg">
                    <div class="card">
                        <div class="card-inner">
                            <form action="{{ route('portal.events.store') }}" method="POST">
                                @csrf

                                <!-- Row 1: Title, Category, Type -->
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="title">Event Title</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                                            </div>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="category">Category</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}" required>
                                            </div>
                                            @error('category')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="type">Type</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="type" name="type" value="{{ old('type') }}" required>
                                            </div>
                                            @error('type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 2: Start Date, End Date, Venue -->
                                <div class="row g-4 mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="start_date">Start Date</label>
                                            <div class="form-control-wrap">
                                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                                            </div>
                                            @error('start_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="end_date">End Date</label>
                                            <div class="form-control-wrap">
                                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                                            </div>
                                            @error('end_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="venue">Venue</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="venue" name="venue" value="{{ old('venue') }}" required>
                                            </div>
                                            @error('venue')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 3: Description -->
                                <div class="row g-4 mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="description">Event Description</label>
                                            <div class="form-control-wrap">
                                                <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                                            </div>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="row g-4 mt-4">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-primary">Create Event</button>
                                    </div>
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
