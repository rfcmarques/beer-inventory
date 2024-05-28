@props(['items'])

<table class="table table-striped table-hover">
    <thead>
        <th>Beer</th>
        <th>Style</th>
        <th>Brewery</th>
        <th>Container</th>
        <th>Best By</th>
        <th></th>
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
                <td>
                    <form action="/items/{{ $item->id }}/consume" method="post">
                        @csrf
                        @method('put')
                        <button class="dropdown-item" type="submit">
                            <i class="fa-solid fa-beer-mug-empty"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
