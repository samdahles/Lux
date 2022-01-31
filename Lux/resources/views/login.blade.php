@extends('layouts.app')

@section('head')
<script src="./source/scripts/login.js"></script>

@isset($request->error)
<script>
    $(window).on("DOMContentLoaded", () => {
        displayError("{{ $request->error }}");
    });
</script>
@endisset
@endsection

@section('body')
<div class="vacontainer">
    <span class="message">Please enter your access code.</span>
    <form action="./login" method="POST" target="_self">
        <input type="hidden" class="code" name="code" value="0000" />
        <input type="number" maxlength="1" autofocus min="0" class="codeentry entry-1" placeholder="_" />
        <input type="number" maxlength="1" min="0" class="codeentry entry-2" placeholder="_" />
        <input type="number" maxlength="1" min="0" class="codeentry entry-3" placeholder="_" />
        <input type="number" maxlength="1" min="0" class="codeentry entry-4" placeholder="_" />
    </form>
</div>
@endsection