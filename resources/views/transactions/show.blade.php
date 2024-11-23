@extends('layout')
@section('title', 'Transaction Details')

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Transaction Details</h3>
                            <div class="nk-block-des text-soft">
                                <p>Reference: {{ $transaction->reference }}</p>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ route('portal.transactions.index') }}" class="btn btn-outline-light">
                                <em class="icon ni ni-arrow-left"></em>
                                <span>Back to Transactions</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Amount</label>
                                        <div class="form-control-wrap">
                                            <div class="form-control-plaintext">
                                                {{ $transaction->currency }} {{ number_format($transaction->amount / 100, 2) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <div class="form-control-wrap">
                                            @php
                                                $statusColors = [
                                                    'success' => 'success',
                                                    'pending' => 'warning',
                                                    'failed' => 'danger'
                                                ];
                                                $statusColor = $statusColors[$transaction->status] ?? 'secondary';
                                            @endphp
                                            <span class="badge badge-dot badge-{{ $statusColor }}">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <div class="form-control-wrap">
                                            <div class="form-control-plaintext">
                                                {{ $transaction->email }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Transaction Type</label>
                                        <div class="form-control-wrap">
                                            @if($transaction->contribution_id)
                                                <span class="badge badge-dim badge-primary">Contribution</span>
                                            @elseif($transaction->event_id)
                                                <span class="badge badge-dim badge-info">Event</span>
                                            @else
                                                <span class="badge badge-dim badge-dark">Other</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Date</label>
                                        <div class="form-control-wrap">
                                            <div class="form-control-plaintext">
                                                {{ $transaction->created_at->format('M d, Y H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($transaction->metadata)
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Additional Information</label>
                                        <div class="form-control-wrap">
                                            <div class="form-control-plaintext">
                                                <pre class="json-preview">{{ json_encode($transaction->metadata, JSON_PRETTY_PRINT) }}</pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.json-preview {
    background: #f5f6fa;
    padding: 1rem;
    border-radius: 4px;
    max-height: 300px;
    overflow-y: auto;
}

.badge-dim {
    opacity: 0.8;
}
</style>
@endsection
