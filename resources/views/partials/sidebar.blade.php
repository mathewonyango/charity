<div class="nk-sidebar-element">
    <div class="nk-sidebar-body" data-simplebar>
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-widget d-xl-block">
                <div class="user-account-info between-center">
                </div>
            </div>

            {{-- @include('partials.config') --}}
            @include('partials.menu')
            @include('partials.statement-menu')
            @include('partials.logs')

            <div class="nk-sidebar-footer">
                <ul class="nk-menu nk-menu-footer">
                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-help-alt"></em></span>
                            <span class="nk-menu-text">Support</span>
                        </a>
                    </li>
                    <li class="nk-menu-item ml-auto">

                        <a href="{{route('logout')}}" class="nk-menu-link " data-offset="0,10">
                            <span class="nk-menu-icon"><em class="icon ni ni-signout"></em></span>
                            <span class="nk-menu-text">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
