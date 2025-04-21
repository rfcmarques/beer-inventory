<?php

namespace App\Livewire;

use App\Models\Style;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class BeerStyles extends Component
{
    use WithPagination;

    public string $search = '';

    public function render()
    {
        $styles = empty($this->search)
            ? $this->getStyles()
            : $this->searchStyles();


        return view('livewire.beer-styles', ['styles' => $styles]);
    }

    public function getStyles(): Paginator
    {
        return Style::orderBy('name')->simplePaginate(30);
    }

    public function searchStyles(): Paginator
    {
        return Style::where('name', 'like', '%' . $this->search . '%')
            ->simplePaginate(30);
    }
}
