@extends('layouts.app')

@section('body')
<iframe id="dummyframe" title="dummyframe" name="dummyframe" height="0" width="0"></iframe>
<div class="minheight-notifier overlaynotification">
    <div class="vacontainer">
        <div class="notificationbox">
            <div class="icon"></div>
            <span>Please rotate your device to use this application.</span>
        </div>
    </div>
</div>

<div class="menu-container divider">
    <div class="menu">
        <div class="menu-title">
            <span class="title-icon">&nbsp;</span>
            <span class="title-name">Lux</span>
        </div>
        <div class="menu-items">
            <a class="menu-item menu-dashboard @if(Route::currentRouteName() == 'dashboard') active @endif" href="{{ route('dashboard') }}">
                <span class="menu-icon"><i class="fas fa-sliders-h"></i></span>
                <span class="menu-name">Dashboard</span>
            </a>
            <a class="menu-item menu-broadcast @if(Route::currentRouteName() == 'broadcast') active @endif" href="{{ route('broadcast') }}">
                <span class="menu-icon"><i class="fas fa-broadcast-tower"></i></span>
                <span class="menu-name">Broadcasting</span>
            </a>
            <a class="menu-item menu-settings @if(Route::currentRouteName() == 'settings') active @endif" href="{{ route('settings') }}">
                <span class="menu-icon"><i class="fas fa-cogs"></i></span>
                <span class="menu-name">Settings</span>
            </a>
            <a class="menu-item menu-link @if(Route::currentRouteName() == 'link') active @endif" href="{{ route('link') }}">
                <span class="menu-icon"><i class="fas fa-link"></i></span>
                <span class="menu-name">Link</span>
            </a>
            <a class="menu-item menu-updates @if(Route::currentRouteName() == 'updates') active @endif" href="{{ route('updates') }}">
                <span class="menu-icon"><i class="fas fa-sync-alt"></i> </span>
                <span class="menu-name">Updates</span>
            </a>
            <a class="menu-item menu-about @if(Route::currentRouteName() == 'about') active @endif" href="{{ route('about') }}">
                <span class="menu-icon"><i class="fas fa-info-circle"></i></span>
                <span class="menu-name">About</span>
            </a>

            @if(\app\Http\Controllers\API\APIController::authNeeded())
            <a class="menu-item menu-exit" href="{{ route('logout') }}">
                <span class="menu-icon"><i class="fas fa-sign-out-alt"></i></span>
                <span class="menu-name">Logout</span>
            </a>
            @endif
        </div>
    </div>
</div>

<div class="window divider">
    <a class="menubutton"><i class="fas fa-chevron-left"></i> Menu</a>
    @yield('content')
</div>

@endsection
