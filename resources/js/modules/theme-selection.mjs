function setTheme(theme) {
    var selectedTheme = theme;
    var body = document.body;
    document.getElementById('themeIcon').className = '';
    var iconClasses = 'bi ';

    var themeOtions = document.getElementsByClassName('theme-dd-option');
    for (var i = 0; i < themeOtions.length; i++) {
        themeOtions.item(i).classList.remove('active');
    }

    if (theme == 'dark') {
        iconClasses += 'bi-moon-stars-fill';
        body.dataset.bsTheme = theme;
        document.getElementById('darkThemeOption').classList.add('active');
    } else if (theme == 'light') {
        iconClasses += 'bi-brightness-high-fill';
        body.dataset.bsTheme = theme;
        document.getElementById('lightThemeOption').classList.add('active');
    } else if (theme == 'os') {
        iconClasses += 'bi-circle-half';
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            body.dataset.bsTheme = 'dark';
            selectedTheme = 'dark';
        } else {
            body.dataset.bsTheme = 'light';
            selectedTheme = 'light';
        }
        document.getElementById('osThemeOption').classList.add('active');
    }

    document.getElementById('themeValue').value = selectedTheme;
    document.getElementById('themeIcon').className = iconClasses;
    localStorage.setItem('theme', theme);
}

export { setTheme };