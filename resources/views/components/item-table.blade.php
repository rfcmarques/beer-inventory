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
                    @can('update', $item)
                        <x-modal-button class="btn" target="#modal{{ $item->id }}">
                            <i class="fa-solid fa-beer-mug-empty"></i>
                        </x-modal-button>
                    @endcan
                </td>
            </tr>

            @can('update', $item)
                <x-modal id="modal{{ $item->id }}">
                    <x-slot:header>Register new consumption</x-slot:header>

                    <x-form.form action="/items/{{ $item->id }}/consume" method="put">
                        <div class="mb-3">
                            <x-form.input class="mb-3" label="Date of Consumption" name="consumed_at" type="date" />
                        </div>
                    </x-form.form>
                </x-modal>
            @endcan
        @endforeach
    </tbody>
</table>
