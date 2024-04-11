<div class="row mb-3">
    <div class="col-12">
        <div class="card card border-1 shadow">
            <div class="card-body d-flex">
                <div class="me-auto">
                    <h3 class="fw-semibold">{{ $beer->name }}</h3>
                    <h4>{{ $beer->brewery->name }}</h4>
                    <h5 class="fw-light">{{ $beer->style->name }}</h5>
                </div>
                <div class="dropdown-center">
                    <a class="text-decoration-none text-secondary" data-bs-toggle="dropdown" aria-expanded="false"
                        href="">
                        <i class="fa-solid fa-ellipsis"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/beers/{{ $beer->id }}/edit">
                                Edit
                            </a>
                        </li>
                        <li>
                            <form action="/beers/{{ $beer->id }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="dropdown-item" type="submit">Delete</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
