<div>
    <button wire:click="$toggle('modalOpen')"
        class="inline-flex items-center justify-center w-full px-4 py-3 md:py-1.5 font-medium leading-6 text-center whitespace-no-wrap transition duration-150 ease-in-out border border-transparent md:mr-1 text-gray-600 md:w-auto bg-white rounded-lg md:rounded-full hover:bg-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-700">
        Create
    </button>

    <x-modal wire:model="modalOpen" :title="!empty($form->model) ? 'Edit Brewery' : 'Create Brewery'">
        <form wire:submit="save">
            @csrf

            <x-form.field label="Name" name="name" error="form.name">
                <x-form.input id="name" name="name" type="text" wire:model="form.name" />
            </x-form.field>

            <x-form.field label="Country" name="country_id" error="form.country_id">
                <x-form.searchable-select id="country_id" name="country_id" wire:model="form.country_id"
                    :options="$countries" placeholder="Select a country" />
            </x-form.field>

            <x-form.field label="Logo (Optional)" name="logo" error="form.logo">
                <x-form.input id="logo" name="logo" type="file" wire:model="form.logo" />
            </x-form.field>

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