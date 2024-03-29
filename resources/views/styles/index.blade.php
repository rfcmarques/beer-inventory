<x-layout>

    <x-success-msg />

    <x-container title="Styles List" :button="['endpoint' => '/styles/add', 'text' => 'Add']">
        <div class="row mt-4">
            @foreach ($styles as $style)
                <x-style-card :style="$style"></x-style-card>
            @endforeach
        </div>
    </x-container>
</x-layout>
