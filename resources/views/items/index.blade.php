<x-layout>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Inventory</h1>
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
                                    <td>{{ $item->beer->style->style }}</td>
                                    <td>{{ $item->beer->brewery->name }}</td>
                                    <td>{{ $item->container }}</td>
                                    <td>{{ $item->expiration_date }}</td>
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
