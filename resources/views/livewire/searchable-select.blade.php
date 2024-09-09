<div x-data="selectComponent({{ Js::from($options) }}, {{ Js::from($selectedOption) }})" x-init="init()" class="w-100 position-relative" @click.away="open = false">
    <div class="input-group">
        <input type="text" x-model="searchTerm" @input="filterOptions" class="form-control"
            placeholder="{{ $placeholder }}" @focus="open = true" @keydown.arrow-down.prevent="navigateOptions('down')"
            @keydown.arrow-up.prevent="navigateOptions('up')" @keydown.enter.prevent="selectHighlightedOption">

        <span class="input-group-text" x-show="loading" x-cloak>
            <div class="spinner-border spinner-border-sm text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </span>

        <button @click="clearSearch" type="button" class="btn btn-outline-secondary" x-show="searchTerm.length > 0"
            x-cloak>×</button>
    </div>

    <input type="hidden" name="{{ $name }}" x-model="selectedOption">

    <ul x-bind:style="open || noResultsFound ? 'display: block; max-height: 200px; overflow-y: auto' :
        'display: none; max-height: 200px; overflow-y: auto'"
        class="dropdown-menu w-100 position-absolute" x-ref="dropdownList">
        <template x-for="(option, index) in filteredOptions" :key="option.id">
            <li @click="selectOption(option)" class="dropdown-item" :class="{ 'active': option.id === selectedOption }"
                x-bind:class="highlightedIndex === index ? 'bg-primary text-white' : ''" :data-index="index">
                <span x-text="option.name"></span>
            </li>
        </template>
        <li x-bind:style="filteredOptions.length === 0 ? 'display: block;' : 'display: none;'"
            class="dropdown-item disabled">
            No results found
        </li>
    </ul>
</div>

<script>
    function selectComponent(options, initialValue) {
        return {
            open: false,
            noResultsFound: false,
            searchTerm: '',
            selectedOption: initialValue ?? null, // Set the initial selected value
            options: options,
            filteredOptions: [],
            highlightedIndex: -1,
            loading: false,

            init() {
                // Initialize with the selected option
                if (this.selectedOption) {
                    const selectedOption = this.options.find(option => option.id === this.selectedOption);
                    if (selectedOption) {
                        this.searchTerm = selectedOption.name; // Set the search term to show the selected value
                    }
                }
                this.filteredOptions = this.options;
            },

            filterOptions: function() {
                this.loading = true;
                setTimeout(() => {
                    this.filteredOptions = this.options.filter(option =>
                        option.name.toLowerCase().includes(this.searchTerm.toLowerCase())
                    );

                    this.open = this.filteredOptions.length > 0;
                    this.noResultsFound = this.filteredOptions.length === 0;

                    this.highlightedIndex = this.filteredOptions.length > 0 ? 0 : -1;
                    this.loading = false;
                }, 300);
            },

            clearSearch() {
                this.searchTerm = '';
                this.filterOptions();
                this.open = false;
            },

            navigateOptions(direction) {
                if (!this.open || this.filteredOptions.length === 0) return;

                if (direction === 'down') {
                    this.highlightedIndex = (this.highlightedIndex + 1) % this.filteredOptions.length;
                } else if (direction === 'up') {
                    this.highlightedIndex = (this.highlightedIndex - 1 + this.filteredOptions.length) % this
                        .filteredOptions.length;
                }

                this.scrollToHighlightedOption();
            },

            scrollToHighlightedOption() {
                const dropdownElement = this.$refs.dropdownList;
                const optionElement = dropdownElement.querySelector(`[data-index='${this.highlightedIndex}']`);

                if (optionElement && dropdownElement) {
                    const optionTop = optionElement.offsetTop;
                    const optionHeight = optionElement.offsetHeight;
                    const dropdownScrollTop = dropdownElement.scrollTop;
                    const dropdownHeight = dropdownElement.clientHeight;

                    if (optionTop < dropdownScrollTop) {
                        dropdownElement.scrollTop = optionTop;
                    } else if (optionTop + optionHeight > dropdownScrollTop + dropdownHeight) {
                        dropdownElement.scrollTop = optionTop + optionHeight - dropdownHeight;
                    }
                }
            },

            selectHighlightedOption() {
                if (this.highlightedIndex >= 0 && this.highlightedIndex < this.filteredOptions.length) {
                    this.selectOption(this.filteredOptions[this.highlightedIndex]);
                }
            },

            selectOption(option) {
                this.selectedOption = option.id;
                this.searchTerm = option.name;
                this.open = false;
                this.highlightedIndex = -1;
                this.$wire.updateSelectedOption(option.id);
            }
        }
    }
</script>
