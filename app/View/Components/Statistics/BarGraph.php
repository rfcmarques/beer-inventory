<?php

namespace App\View\Components\Statistics;

use App\DTOs\BarGraphDto;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\View;

class BarGraph extends Component
{
    /**
     * @param BarGraphDto[] $datasets
     * @param string $canvasId
     */
    public function __construct(
        public array $datasets,
        public string $canvasId
    ) {}

    protected function getTabsProperty(): array
    {
        return collect($this->datasets)
            ->map(fn(BarGraphDto $dto) => [
                'key'             => Str::slug("{$this->canvasId} {$dto->label}", '-'),
                'label'           => $dto->label,
                'canvasId'        => $this->canvasId . Str::studly($dto->label) . 'Chart',
                'labels'          => $dto->labels('name'),
                'data'            => $dto->data(),
                'datasetLabel'    => $dto->label,
                'backgroundColor' => $dto->bgColor,
                'borderColor'     => $dto->borderColor,
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
