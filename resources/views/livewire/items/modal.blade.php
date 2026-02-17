<div>
    <button wire:click="$toggle('modalOpen')"
        class="inline-flex items-center justify-center w-full px-4 py-3 md:py-1.5 font-medium leading-6 text-center whitespace-no-wrap transition duration-150 ease-in-out border border-transparent md:mr-1 text-gray-600 md:w-auto bg-white rounded-lg md:rounded-full hover:bg-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-700">
        Create
    </button>

    <x-modal wire:model="modalOpen" title="{{ !empty($form->item) ? 'Edit Item' : 'Create Item' }}">
        <form wire:submit="save">
            @csrf

            <x-form.field label="Beer" name="beer" error="form.beerId">
                <x-form.searchable-select id="beer_id" name="beer_id" wire:model="form.beerId" :options="$beers"
                    placeholder="Select a beer" />
            </x-form.field>

            <x-form.field label="Container" name="srm" error="form.containerId">
                <x-form.searchable-select id="container_id" name="container_id" wire:model="form.containerId"
                    :options="$containers" placeholder="Select a container" />
            </x-form.field>

            @if(empty($form->model))
                <div class="grid grid-cols-2 gap-4">
            @endif
                <x-form.field label="Expiration Date" name="expiration_date" error="form.expirationDate">
                    <x-form.input id="expiration_date" name="expiration_date" type="date"
                        wire:model="form.expirationDate" />
                </x-form.field>

                @if(empty($form->model))
                        <x-form.field label="Quantity" name="quantity" error="form.quantity">
                            <x-form.input id="quantity" name="quantity" type="number" wire:model="form.quantity" />
                        </x-form.field>
                    </div>
                @endif

            <div class="flex justify-end pt-2">
                <button type="button" wire:click="$toggle('modalOpen')"
                    class="mr-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save
                </button>
            </div>
        </form>
    </x-modal>
</div>