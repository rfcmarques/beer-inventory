<?php

namespace App\Livewire\Styles;

use App\Models\Style;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url(as: 'q', nullable: true)]
    public ?string $search = null;

    #[On('refresh-list')]
    public function render()
    {
        return view('livewire.styles.index', [
            'beerStyles' => $this->styles
        ]);
    }

    public function delete(Style $style): void
    {
        $style->delete();
    }

    #[Computed]
    protected function styles(): Paginator
    {
        return Style::withQuantityBeers()
            ->withQuantityAvailable()
            ->withQuantityConsumed()
            ->when(
                $this->search,
                fn(Builder $q) => $q->search($this->search)
            )
            ->orderBy('name')
            ->simplePaginate(18);
    }
}
