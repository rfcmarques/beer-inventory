<?php

namespace App\Livewire\Items;

use App\Models\Item;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class DataTable extends Component
{
    use WithPagination;

    public string $orderBy = 'expiration_date';
    public string $orderDirection = 'asc';
    public int $perPage = 10;
    public string $search = '';

    public array $perPageOptions = [
        ['id' => '10', 'name' => '10'],
        ['id' => '25', 'name' => '25'],
        ['id' => '50', 'name' => '50'],
        ['id' => '100', 'name' => '100'],
    ];

    #[On('refresh-list')]
    public function render(): View
    {
        return view('livewire.items.data-table', [
            'items' => $this->items
        ]);
    }

    public function delete(Item $item): void
    {
        $item->delete();
    }

    #[Computed]
    protected function items(): LengthAwarePaginator
    {
        $query = Item::query()
            ->available()
            ->with(['beer', 'container'])
            ->with(['beer.style', 'beer.brewery']);

        $query->search($this->search);

        match ($this->orderBy) {
            'beer.name' => $query->join('beers', 'items.beer_id', 'beers.id')
                ->orderBy('beers.name', $this->orderDirection)
                ->select('items.*'),
            'beer.style.name' => $query->join('beers', 'items.beer_id', 'beers.id')
                ->join('styles', 'beers.style_id', 'styles.id')
                ->orderBy('styles.name', $this->orderDirection)
                ->select('items.*'),
            'beer.brewery.name' => $query->join('beers', 'items.beer_id', 'beers.id')
                ->join('breweries', 'beers.brewery_id', 'breweries.id')
                ->orderBy('breweries.name', $this->orderDirection)
                ->select('items.*'),
            default => $query->orderBy($this->orderBy, $this->orderDirection),
        };

        return $query->paginate($this->perPage);
    }

    public function changeOrderAndDirection(string $orderBy)
    {
        $this->orderBy = $orderBy;
        $this->orderDirection = $this->orderDirection === 'asc' ? 'desc' : 'asc';
        $this->resetPage();
    }
}
