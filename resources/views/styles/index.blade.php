<x-layout>

    <x-success-msg />

    <x-container title="Styles" :button="['endpoint' => '/styles/add', 'text' => 'Add']">
        <div class="row mt-4">
            @foreach ($styles as $style)
                <x-style-card :style="$style"></x-style-card>
            @endforeach
        </div>

        {{ $styles->links() }}
    </x-container>
</x-layout>
