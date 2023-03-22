<div class="modal fade" id="delete-modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="delete-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark">
            <form method="POST" action="" name="delete-form" id="delete-form" autocomplete="nope">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="delete-modal-label">{{ __('common.delete') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('common.are-you-sure-you-want-to-delete') }} <strong><u id="delete-record"></u></strong>?</p>
                </div>
                <div class="modal-footer">
                    <div class="btn-group w-100" role="group" aria-label="{{ __('common.processes') }}">
                        <button type="button" class="btn btn-danger w-25" data-bs-dismiss="modal">{{ __('common.close') }}</button>
                        <button type="submit" class="btn btn-success w-75" id="confirm-button" disabled>{{ __('common.delete') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="module">
    const deleteModal = document.getElementById('delete-modal');
    let waitForSeconds = 5;
    const confirmButton = deleteModal.querySelector('#confirm-button');
    var countdown;
    deleteModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        if(button) {
            document.getElementById('delete-form').action = button.getAttribute('data-route');
            deleteModal.querySelector('#delete-record').textContent = button.getAttribute('data-record');
            countdown = setInterval(function() {
                confirmButton.innerHTML = '{{ __('common.delete') }} (' + (--waitForSeconds) + ')';
                if (waitForSeconds <= 0) {
                    confirmButton.innerHTML = '{{ __('common.delete') }}';
                    confirmButton.removeAttribute('disabled');
                }
            }, 1000);
        }
        confirmButton.innerHTML = '{{ __('common.delete') }} (' + (waitForSeconds) + ')';
    })
    deleteModal.addEventListener('hide.bs.modal', event => {
        waitForSeconds = 5;
        clearInterval(countdown);
        const confirmButton = deleteModal.querySelector('#confirm-button');
        confirmButton.setAttribute('disabled', 'disabled');
    })
</script>
