<!-- Navbar Start -->
@include('admin.layouts.navbar')
<!-- Navbar End -->

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">{{ __('Stisla') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">{{ __('St') }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">{{ __('Dashboard') }}</li>
            <li class="{{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>{{ __('Dashboard') }}</span></a>
            </li>
            <li class="menu-header">{{ __('Settings') }}</li>
            <li class="{{ Request::is('admin/language*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.language.index') }}"><i class="fas fa-language"></i> <span>{{ __('Languages') }}</span></a>
            </li>
        </ul>
    </aside>
</div>