import './bootstrap';

import Alpine from 'alpinejs';
import Autosize from '@marcreichel/alpine-autosize';
import flatpickr from 'flatpickr';
import Quill from 'quill';
import TomSelect from 'tom-select';
import * as numerous from 'numerous';

import enLocale from 'numerous/locales/en';
import esLocale from 'numerous/locales/es';

Alpine.plugin(Autosize);

window.Alpine = Alpine;

Alpine.start();

window.TomSelect = TomSelect;

window.Quill = Quill;

window.flatpickr = flatpickr;

window.numerous = numerous;

numerous.registerLocale([
    enLocale,
    esLocale,
]);
