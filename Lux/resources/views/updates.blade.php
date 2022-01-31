@extends('layouts.main')

@section('content')
<div class="window-content updates">
    <div class="container">
        <div class="titlebox">
            <div class="icon">
                <i class="fas fa-check"></i>
                <i class="fas fa-download"></i>
            </div>
        </div>
        <div class="infobox">
            <div class="subtitle">The system is up-to-date.</div>
            <div class="subtitle update">There is an update available.</div>
            <div class="versioninfo">
                <a class="latest">Latest Version: <span class="latestVersion">0</span></a>
                <a class="current">Current Version: <span class="currentVersion">0</span></a>
            </div>
        </div>
        <div class="buttonbox">
            <a href="#">Download Lux <span class="latestVersion">0</span></a>
        </div>
    </div>
</div>
@endsection