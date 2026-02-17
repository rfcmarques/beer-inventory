<?php

namespace App\Livewire\Forms;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;

class ItemForm extends ModelForm
{
    public int $beerId = 0;
    public int $containerId = 0;
    public int $quantity = 0;
    public string $expirationDate = '';

    public function setModel(Model $model): void
    {
        parent::setModel($model);

        $this->beerId = $model->beer_id;
        $this->containerId = $model->container_id;
        $this->expirationDate = $model->expiration_date->format('Y-m-d');
    }

    public function store(): void
    {
        $this->validate();

        for ($i = 0; $i < $this->quantity; $i++) {
            Item::create([
                'beer_id' => $this->beerId,
                'container_id' => $this->containerId,
                'expiration_date' => $this->expirationDate
            ]);
        }

        $this->reset();
    }

    public function update(): void
    {
        $this->validateOnly('beerId');
        $this->validateOnly('containerId');
        $this->validateOnly('expirationDate');

        $this->model->update($this->only(['beerId', 'containerId', 'expirationDate']));

        $this->reset();
    }

    protected function rules(): array
    {
        return [
            'beerId' => [
                'required',
                'integer',
                'exists:beers,id'
            ],
            'containerId' => [
                'required',
                'integer',
                'exists:containers,id'
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1'
            ],
            'expirationDate' => [
                'required',
                'date'
            ]
        ];
    }

    protected function messages(): array
    {
        return [
            'beerId.required' => 'You have to select a :attribute from the list',
            'beerId.exists' => 'You have to select a :attribute from the list',
            'containerId.required' => 'You have to select a :attribute from the list',
            'containerId.exists' => 'You have to select a :attribute from the list',
            'quantity.required' => 'You have to add a valid :attribute',
            'quantity.min' => 'The :attribute should be higher then 1',
            'expirationDate.required' => 'You must select a valid :attribute',
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'beerId' => 'beer',
            'containerId' => 'container',
            'quantity' => 'quantity',
            'expirationDate' => 'expiration date',
        ];
    }
}
