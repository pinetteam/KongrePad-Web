@props(['method' => 'edit'])
<div class="modal fade" id="edit-modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="edit-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-dark">
            <form method="POST" action="" name="edit-form" id="edit-form" enctype="multipart/form-data">
                @csrf
                <input name="_method" type="hidden" value="PATCH" />
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="edit-modal-label">{{ __('common.edit') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 justify-content-center">
                            @yield('edit-form')
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group w-100" role="group" aria-label="{{ __('common.processes') }}">
                        <button type="button" class="btn btn-danger w-25" data-bs-dismiss="modal">{{ __('common.close') }}</button>
                        <button type="submit" class="btn btn-success w-75">{{ __('common.edit') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="module">
    const editModal = document.getElementById('edit-modal');
    editModal.addEventListener('show.bs.modal', event => {
        if(event.relatedTarget) {
            const button = event.relatedTarget
            let url = button.getAttribute('data-resource')
            fetch(url)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    const resource = data.data;

                    document.getElementById('edit-form').action = resource.route
                    for (const [key, value] of Object.entries(resource)) {
                        if(value['type'] == 'text') {
                            const textElement = editModal.querySelector('#{{ $method }}-' + key);
                            if (textElement !== null) {
                                textElement.value = value['value'];
                            }
                        } else if(value['type'] == 'select') {
                            const selectElement = editModal.querySelector('#{{ $method }}-' + key);
                            if (selectElement !== null) {
                                selectElement.value = value['value'];
                            }
                        } else if(value['type'] == 'radio') {
                            const radioElement = editModal.querySelector('#{{ $method }}-' + key + '-' + value['value']);
                            if (radioElement !== null) {
                                radioElement.setAttribute('checked', 'checked');
                            }
                        }else if(value['type'] == 'checkbox') {
                            value['value'].forEach(title => {
                                const checkElement = editModal.querySelector('#{{ $method }}-' + key + '-' + title.replaceAll('.',"\\."));
                                if (checkElement !== null) {
                                    checkElement.setAttribute('checked', 'checked');
                                }
                            });

                        }
                    }
                })
                .catch();
        }
    })
    editModal.addEventListener('hide.bs.modal', event => {
        const formControl = document.querySelectorAll('.form-control');
        const formCheckInput = document.querySelectorAll('.form-check-input');
        formControl.forEach(element => {
            element.classList.remove("is-invalid");
            element.value = null;
            element.removeAttribute('checked')
        });
        formCheckInput.forEach(element => {
            element.removeAttribute('checked')
        });

    })
</script>
@if($errors->any() && session('method') && session('route'))
    @if(session('method')=='PATCH' || session('method')=='PUT')
        <script type="module">
            new bootstrap.Modal('#edit-modal', {}).show();
            document.getElementById('edit-form').action = '{{ session('route') }}';
        </script>
    @endif
@endif
