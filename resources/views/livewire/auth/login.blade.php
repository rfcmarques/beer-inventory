<div class="flex items-center justify-center min-h-[50vh]">
    <div class="w-full max-w-md">
        <x-card>
            <form wire:submit="login" class="space-y-6">

                <div class="text-center">
                    <h2 class="text-2xl font-bold text-white">Login</h2>
                </div>

                <div class="mb-4">
                    <x-form.label for="email" label="Email" class="!text-white" />
                    <x-form.input wire:model="email" id="email" type="email" autocomplete="email" autofocus
                        class="!text-white !bg-gray-700 !border-gray-600" />
                    <x-form.error name="email" />
                </div>

                <div class="mb-4">
                    <x-form.label for="password" label="Password" class="!text-white" />
                    <x-form.input wire:model="password" id="password" type="password" autocomplete="current-password"
                        class="!text-white !bg-gray-700 !border-gray-600" />
                    <x-form.error name="password" />
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-500 disabled:opacity-50"
                        wire:loading.attr="disabled">
                        Login
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</div>