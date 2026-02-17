<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Models\Beer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class BeerForm extends ModelForm
{
    public string $name = '';
    public int $brewery_id = 0;
    public int $style_id = 0;
    public float $abv = 0.0;

    public function setModel(Model $model): void
    {
        parent::setModel($model);

        $this->name = $model->name;
        $this->brewery_id = $model->brewery_id;
        $this->style_id = $model->style_id;
        $this->abv = (float) $model->abv;
    }

    public function store(): void
    {
        $this->validate();

        Beer::create($this->only(['name', 'brewery_id', 'style_id', 'abv']));

        $this->reset();
    }

    public function update(): void
    {
        $this->validate();

        $this->model->update($this->only(['name', 'brewery_id', 'style_id', 'abv']));

        $this->reset();
    }

    protected function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('beers', 'name')->ignore($this->model),
            ],
            'brewery_id' => [
                'required',
                'int',
                'exists:breweries,id',
            ],
            'style_id' => [
                'required',
                'int',
                'exists:styles,id',
            ],
            'abv' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required' => 'The :attribute is required.',
            'name.max' => 'The :attribute must be at most 255 characters.',
            'name.unique' => 'The selected :attribute is already in use.',
            'brewery_id.required' => 'The :attribute is required.',
            'brewery_id.exists' => 'The selected :attribute is invalid.',
            'style_id.required' => 'The :attribute is required.',
            'style_id.exists' => 'The selected :attribute is invalid.',
            'abv.required' => 'The :attribute is required.',
            'abv.numeric' => 'The :attribute must be a number.',
            'abv.min' => 'The :attribute must be at least 0.',
            'abv.max' => 'The :attribute must be at most 100.',
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'name' => 'beer name',
            'brewery_id' => 'brewery',
            'style_id' => 'style',
            'abv' => 'abv',
        ];
    }
}
