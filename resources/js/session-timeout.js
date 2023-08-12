var session = (window.sessionLifetime * 60);
var warningTime = (session - 60) * 1000;
var logoutTime = session * 1000;
var sessionTimer = window.setTimeout(timeoutWarning, warningTime);
var warningTimer = window.setTimeout(timeoutLogout, logoutTime);
const timeOutModal = new bootstrap.Modal('#timeoutModal', {
    keyboard: false,
});

function timeoutWarning() {
    timeOutModal.show();
}

function timeoutLogout() {
    document.getElementById("logoutForm").submit();
}

function keepLoggedIn() {
    window.clearTimeout(sessionTimer);
    window.clearTimeout(warningTimer);
    sessionTimer = window.setTimeout(timeoutWarning, warningTime);
    warningTimer = window.setTimeout(timeoutLogout, logoutTime);
    timeOutModal.hide();
}

window.keepLoggedIn = keepLoggedIn;