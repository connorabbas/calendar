import { setTheme } from '../js/modules/theme-selection.mjs';
import * as bootstrap from 'bootstrap';

// set the site theme
var siteTheme = (localStorage.getItem('theme') != null)
    ? localStorage.getItem('theme')
    : 'os';
setTheme(siteTheme);

// give window access
window.setTheme = setTheme;
window.bootstrap = bootstrap;