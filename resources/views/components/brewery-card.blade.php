<div class="col-md-4 mb-3">
    <div class="card shadow-sm h-100">
        <div class="card-body">
            <div class="d-flex flex-row align-items-center h-100">
                <div class="col me-5">
                    <h4>{{ $brewery->name }}</h4>
                    <p>{{ $brewery->country }}</p>
                </div>
                <div class="col">
                    <img src="https://www.doiscorvos.pt/images/Logo_DoisCorvos2020_Black.png"
                        class="img-fluid object-fit-contain" />
                </div>
            </div>
        </div>
        <div class="card-footer border-0 p-0 mx-0 text-bg-light">
            <div class="d-grid">
                <div class="btn-group" role="group">
                    <button class="btn btn-light border-top border-end text-danger" form="delete-form">
                        Delete
                    </button>
                    <a href="/breweries/{{ $brewery->id }}/edit"
                        class="btn btn-light border-top border-start text-primary">
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="/breweries/{{ $brewery->id }}" id="delete-form" class="d-none">
        @csrf
        @method('delete')
    </form>
</div>
