@extends('layouts.main')

@section('content')
<div class="window-content settings">
    <div class="vacontainer">
        <span class="message"></span>
        <form class="flexparent" name="enablePasswordForm" action="./endpoint/set" target="dummyframe">
            <input type="hidden" name="type" value="enablepass" />
            <div class="row">
                <label for="enablePassword">Enable access code</label>
                <label class="switch">
                    <input type="checkbox" oninput="submitForm(this)" class="enablePassword" name="enablePassword">
                    <span class="slider round"></span>
                </label>
                <input type="submit" class="hiddenSubmit" />
            </div>
        </form>
        <form class="flexparent" name="setPasswordForm" action="./endpoint/set">
            <input type="hidden" name="type" value="setpass" />
            <input type="hidden" name="code" class="code entry-A" value="0000" />
            <input type="hidden" name="oldcode" class="code entry-B" value="0000" />
            <div class="row">
                <span class="description">Your new code</span>
                <input type="number" maxlength="1" min="0" class="codeentry entry-A-1" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-A-2" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-A-3" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-A-4" placeholder="_" />
            </div>
            <div class="row">
                <span class="description">Your old code</span>
                <input type="number" maxlength="1" min="0" class="codeentry entry-B-1" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-B-2" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-B-3" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-B-4" placeholder="_" />
            </div>
            <div class="row">
                <span class="description">Set access code</span>
                <button type="submit">Save</button>
            </div>
        </form>
        <div class="flexparent IOHandlerbox">
            <div class="item">
                <span class="address">
                    <input onkeyup="checkForEnterClick(event, $('.fas.fa-plus-circle'));" type="text" class="address" placeholder="XXX.XXX.X.XX" title="Enter the IP Address or hostname of the IO Handler."/>
                </span>
                <span class="info IOHandlerAddressHelp"><i class="fas fa-question-circle"></i></span>
                <i onclick="addIOHandler(this.parentNode);" class="fas fa-plus-circle"></i>
            </div>
            <div class="scrollbox">
            </div>
        </div>
    </div>
</div>
@endsection