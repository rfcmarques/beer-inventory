<div>
    <h1 class="text-5xl font-bold text-white text-left">Welcome to my stash!</h1>

    <div class="flex flex-col md:flex-row gap-6 mt-4 w-full items-center">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full md:w-2/3 h-fit">
            <x-card class="border-b-4 border-yellow-400" x-data="{ active: 'available' }"
                x-init="setInterval(() => active = active === 'available' ? 'consumed' : 'available', 3000)">
                <h3 class="text-gray-200">Total Items</h3>
                <div class="relative mt-1 h-8">
                    <p x-show="active === 'available'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2"
                        class="text-2xl font-bold text-white absolute top-0 left-0 w-full">
                        Available: {{ $totals['items']['available'] }}
                    </p>
                    <p x-show="active === 'consumed'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2" style="display: none;"
                        class="text-2xl font-bold text-white absolute top-0 left-0 w-full">
                        Consumed: {{ $totals['items']['consumed'] }}
                    </p>
                </div>
            </x-card>

            <x-card class="border-b-4 border-yellow-400" x-data="{ active: 'available' }"
                x-init="setInterval(() => active = active === 'available' ? 'consumed' : 'available', 3000)">
                <h3 class="text-gray-200">Unique Beers</h3>
                <div class="relative mt-1 h-8">
                    <p x-show="active === 'available'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2"
                        class="text-2xl font-bold text-white absolute top-0 left-0 w-full">
                        Available: {{ $totals['beers']['available'] }}
                    </p>
                    <p x-show="active === 'consumed'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2" style="display: none;"
                        class="text-2xl font-bold text-white absolute top-0 left-0 w-full">
                        Consumed: {{ $totals['beers']['consumed'] }}
                    </p>
                </div>
            </x-card>

            <x-card class="border-b-4 border-yellow-400" x-data="{ active: 'available' }"
                x-init="setInterval(() => active = active === 'available' ? 'consumed' : 'available', 3000)">
                <h3 class="text-gray-200">Breweries</h3>
                <div class="relative mt-1 h-8">
                    <p x-show="active === 'available'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2"
                        class="text-2xl font-bold text-white absolute top-0 left-0 w-full">
                        Available: {{ $totals['breweries']['available'] }}
                    </p>
                    <p x-show="active === 'consumed'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2" style="display: none;"
                        class="text-2xl font-bold text-white absolute top-0 left-0 w-full">
                        Consumed: {{ $totals['breweries']['consumed'] }}
                    </p>
                </div>
            </x-card>

            <x-card class="border-b-4 border-yellow-400" x-data="{ active: 'available' }"
                x-init="setInterval(() => active = active === 'available' ? 'consumed' : 'available', 3000)">
                <h3 class="text-gray-200">Styles</h3>
                <div class="relative mt-1 h-8">
                    <p x-show="active === 'available'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2"
                        class="text-2xl font-bold text-white absolute top-0 left-0 w-full">
                        Available: {{ $totals['styles']['available'] }}
                    </p>
                    <p x-show="active === 'consumed'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2" style="display: none;"
                        class="text-2xl font-bold text-white absolute top-0 left-0 w-full">
                        Consumed: {{ $totals['styles']['consumed'] }}
                    </p>
                </div>
            </x-card>

            <x-card class="border-b-4 border-yellow-400" x-data="{ active: 'available' }"
                x-init="setInterval(() => active = active === 'available' ? 'consumed' : 'available', 3000)">
                <h3 class="text-gray-200">Countries</h3>
                <div class="relative mt-1 h-8">
                    <p x-show="active === 'available'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2"
                        class="text-2xl font-bold text-white absolute top-0 left-0 w-full">
                        Available: {{ $totals['countries']['available'] }}
                    </p>
                    <p x-show="active === 'consumed'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2" style="display: none;"
                        class="text-2xl font-bold text-white absolute top-0 left-0 w-full">
                        Consumed: {{ $totals['countries']['consumed'] }}
                    </p>
                </div>
            </x-card>

            <x-card class="border-b-4 border-yellow-400" x-data="{ active: 'available' }"
                x-init="setInterval(() => active = active === 'available' ? 'consumed' : 'available', 3000)">
                <h3 class="text-gray-200">Liters</h3>
                <div class="relative mt-1 h-8">
                    <p x-show="active === 'available'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2"
                        class="text-2xl font-bold text-white absolute top-0 left-0 w-full">
                        Available: {{ $totals['liters']['available'] }}
                    </p>
                    <p x-show="active === 'consumed'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2" style="display: none;"
                        class="text-2xl font-bold text-white absolute top-0 left-0 w-full">
                        Consumed: {{ $totals['liters']['consumed'] }}
                    </p>
                </div>
            </x-card>

            <x-card class="border-b-4 border-yellow-400" x-data="{
                    items: {{ Js::from($totals['lastBeersConsumed']) }},
                    active: 0,
                    init() {
                        if (this.items.length > 1) {
                            setInterval(() => {
                                this.active = (this.active + 1) % this.items.length;
                            }, 3000);
                        }
                    }
                }">
                <h3 class="text-gray-200">Last Beers Consumed</h3>
                <div class="relative mt-1 h-8">
                    <template x-for="(item, index) in items" :key="index">
                        <p x-show="active === index" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2"
                            class="text-2xl font-bold text-white absolute top-0 left-0 w-full truncate" x-text="item">
                        </p>
                    </template>
                </div>
            </x-card>

            <x-card class="border-b-4 border-yellow-400" x-data="{
                    items: [
                        { label: 'Year', value: {{ $totals['beersConsumed']['year'] }} },
                        { label: 'Month', value: {{ $totals['beersConsumed']['month'] }} },
                        { label: 'Week', value: {{ $totals['beersConsumed']['week'] }} }
                    ],
                    active: 0,
                    init() {
                        setInterval(() => {
                            this.active = (this.active + 1) % this.items.length;
                        }, 3000);
                    }
                }">
                <h3 class="text-gray-200">Beers Consumed</h3>
                <div class="relative mt-1 h-8">
                    <template x-for="(item, index) in items" :key="index">
                        <p x-show="active === index" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2"
                            class="text-2xl font-bold text-white absolute top-0 left-0 w-full">
                            <span x-text="item.label + ': '"></span>
                            <span x-text="item.value"></span>
                        </p>
                    </template>
                </div>
            </x-card>
        </div>

        <div class="w-full md:w-1/3 flex flex-col gap-4">
            <x-card>
                <h1 class="text-xl font-bold text-white text-left mb-6">Expiring soon</h1>
                <div class="relative">
                    <div class="absolute top-2 bottom-6 left-[9px] w-[2px] bg-yellow-400"></div>
                    <div class="flex flex-col gap-6">
                        @foreach ($expiringSoon as $item)
                            <div class="relative pl-8">
                                <div class="absolute left-0 top-1 w-5 h-5 rounded-full bg-yellow-400 z-10"></div>
                                <div class="flex flex-col">
                                    <div class="flex items-baseline gap-2">
                                        <span class="font-bold text-white text-base">{{ $item->beer->name }}</span>
                                        <span class="text-gray-400 text-sm font-normal">
                                            {{ (int) now()->diffInDays($item->expiration_date, false) }} days
                                        </span>
                                    </div>
                                    <div class="text-left text-gray-300 text-sm">
                                        {{ $item->beer->brewery->name }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </x-card>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-4 w-full items-center mt-8">
        <!-- Top 5 Breweries Chart -->
        <div class="w-full md:w-1/2">
            <x-card class="h-full" x-data="{
                     activeTab: 'available',
                     data: {
                         available: {{ Js::from($totals['charts']['breweries']['available']) }},
                         consumed: {{ Js::from($totals['charts']['breweries']['consumed']) }}
                     },
                     init() {
                         let chart = null;
                         const ctx = this.$refs.canvas.getContext('2d');
                         
                         const updateChart = (type) => {
                             const dataset = this.data[type];
                             // Blue for Available, Pink for Consumed
                             const color = type === 'available' 
                                 ? { bg: 'rgba(59, 130, 246, 0.5)', border: 'rgb(59, 130, 246)' } 
                                 : { bg: 'rgba(236, 72, 153, 0.5)', border: 'rgb(236, 72, 153)' };

                             const labels = Object.keys(dataset).map(label => label.split(' '));

                             if (chart) {
                                 chart.data.labels = labels;
                                 chart.data.datasets[0].label = type.charAt(0).toUpperCase() + type.slice(1);
                                 chart.data.datasets[0].data = Object.values(dataset);
                                 chart.data.datasets[0].backgroundColor = color.bg;
                                 chart.data.datasets[0].borderColor = color.border;
                                 chart.update();
                             } else {
                                 chart = new Chart(ctx, {
                                     type: 'bar',
                                     data: {
                                         labels: labels,
                                         datasets: [{
                                             label: type.charAt(0).toUpperCase() + type.slice(1),
                                             data: Object.values(dataset),
                                             backgroundColor: color.bg,
                                             borderColor: color.border,
                                             borderWidth: 1
                                         }]
                                     },
                                     options: {
                                         responsive: true,
                                         maintainAspectRatio: false,
                                         scales: {
                                             y: { 
                                                 beginAtZero: true,
                                                 grid: { color: 'rgba(255, 255, 255, 0.1)' },
                                                 ticks: { 
                                                     color: '#cbd5e1',
                                                     stepSize: 1,
                                                     precision: 0
                                                 }
                                             },
                                             x: {
                                                 grid: { color: 'rgba(255, 255, 255, 0.1)' },
                                                 ticks: { 
                                                     color: '#cbd5e1',
                                                     maxRotation: 0,
                                                     minRotation: 0,
                                                     autoSkip: false
                                                 }
                                             }
                                         },
                                         plugins: {
                                             legend: {
                                                 labels: { color: '#cbd5e1' }
                                             }
                                         }
                                     }
                                 });
                             }
                         };

                         updateChart(this.activeTab);
                         this.$watch('activeTab', (value) => updateChart(value));
                     }
                 }">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-white">Top 5 Breweries</h3>
                    <div class="flex gap-2">
                        <button @click="activeTab = 'available'"
                            :class="{ 'bg-blue-600 text-white': activeTab === 'available', 'text-blue-400 hover:text-blue-300': activeTab !== 'available' }"
                            class="px-3 py-1 rounded text-sm font-bold transition-colors">
                            Available
                        </button>
                        <button @click="activeTab = 'consumed'"
                            :class="{ 'bg-blue-600 text-white': activeTab === 'consumed', 'text-blue-400 hover:text-blue-300': activeTab !== 'consumed' }"
                            class="px-3 py-1 rounded text-sm font-bold transition-colors">
                            Consumed
                        </button>
                    </div>
                </div>
                <div class="h-64">
                    <canvas x-ref="canvas"></canvas>
                </div>
            </x-card>
        </div>

        <!-- Top 5 Styles Chart -->
        <div class="w-full md:w-1/2">
            <x-card class="h-full" x-data="{
                     activeTab: 'available',
                     data: {
                         available: {{ Js::from($totals['charts']['styles']['available']) }},
                         consumed: {{ Js::from($totals['charts']['styles']['consumed']) }}
                     },
                     init() {
                         let chart = null;
                         const ctx = this.$refs.canvas.getContext('2d');
                         
                         const updateChart = (type) => {
                             const dataset = this.data[type];
                             const color = type === 'available' 
                                 ? { bg: 'rgba(59, 130, 246, 0.5)', border: 'rgb(59, 130, 246)' } 
                                 : { bg: 'rgba(236, 72, 153, 0.5)', border: 'rgb(236, 72, 153)' };

                             const labels = Object.keys(dataset).map(label => label.split(' '));

                             if (chart) {
                                 chart.data.labels = labels;
                                 chart.data.datasets[0].label = type.charAt(0).toUpperCase() + type.slice(1);
                                 chart.data.datasets[0].data = Object.values(dataset);
                                 chart.data.datasets[0].backgroundColor = color.bg;
                                 chart.data.datasets[0].borderColor = color.border;
                                 chart.update();
                             } else {
                                 chart = new Chart(ctx, {
                                     type: 'bar',
                                     data: {
                                         labels: labels,
                                         datasets: [{
                                             label: type.charAt(0).toUpperCase() + type.slice(1),
                                             data: Object.values(dataset),
                                             backgroundColor: color.bg,
                                             borderColor: color.border,
                                             borderWidth: 1
                                         }]
                                     },
                                     options: {
                                         responsive: true,
                                         maintainAspectRatio: false,
                                         scales: {
                                             y: { 
                                                 beginAtZero: true,
                                                 grid: { color: 'rgba(255, 255, 255, 0.1)' },
                                                 ticks: { 
                                                     color: '#cbd5e1',
                                                     stepSize: 1,
                                                     precision: 0
                                                 }
                                             },
                                             x: {
                                                 grid: { color: 'rgba(255, 255, 255, 0.1)' },
                                                 ticks: { 
                                                     color: '#cbd5e1',
                                                     maxRotation: 0,
                                                     minRotation: 0,
                                                     autoSkip: false
                                                 }
                                             }
                                         },
                                         plugins: {
                                             legend: {
                                                 labels: { color: '#cbd5e1' }
                                             }
                                         }
                                     }
                                 });
                             }
                         };

                         updateChart(this.activeTab);
                         this.$watch('activeTab', (value) => updateChart(value));
                     }
                 }">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-white">Top 5 Styles</h3>
                    <div class="flex gap-2">
                        <button @click="activeTab = 'available'"
                            :class="{ 'bg-blue-600 text-white': activeTab === 'available', 'text-blue-400 hover:text-blue-300': activeTab !== 'available' }"
                            class="px-3 py-1 rounded text-sm font-bold transition-colors">
                            Available
                        </button>
                        <button @click="activeTab = 'consumed'"
                            :class="{ 'bg-blue-600 text-white': activeTab === 'consumed', 'text-blue-400 hover:text-blue-300': activeTab !== 'consumed' }"
                            class="px-3 py-1 rounded text-sm font-bold transition-colors">
                            Consumed
                        </button>
                    </div>
                </div>
                <div class="h-64">
                    <canvas x-ref="canvas"></canvas>
                </div>
            </x-card>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</div>