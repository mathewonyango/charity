@extends('layout')
@section('title', 'Add User')

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-lg wide-lg">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title page-title">New User</h4>
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

                            <form action="{{ route('portal.users.store') }}" class="buysell-form" method="post" autocomplete="off">
                                @csrf
                                <div class="row g-4">
                                    {{-- <div class="col-lg-6">
                                        <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label for="first-name" class="form-label">First Name</label>
                                            </div>
                                            <div class="form-control-group">
                                                <input type="text" id="first-name" class="form-control form-control-lg" name="first_name" placeholder="John" required>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-lg-6">
                                        <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label for="last-name" class="form-label">Last Name</label>
                                            </div>
                                            <div class="form-control-group">
                                                <input type="text" id="last-name" class="form-control form-control-lg" name="last_name" placeholder="Doe" required>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-6">
                                        <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label for="email" class="form-label">Email (username)</label>
                                            </div>
                                            <div class="form-control-group">
                                                <input type="email" id="email" class="form-control form-control-lg" name="email" placeholder="johndoe@example.com" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label for="phone" class="form-label">Phone Number</label>
                                            </div>
                                            <div class="form-control-group">
                                                <input type="text" id="phone" class="form-control form-control-lg" name="phone_number" placeholder="0722******">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label for="role" class="form-label">Role</label>
                                            </div>
                                            <div>
                                                <select class="select2 form-control-lg form-control-select form-control" name="role" id="role" required>
                                                    <option value="">--Select Role--</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="user">User</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="buysell-field form-action mt-4">
                                            <a class="btn btn-lg btn-block btn-primary proceed" data-toggle="modal" data-target="#enterPassword">Submit</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade modal-danger" id="enterPassword" role="dialog" aria-label="enterPasswordModal" aria-hidden="true" tabindex="-1">
                                    <div class="modal-dialog modal-confirm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="icon-box">
                                                    <i class="uil uil-check"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <p>Please enter your password to proceed.</p>
                                                <input type="password" class="form-control hidden" id="password" autocomplete="false" name="password">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
                                                <button type="submit" id="submit" class="btn btn-success success" aria-hidden="true">
                                                    <i class="uil uil-check"></i>
                                                    Confirm
                                                </button>
                                            </div>

                                        </div>
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

@section('custom-scripts')

@endsection
