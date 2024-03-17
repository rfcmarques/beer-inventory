<x-layout>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Styles List</h1>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($styles as $style)
                    <div class="col-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-5">
                                        <i class="fa-solid fa-font-awesome fa-2xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="card-title">{{ $style->style }}</h4>
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
