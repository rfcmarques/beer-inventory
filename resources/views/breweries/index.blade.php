<x-layout>
    <x-success-msg />

    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <h1 class="card-title me-auto">Breweries List</h1>
                <a href="/breweries/create" class="btn btn-primary">Add</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($breweries as $brewery)
                    <div class="col-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-5">
                                        <i class="fa-solid fa-font-awesome fa-2xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="card-title">{{ $brewery->name }}</h4>
                                        <p>{{ $brewery->country }}</p>
                                    </div>
                                    <div class="d-flex flex-column align-items-center ms-auto">
                                        <a href="/breweries/{{ $brewery->id }}/edit">
                                            <i class="fa-solid fa-pen-to-square text-primary"></i>
                                        </a>
                                        <form action="/breweries/{{ $brewery->id }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-link text-decoration-none" type="submit">
                                                <i class="fa-solid fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
