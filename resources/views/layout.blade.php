<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body class="nk-body npc-crypto has-sidebar has-sidebar-fat ui-clean ">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- sidebar @s -->
        <div class="nk-sidebar nk-sidebar-fat nk-sidebar-fixed" data-content="sidebarMenu">
            <div class="nk-sidebar-element nk-sidebar-head">
                <div class="nk-sidebar-brand">
                    <a href="{{route('portal.dashboard')}}" class="logo-link nk-sidebar-logo">

                        <span class="nio-version d-none">Donate<span>
                    </a>

                </div>
                <div class="nk-menu-trigger mr-n2">
                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                            class="icon ni ni-arrow-left"></em></a>
                </div>
            </div><!-- .nk-sidebar-element -->

        @include('partials.sidebar')
        <!-- .nk-sidebar-element -->
        </div>
        <!-- sidebar @e -->
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <div class="nk-header nk-header-fluid nk-header-fixed is-light">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger d-xl-none ml-n1">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em
                                    class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-news d-none d-xl-block">
                            <div class="nk-news-list">
                                <a class="nk-news-item" href="#">
                                    <div class="nk-news-icon">
                                        <em class="icon ni ni-card-view"></em>
                                    </div>
                                    <div class="nk-news-text">
                                        <p>Charity Contribution!<span>   &nbsp; &nbsp; &nbsp; &nbsp; </span>
                                        </p>
                                        <em class="icon ni ni-external"></em>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                @if(auth()->user()->image !== null)
                                                <img id="imageIcon" src="{{ url('/storage/'. auth()->user()->image) }}" class="avatar-lg rounded-circle"/>
                                                @else
                                                <em class="icon ni ni-user-alt"></em>
                                                @endif
                                            </div>
                                            <div class="user-info d-none d-md-block">
                                                <div class="dropdown-indicator">{{ auth()->user()->email }}</div>
                                                <div class="user-status text-muted">{{ auth()->user()->role }}</div>
                                            </div>
                                        </div>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                    <span>{{ (auth()->user()->email) }}</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{ auth()->user()->email}}</span>
                                                    <span class="sub-text">{{ auth()->user()->role }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li>
                                                    <a href="{{ route('portal.users.show') }}">
                                                        <em class="icon ni ni-user-alt"></em><span>View Profile</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('portal.users.settings', auth()->user()->id) }}">
                                                        <em class="icon ni ni-setting-alt"></em><span>Account Setting</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li>
                                                    <a href="{{route('logout')}}">
                                                        <em class="icon ni ni-signout"></em>
                                                        <span>Sign out</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main header @e -->
            <!-- content @s -->

        @yield('content')
        @include('sweetalert::alert')
        <!-- content @e -->
            <!-- footer @s -->

        @include('partials.footer')
        <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- main @e -->
</div>
<!-- app-root @e -->

@include('partials.scripts')

@yield('custom-scripts')

</body>

</html>
