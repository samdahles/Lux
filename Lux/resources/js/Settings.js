const $ = require('jquery');

import JSONRequest from './JSONRequest';

class Settings {
    _settings = null;

    constructor() {
        this.refresh();
    }

    refresh() {
        this._settings = JSONRequest.get('/api/settings');
    }

    get() {
        return this._settings;
    }
}

export default Settings;