<div class="window-content settings">
    <div class="vacontainer">
        <form name="enablePasswordForm" action="./endpoint/set" target="dummyframe">
            <input type="hidden" name="type" value="enablepass" />
            <div class="row">
                <label for="enablePassword">Enable access code</label>
                <label class="switch">
                    <input type="checkbox" onchange="this.form.submit();" class="enablePassword" name="enablePassword">
                    <span class="slider round"></span>
                </label>
            </div>
        </form>
    </div>
</div>