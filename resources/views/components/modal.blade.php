@props(['header' => false, 'footer' => false, 'id'])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            @if ($header)
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabel">
                        {{ $header }}
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            @endif

            <div class="modal-body">
                {{ $slot }}
            </div>

            @if ($footer)
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            @endif
        </div>
    </div>
</div>
