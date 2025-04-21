<x-layout>
    <h1 class="display-5"><strong>Welcome to my stash!</strong></h1>

    <div class="row mt-4 mb-4">

        <div class="col-md-9">
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
                    <x-statistics.card-stats-carousel title="Last Beers Consumed" :carousels="$lastBeersConsumed"
                        border="border-warning" />
                </div>
            </div>
        </div>

        <div class="col-md-3 pt-3">
            <x-card class="bg-white shadow rounded-2 mb-4">
                <x-slot name="header">
                    <h3 class="mb-0">Expiring soon</h3>
                </x-slot> {{-- note: just </x-slot> here --}}

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

    <div class="row mb-4">
        {{-- Last beers consumed --}}


        <!-- Mean Time to Consume an Item Card -->
        {{-- <div class="col-md-3 mb-3">
            <x-statistics.card-stats-carousel title="Mean Time To Consume" :carousels="[$meanTimeToConsume . ' days']" border="border-info" />
        </div> --}}
    </div>

    <!-- Expiration Timeline (Scrollable) -->
    {{-- <div class="mb-4 p-3 bg-white shadow rounded-2">
        <h4>Beers Expiring Soon</h4>
        <div class="d-flex overflow-x-auto p-3">
            <ul class="timeline px-5">
                @foreach ($expirignBeers as $item)
                    @php
                        $expirationDate = $item->expiration_date;
                        $daysToExpiration = (int) now()->diffInDays($expirationDate, false);
                    @endphp
                    <li data-time="{{ $daysToExpiration }} days" data-text="{{ $item->beer->name }}" />
                    </li>
                @endforeach
            </ul>
        </div>
    </div> --}}

    {{-- Top 5 Breweries and Styles --}}
    <div class="row d-flex mb-4">
        <div class="col-md-6 mb-3">
            <h4>Top 5 Breweries</h4>
            <x-card class="bg-white shadow rounded-2 border-0">
                <ul class="nav nav-pills py-2" id="myTab" role="tablist" aria-orientation="vertical">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="breweries-available-tab" data-bs-toggle="tab"
                            data-bs-target="#breweries-available" type="button" role="tab">Available</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="breweries-consumed-tab" data-bs-toggle="tab"
                            data-bs-target="#breweries-consumed" type="button" role="tab">Consumed</button>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- Available Tab -->
                    <div class="tab-pane fade show active" id="breweries-available" role="tabpanel">
                        <div class="chart-container mt-3">
                            <canvas id="breweriesAvailableChart"></canvas>
                        </div>
                    </div>

                    <!-- Consumed Tab -->
                    <div class="tab-pane fade" id="breweries-consumed" role="tabpanel">
                        <div class="chart-container mt-3">
                            <canvas id="breweriesConsumedChart"></canvas>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
        <div class="col-md-6 mb-3">
            <h4>Top 5 Styles</h4>
            <x-card class="bg-white shadow rounded-2 border-0">
                <ul class="nav nav-pills py-2" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="styles-available-tab" data-bs-toggle="tab"
                            data-bs-target="#styles-available" type="button" role="tab">Available</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="styles-consumed-tab" data-bs-toggle="tab"
                            data-bs-target="#styles-consumed" type="button" role="tab">Consumed</button>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- Available Tab -->
                    <div class="tab-pane fade show active" id="styles-available" role="tabpanel">
                        <div class="chart-container mt-3">
                            <canvas id="stylesAvailableChart"></canvas>
                        </div>
                    </div>

                    <!-- Consumed Tab -->
                    <div class="tab-pane fade" id="styles-consumed" role="tabpanel">
                        <div class="chart-container mt-3">
                            <canvas id="stylesConsumedChart"></canvas>
                        </div>
                    </div>
                </div>
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
    <script>
        // Data for Available Breweries
        const availableBreweriesData = {
            labels: {{ Js::from($availableBreweriesTop5->pluck('name')->map(fn($name) => explode(' ', $name))->toArray()) }},
            datasets: [{
                label: 'Available Beers',
                data: {{ Js::from($availableBreweriesTop5->pluck('available_items')->toArray()) }},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Data for Consumed Breweries
        const consumedBreweriesData = {
            labels: {{ Js::from($consumedBreweriesTop5->pluck('name')->map(fn($name) => explode(' ', $name))->toArray()) }},
            datasets: [{
                label: 'Consumed Beers',
                data: {{ Js::from($consumedBreweriesTop5->pluck('consumed_items')->toArray()) }},
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        };

        // Data for Available Styles
        const availableStylesData = {
            labels: {{ Js::from($availableStylesTop5->pluck('name')->map(fn($name) => explode(' ', $name))->toArray()) }},
            datasets: [{
                label: 'Available Beers',
                data: {{ Js::from($availableStylesTop5->pluck('available_items')->toArray()) }},
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        };

        // Data for Consumed Styles
        const consumedStylesData = {
            labels: {{ Js::from($consumedStylesTop5->pluck('name')->map(fn($name) => explode(' ', $name))->toArray()) }},
            datasets: [{
                label: 'Consumed Beers',
                data: {{ Js::from($consumedStylesTop5->pluck('consumed_items')->toArray()) }},
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };

        // Create Available Breweries Chart
        const ctxBreweriesAvailable = document.getElementById('breweriesAvailableChart').getContext('2d');
        new Chart(ctxBreweriesAvailable, {
            type: 'bar',
            data: availableBreweriesData,
            options: {
                scales: {
                    x: {
                        ticks: {
                            maxRotation: 0, // Set to 0 to display labels horizontally
                            minRotation: 0, // This can be adjusted for other angles (e.g., 45 for diagonal)
                            autoSkip: false, // Ensures all labels are shown
                            font: {
                                size: 10 // Adjust font size if needed
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
        });

        // Create Consumed Breweries Chart
        const ctxBreweriesConsumed = document.getElementById('breweriesConsumedChart').getContext('2d');
        new Chart(ctxBreweriesConsumed, {
            type: 'bar',
            data: consumedBreweriesData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Create Available Styles Chart
        const ctxStylesAvailable = document.getElementById('stylesAvailableChart').getContext('2d');
        new Chart(ctxStylesAvailable, {
            type: 'bar',
            data: availableStylesData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Create Consumed Styles Chart
        const ctxStylesConsumed = document.getElementById('stylesConsumedChart').getContext('2d');
        new Chart(ctxStylesConsumed, {
            type: 'bar',
            data: consumedStylesData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        const collectionTrendData = {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "Setember", "October",
                "November", "December"
            ], // Time points (e.g., months)
            datasets: [{
                    label: 'Available Beers',
                    data: [120, 150, 170, 160, 180, 200, 220, 160, 180, 200, 220,
                        300
                    ], // Data points for available beers
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.4, // Smooth the line
                },
                {
                    label: 'Consumed Beers',
                    data: [60, 80, 100, 120, 140, 160, 180, 100, 120, 140, 160,
                        180
                    ], // Data points for consumed beers
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true,
                    tension: 0.4, // Smooth the line
                }
            ]
        };

        // Create the Collection Trend Line Chart
        const ctxCollectionTrend = document.getElementById('collectionTrendChart').getContext('2d');
        new Chart(ctxCollectionTrend, {
            type: 'line',
            data: collectionTrendData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Beers'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Months'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });


        // Placeholder data for Time of Day Heatmap
        const timeOfDayData = {
            labels: ['Morning', 'Afternoon', 'Evening', 'Night'], // X-axis labels for times of day
            datasets: [{
                label: 'Consumption by Hour',
                data: [5, 15, 25, 10], // Example data: consumption per time period
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Create the Time of Day Heatmap
        const ctxTimeOfDay = document.getElementById('timeOfDayHeatmap').getContext('2d');
        new Chart(ctxTimeOfDay, {
            type: 'bar',
            data: timeOfDayData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Beers'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Time of Day'
                        }
                    }
                }
            }
        });

        const ctx = document.getElementById('stylesReadyChart').getContext('2d');
        const stylesReadyChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Gulden Draak Classic', 'Westmalle Tripel', 'Chimay Blue', 'Duvel', 'La Trappe Quadrupel'],
                datasets: [{
                    label: 'Days in Storage',
                    data: [150, 90, 180, 120, 200],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Days in Storage'
                        }
                    }
                }
            }
        });

        // Breweries Contribution Pie Chart
        const ctxBreweriesPie = document.getElementById('breweriesContributionChart').getContext('2d');
        const breweriesContributionChart = new Chart(ctxBreweriesPie, {
            type: 'pie',
            data: {
                labels: {{ Js::from($breweriesContribution->pluck('name')->toArray()) }}, // Example brewery names
                datasets: [{
                    label: 'Breweries Contribution',
                    data: {{ Js::from($breweriesContribution->pluck('available_items')->toArray()) }}, // Example data: number of beers per brewery
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        // Styles Distribution Pie Chart
        const ctxStyles = document.getElementById('stylesDistributionChart').getContext('2d');
        const stylesDistributionChart = new Chart(ctxStyles, {
            type: 'pie',
            data: {
                labels: {{ Js::from($styleContribution->pluck('name')->toArray()) }}, // Example beer styles
                datasets: [{
                    label: 'Beer Styles',
                    data: {{ Js::from($styleContribution->pluck('available_items')->toArray()) }}, // Example data: number of beers per style
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });


        // Data for Seasonal Consumption Patterns
        const ctxSeasonal = document.getElementById('seasonalConsumptionChart').getContext('2d');
        const seasonalConsumptionChart = new Chart(ctxSeasonal, {
            type: 'bar',
            data: {
                labels: ['Spring', 'Summer', 'Fall', 'Winter'], // Seasons
                datasets: [{
                    label: 'Beers Consumed',
                    data: [50, 70, 40, 30], // Example consumption data for each season
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', // Spring
                        'rgba(54, 162, 235, 0.2)', // Summer
                        'rgba(255, 206, 86, 0.2)', // Fall
                        'rgba(75, 192, 192, 0.2)' // Winter
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)', // Spring
                        'rgba(54, 162, 235, 1)', // Summer
                        'rgba(255, 206, 86, 1)', // Fall
                        'rgba(75, 192, 192, 1)' // Winter
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Beers'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Seasons'
                        }
                    }
                }
            }
        });
    </script>

    <script>
        // Initialize CalHeatmap
        const cal = new CalHeatmap();

        cal.paint({
            itemSelector: "#daily-consumption-calendar",
            domain: {
                type: "month", // Updated to follow newer version syntax
                label: {
                    position: "top",
                },
                gutter: 10, // Spacing between domains
            },
            subDomain: {
                type: "day",
                // label: "%d", // Show day of the month in each cell
            },
            // range: {
            //     month: 1
            // }, // Display current month only
            data: {
                1693526400: 1, // Example consumption data (beer count)
                1693612800: 2,
                1693699200: 3,
                1694304000: 5,
                1694716800: 4,
                1695168000: 6,
            },
            // legend: [0, 2, 4, 6], // Display legend for the scale
            // legendColors: {
            //     min: "#d6e685",
            //     max: "#1e6823",
            //     empty: "#ffffff",
            // },
            // options: {
            //     cellSize: 20, // Size of each cell in the calendar
            // },
        });
    </script>

    <script src="https://d3js.org/d3.v6.min.js"></script>


    <script>
        // Set dimensions of the map
        const width = 960;
        const height = 500;

        // Append the SVG for the map
        const svg = d3.select("#beer-origins-map")
            .append("svg")
            .attr("width", width)
            .attr("height", height);

        // Set up projection and path generator
        const projection = d3.geoNaturalEarth1()
            .scale(150)
            .translate([width / 2, height / 2]);

        const path = d3.geoPath().projection(projection);

        // Define color scale for the choropleth
        const colorScale = d3.scaleSequential(d3.interpolateBlues)
            .domain([0, 20]); // Adjust max based on your data

        // Example beer data by country (replace with your actual data)
        const beerData = {
            "POR": 34,
            "BEL": 15, // Belgium
            "DEU": 10, // Germany
            "USA": 8, // United States
            "CZE": 6, // Czech Republic
            "NLD": 12 // Netherlands
        };

        // Load GeoJSON data for world countries
        d3.json("https://raw.githubusercontent.com/holtzy/D3-graph-gallery/master/DATA/world.geojson").then(function(
            world) {

            // Draw each country
            svg.selectAll("path")
                .data(world.features)
                .enter()
                .append("path")
                .attr("d", path)
                .attr("fill", function(d) {
                    // Use the country code to set color based on beer data
                    const countryCode = d.id; // ISO 3166-1 alpha-3 country code
                    const beerCount = beerData[countryCode] || 0; // Default to 0 if no data
                    return colorScale(beerCount); // Color based on number of beers
                })
                .attr("stroke", "#fff")
                .attr("stroke-width", 0.5)
                .on("mouseover", function(event, d) {
                    const countryCode = d.id;
                    const beerCount = beerData[countryCode] || 0;
                    d3.select(this)
                        .attr("fill", "#ffcc00"); // Highlight on hover
                    // Add tooltip or popup here if desired
                })
                .on("mouseout", function(event, d) {
                    const countryCode = d.id;
                    const beerCount = beerData[countryCode] || 0;
                    d3.select(this)
                        .attr("fill", colorScale(beerCount)); // Reset color
                });
        });

        // Optional: Add legend for color scale
        const legend = svg.append("g")
            .attr("class", "legend")
            .attr("transform", "translate(20, 20)");

        const legendScale = d3.scaleLinear()
            .domain([0, 20]) // Adjust max based on your data
            .range([0, 200]);

        const axisBottom = d3.axisBottom(legendScale)
            .ticks(5);

        legend.append("g")
            .attr("class", "axis")
            .call(axisBottom);

        legend.selectAll("rect")
            .data(d3.range(0, 21))
            .enter()
            .append("rect")
            .attr("x", d => legendScale(d))
            .attr("y", -10)
            .attr("width", 10)
            .attr("height", 10)
            .attr("fill", d => colorScale(d));
    </script>

</x-layout>
