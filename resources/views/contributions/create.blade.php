@extends('layout')
@section('title', 'Add Contribution')

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-lg wide-lg">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title page-title">New Contribution</h4>
                        </div>
                        <div class="nk-block-head-content">
                            <ul class="nk-block-tools gx-3">
                                <li>
                                    <a href="{{ route('portal.Pcontributions.index') }}" class="btn btn-primary">
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
                                <h5 class="card-title">Contribution Details</h5>
                            </div>

                            <form action="{{ route('portal.Pcontributions.store') }}" class="buysell-form" method="post" autocomplete="off">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label for="title" class="form-label">Contribution Title</label>
                                            </div>
                                            <div class="form-control-group">
                                                <input type="text" id="title" class="form-control form-control-lg" name="title" placeholder="Contribution Title" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label for="category" class="form-label">Category</label>
                                            </div>
                                            <div class="form-control-group">
                                                <input type="text" id="category" class="form-control form-control-lg" name="category" placeholder="Category" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label for="goal_amount" class="form-label">Goal Amount</label>
                                            </div>
                                            <div class="form-control-group">
                                                <input type="number" id="goal_amount" class="form-control form-control-lg" name="goal_amount" placeholder="Goal Amount" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label for="duration" class="form-label">Duration (in days)</label>
                                            </div>
                                            <div class="form-control-group">
                                                <input type="number" id="duration" class="form-control form-control-lg" name="duration" placeholder="Duration" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label for="description" class="form-label">Description</label>
                                            </div>
                                            <div class="form-control-group">
                                                <textarea id="description" class="form-control form-control-lg" name="description" placeholder="Description" rows="4" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label for="organizer_name" class="form-label">Organizer Name</label>
                                            </div>
                                            <div class="form-control-group">
                                                <input type="text" id="organizer_name" class="form-control form-control-lg" name="organizer_name" placeholder="Organizer Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label for="organizer_contact" class="form-label">Organizer Contact</label>
                                            </div>
                                            <div class="form-control-group">
                                                <input type="text" id="organizer_contact" class="form-control form-control-lg" name="organizer_contact" placeholder="Organizer Contact" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label for="status" class="form-label">Status</label>
                                            </div>
                                            <div>
                                                <select class="select2 form-control-lg form-control-select form-control" name="status" id="status" required>
                                                    <option value="">--Select Status--</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
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
