<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Models\Brewery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class BreweryForm extends ModelForm
{
    public string $name = '';
    public int $country_id = 0;
    public TemporaryUploadedFile|string|null $logo = null;

    public function setModel(Model $model): void
    {
        parent::setModel($model);
        $this->name = $model->name;
        $this->country_id = $model->country_id;
        $this->logo = $model->logo;
    }

    public function store(): void
    {
        $this->validate();

        Brewery::create([
            'name' => $this->name,
            'country_id' => $this->country_id,
            'logo' => $this->storelogo(),
        ]);

        $this->reset();
    }

    public function update(): void
    {
        $this->validate();

        $this->model->update([
            'name' => $this->name,
            'country_id' => $this->country_id,
            'logo' => $this->storelogo() ?? $this->model->logo,
        ]);

        $this->reset();
    }

    protected function storeLogo(): ?string
    {
        if ($this->logo instanceof TemporaryUploadedFile) {
            return $this->logo->store('logos', 'public');
        }

        return null;
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('breweries', 'name')->ignore($this->model)],
            'country_id' => ['required', 'exists:countries,id'],
            'logo' => ['nullable', 'image'],
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required' => 'The :attribute is required.',
            'name.max' => 'The :attribute must be at most 255 characters.',
            'name.unique' => 'The selected :attribute is already in use.',
            'country_id.required' => 'The :attribute is required.',
            'country_id.exists' => 'The selected :attribute is invalid.',
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'name' => 'brewery name',
            'country_id' => 'country',
            'logo' => 'logo',
        ];
    }
}
