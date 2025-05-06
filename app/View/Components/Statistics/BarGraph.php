<?php

namespace App\View\Components\Statistics;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\View;

class BarGraph extends Component
{

    public function __construct(
        public array $datasets,
        public string $canvasId
    ) {}

    protected function getTabsProperty(): array
    {
        return collect($this->datasets)
            ->map(fn($dataset) => [
                'key' => Str::slug($this->canvasId . ' ' . $dataset['label'], '-'),
                'label' => $dataset['label'],
                'canvasId' => $this->canvasId . ucfirst($dataset['label']) . 'Chart',
                'labels' => $dataset['collection']->pluck('name')->toArray(),
                'data' => $dataset['collection']->pluck($dataset['valueField'])->toArray(),
                'datasetLabel' => $dataset['label'],
                'backgroundColor' => $dataset['bgColor'],
                'borderColor' => $dataset['borderColor'],
            ])
            ->toArray();
    }

    public function render(): View
    {
        return view('components.statistics.bar-graph', [
            'tabs' => $this->getTabsProperty(),
        ]);
    }
}
