<x-layout>
    <h1 class="display-5"><strong>Welcome to my stash!</strong></h1>

    <div class="row mt-4 mb-4">

        <div class="col-lg-12 col-xl-9">
            <div class="row">
                <div class="col-md-6 col-sm-6 mb-3">
                    <x-statistics.card-stats-carousel title="Total Items" :carousels="['available' => $itemsAvailable, 'consumed' => $itemsConsumed]" border="border-warning" />
                </div>

                <!-- Unique Beers Card -->
                <div class="col-md-6 col-sm-6 mb-3">
                    <x-statistics.card-stats-carousel title="Unique Beers" :carousels="['available' => $beersAvailable, 'consumed' => $beersConsumed]" border="border-warning" />
                </div>

                <!-- Breweries Card -->
                <div class="col-md-6 col-sm-6 mb-3">
                    <x-statistics.card-stats-carousel title="Breweries" :carousels="['available' => $breweriesAvailable, 'consumed' => $breweriesConsumed]" border="border-warning" />
                </div>

                <!-- Styles Card -->
                <div class="col-md-6 col-sm-6 mb-3">
                    <x-statistics.card-stats-carousel title="Styles" :carousels="['available' => $stylesAvailable, 'consumed' => $stylesConsumed]" border="border-warning" />
                </div>

                <div class="col-md-6 col-sm-6 mb-3">
                    <x-statistics.card-stats-carousel title="Countries" :carousels="['available' => $countriesAvailable, 'consumed' => $countriesConsumed]" border="border-warning" />
                </div>

                <div class="col-md-6 col-sm-6 mb-3">
                    <x-statistics.card-stats-carousel title="Liters" :carousels="['available' => $litersAvailable, 'consumed' => $litersConsumed]" border="border-warning" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-statistics.card-stats-carousel title="Last Beers Consumed" :carousels="$lastBeersConsumed"
                        border="border-warning" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-statistics.card-stats-carousel title="Beers Consumed" :carousels="[
                        'week' => $itemsConsumedPerWeek,
                        'month' => $itemsConsumedPerMonth,
                        'year' => $itemsConsumedPerYear,
                    ]"
                        border="border-warning" />
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-xl-3">
            <h4 class="mb-3">Expiring Soon</h4>
            <x-card class="bg-white shadow rounded-2 mb-4">

                <ul class="timeline list-unstyled">
                    @foreach ($expirignBeers as $item)
                        <li class="timeline-item d-flex mb-4">
                            <div class="icon-wrapper bg-warning rounded-circle"></div>
                            <div class="content ms-3">
                                @php
                                    $expirationDate = $item->expiration_date;
                                    $daysToExpiration = (int) now()->diffInDays($expirationDate, false);
                                @endphp
                                <strong>{{ $item->beer->name }}</strong> <span
                                    class="text-muted">{{ $daysToExpiration }} days</span>
                                <p class="mb-0">{{ $item->beer->brewery->name }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </x-card>
        </div>
    </div>

    {{-- Top 5 Breweries and Styles --}}
    <div class="row d-flex mb-4">
        <div class="col-lg-6 col-sm-12 mb-3">
            <h4>Top 5 Breweries</h4>
            <x-card class="bg-white shadow rounded-2 border-0">
                @php
                    $datasets = [
                        [
                            'label' => 'Available',
                            'collection' => $availableBreweriesTop5,
                            'valueField' => 'available_items',
                            'bgColor' => 'rgba(75, 192, 192, 0.2)',
                            'borderColor' => 'rgba(75, 192, 192, 1)',
                        ],
                        [
                            'label' => 'Consumed',
                            'collection' => $consumedBreweriesTop5,
                            'valueField' => 'consumed_items',
                            'bgColor' => 'rgba(153, 102, 255, 0.2)',
                            'borderColor' => 'rgba(153, 102, 255, 1)',
                        ],
                    ];
                @endphp

                <x-statistics.bar-graph :datasets="$datasets" canvasId="breweries" />
            </x-card>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <h4>Top 5 Styles</h4>
            <x-card class="bg-white shadow rounded-2 border-0">

                @php
                    $datasets = [
                        [
                            'label' => 'Available',
                            'collection' => $availableStylesTop5,
                            'valueField' => 'available_items',
                            'bgColor' => 'rgba(75, 192, 192, 0.2)',
                            'borderColor' => 'rgba(75, 192, 192, 1)',
                        ],
                        [
                            'label' => 'Consumed',
                            'collection' => $consumedStylesTop5,
                            'valueField' => 'consumed_items',
                            'bgColor' => 'rgba(153, 102, 255, 0.2)',
                            'borderColor' => 'rgba(153, 102, 255, 1)',
                        ],
                    ];
                @endphp

                <x-statistics.bar-graph :datasets="$datasets" canvasId="styles" />
            </x-card>
        </div>
    </div>

    {{-- Trend Over Time --}}
    {{-- <div class="mb-4">
        <h4>Collection Trend Over Time</h4>
        <x-card class="bg-white shadow rounded-2 border-0">
            <div class="chart-container mt-3">
                <canvas id="collectionTrendChart"></canvas>
            </div>
        </x-card>
    </div> --}}

    {{-- Consumption Patters --}}
    {{-- <div class="row mb-4">
        <!-- Time of Day Heatmap -->
        <div class="col-md-6">
            <h4>Time of Day Consumption</h4>
            <x-card class="bg-white shadow rounded-2 border-0">
                <div class="chart-container mt-3">
                    <canvas id="timeOfDayHeatmap"></canvas>
                </div>
            </x-card>
        </div>

        <!-- Daily Consumption Calendar -->
        <div class="col-md-6">
            <h4>Daily Consumption Calendar</h4>
            <x-card class="bg-white shadow rounded-2 border-0">
                <div id="daily-consumption-calendar" class="chart-container mt-3"></div> <!-- Calendar Container -->
            </x-card>
        </div>
    </div> --}}


    {{-- Ready for consumption --}}
    {{-- <div class="mb-4">
        <h4>Styles Ready for Consumption</h4>
        <x-card class="bg-white shadow rounded-2 border-0">
            <div class="table-responsive mt-3">
                <table class="table table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Beer</th>
                            <th scope="col">Style</th>
                            <th scope="col">Days in Storage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Gulden Draak Classic</td>
                            <td>Belgian Strong Ale</td>
                            <td>150 days</td>
                        </tr>
                        <tr>
                            <td>Westmalle Tripel</td>
                            <td>Tripel</td>
                            <td>90 days</td>
                        </tr>
                        <tr>
                            <td>Chimay Blue</td>
                            <td>Belgian Dark Ale</td>
                            <td>180 days</td>
                        </tr>
                        <tr>
                            <td>Duvel</td>
                            <td>Belgian Strong Ale</td>
                            <td>120 days</td>
                        </tr>
                        <tr>
                            <td>La Trappe Quadrupel</td>
                            <td>Quadrupel</td>
                            <td>200 days</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </x-card>
    </div> --}}

    {{-- <div class="mb-4">
        <h4>Styles Ready for Consumption</h4>
        <x-card class="bg-white shadow rounded-2 border-0">
            <div class="chart-container mt-3">
                <canvas id="stylesReadyChart"></canvas>
            </div>
        </x-card>
    </div> --}}

    {{-- <div class="row mb-4">
        <!-- Breweries Contribution Bar Chart -->
        <div class="col-md-6">
            <h4>Breweries Contribution</h4>
            <x-card class="bg-white shadow rounded-2 border-0">
                <div class="chart-container mt-3">
                    <canvas id="breweriesContributionChart"></canvas>
                </div>
            </x-card>
        </div>

        <!-- Styles Distribution Pie Chart -->
        <div class="col-md-6">
            <h4>Styles Distribution</h4>
            <x-card class="bg-white shadow rounded-2 border-0">
                <div class="chart-container mt-3">
                    <canvas id="stylesDistributionChart"></canvas>
                </div>
            </x-card>
        </div>
    </div> --}}

    {{-- <div class="mb-4">
        <h4>Beer Origins Map</h4>
        <x-card class="bg-white shadow rounded-2 border-0">
            <div id="beer-origins-map" class="chart-container mt-3" style="height: 500px;"></div>
            <!-- Map container -->
        </x-card>
    </div> --}}

    {{-- <div class="mb-4">
        <h4>Seasonal Consumption Patterns</h4>
        <x-card class="bg-white shadow rounded-2 border-0">
            <div class="chart-container mt-3">
                <canvas id="seasonalConsumptionChart"></canvas>
            </div>
        </x-card>
    </div> --}}


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('chartjs-scripts')

</x-layout>
