<x-layout>
    <div class="mx-auto my-auto col-6">
        <x-card class="p-3">
            <h3 class="text-center fw-bold">Login</h3>

            <div class="px-5 py-3">
                <x-form.form action="/login">
                    <div class="col-md-12 mb-3">
                        <x-form.input label="Email" name="email" value="{{ old('email') }}" />
                    </div>

                    <div class="col-md-12 mb-3">
                        <x-form.input label="Password" name="password" type="password" value="" />
                    </div>

                </x-form.form>
            </div>
        </x-card>
    </div>
</x-layout>
