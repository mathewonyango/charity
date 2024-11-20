<div class="nk-sidebar-menux mt-4">
    <ul class="nk-menu">
        <li class="nk-menu-heading">
            <h6 class="overline-title">Logs</h6>
        </li>
        
        @if(auth()->check() && auth()->user()->type === 'super-admin')
            <li class="nk-menu-item">
                <a href="{{ route('logs') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-bars"></em></span>
                    <span class="nk-menu-text">Activity Logs</span>
                </a>
            </li>
        @else @endif
    </ul>
</div>