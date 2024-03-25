<x-layout>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <h1 class="card-title me-auto">Beers List</h1>
                <a href="" class="btn btn-primary">Add</a>
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
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($beers as $beer)
                                <tr>
                                    <td>{{ $beer->name }}</td>
                                    <td>{{ $beer->brewery->name }}</td>
                                    <td>{{ $beer->style->style }}</td>
                                    <td>{{ $beer->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-layout>
