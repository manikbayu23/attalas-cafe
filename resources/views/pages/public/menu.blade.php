@extends('layouts.public')

@section('title', __('public.seo.menu_title'))
@section('meta_description', __('public.seo.menu_description'))

@section('content')
    <main>
        <section class="page-hero" @style(['--hero-image: url(' . $heroImage . ')' => $heroImage])>
            <div class="container">
                <span class="eyebrow">{{ __('public.menu.hero.eyebrow') }}</span>
                <h1>{{ __('public.menu.hero.h1') }}</h1>
                <p>{{ __('public.menu.hero.p') }}</p>
            </div>
        </section>

        <section class="menu-section">
            <div class="container">
                @if ($menus->isEmpty())
                    <div class="empty-state">{{ __('public.menu.empty_state') }}</div>
                @else
                    @php
                        $initialBatch = 12;
                        $hasMoreMenus  = $menus->count() > $initialBatch;
                    @endphp
                    <div class="menu-header">
                        <button type="button" class="btn btn-primary" id="btnFilterToggle" aria-label="Open Filters" onclick="openFilterModal()">
                            <i class="ph-faders"></i>
                            <span>{{ app()->getLocale() === 'id' ? 'Filter Kategori' : 'Filter Category' }}</span>
                        </button>
                    </div>

                    {{-- Initial server-rendered batch ──--}}
                    <div class="menu-grid" id="menuGrid">
                        @foreach ($menus->take($initialBatch) as $menu)
                            @php
                                $cleanDesc = addslashes(str_replace(["\r", "\n"], ' ', $menu->description));
                                $imageSrc  = $menu->image ? asset('storage/' . $menu->image) : '';
                            @endphp
                            <article class="menu-card" data-category-id="{{ $menu->menu_category_id ?? 0 }}"
                                onclick="openMenuModal('{{ addslashes($menu->name) }}', '{{ addslashes($menu->category->name ?? 'Menu') }}', '{{ $menu->formatted_price }}', '{{ $cleanDesc }}', '{{ $imageSrc }}')">
                                <div class="menu-image">
                                    @if ($menu->image)
                                        <div class="image-zoom-link">
                                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" loading="lazy">
                                            <span class="zoom-indicator"><i class="ph-magnifying-glass-plus"></i></span>
                                        </div>
                                    @else
                                        <div class="menu-placeholder"><i class="ph-image"></i></div>
                                    @endif
                                    @if ($menu->is_best_seller)
                                        <span class="menu-badge">{{ __('public.menu.badge.best_seller') }}</span>
                                    @elseif ($menu->is_featured)
                                        <span class="menu-badge">{{ __('public.menu.badge.featured') }}</span>
                                    @endif
                                </div>
                                <div class="menu-body">
                                    <span>{{ $menu->category->name ?? 'Menu' }}</span>
                                    <h3>{{ $menu->name }}</h3>
                                    <hr class="menu-divider">
                                    <div class="menu-footer">
                                        <strong>{{ $menu->formatted_price }}</strong>
                                        <span class="detail-trigger"><i class="ph-arrow-up-right"></i></span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    {{-- Skeleton cards shown while loading next batch --}}
                    <div class="menu-skeleton-container" id="menuSkeletonContainer">
                        @for ($s = 0; $s < 6; $s++)
                        <div class="skeleton-card">
                            <div class="sk-image"></div>
                            <div class="sk-body">
                                <div class="sk-line sk-line-sm"></div>
                                <div class="sk-line sk-line-lg"></div>
                                <div class="sk-line sk-line-md"></div>
                                <div class="sk-line sk-line-price"></div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    <div class="menu-sentinel" id="menuSentinel" aria-hidden="true"></div>
                @endif
            </div>

            {{-- Category Filter Modal --}}
            <div class="menu-modal" id="filterModal" aria-hidden="true" role="dialog">
                <div class="menu-modal-overlay" onclick="closeFilterModal()"></div>
                <div class="menu-modal-container" style="max-width: 480px;">
                    <button type="button" class="menu-modal-close" onclick="closeFilterModal()" aria-label="Close modal">
                        <i class="ph-x"></i>
                    </button>
                    <div class="filter-modal-header">
                        <h3>{{ app()->getLocale() === 'id' ? 'Filter Kategori' : 'Filter Categories' }}</h3>
                    </div>
                    <div class="filter-modal-body">
                        @foreach ($categoryTypes as $typeKey => $typeMeta)
                            @php
                                $groupCategories = $categories->where('type', $typeKey);
                            @endphp
                            @if ($groupCategories->isNotEmpty())
                                <div class="filter-group">
                                    <h4 class="filter-group-title">{{ app()->getLocale() === 'id' ? $typeMeta['label'] : $typeMeta['label_en'] }}</h4>
                                    <div class="filter-checkbox-grid">
                                        @foreach ($groupCategories as $category)
                                            <label class="filter-checkbox-label">
                                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="filter-checkbox-input" onchange="toggleFilterCheckbox(this)">
                                                <span class="filter-checkbox-btn">
                                                    {{ $category->name }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="filter-modal-footer">
                        <button type="button" class="btn btn-ghost" style="color: var(--primary-900); border-color: var(--primary-900); width: 100%;" onclick="resetFilters()">
                            {{ app()->getLocale() === 'id' ? 'Reset' : 'Reset' }}
                        </button>
                        <button type="button" class="btn btn-primary" style="width: 100%;" onclick="applyFilters()">
                            {{ app()->getLocale() === 'id' ? 'Terapkan' : 'Apply' }}
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <style>
        .page-hero {
            padding: 180px 0 86px;
            color: #fff;
            background-image: linear-gradient(90deg, rgba(17, 29, 28, 0.88), rgba(32, 50, 49, 0.52), rgba(32, 50, 49, 0.2)), var(--hero-image), linear-gradient(135deg, var(--primary-950), var(--primary-800));
            background-size: cover;
            background-position: center;
        }

        .eyebrow {
            display: inline-block;
            margin-bottom: 14px;
            color: rgba(255, 255, 255, .72);
            font-size: .78rem;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .page-hero h1 {
            max-width: 880px;
            margin: 0 0 18px;
            font-size: clamp(2.3rem, 4.5vw, 4.2rem);
            line-height: .98;
            letter-spacing: -.07em;
        }

        .page-hero p {
            max-width: 620px;
            margin: 0;
            color: rgba(255, 255, 255, .72);
            line-height: 1.75;
        }

        .menu-section {
            padding: 76px 0;
        }

        .menu-filters-wrapper {
            position: relative;
            margin-bottom: 24px;
        }

        /* Gradient overlays */
        .menu-filters-wrapper::before,
        .menu-filters-wrapper::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 48px;
            pointer-events: none;
            z-index: 2;
            transition: opacity .3s ease;
            opacity: 0;
        }

        .menu-filters-wrapper::before {
            left: 0;
            background: linear-gradient(to right, #fff, transparent);
        }

        .menu-filters-wrapper::after {
            right: 0;
            background: linear-gradient(to left, #fff, transparent);
        }

        .menu-filters-wrapper.has-scroll-left::before {
            opacity: 1;
        }

        .menu-filters-wrapper.has-scroll-right::after {
            opacity: 1;
        }

        .menu-filters {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none; /* Hide scrollbar for Firefox */
            -ms-overflow-style: none;  /* Hide scrollbar for IE/Edge */
            gap: 10px;
            padding: 4px 0; /* prevent box-shadow/border clipping */
            scroll-behavior: smooth;
        }

        .menu-filters::-webkit-scrollbar {
            display: none; /* Hide scrollbar for Chrome/Safari/Opera */
        }

        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid rgba(16, 20, 23, .08);
            box-shadow: 0 4px 12px rgba(16, 20, 23, .08);
            color: var(--primary-900);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: opacity 0.3s ease, transform 0.2s ease, background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
            opacity: 0;
            pointer-events: none;
        }

        .scroll-btn.btn-left {
            left: 8px;
        }

        .scroll-btn.btn-right {
            right: 8px;
        }

        .scroll-btn.is-visible {
            opacity: 1;
            pointer-events: auto;
        }

        .scroll-btn:hover {
            background: var(--primary-900);
            color: #fff;
            border-color: var(--primary-900);
            box-shadow: 0 6px 16px rgba(16, 20, 23, .16);
            transform: translateY(-50%) scale(1.05);
        }

        .filter-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid rgba(16, 20, 23, .12);
            background: #fff;
            color: var(--primary-900);
            padding: 10px 14px;
            border-radius: 999px;
            font-weight: 700;
            cursor: pointer;
            text-transform: capitalize;
            transition: all .18s ease;
            flex-shrink: 0; /* Prevent pills from shrinking */
        }

        .filter-pill i {
            font-size: 1rem;
        }

        .filter-pill:hover,
        .filter-pill.is-active {
            background: var(--primary-900);
            color: #fff;
            border-color: var(--primary-900);
        }

        .filter-divider {
            width: 1px;
            background-color: rgba(16, 20, 23, .16);
            margin: 4px 6px;
            flex-shrink: 0;
            border-radius: 2px;
        }

        /* ── Grid layout ── */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .menu-card {
            overflow: hidden;
            border-radius: 12px;
            background: #fff;
            border: 1px solid rgba(16, 20, 23, .06);
            box-shadow: 0 10px 30px rgba(16, 20, 23, .04);
            cursor: pointer;
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }

        .menu-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(16, 20, 23, .08);
            border-color: rgba(32, 50, 49, 0.15);
        }

        .menu-card.is-hidden,
        .menu-card.is-filtered-out {
            display: none;
        }

        /* ── Card image ── */
        .menu-image {
            position: relative;
            aspect-ratio: 4 / 3;
            background: var(--mist-100);
            overflow: hidden;
        }

        .image-zoom-link {
            position: absolute;
            inset: 0;
            display: block;
            overflow: hidden;
            color: inherit;
        }

        .menu-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .18s ease;
        }

        .menu-card:hover .menu-image img {
            transform: scale(1.05);
        }

        .zoom-indicator {
            position: absolute;
            right: 14px;
            bottom: 14px;
            width: 42px;
            height: 42px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            background: rgba(255, 255, 255, .86);
            color: var(--primary-900);
            backdrop-filter: blur(12px);
            box-shadow: 0 12px 28px rgba(16, 20, 23, .16);
            opacity: 0;
            transform: translateY(8px) scale(.94);
            transition: opacity .18s ease, transform .18s ease;
        }

        .menu-card:hover .zoom-indicator {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .menu-placeholder {
            width: 100%;
            height: 100%;
            display: grid;
            place-items: center;
            color: var(--sage-700);
            font-size: 2rem;
        }

        .menu-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(16, 20, 23, .82);
            color: #fff;
            font-size: .72rem;
            font-weight: 800;
        }

        /* ── Card body ── */
        .menu-body {
            padding: 16px 18px 18px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .menu-body span {
            display: block;
            color: var(--sage-700);
            font-size: .72rem;
            font-weight: 700;
            text-transform: capitalize;
            letter-spacing: 0.02em;
        }

        .menu-body h3 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 700;
            line-height: 1.3;
            color: var(--primary-950);
            text-transform: capitalize;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .menu-body strong {
            color: var(--primary-900);
            font-size: 1rem;
            font-weight: 800;
        }

        .menu-divider {
            border: 0;
            border-top: 1px solid rgba(16, 20, 23, 0.08);
            margin: 10px 0 8px;
            width: 100%;
        }

        .menu-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2px;
        }

        .detail-trigger {
            width: 26px;
            height: 26px;
            border-radius: 50% !important;
            background: rgba(32, 50, 49, 0.05);
            color: var(--primary-900);
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 0.85rem;
            line-height: 1 !important;
            box-sizing: border-box !important;
            transition: background-color 0.2s ease, transform 0.2s ease, color 0.2s ease;
        }

        .detail-trigger i {
            display: inline-block !important;
            line-height: 1 !important;
            margin: 0 !important;
            padding: 0 !important;
        }


        .menu-card:hover .detail-trigger {
            background: var(--primary-900);
            color: #fff;
            transform: scale(1.1);
        }

        .empty-state {
            padding: 28px;
            border-radius: 16px;
            background: #fff;
            text-align: center;
            color: var(--muted);
        }

        /* ── Skeleton loader ── */
        .menu-skeleton-container {
            display: none;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
            margin-top: 22px;
        }

        .menu-skeleton-container.is-visible {
            display: grid;
        }

        .skeleton-card {
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            border: 1px solid rgba(16, 20, 23, .06);
            box-shadow: 0 18px 44px rgba(16, 20, 23, .06);
        }

        /* Shimmer keyframe shared by all sk-* elements */
        @keyframes sk-shimmer {
            0%   { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .sk-image {
            position: relative;
            aspect-ratio: 4 / 3;
            background: #eaecee;
            overflow: hidden;
        }

        .sk-image::after,
        .sk-line::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                90deg,
                transparent 0%,
                rgba(255,255,255,.65) 40%,
                rgba(255,255,255,.9)  50%,
                rgba(255,255,255,.65) 60%,
                transparent 100%
            );
            animation: sk-shimmer 1.4s ease-in-out infinite;
        }

        .sk-body {
            padding: 16px 18px 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .sk-line {
            position: relative;
            border-radius: 8px;
            background: #eaecee;
            overflow: hidden;
        }

        .sk-line-sm    { height: 10px; width: 40%; }
        .sk-line-lg    { height: 16px; width: 85%; }
        .sk-line-md    { height: 12px; width: 65%; }
        .sk-line-price { height: 18px; width: 30%; margin-top: 4px; background: #dde2e6; }

        .menu-sentinel {
            height: 1px;
        }

        /* ── Responsive ── */
        @media (max-width: 992px) {
            .menu-grid,
            .menu-skeleton-container {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        /* 2 columns on mobile (≤ 480px) */
        @media (max-width: 480px) {
            .menu-grid,
            .menu-skeleton-container {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .menu-body {
                padding: 12px;
            }

            .menu-body h3 {
                font-size: .88rem;
            }

            .menu-body p {
                font-size: .78rem;
                min-height: unset;
            }

            .menu-body strong {
                font-size: .95rem;
            }
        }
    </style>
    </style>
    <style>
        .menu-header {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 24px;
        }

        .filter-modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(16, 20, 23, 0.08);
        }

        .filter-modal-header h3 {
            margin: 0;
            font-size: 1.1rem;
            color: var(--primary-950);
            font-weight: 800;
        }

        .filter-modal-body {
            padding: 20px 24px;
            max-height: 60vh;
            overflow-y: auto;
        }

        .filter-group {
            margin-bottom: 24px;
        }

        .filter-group:last-child {
            margin-bottom: 0;
        }

        .filter-group-title {
            margin: 0 0 12px;
            font-size: 0.85rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 800;
        }

        .filter-checkbox-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .filter-checkbox-label {
            cursor: pointer;
            margin: 0;
        }

        .filter-checkbox-input {
            display: none;
        }

        .filter-checkbox-btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 999px;
            border: 1px solid rgba(16, 20, 23, 0.12);
            background: #fff;
            color: var(--primary-900);
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.2s ease;
            user-select: none;
        }

        .filter-checkbox-btn:hover {
            border-color: var(--primary-900);
        }

        .filter-checkbox-input:checked + .filter-checkbox-btn {
            background: var(--primary-900);
            color: #fff;
            border-color: var(--primary-900);
            box-shadow: 0 4px 12px rgba(32, 50, 49, 0.2);
        }

        .filter-modal-footer {
            padding: 16px 24px;
            border-top: 1px solid rgba(16, 20, 23, 0.08);
            display: flex;
            gap: 12px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuApiUrl   = '{{ route('menu.data') }}';
            const gridEl       = document.getElementById('menuGrid');
            const skeletonEl   = document.getElementById('menuSkeletonContainer');
            const sentinelEl   = document.getElementById('menuSentinel');
            const BATCH        = 6;
            const NO_RESULT    = '{{ __('public.menu.no_result') }}';
            const LOAD_ERROR   = '{{ __('public.menu.load_error') }}';

            let currentFilter  = [];
            // Start at initialBatch count — server already rendered those cards
            let visibleCount   = gridEl ? gridEl.querySelectorAll('.menu-card').length : 0;
            let isLoading      = false;
            let hasMore        = @json($hasMoreMenus);
            let observer       = null;

            /* ── Render API items ── */
            const renderMenuItems = function(items) {
                if (!gridEl) return;
                const frag = document.createDocumentFragment();
                items.forEach(function(item) {
                    const el = document.createElement('article');
                    el.className = 'menu-card';
                    el.style.cursor = 'pointer';
                    el.setAttribute('data-category-id', item.category_id || 0);

                    // Safely escape parameters for modal trigger
                    const nameEsc = (item.name || '').replace(/'/g, "\\'");
                    const catEsc  = (item.category || '').replace(/'/g, "\\'");
                    const priceEsc = (item.price || '').replace(/'/g, "\\'");
                    const descEsc = (item.description || '').replace(/'/g, "\\'").replace(/[\r\n]+/g, ' ');
                    const imgEsc  = (item.image || '').replace(/'/g, "\\'");

                    el.setAttribute('onclick', "openMenuModal('" + nameEsc + "', '" + catEsc + "', '" + priceEsc + "', '" + descEsc + "', '" + imgEsc + "')");

                    let html = '<div class="menu-image">';
                    if (item.image) {
                        html += '<div class="image-zoom-link">';
                        html += '<img src="' + item.image + '" alt="' + (item.name || '') + '" loading="lazy">';
                        html += '<span class="zoom-indicator"><i class="ph-magnifying-glass-plus"></i></span>';
                        html += '</div>';
                    } else {
                        html += '<div class="menu-placeholder"><i class="ph-image"></i></div>';
                    }
                    if (item.badge) html += '<span class="menu-badge">' + item.badge + '</span>';
                    html += '</div>';
                    html += '<div class="menu-body">';
                    html += '<span>' + (item.category || '') + '</span>';
                    html += '<h3>' + (item.name || '') + '</h3>';
                    html += '<hr class="menu-divider">';
                    html += '<div class="menu-footer">';
                    html += '<strong>' + (item.price || '') + '</strong>';
                    html += '<span class="detail-trigger"><i class="ph-arrow-up-right"></i></span>';
                    html += '</div>';
                    html += '</div>';
                    el.innerHTML = html;
                    frag.appendChild(el);
                });
                gridEl.appendChild(frag);
            };

            /* ── Fetch from API (only called for filter change or scroll-load) ── */
            const fetchItems = function(offset, append) {
                if (!gridEl) return;
                if (skeletonEl) skeletonEl.classList.add('is-visible');

                let filterVal = 'all';
                if (Array.isArray(currentFilter)) {
                    filterVal = currentFilter.length ? currentFilter.join(',') : 'all';
                } else if (typeof currentFilter === 'string' && currentFilter.trim() !== '') {
                    filterVal = currentFilter;
                }

                const params = new URLSearchParams({
                    category: filterVal,
                    offset:   String(offset),
                    limit:    String(BATCH)
                });

                fetch(menuApiUrl + '?' + params.toString(), { headers: { 'Accept': 'application/json' } })
                    .then(function(r) {
                        if (!r.ok) throw new Error();
                        return r.json();
                    })
                    .then(function(data) {
                        if (!append) gridEl.innerHTML = '';

                        if (data.items && data.items.length) {
                            renderMenuItems(data.items);
                        } else if (!append) {
                            gridEl.innerHTML = '<div class="empty-state">' + NO_RESULT + '</div>';
                        }

                        visibleCount = offset + (data.items ? data.items.length : 0);
                        hasMore      = Boolean(data.hasMore);
                        isLoading    = false;

                        if (skeletonEl) {
                            skeletonEl.classList.remove('is-visible');
                        }
                    })
                    .catch(function() {
                        if (!append && gridEl) gridEl.innerHTML = '<div class="empty-state">' + LOAD_ERROR + '</div>';
                        isLoading = false;
                        if (skeletonEl) skeletonEl.classList.remove('is-visible');
                    });
            };

            /* ── Infinite scroll: load next batch ── */
            const loadMore = function() {
                if (isLoading || !hasMore || !sentinelEl) return;
                isLoading = true;
                fetchItems(visibleCount, true);
            };

            /* ── Filter Init ── */
            window.openFilterModal = function() {
                const modal = document.getElementById('filterModal');
                if (modal) modal.classList.add('is-active');
            };

            window.closeFilterModal = function() {
                const modal = document.getElementById('filterModal');
                if (modal) modal.classList.remove('is-active');
            };

            window.toggleFilterCheckbox = function(checkbox) {
                // Checkbox handles its own state
            };

            window.resetFilters = function() {
                const checkboxes = document.querySelectorAll('.filter-checkbox-input');
                checkboxes.forEach(cb => cb.checked = false);
                currentFilter = [];
                visibleCount  = 0;
                hasMore       = true;
                isLoading     = false;
                fetchItems(0, false);
                closeFilterModal();
            };

            window.applyFilters = function() {
                const checkboxes = document.querySelectorAll('.filter-checkbox-input:checked');
                currentFilter = Array.from(checkboxes).map(cb => cb.value);
                visibleCount  = 0;
                hasMore       = true;
                isLoading     = false;
                fetchItems(0, false);
                closeFilterModal();
            };

            /* ── Hero animation ── */
            if (window.gsap) {
                gsap.from('.page-hero .eyebrow, .page-hero h1, .page-hero p', {
                    y: 34, opacity: 0, duration: .9, stagger: .12, ease: 'power3.out'
                });
            }

            /* ── Init ── */
            // Initial server-rendered cards have onclick handlers already

            /* ── Sentinel observer — triggers only for scroll-load, NOT on initial page load ── */
            if (sentinelEl) {
                observer = new IntersectionObserver(function(entries) {
                    if (entries[0] && entries[0].isIntersecting) loadMore();
                }, { rootMargin: '400px 0px' });
                observer.observe(sentinelEl);
            }
        });
    </script>
@endpush
