@php use Illuminate\Support\Js; @endphp

<div>
    <ul class="nav nav-pills py-2" role="tablist">
        @foreach ($tabs as $i => $tab)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $i === 0 ? 'active' : '' }}" id="{{ $tab['key'] }}-tab" data-bs-toggle="tab"
                    data-bs-target="#{{ $tab['key'] }}" type="button">
                    {{ $tab['label'] }}
                </button>
            </li>
        @endforeach
    </ul>

    <div class="tab-content">
        @foreach ($tabs as $i => $tab)
            <div class="tab-pane fade {{ $i === 0 ? 'show active' : '' }}" id="{{ $tab['key'] }}" role="tabpanel">
                <div class="chart-container mt-3">
                    <canvas id="{{ $tab['canvasId'] }}"></canvas>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('chartjs-scripts')
    <script>
        @foreach ($tabs as $tab)
            (function() {
                const el = document.getElementById('{{ $tab['canvasId'] }}');
                if (!el) return;

                const cfg = {
                    type: '{{ $tab['type'] ?? 'bar' }}',
                    data: {
                        labels: {{ Js::from($tab['labels']) }},
                        datasets: [{
                            label: {{ Js::from($tab['datasetLabel']) }},
                            data: {{ Js::from($tab['data']) }},
                            backgroundColor: {{ Js::from($tab['backgroundColor']) }},
                            borderColor: {{ Js::from($tab['borderColor']) }},
                            borderWidth: {{ $tab['borderWidth'] ?? 1 }}
                        }],
                    },
                    options: {
                        scales: {
                            x: {
                                ticks: {
                                    maxRotation: 0,
                                    minRotation: 0,
                                    autoSkip: false,
                                    font: {
                                        size: 10
                                    }
                                }
                            },
                            y: {
                                beginAtZero: true,
                                fontSize: 40
                            },
                            yAxes: [{
                                ticks: {
                                    fontSize: 40
                                }
                            }]
                        }
                    }
                };

                @if (!empty($tab['options']))
                    cfg.options = {{ Js::from($tab['options']) }};
                @endif

                new Chart(el, cfg);
            })();
        @endforeach
    </script>
@endpush
