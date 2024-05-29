<div class="col-md-4 mb-3">
    <div class="card border shadow-sm h-100">
        <div class="card-body">
            <div class="d-flex flex-row align-items-center h-100">
                <div class="col me-5">
                    <h4>{{ $brewery->name }}</h4>
                    <p>{{ $brewery->country }}</p>
                </div>
                <div class="col">
                    @php
                        $logoUrl = $brewery->logo ? Storage::url($brewery->logo) : '/imgs/hop.svg';
                    @endphp

                    <img src="{{ $logoUrl }}" class="img-fluid object-fit-contain" />
                </div>
            </div>
        </div>
        @can('update', $brewery)
            <div class="card-footer border-0 p-0 mx-0 text-bg-light">
                <div class="d-grid">
                    <div class="btn-group" role="group">
                        <button class="btn btn-light border-top border-end text-danger text-opacity-75" form="delete-form">
                            Delete
                        </button>
                        <a href="/breweries/{{ $brewery->id }}/edit"
                            class="btn btn-light border-top border-start text-primary text-opacity-75">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        @endcan
    </div>

    <form method="POST" action="/breweries/{{ $brewery->id }}" id="delete-form" class="d-none">
        @csrf
        @method('delete')
    </form>
</div>
