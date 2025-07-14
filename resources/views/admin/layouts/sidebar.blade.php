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
            <li class="menu-header">{{ __('Posts') }}</li>
            <li class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="fas fa-list"></i> <span>{{ __('Categories') }}</span></a>
            </li>
            <li class="dropdown {{ Request::is('admin/news*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-newspaper"></i> <span>{{ __('News') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/news*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.news.index') }}">{{ __('All News') }}</a></li>
                </ul>
            </li>
            <li class="menu-header">{{ __('Features') }}</li>
            <li class="{{ Request::is('admin/subscribers*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.subscribers') }}"><i class="fas fa-ad"></i> <span>{{ __('Subscribers') }}</span></a>
            </li>
            <li class="menu-header">{{ __('Settings') }}</li>
            <li class="{{ Request::is('admin/languages*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.languages.index') }}"><i class="fas fa-language"></i> <span>{{ __('Languages') }}</span></a>
            </li>
            <li class="{{ Request::is('admin/settings/home*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.settings.home') }}"><i class="fas fa-home"></i> <span>{{ __('Home') }}</span></a>
            </li>
            <li class="{{ Request::is('admin/settings/social-media*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.social-media.index') }}"><i class="fas fa-share-alt"></i> <span>{{ __('Social Media') }}</span></a>
            </li>
            <li class="{{ Request::is('admin/settings/advertisements*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.settings.advertisements') }}"><i class="fas fa-ad"></i> <span>{{ __('Advertisements') }}</span></a>
            </li>
        </ul>
    </aside>
</div>