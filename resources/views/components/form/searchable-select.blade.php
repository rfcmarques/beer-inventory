@props(['options', 'placeholder' => 'Select an option'])

<div x-data="{
        open: false,
        search: '',
        selected: @entangle($attributes->wire('model')),
        options: {{ json_encode($options) }},
        highlightedIndex: 0,
        get filteredOptions() {
            if (this.search === '') {
                return this.options;
            }
            return this.options.filter(option => 
                option.name.toLowerCase().includes(this.search.toLowerCase())
            );
        },
        get selectedLabel() {
            if (!this.selected) return '{{ $placeholder }}';
            const option = this.options.find(o => o.id == this.selected);
            return option ? option.name : '{{ $placeholder }}';
        },
        select(id) {
            this.selected = id;
            this.open = false;
            this.search = '';
        },
        highlightNext() {
            if (this.highlightedIndex === this.filteredOptions.length - 1) {
                this.highlightedIndex = 0;
            } else {
                this.highlightedIndex++;
            }
            this.scrollToHighlighted();
        },
        highlightPrev() {
            if (this.highlightedIndex === 0) {
                this.highlightedIndex = this.filteredOptions.length - 1;
            } else {
                this.highlightedIndex--;
            }
            this.scrollToHighlighted();
        },
        selectHighlighted() {
            if (this.filteredOptions.length > 0 && this.highlightedIndex >= 0 && this.highlightedIndex < this.filteredOptions.length) {
                this.select(this.filteredOptions[this.highlightedIndex].id);
            }
        },
        scrollToHighlighted() {
            this.$nextTick(() => {
                const list = this.$refs.optionsList;
                const item = list.querySelectorAll('li')[this.highlightedIndex];
                if (item) {
                    item.scrollIntoView({ block: 'center' });
                }
            });
        }
    }" x-init="$watch('open', value => {
        if (value) {
            this.highlightedIndex = 0;
            this.$nextTick(() => $refs.searchInput.focus());
        }
    }); $watch('search', () => highlightedIndex = 0)" class="relative" @click.away="open = false"
    @keydown.arrow-down.prevent="highlightNext()" @keydown.arrow-up.prevent="highlightPrev()"
    @keydown.enter.prevent="open ? selectHighlighted() : open = true">

    <!-- Trigger Button -->
    <button type="button" @click="open = !open"
        class="relative w-full py-2 pl-3 pr-10 text-left bg-white border border-gray-300 rounded-md shadow-sm cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <span class="block truncate" x-text="selectedLabel"></span>
        <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </span>
    </button>

    <!-- Dropdown -->
    <div x-show="open" style="display: none;" x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="absolute z-10 w-full mt-1 bg-white shadow-lg rounded-md text-base ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm flex flex-col overflow-hidden">

        <!-- Search Input -->
        <div class="z-10 bg-white px-2 py-1.5 border-b border-gray-200">
            <input type="text" x-ref="searchInput" x-model="search"
                class="block w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow focus:outline-none focus:shadow-outline"
                placeholder="Search..." @click.stop @keydown.enter.prevent="selectHighlighted()">
        </div>

        <!-- Options List -->
        <ul class="pt-1 overflow-y-auto max-h-60" x-ref="optionsList">
            <template x-for="(option, index) in filteredOptions" :key="option.id">
                <li @click="select(option.id)" @mouseenter="highlightedIndex = index"
                    class="relative py-2 pl-3 cursor-default select-none pr-9 text-gray-900"
                    :class="{ 'bg-indigo-600 text-white': highlightedIndex === index, 'text-gray-900': highlightedIndex !== index }">
                    <span class="block truncate font-normal"
                        :class="{ 'font-semibold': selected == option.id, 'font-normal': selected != option.id }"
                        x-text="option.name">
                    </span>

                    <span x-show="selected == option.id" class="absolute inset-y-0 right-0 flex items-center pr-4"
                        :class="{ 'text-white': highlightedIndex === index, 'text-indigo-600': highlightedIndex !== index }">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </li>
            </template>
            <li x-show="filteredOptions.length === 0" class="px-3 py-2 text-gray-500">
                No results found.
            </li>
        </ul>
    </div>
</div>