@extends('layouts.main')

@section('content')
<div class="window-content broadcast">
    <div class="support">

        @if(request()->secure())
        <div>
            <p>Sync your screen to the lights</p>
        </div>
        <div>
            <button class="capture-button" type="button">Start capture</button>
        </div>
        <div class="averagecolor">
            <video class="broadcast-dump" autoplay></video>
            <span class="currentcolor"></span>
            <div class="disablednotice">
                <div>
                    <p>Your screen is still broadcasting!</p>
                    <p>Click the screen to view the video.</p>
                </div>
            </div>
        </div>
        @else
            <div>
                <p>This page requires HTTPS to work. Please visit this page again using <a href="https://{{ substr(Request::root(), 7) }}">this link</a>.</p>
            </div>
        @endif

    </div>    
</div>
@endsection