@props(['style'])

<div class="col-lg-4 col-md-6 mb-4">
    <div class="card rounded-4 border-4 border-warning shadow-sm mb-3 h-100">
        <div class="card-body p-0">
            <div class="d-flex flex-row align-items-center h-100">
                <div class="d-flex align-items-center justify-content-center bg-warning h-100" style="width: 10rem">
                    <img src="/imgs/hop.svg" style="width: 3rem; filter: brightness(0) invert(1);">
                </div>
                <div class="d-flex align-items-center ps-3 h-100  w-100">
                    <span class="lead fw-medium me-auto">{{ $style->name }}</span>
                    @can(['update', 'delete'], $style)
                        <div class="dropdown-center">
                            <a class="me-4 text-decoration-none text-secondary" data-bs-toggle="dropdown"
                                aria-expanded="false" href="">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="/styles/{{ $style->id }}/edit">
                                        Edit
                                    </a>
                                </li>
                                <li>
                                    <form action="/styles/{{ $style->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="dropdown-item" type="submit">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
