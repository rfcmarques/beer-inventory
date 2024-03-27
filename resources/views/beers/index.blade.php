<x-layout>
    <x-success-msg />

    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <h1 class="card-title me-auto">Beers List</h1>
                <a href="/beers/create" class="btn btn-primary">Add</a>
            </div>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>Name</th>
                            <th>Brewery</th>
                            <th>Style</th>
                            <th>Added at</th>
                            <th></th>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($beers as $beer)
                                <tr>
                                    <td>
                                        <a class="text-decoration-none" href="/beers/{{ $beer->id }}/edit">
                                            {{ $beer->name }}
                                        </a>
                                    </td>
                                    <td>{{ $beer->brewery->name }}</td>
                                    <td>{{ $beer->style->name }}</td>
                                    <td>{{ $beer->created_at }}</td>
                                    <th>
                                        <form action="/beers/{{ $beer->id }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-link text-decoration-none" type="submit">
                                                <i class="fa-solid fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>
