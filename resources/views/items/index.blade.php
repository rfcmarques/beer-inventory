<x-layout>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <h1 class="card-title me-auto">Inventory</h1>
                <a href="" class="btn btn-primary">Add</a>
            </div>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>Beer</th>
                            <th>Style</th>
                            <th>Brewery</th>
                            <th>Container</th>
                            <th>Best By</th>
                            <th>Added At</th>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->beer->name }}</td>
                                    <td>{{ $item->beer->style->name }}</td>
                                    <td>{{ $item->beer->brewery->name }}</td>
                                    <td>{{ $item->container }}</td>
                                    <td>{{ $item->expiration_date->diffForHumans() }}</td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-layout>
