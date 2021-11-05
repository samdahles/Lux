<div class="window-content settings">
    <div class="vacontainer">
        <span class="message"></span>
        <form name="enablePasswordForm" action="./endpoint/set" target="dummyframe">
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
        <form name="setPasswordForm" action="./endpoint/set">
            <input type="hidden" name="type" value="setpass" />
            <input type="hidden" name="code" class="code entry-A" value="0000" />
            <input type="hidden" name="oldcode" class="code entry-B" value="0000" />
            <span class="description">Your new code</span>
            <div class="row">
                <input type="number" maxlength="1" min="0" class="codeentry entry-A-1" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-A-2" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-A-3" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-A-4" placeholder="_" />
            </div>
            <span class="description">Your old code</span>
            <div class="row">
                <input type="number" maxlength="1" min="0" class="codeentry entry-B-1" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-B-2" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-B-3" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-B-4" placeholder="_" />
            </div>

            <button type="submit">Set access code</button>
        </form>
    </div>
</div>