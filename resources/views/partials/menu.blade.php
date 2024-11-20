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
                {{-- <li class="nk-menu-item">
                    <a href="{{ route('portal.contributions.approved') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-gift"></em></span>
                        <span class="nk-menu-text">Approved Contributions</span>
                    </a>
                </li> --}}
                {{-- <li class="nk-menu-item">
                    <a href="{{ route('portal.contributions.all') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-gift"></em></span>
                        <span class="nk-menu-text">Search Contributions</span>
                    </a>
                </li> --}}
            </ul>
        </li>

        <li class="nk-menu-item has-sub">
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
                {{-- <li class="nk-menu-item">
                    <a href="{{ route('portal.events.pending') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-calendar-alt"></em></span>
                        <span class="nk-menu-text">Pending Events</span>
                    </a>
                </li> --}}
                {{-- <li class="nk-menu-item">
                    <a href="{{ route('portal.events.all') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-calendar-alt"></em></span>
                        <span class="nk-menu-text">Search Events</span>
                    </a>
                </li> --}}
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
                {{-- <li class="nk-menu-item">
                    <a href="{{ route('portal.users.all') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                        <span class="nk-menu-text">Search Users</span>
                    </a>
                </li> --}}
            </ul>
        </li>

        <li class="nk-menu-item has-sub">
            <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle">
                <span class="nk-menu-icon"><em class="icon ni ni-reports"></em></span>
                <span class="nk-menu-text">Reports</span>
            </a>
             <li class="nk-menu-item">
                    <a href="{{ route('portal.reports.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                        <span class="nk-menu-text">Reports </span>
                    </a>
                </li>

        </li>

    </ul>
</div>
