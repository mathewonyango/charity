<div class="nk-sidebar-menux mt-4">
    <ul class="nk-menu">
        <li class="nk-menu-heading">
            <h6 class="overline-title">Menu</h6>
        </li>
        <li class="nk-menu-item">
            <a href="{{route('dashboard')}}" class="nk-menu-link">
                <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                <span class="nk-menu-text">Dashboard</span>
            </a>
        </li>
		
        @if(auth()->user()->type === 'super-admin' || auth()->user()->type === 'Institution Checker' || auth()->user()->type === 'Institutional Maker')
            <li class="nk-menu-item has-sub">
                <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle" data-original-title title>
                <span class="nk-menu-icon">
                    <em class="icon ni ni-link-group"></em>
                </span>
                    <span class="nk-menu-text">Configure Institution</span>
                </a>
                <ul class="nk-menu-sub">
                    <li class="nk-menu-item">
                        <a href="{{ route('categories.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-share-alt"></em></span>
                            <span class="nk-menu-text">Category</span>
                        </a>
                    </li>

                    <li class="nk-menu-item">
                        <a href="{{ route('institutions.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>
                            <span class="nk-menu-text">Institutions</span>
                        </a>
                    </li>
                </ul>
            </li>
        @else @endif

        @if(auth()->check() && auth()->user()->type === 'super-admin')
            <li class="nk-menu-item">
                <a href="{{ route('C2B') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
                    <span class="nk-menu-text">C2B Transactions</span>
                </a>
            </li>
        @else
            @can('view_transactions')
                <li class="nk-menu-item d-none">
                    <a href="{{ route('transactions') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
                        <span class="nk-menu-text">Transactions</span>
                    </a>
                </li>

                <li class="nk-menu-item d-none">
                    <a href="javascript:void(0);" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
                        <span class="nk-menu-text">Transaction Enquiry</span>
                    </a>
                </li>
            @endcan
        @endif
    </ul>
</div>
