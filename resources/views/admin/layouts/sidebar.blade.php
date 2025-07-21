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
            <li class="{{ activeMenu(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>{{ __('Dashboard') }}</span></a>
            </li>
            <li class="menu-header">{{ __('Posts') }}</li>
            <li class="{{ activeMenu(['admin.categories.*']) }}">
                <a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="fas fa-list"></i> <span>{{ __('Categories') }}</span></a>
            </li>
            <li class="dropdown {{ activeMenu(['admin.news.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-newspaper"></i> <span>{{ __('News') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ activeMenu(['admin.news.*']) }}"><a class="nav-link" href="{{ route('admin.news.index') }}">{{ __('All News') }}</a></li>
                </ul>
            </li>
            <li class="menu-header">{{ __('Features') }}</li>
            <li class="{{ activeMenu(['admin.subscribers*']) }}">
                <a class="nav-link" href="{{ route('admin.subscribers') }}"><i class="fas fa-user-friends"></i> <span>{{ __('Subscribers') }}</span></a>
            </li>
            <li class="dropdown {{ activeMenu(['admin.roles.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user-cog"></i> <span>{{ __('Permissions') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ activeMenu(['admin.roles.*']) }}"><a class="nav-link" href="{{ route('admin.roles.index') }}">{{ __('Roles') }}</a></li>
                </ul>
            </li>
            <li class="menu-header">{{ __('Settings') }}</li>
            <li class="{{ activeMenu(['admin.languages.*']) }}">
                <a class="nav-link" href="{{ route('admin.languages.index') }}"><i class="fas fa-language"></i> <span>{{ __('Languages') }}</span></a>
            </li>
            <li class="{{ activeMenu(['admin.settings.home']) }}">
                <a class="nav-link" href="{{ route('admin.settings.home') }}"><i class="fas fa-home"></i> <span>{{ __('Home') }}</span></a>
            </li>
            <li class="dropdown {{ activeMenu(['admin.social-platform.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th-list"></i> <span>{{ __('Footer') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ activeMenu(['admin.social-platform.*']) }}"><a class="nav-link" href="{{ route('admin.social-platform.index') }}">{{ __('Social Platform') }}</a></li>
                </ul>
            </li>
            <li class="{{ activeMenu(['admin.social-media.*']) }}">
                <a class="nav-link" href="{{ route('admin.social-media.index') }}"><i class="fas fa-share-alt"></i> <span>{{ __('Social Media') }}</span></a>
            </li>
            <li class="{{ activeMenu(['admin.settings.advertisements']) }}">
                <a class="nav-link" href="{{ route('admin.settings.advertisements') }}"><i class="fas fa-ad"></i> <span>{{ __('Advertisements') }}</span></a>
            </li>
        </ul>
    </aside>
</div>