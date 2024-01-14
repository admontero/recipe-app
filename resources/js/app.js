import './bootstrap';

import Alpine from 'alpinejs';
import Autosize from '@marcreichel/alpine-autosize';

Alpine.plugin(Autosize);

window.Alpine = Alpine;

Alpine.start();

import TomSelect from 'tom-select';

window.TomSelect = TomSelect;

import Quill from 'quill';

window.Quill = Quill;

import flatpickr from 'flatpickr';

window.flatpickr = flatpickr;
