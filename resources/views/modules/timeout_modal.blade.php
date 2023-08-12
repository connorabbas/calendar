<div class="modal fade" id="timeoutModal" tabindex="-1" aria-labelledby="timeOutModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="timeOutModalLabel">Timeout Warning</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning mb-0" role="alert">
                    Your session will automatically be logged out in one minute.
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="keepLoggedInBtn" onclick="window.keepLoggedIn()">
                    Keep me signed in
                </button>
            </div>
        </div>
    </div>
</div>