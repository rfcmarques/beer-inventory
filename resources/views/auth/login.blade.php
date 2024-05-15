<x-layout>
    <div class="mx-auto my-auto col-6">
        <x-card class="p-3">
            <h3 class="text-center fw-bold">Login</h3>

            <div class="px-5 py-3">
                <x-form.form endpoint="/login">
                    <x-form.field class="col-md-12">
                        <x-form.label for="email">Email</x-form.label>
                        <x-form.input name="email" value="{{ old('email') }}" />
                    </x-form.field>

                    <x-form.field class="col-md-12">
                        <x-form.label for="password">Password</x-form.label>
                        <x-form.input name="password" type="password" value="" />
                    </x-form.field>

                </x-form.form>
            </div>
        </x-card>
    </div>
</x-layout>
