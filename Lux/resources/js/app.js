const $ = require('jquery');

import JSONRequest from './JSONRequest';
import Settings from './Settings';
import HSL from './HSL';

require('./bootstrap');

let settings;
let hsl;

$(window).on('load', () => {
    settings = new Settings();
    hsl = new HSL(settings.get());
});