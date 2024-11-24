@extends('layout')
@section('title', 'Contributions Details')

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Contribution Details</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ route('portal.contributions.index') }}" class="btn btn-outline-light">
                                <em class="icon ni ni-arrow-left"></em><span>Back</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner">
                            <div class="nk-block">
                                <div class="row g-gs">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Title</label>
                                            <div class="form-control-plaintext">{{ $contribution->title }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Category</label>
                                            <div class="form-control-plaintext">{{ $contribution->category }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Goal Amount</label>
                                            <div class="form-control-plaintext">{{ number_format($contribution->goal_amount) }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Amount Raised</label>
                                            <div class="form-control-plaintext">{{ number_format($contribution->currentAmount()) }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Organizer Name</label>
                                            <div class="form-control-plaintext">{{ $contribution->organizer_name }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Organizer Contact</label>
                                            <div class="form-control-plaintext">{{ $contribution->organizer_contact }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <div class="form-control-plaintext">{{ $contribution->description }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
