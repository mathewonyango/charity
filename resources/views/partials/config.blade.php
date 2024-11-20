<div class="nk-sidebar-menux">
    <ul class="nk-menu">
		@if(auth()->user()->role === 'admin')
            <li class="nk-menu-heading">
                <h6 class="overline-title">Users & Roles Management</h6>
            </li>
        @else @endif
        <li class="nk-menu-item has-sub">
			@if(auth()->user()->role === 'admin')
                <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle" data-original-title title>
                <span class="nk-menu-icon">
                    <em class="icon ni ni-files"></em>
                </span>
                    <span class="nk-menu-text">Configuration Management</span>
                </a>
            @else @endif
            <ul class="nk-menu-sub">
				@if(auth()->user()->role === 'admin')
                    <li class="nk-menu-item">
                        <a href="{{route('portal.users.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                            <span class="nk-menu-text"> Users</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('portal.users.all') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-share-alt"></em></span>
                            <span class="nk-menu-text">Search User</span>
                        </a>
                    </li>

                @else @endif
            </ul>
        </li>
    </ul>
</div>
