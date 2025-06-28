<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <div class="mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('admin/assets/images/avatar/avatar.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::guard('admin')->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('admin.profile.index') }}" class="dropdown-item has-icon"> <i class="far fa-user"></i> {{ __('Profile') }} </a>
                <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i> {{ __('Settings') }} </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }} </a>
                </form>
            </div>
        </li>
    </ul>
</nav>