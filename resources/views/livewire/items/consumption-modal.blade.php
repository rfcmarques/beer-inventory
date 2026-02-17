<div>
    <button class="transition-colors duration-200 cursor-pointer" wire:click="$toggle('showModal')">
        <x-icons.mug class="w-6 h-6 hover:text-blue-800" color="primary" />
    </button>

    <x-modal wire:model="showModal" title="Register Consumption">
        <form wire:submit="save">
            @csrf

            <x-form.field label="Consumption Date" name="consumed_at" error="consumed_at">
                <x-form.input id="consumed_at" name="consumed_at" type="date" wire:model="consumedAt" />
            </x-form.field>

            <div class="flex justify-end pt-2">
                <button type="button" wire:click="$toggle('showModal')"
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