@extends('layout')
@section('title', 'Transactions')

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title page-title">Transactions List</h4>

                            @if ($transaction_count > 1)
                                <div class="nk-block-des text-soft">
                                    <p>{{ number_format($transaction_count) }} Total Transactions</p>
                                </div>
                            @else
                                <div class="nk-block-des text-soft">
                                    <p>{{ number_format($transaction_count) }} Transaction</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="nk-block nk-block-lg">
                    <div class="card">
                        <div class="card-inner">
                            <table class="datatable-init nowrap nk-tb-list nk-tb-ulist dataTable">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th class="nk-tb-col"><span class="sub-text">Reference</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Email</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Amount</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Type</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Date</span></th>
                                        <th class="nk-tb-col nk-tb-col-tools" style="width: 100px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr class="nk-tb-item">
                                            <td class="nk-tb-col">
                                                <span class="text-primary">{{ $transaction->reference }}</span>
                                            </td>
                                            <td class="nk-tb-col">{{ $transaction->email }}</td>
                                            <td class="nk-tb-col">
                                                {{ $transaction->currency }} {{ number_format($transaction->amount / 100, 2) }}
                                            </td>
                                            <td class="nk-tb-col">
                                                @if($transaction->contribution_id)
                                                    <span class="badge badge-dim badge-primary">Contribution</span>
                                                @elseif($transaction->event_id)
                                                    <span class="badge badge-dim badge-info">Event</span>
                                                @else
                                                    <span class="badge badge-dim badge-dark">Other</span>
                                                @endif
                                            </td>
                                            <td class="nk-tb-col">
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
                                            </td>
                                            <td class="nk-tb-col">
                                                {{ $transaction->created_at->format('M d, Y H:i') }}
                                            </td>
                                            <td class="nk-tb-col-tools" style="min-width: 100px; white-space: nowrap;">
                                                <div class="d-flex gap-2 justify-content-end">
                                                    <a href="{{ route('portal.transactions.show', $transaction->id) }}"
                                                       class="btn btn-sm btn-primary d-inline-flex align-items-center">
                                                        <em class="icon ni ni-eye"></em>
                                                        <span class="ms-1">View</span>
                                                    </a>
                                                </div>
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

<style>
/* Add these styles to your global CSS or component styles */
.nk-tb-col-tools {
    width: 100px !important;
    min-width: 100px !important;
}

.nk-tb-col-tools .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    white-space: nowrap;
}

.nk-tb-col-tools .btn em {
    font-size: 14px;
    vertical-align: middle;
    margin-right: 2px;
}

.nk-tb-col-tools .gap-2 {
    gap: 0.5rem !important;
}

.nk-tb-col .badge {
    white-space: nowrap;
}

.datatable-init {
    width: 100%;
    overflow-x: auto;
}

@media (max-width: 991px) {
    .card-inner {
        overflow-x: auto;
    }

    .datatable-init {
        min-width: 800px;
    }
}

/* Additional styles for transaction-specific elements */
.text-primary {
    font-family: monospace;
    font-size: 0.9em;
}

.badge-dim {
    opacity: 0.8;
}
</style>
@endsection
