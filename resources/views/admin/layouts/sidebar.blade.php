<!-- Navbar Start -->
@include('admin.layouts.navbar')
<!-- Navbar End -->

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">{{ __('backend.Stisla') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">{{ __('backend.St') }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">{{ __('backend.Dashboard') }}</li>
            <li class="{{ activeMenu(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>{{ __('backend.Dashboard') }}</span></a>
            </li>
            @if (canAccess(['Read Category', 'Read News']))
                <li class="menu-header">{{ __('backend.Posts') }}</li>
            @endif
            @if (canAccess(['Read Category']))
                <li class="{{ activeMenu(['admin.categories.*']) }}">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="fas fa-list"></i> <span>{{ __('backend.Categories') }}</span></a>
                </li>
            @endif
            @if (canAccess(['Read News']))
                <li class="dropdown {{ activeMenu(['admin.news.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-newspaper"></i> <span>{{ __('backend.News') }}</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ activeMenu(['admin.news.index', 'admin.news.create', 'admin.news.edit']) }}"><a class="nav-link" href="{{ route('admin.news.index') }}">{{ __('backend.All News') }}</a></li>
                        <li class="{{ activeMenu(['admin.news.pending']) }}"><a class="nav-link" href="{{ route('admin.news.pending') }}">{{ __('backend.Pending News') }}</a></li>
                    </ul>
                </li>
            @endif
            @if (canAccess(['Read Subscriber', 'Read Permission']))
                <li class="menu-header">{{ __('backend.Features') }}</li>
            @endif
            @if (canAccess(['Read Subscriber']))
                <li class="{{ activeMenu(['admin.subscribers*']) }}">
                    <a class="nav-link" href="{{ route('admin.subscribers') }}"><i class="fas fa-user-friends"></i> <span>{{ __('backend.Subscribers') }}</span></a>
                </li>
            @endif
            @if (canAccess(['Read Permission']))
                <li class="dropdown {{ activeMenu(['admin.roles.*', 'admin.users.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user-cog"></i> <span>{{ __('backend.Permissions') }}</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ activeMenu(['admin.roles.*']) }}"><a class="nav-link" href="{{ route('admin.roles.index') }}">{{ __('backend.Roles') }}</a></li>
                        <li class="{{ activeMenu(['admin.users.*']) }}"><a class="nav-link" href="{{ route('admin.users.index') }}">{{ __('backend.Users') }}</a></li>
                    </ul>
                </li>
            @endif
            @if (canAccess(['Read Language', 'Read Platform', 'Read Home', 'Read Social', 'Read Home', 'Read Footer', 'Read Advertisement']))
                <li class="menu-header">{{ __('backend.Settings') }}</li>
            @endif
            @if (canAccess(['Read Language']))
                <li class="{{ activeMenu(['admin.languages.*']) }}">
                    <a class="nav-link" href="{{ route('admin.languages.index') }}"><i class="fas fa-language"></i> <span>{{ __('backend.Languages') }}</span></a>
                </li>
            @endif
            @if (canAccess(['Read Platform']))
                <li class="dropdown {{ activeMenu(['admin.social-platform.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i> <span>{{ __('backend.General') }}</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ activeMenu(['admin.social-platform.*']) }}"><a class="nav-link" href="{{ route('admin.social-platform.index') }}">{{ __('backend.Social Platform') }}</a></li>
                    </ul>
                </li>
            @endif
            @if (canAccess(['Read Home']))
                <li class="{{ activeMenu(['admin.settings.home']) }}">
                    <a class="nav-link" href="{{ route('admin.settings.home') }}"><i class="fas fa-home"></i> <span>{{ __('backend.Home') }}</span></a>
                </li>
            @endif
            @if (canAccess(['Read Footer']))
                <li class="">
                    <a href="" class="nav-link"><i class="fas fa-th-list"></i> <span>{{ __('backend.Footer') }}</span></a>
                </li>
            @endif
            @if (canAccess(['Read Social']))
                <li class="{{ activeMenu(['admin.social-media.*']) }}">
                    <a class="nav-link" href="{{ route('admin.social-media.index') }}"><i class="fas fa-share-alt"></i> <span>{{ __('backend.Social Media') }}</span></a>
                </li>
            @endif
            @if (canAccess(['Read Advertisement']))
                <li class="{{ activeMenu(['admin.settings.advertisements']) }}">
                    <a class="nav-link" href="{{ route('admin.settings.advertisements') }}"><i class="fas fa-ad"></i> <span>{{ __('backend.Advertisements') }}</span></a>
                </li>
            @endif
            <li class="dropdown {{ activeMenu(['admin.localization.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-globe"></i> <span>{{ __('backend.Localization') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ activeMenu(['admin.localization.backend']) }}"><a class="nav-link" href="{{ route('admin.localization.backend') }}">{{ __('backend.Backend App') }}</a></li>
                    <li class="{{ activeMenu(['admin.localization.frontend']) }}"><a class="nav-link" href="{{ route('admin.localization.frontend') }}">{{ __('backend.Frontend App') }}</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>