<div class="window-content link">
    <div class="vacontainer">   
        <span class="message"></span>
        <form class="flexparent" name="enableLinkForm" action="./endpoint/set" target="dummyframe">
            <input type="hidden" name="type" value="forwardenable" />
            <div class="row">
                <label for="enablePassword">Enable Link</label>
                <label class="switch">
                    <input type="checkbox" oninput="submitForm(this)" class="enableForward" name="enableForward">
                    <span class="slider round"></span>
                </label>
                <input type="submit" class="hiddenSubmit" />
            </div>
        </form>
        <form class="flexparent" name="setForwardingAddressForm" action="./endpoint/set" target="dummyframe">
            <input type="hidden" name="type" value="forwardaddress" />
            <div class="row">
                <label for="enablePassword">Linking Address</label>
                <span class="info forwardingAddressHelp"><i class="fas fa-question-circle"></i></span>
                <input type="text" name="address" class="forwardingAddress" />
            </div>
        </form>
        <form class="flexparent" name="setForwardCodeForm" action="./endpoint/set" target="dummyframe">
            <input type="hidden" name="type" value="forwardcode" />
            <input type="hidden" name="code" class="code entry-A" value="0000" />
            <div class="row">
                <span class="description">Other user's access code</span>
                <input type="number" maxlength="1" min="0" class="codeentry entry-A-1" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-A-2" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-A-3" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-A-4" placeholder="_" />
            </div>
        </form>

        <button class="submitAllFormsButton">Save settings</button>

    </div>
</div>