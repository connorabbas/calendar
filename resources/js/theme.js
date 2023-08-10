import { setTheme } from '../js/modules/theme-selection.mjs';

var siteTheme;
if (localStorage.getItem('theme') === null) {
    siteTheme = 'os';
} else {
    siteTheme = localStorage.getItem('theme');
}
setTheme(siteTheme);

window.setTheme = setTheme;