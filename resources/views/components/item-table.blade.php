@props(['items'])

<table class="table table-striped table-hover">
    <thead>
        <th>Beer</th>
        <th>Style</th>
        <th>Brewery</th>
        <th>Container</th>
        <th>Best By</th>
    </thead>
    <tbody class="table-group-divider">
        @foreach ($items as $item)
            <tr>
                <td>
                    <a class="text-decoration-none fw-semibold text-dark" href="/items/{{ $item->id }}/edit">
                        {{ $item->beer->name }}
                    </a>
                </td>
                <td>{{ $item->beer->style->name ?? 'N/A' }}</td>
                <td>{{ $item->beer->brewery->name ?? 'N/A' }}</td>
                <td>{{ $item->container->type }} {{ $item->container->capacity }} ml</td>
                <td title="{{ $item->expiration_date->format('Y-m-d') }}">
                    {{ $item->expiration_date->diffForHumans() }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
