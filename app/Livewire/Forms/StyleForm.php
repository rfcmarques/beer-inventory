<?php

namespace App\Livewire\Forms;

use App\Models\Style;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class StyleForm extends ModelForm
{
    public string $name = '';
    public ?int $srm = null;

    public function setModel(Model $model): void
    {
        parent::setModel($model);

        $this->name = $model->name;
        $this->srm = $model->srm;
    }

    public function store(): void
    {
        $this->validate();

        Style::create($this->only(['name', 'srm']));

        $this->reset();
    }

    public function update(): void
    {
        $this->validate();

        $this->model->update($this->only(['name', 'srm']));

        $this->reset();
    }

    protected function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('styles', 'name')->ignore($this->model),
            ],
            'srm' => ['nullable', 'integer', 'min:0'],
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required' => 'The :attribute is required.',
            'name.max' => 'The :attribute must be at most 255 characters.',
            'name.unique' => 'The selected :attribute is already in use.',
            'srm.min' => 'The :attribute must be at least 0.',
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'name' => 'style name',
            'srm' => 'SRM',
        ];
    }
}
