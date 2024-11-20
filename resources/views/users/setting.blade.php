@extends('layout')

@section('content')
<div class="row" style="margin-top: 80px;">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="text-center mt-3">
                    <img src="{{url('/storage/'. auth()->user()->image) }}" alt="" class="avatar rounded-circle" rel="tooltip" data-placement="top" title="Click to change image" />
                    <h5 class="mt-2 mb-0">{{ auth()->user()->email }}</h5>
                    <h6 class="text-muted font-weight-normal mt-2 mb-0">{{ strtoupper(auth()->user()->role) }}
                    </h6><br>
                    <h6 class="text-muted font-weight-normal mt-1 mb-4">{{ config('app.name') }}</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills navtab-bg nav-justified" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="btn btn-danger nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">
                            Profile Summary
                        </a>
                    </li>
                    {{-- @can('change_password')--}}
                    <li class="nav-item">
                        <a class="btn btn-danger nav-link" id="pills-settings-tab" data-toggle="pill" href="#pills-settings" role="tab" aria-controls="pills-settings" aria-selected="true">
                            Change Password
                        </a>
                    </li>
                    {{-- @endcan--}}
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <h5 class="mt-3">Avatar</h5>
                        <div class="row ml-2 mt-4">
                            <form action="{{ route('users.upload_avatar') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image
                                        file. Size of image should not be more than 2MB.</small>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="uil uil-location-arrow"></i>
                                    Submit
                                </button>
                            </form>
                        </div>

                        <hr />
                        <h5 class="mt-3">User Details</h5>
                        <div class="row ml-2 mt-4">
                            <form action="">
                                <div class="form-group row mb-3">
                                    <label for="fname"></label>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- password -->
                    <div class="tab-pane" id="pills-settings" role="tabpanel" aria-labelledby="pills-settings-tab">
                        <h6 class="mt-3">Change your password</h6>
                        <div class="row ml-2 mt-4">
                            <form action="{{ route('users.change_password') }}" method="post">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="password" class="col-4 col-form-label">Password</label>
                                    <div class="col-8">
                                        <input type="password" class="form-control" id="password1" placeholder="Password" required value="" name="password">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="passwordConfirm" class="col-4 col-form-label">Confirm
                                        Password</label>
                                    <div class="col-8">
                                        <input type="password" class="form-control" id="password2" placeholder="Confirm Password" required value="" name="confirm_password">
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i class="uil uil-location-arrow"></i> Submit
                                    </button>
                                </div>
                            </form>
                        </div>

                        <h5 class="mt-3 text-info">Password Policy</h5>
                        <div class="row ml-2 mt-4">
                            <ul>
                                <li>
                                    <small>must be at least 8 characters in length</small>
                                </li>
                                <li>
                                    <small>must contain at least one lowercase letter</small>
                                </li>
                                <li>
                                    <small>must contain at least one uppercase letter</small>
                                </li>
                                <li>
                                    <small>must contain at least one digit</small>
                                </li>
                                <li>
                                    <small>must contain a special character</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- password end -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
