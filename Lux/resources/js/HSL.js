const $ = require('jquery');

import JSONRequest from './JSONRequest';

class HSL {
    _settings;
    _updater;

    constructor(settings) {
        this._settings = settings;
        this._updater = setInterval(async () => {
            if(this._settings['synchronization']['enabled']) {
                this._settings.refresh();
            }
        }, this._settings['synchronization']['timeout']);
        this._registerEventHandlers();
    }


    _registerEventHandlers() {
        $('#lightControl .hue, #lightControl .saturation, #lightControl .luminosity').on('input', () => this._inputEvent(true));
        $('#lightControl .hue, #lightControl .saturation, #lightControl .luminosity').on('change', () => this._inputEvent(false));
    }

    _inputEvent(doSend) {
        if(this._settings['hsl']['isOn']) {
            this.updateFromUI();
            if(doSend) this.updateAPI();
        }
    }

    updateAPI() {
        this.updateFromUI();
        JSONRequest.post('/api/hsl/' + this._settings['hsl']['hue'] + '-' 
            + this._settings['hsl']['saturation'] + '-' 
            + this._settings['hsl']['luminosity'] + '-' 
            + this._settings['hsl']['isOn']);
    }

    updateFromUI() {
        this._settings['hsl']['hue'] = $("#lightControl .hue").val();
        this._settings['hsl']['saturation'] = $("#lightControl .saturation").val();
        this._settings['hsl']['luminosity'] = $("#lightControl .luminosity").val();
        this._settings['hsl']['isOn'] = $("#lightControl #lightControlIsOn").val();
        this.updateUIComponents();
    }

    updateUIComponents() {
        $("#hueDegrees").text(this._settings['hsl']['hue']);
        $("#saturationPercentage").text(this._settings['hsl']['saturation']);
        $("#luminosityPercentage").text(this._settings['hsl']['luminosity']);
    }

    updateToUI() {
        $("#lightControl .hue").val(this._settings['hsl']['hue']);
        $("#lightControl .saturation").val(this._settings['hsl']['saturation']);
        $("#lightControl .luminosity").val(this._settings['hsl']['luminosity']);
        $("#lightControl #lightControlIsOn").val(this._settings['hsl']['isOn']);
        this.updateUIComponents();
    }
}

export default HSL;