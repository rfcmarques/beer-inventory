<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ItemTable extends Component
{
    use WithPagination, WithoutUrlPagination;

    public ?int $item_id = 0;

    public int $perPage = 15;

    #[Url]
    public string $search = '';

    public string $sortDirection = 'asc';
    public string $sortColumn = 'expiration_date';

    public function doSort(string $column): void
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection === 'asc'
                ? $this->sortDirection = 'desc'
                : $this->sortDirection = 'asc';
        }

        $this->sortColumn = $column;
    }

    public function render()
    {
        $query = Item::available()->with('beer');

        match ($this->sortColumn) {
            'beer_name' => $query->join('beers', 'items.beer_id', 'beers.id')
                ->orderBy('beers.name', $this->sortDirection)
                ->select('items.*'),
            'beer_style' => $query->join('beers', 'items.beer_id', 'beers.id')
                ->join('styles', 'beers.style_id', 'styles.id')
                ->orderBy('styles.name', $this->sortDirection)
                ->select('items.*'),
            'beer_brewery' => $query->join('beers', 'items.beer_id', 'beers.id')
                ->join('breweries', 'beers.brewery_id', 'breweries.id')
                ->orderBy('breweries.name', $this->sortDirection)
                ->select('items.*'),
            default => $query->orderBy($this->sortColumn, $this->sortDirection)
        };

        $items = $query->search($this->search)
            ->paginate($this->perPage);

        return view('livewire.item-table', [
            'items' => $items
        ]);
    }

    public function changeItemId($id)
    {
        $this->item_id = $id;
    }
}
