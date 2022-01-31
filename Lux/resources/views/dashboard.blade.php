@extends('layouts.main')

@section('content')
<div class="window-content dashboard">
    <div class="lightbox">
        <div class="lightbutton" @if($hsl[3])style="background-color: hsl({{$hsl[0] . ', ' . $hsl[1] . '% ,' . $hsl[2] . '%'}})" @endif>
            <div class="lightbulb"></div>
        </div>
    </div>

    <div class="controlbox">
        <form id="lightControl">
            <input type="hidden" class="forwardCode" />
            <input type="hidden" name="type" value="hsl" />
            <input type="hidden" id="lightControlIsOn" name="isOn" value="true" />
            <div class="row">
                <a>Hue (<span id="hueDegrees">{{ $hsl[0] }}</span>&deg;)</a>
                <input type="range" value="{{ $hsl[0] }}" step="1" min="0" max="359" name="h" class="hue" />
            </div>
            <div class="row">
                <a>Saturation (<span id="saturationPercentage">{{ $hsl[1] }}</span>%)</a>
                <input type="range" value="{{ $hsl[1] }}" step="1" min="0" max="100" name="s" class="saturation" />
            </div>
            <div class="row">
                <a>Luminosity (<span id="luminosityPercentage">{{ $hsl[2] }}</span>%)</a>
                <input type="range" value="{{ $hsl[2] }}" step="5" min="0" max="100" name="l" class="luminosity" />
            </div>
        </form>
    </div>
</div>
@endsection