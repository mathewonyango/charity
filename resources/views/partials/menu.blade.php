<div class="nk-sidebar-menux mt-4">
    <ul class="nk-menu">
        <li class="nk-menu-heading">
            <h6 class="overline-title">Menu</h6>
        </li>
        <li class="nk-menu-item">
            <a href="{{ route('portal.dashboard') }}" class="nk-menu-link">
                <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                <span class="nk-menu-text">Dashboard</span>
            </a>
        </li>

        <li class="nk-menu-item has-sub">
            <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle">
                <span class="nk-menu-icon"><em class="icon ni ni-link-group"></em></span>
                <span class="nk-menu-text">Contributions</span>
            </a>
            <ul class="nk-menu-sub">
                <li class="nk-menu-item">
                    <a href="{{ route('portal.Pcontributions.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-gift"></em></span>
                        <span class="nk-menu-text"> Contributions</span>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nk-menu-item has-sub ">
            <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle">
                <span class="nk-menu-icon"><em class="icon ni ni-calendar"></em></span>
                <span class="nk-menu-text">Events</span>
            </a>
            <ul class="nk-menu-sub">
                <li class="nk-menu-item">
                    <a href="{{ route('portal.Pevents.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-calendar-alt"></em></span>
                        <span class="nk-menu-text"> Events</span>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nk-menu-item has-sub ">  <!-- Removed 'active' class -->
            <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle">
                <span class="nk-menu-icon"><em class="icon ni ni-wallet-fill"></em></span>
                <span class="nk-menu-text">Money In</span>
            </a>
            <ul class="nk-menu-sub">  <!-- Removed style="display: block" -->
                <li class="nk-menu-item">
                    <a href="{{ route('portal.transactions.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-tranx"></em></span>
                        <span class="nk-menu-text">Transactions</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nk-menu-item has-sub">
            <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle">
                <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                <span class="nk-menu-text">Users</span>
            </a>
            <ul class="nk-menu-sub">
                <li class="nk-menu-item">
                    <a href="{{ route('portal.users.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                        <span class="nk-menu-text">Users</span>
                    </a>
                </li>

            </ul>
        </li>
    </ul>
</div>
