/* ============================================================
   SERVICEHUB — SERVICES LISTING PAGE
   Frontend-only interactions:
   - Mobile filter sidebar (open/close/backdrop/ESC/scroll lock)
   - Front-end search
   - Category filtering (pills + sidebar radios)
   - Duration / rating / availability filtering
   - Price range filtering
   - Sorting (recommended / price / rating)
   - Clear filters
   - Results count updates
   - Empty state
   ============================================================ */

(function () {
    'use strict';

    function ready(fn) {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', fn);
        } else {
            fn();
        }
    }

    ready(function () {
        var root = document.querySelector('.servicehub-services');
        if (!root) return;

        // ---------- Elements ----------
        var sidebar       = root.querySelector('#filterSidebar');
        var filterOpenBtn = root.querySelector('#filterOpen');
        var filterCloseBtn= root.querySelector('#filterClose');
        var grid          = root.querySelector('[data-services-grid]');
        var emptyState    = root.querySelector('[data-services-empty]');
        var resultsCount  = root.querySelector('[data-results-count]');
        var sortSelect    = root.querySelector('[data-sort-select]');
        var searchInput   = root.querySelector('[data-search-input]');
        var searchSubmit  = root.querySelector('[data-search-submit]');
        var clearButtons  = root.querySelectorAll('[data-clear-filters]');
        var categoryPills = root.querySelectorAll('.cat-pill');
        var quickTags     = root.querySelectorAll('[data-quick-search]');

        var cards = Array.prototype.slice.call(
            root.querySelectorAll('[data-service-card]')
        );

        // Original order for "Recommended"
        cards.forEach(function (card, index) {
            card.dataset.originalIndex = index;
        });

        var state = {
            search:     '',
            category:   'all',
            duration:   [],   // ['under-60', '60-120', '120-plus']
            rating:     null, // '4.5' | '4.0' | null
            availability: [], // ['today', 'week']
            priceMin:   null,
            priceMax:   null,
            sort:       'recommended'
        };


        /* ========================================================
           MOBILE FILTER SIDEBAR
           ======================================================== */

        var backdrop = document.createElement('div');
        backdrop.className = 'filter-backdrop';
        root.appendChild(backdrop);

        function openSidebar() {
            if (!sidebar) return;
            sidebar.classList.add('open');
            backdrop.classList.add('show');
            document.body.classList.add('sh-filters-locked');

            // focus management
            if (filterCloseBtn) filterCloseBtn.focus({ preventScroll: true });
        }

        function closeSidebar() {
            if (!sidebar) return;
            sidebar.classList.remove('open');
            backdrop.classList.remove('show');
            document.body.classList.remove('sh-filters-locked');

            if (filterOpenBtn) filterOpenBtn.focus({ preventScroll: true });
        }

        if (filterOpenBtn) {
            filterOpenBtn.addEventListener('click', openSidebar);
        }

        if (filterCloseBtn) {
            filterCloseBtn.addEventListener('click', closeSidebar);
        }

        backdrop.addEventListener('click', closeSidebar);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && sidebar && sidebar.classList.contains('open')) {
                closeSidebar();
            }
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth > 991.98 && sidebar && sidebar.classList.contains('open')) {
                closeSidebar();
            }
        });


        /* ========================================================
           PRICE RANGE SLIDER
           ======================================================== */

        var rangeMin      = root.querySelector('[data-range-min]');
        var rangeMax      = root.querySelector('[data-range-max]');
        var rangeFill     = root.querySelector('[data-range-fill]');
        var minLabel      = root.querySelector('[data-price-min-label]');
        var maxLabel      = root.querySelector('[data-price-max-label]');

        var PRICE_ABS_MIN = 0;
        var PRICE_ABS_MAX = 2500;

        function formatPrice(v) {
            return '₹' + Number(v).toLocaleString('en-IN');
        }

        function updateRangeVisual() {
            if (!rangeMin || !rangeMax || !rangeFill) return;

            var min = parseInt(rangeMin.value, 10);
            var max = parseInt(rangeMax.value, 10);

            // Prevent crossing
            if (min > max - 50) {
                if (document.activeElement === rangeMin) {
                    rangeMin.value = max - 50;
                    min = max - 50;
                } else {
                    rangeMax.value = min + 50;
                    max = min + 50;
                }
            }

            var total = PRICE_ABS_MAX - PRICE_ABS_MIN;
            var leftPct = ((min - PRICE_ABS_MIN) / total) * 100;
            var rightPct = ((max - PRICE_ABS_MIN) / total) * 100;

            rangeFill.style.left  = leftPct + '%';
            rangeFill.style.right = (100 - rightPct) + '%';

            if (minLabel) minLabel.textContent = formatPrice(min);
            if (maxLabel) maxLabel.textContent = formatPrice(max);

            state.priceMin = min;
            state.priceMax = max;
        }

        if (rangeMin && rangeMax) {
            updateRangeVisual();

            [rangeMin, rangeMax].forEach(function (input) {
                input.addEventListener('input', function () {
                    updateRangeVisual();
                    applyFilters();
                });
            });
        }


        /* ========================================================
           FILTER INPUTS
           ======================================================== */

        var categoryInputs  = root.querySelectorAll('[data-filter-category]');
        var durationInputs  = root.querySelectorAll('[data-filter-duration]');
        var ratingInputs    = root.querySelectorAll('[data-filter-rating]');
        var availabilityInputs = root.querySelectorAll('[data-filter-availability]');

        categoryInputs.forEach(function (input) {
            input.addEventListener('change', function () {
                if (!input.checked) return;
                state.category = input.value;
                syncCategoryPills(state.category);
                applyFilters();
            });
        });

        durationInputs.forEach(function (input) {
            input.addEventListener('change', function () {
                state.duration = Array.prototype.filter
                    .call(durationInputs, function (i) { return i.checked; })
                    .map(function (i) { return i.value; });
                applyFilters();
            });
        });

        ratingInputs.forEach(function (input) {
            input.addEventListener('change', function () {
                if (input.checked) {
                    state.rating = input.value;
                } else if (state.rating === input.value) {
                    state.rating = null;
                }
                applyFilters();
            });
        });

        availabilityInputs.forEach(function (input) {
            input.addEventListener('change', function () {
                state.availability = Array.prototype.filter
                    .call(availabilityInputs, function (i) { return i.checked; })
                    .map(function (i) { return i.value; });
                applyFilters();
            });
        });


        /* ========================================================
           CATEGORY PILLS (top nav)
           ======================================================== */

        function syncCategoryPills(category) {
            categoryPills.forEach(function (pill) {
                var active = pill.dataset.category === category;
                pill.classList.toggle('active', active);
                pill.setAttribute('aria-selected', active ? 'true' : 'false');
            });

            // Sync sidebar radio
            categoryInputs.forEach(function (input) {
                input.checked = (input.value === category);
            });
        }

        categoryPills.forEach(function (pill) {
            pill.addEventListener('click', function () {
                var cat = pill.dataset.category || 'all';
                state.category = cat;
                syncCategoryPills(cat);
                applyFilters();

                // Bring to view on horizontal scroll
                pill.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
            });
        });


        /* ========================================================
           QUICK SEARCH TAGS (hero)
           ======================================================== */

        quickTags.forEach(function (tag) {
            tag.addEventListener('click', function () {
                var query = tag.dataset.quickSearch || tag.textContent.trim();
                if (searchInput) {
                    searchInput.value = query;
                    state.search = query.toLowerCase();
                    applyFilters();
                }
            });
        });


        /* ========================================================
           SEARCH
           ======================================================== */

        function handleSearch() {
            state.search = (searchInput && searchInput.value || '').trim().toLowerCase();
            applyFilters();
        }

        if (searchInput) {
            // live search with a tiny debounce
            var searchDebounce;
            searchInput.addEventListener('input', function () {
                clearTimeout(searchDebounce);
                searchDebounce = setTimeout(handleSearch, 150);
            });

            searchInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    handleSearch();
                }
            });
        }

        if (searchSubmit) {
            searchSubmit.addEventListener('click', function (e) {
                e.preventDefault();
                handleSearch();
            });
        }


        /* ========================================================
           SORT
           ======================================================== */

        if (sortSelect) {
            sortSelect.addEventListener('change', function () {
                state.sort = sortSelect.value;
                applyFilters();
            });
        }


        /* ========================================================
           CLEAR FILTERS
           ======================================================== */

        function clearAllFilters() {
            // Reset search
            if (searchInput) searchInput.value = '';
            state.search = '';

            // Reset category
            state.category = 'all';
            syncCategoryPills('all');

            // Reset duration
            state.duration = [];
            durationInputs.forEach(function (i) { i.checked = false; });

            // Reset rating
            state.rating = null;
            ratingInputs.forEach(function (i) { i.checked = false; });

            // Reset availability
            state.availability = [];
            availabilityInputs.forEach(function (i) { i.checked = false; });

            // Reset price
            if (rangeMin && rangeMax) {
                rangeMin.value = 299;
                rangeMax.value = 2499;
                updateRangeVisual();
            }

            // Reset sort
            if (sortSelect) sortSelect.value = 'recommended';
            state.sort = 'recommended';

            applyFilters();
        }

        clearButtons.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                clearAllFilters();
            });
        });


        /* ========================================================
           MATCHING LOGIC
           ======================================================== */

        function matchesSearch(card) {
            if (!state.search) return true;
            var haystack = [
                card.dataset.name || '',
                card.dataset.category || '',
                card.dataset.description || '',
                card.textContent || ''
            ].join(' ').toLowerCase();

            // support simple multi-term search
            var terms = state.search.split(/\s+/).filter(Boolean);
            return terms.every(function (t) { return haystack.indexOf(t) !== -1; });
        }

        function matchesCategory(card) {
            if (state.category === 'all') return true;

            var cat = (card.dataset.category || '').toLowerCase();

            // Sidebar category → related service categories
            if (state.category === 'repair') {
                return cat === 'plumbing' || cat === 'electrical' || cat === 'repair';
            }
            if (state.category === 'maintenance') {
                return cat === 'appliance' || cat === 'pest-control' || cat === 'painting';
            }
            return cat === state.category;
        }

        function matchesDuration(card) {
            if (!state.duration.length) return true;
            var duration = parseInt(card.dataset.duration, 10) || 0;
            return state.duration.some(function (bucket) {
                if (bucket === 'under-60')  return duration < 60;
                if (bucket === '60-120')    return duration >= 60 && duration <= 120;
                if (bucket === '120-plus')  return duration > 120;
                return false;
            });
        }

        function matchesRating(card) {
            if (!state.rating) return true;
            var rating = parseFloat(card.dataset.rating) || 0;
            return rating >= parseFloat(state.rating);
        }

        function matchesAvailability(card) {
            if (!state.availability.length) return true;
            var availability = card.dataset.availability || '';
            return state.availability.indexOf(availability) !== -1;
        }

        function matchesPrice(card) {
            if (state.priceMin == null || state.priceMax == null) return true;
            var price = parseFloat(card.dataset.price) || 0;
            return price >= state.priceMin && price <= state.priceMax;
        }


        /* ========================================================
           SORTING
           ======================================================== */

        function getComparator(sort) {
            switch (sort) {
                case 'price-asc':
                    return function (a, b) {
                        return (parseFloat(a.dataset.price) || 0) - (parseFloat(b.dataset.price) || 0);
                    };
                case 'price-desc':
                    return function (a, b) {
                        return (parseFloat(b.dataset.price) || 0) - (parseFloat(a.dataset.price) || 0);
                    };
                case 'rating-desc':
                    return function (a, b) {
                        return (parseFloat(b.dataset.rating) || 0) - (parseFloat(a.dataset.rating) || 0);
                    };
                case 'recommended':
                default:
                    return function (a, b) {
                        return (parseInt(a.dataset.originalIndex, 10) || 0) -
                               (parseInt(b.dataset.originalIndex, 10) || 0);
                    };
            }
        }


        /* ========================================================
           APPLY FILTERS + SORT + EMPTY STATE
           ======================================================== */

        function applyFilters() {
            if (!grid) return;

            var visibleCount = 0;

            // 1. Filter visibility
            cards.forEach(function (card) {
                var visible =
                    matchesSearch(card) &&
                    matchesCategory(card) &&
                    matchesDuration(card) &&
                    matchesRating(card) &&
                    matchesAvailability(card) &&
                    matchesPrice(card);

                if (visible) {
                    card.classList.remove('is-hidden');
                    visibleCount++;
                } else {
                    card.classList.add('is-hidden');
                }
            });

            // 2. Sort visible cards and re-append in order
            var sortedCards = cards.slice().sort(getComparator(state.sort));
            sortedCards.forEach(function (card) {
                grid.appendChild(card);
            });

            // 3. Update results count
            if (resultsCount) {
                resultsCount.textContent = visibleCount;
            }

            // 4. Empty state
            if (emptyState) {
                emptyState.hidden = visibleCount !== 0;
            }

            // 5. Toggle pagination visibility if nothing found
            var pagination = root.querySelector('.services-pagination');
            if (pagination) {
                pagination.style.display = visibleCount === 0 ? 'none' : '';
            }
        }


        /* ========================================================
           INIT
           ======================================================== */

        updateRangeVisual();
        applyFilters();
    });
})();