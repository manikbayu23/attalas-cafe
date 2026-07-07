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
                    <div class="menu-filters" role="tablist" aria-label="Filter menu">
                        <button type="button" class="filter-pill is-active" data-filter="all">
                            <i class="ph-squares-four"></i><span>{{ __('public.menu.filter_all') }}</span>
                        </button>
                        @foreach ($categories as $category)
                            <button type="button" class="filter-pill" data-filter="{{ $category->id }}">
                                <i class="{{ $category->icon }}"></i><span>{{ $category->name }}</span>
                            </button>
                        @endforeach
                    </div>

                    {{-- Initial server-rendered batch --}}
                    <div class="menu-grid" id="menuGrid">
                        @foreach ($menus->take($initialBatch) as $menu)
                            <article class="menu-card" data-category-id="{{ $menu->menu_category_id ?? 0 }}">
                                <div class="menu-image">
                                    @if ($menu->image)
                                        <a href="{{ asset('storage/' . $menu->image) }}" data-fancybox="menu-page"
                                            data-caption="{{ $menu->name }}" class="image-zoom-link">
                                            <img src="{{ asset('storage/' . $menu->image) }}"
                                                alt="{{ $menu->name }}" loading="lazy">
                                            <span class="zoom-indicator"><i class="ph-magnifying-glass-plus"></i></span>
                                        </a>
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
                                    <p>{{ Str::limit($menu->description, 105) }}</p>
                                    <strong>{{ $menu->formatted_price }}</strong>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    @if ($hasMoreMenus)
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
                @endif
            </div>
        </section>
    </main>
@endsection

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <style>
        .page-hero {
            padding: 150px 0 86px;
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
            font-size: clamp(2.5rem, 5vw, 5rem);
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

        .menu-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 24px;
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
            transition: all .18s ease;
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

        /* ── Grid layout ── */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .menu-card {
            overflow: hidden;
            border-radius: 28px;
            background: #fff;
            border: 1px solid rgba(16, 20, 23, .06);
            box-shadow: 0 18px 44px rgba(16, 20, 23, .08);
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
            padding: 18px;
        }

        .menu-body span {
            display: block;
            margin-bottom: 6px;
            color: var(--muted);
            font-size: .82rem;
        }

        .menu-body h3 {
            margin: 0 0 8px;
        }

        .menu-body p {
            min-height: 52px;
            margin: 0 0 16px;
            color: var(--muted);
            line-height: 1.65;
        }

        .menu-body strong {
            color: var(--primary-900);
            font-size: 1.08rem;
        }

        .empty-state {
            padding: 28px;
            border-radius: 24px;
            background: #fff;
            text-align: center;
            color: var(--muted);
        }

        /* ── Skeleton loader ── */
        .menu-skeleton-container {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
            margin-top: 22px;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity .3s ease, visibility .3s ease;
        }

        .menu-skeleton-container.is-visible {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .skeleton-card {
            border-radius: 28px;
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
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuApiUrl   = '{{ route('menu.data') }}';
            const gridEl       = document.getElementById('menuGrid');
            const filterBtns   = Array.from(document.querySelectorAll('.filter-pill'));
            const skeletonEl   = document.getElementById('menuSkeletonContainer');
            const sentinelEl   = document.getElementById('menuSentinel');
            const BATCH        = 6;
            const NO_RESULT    = '{{ __('public.menu.no_result') }}';
            const LOAD_ERROR   = '{{ __('public.menu.load_error') }}';

            let currentFilter  = 'all';
            // Start at initialBatch count — server already rendered those cards
            let visibleCount   = gridEl ? gridEl.querySelectorAll('.menu-card').length : 0;
            let isLoading      = false;
            let hasMore        = !!sentinelEl;
            let observer       = null;

            /* ── Fancybox init ── */
            const initFancybox = function() {
                if (!window.Fancybox) return;
                Fancybox.bind('[data-fancybox="menu-page"]', {
                    animated: true,
                    dragToClose: true,
                    Images: { zoom: true },
                    Toolbar: { display: { left: [], middle: [], right: ['close'] } },
                });
            };

            /* ── Render API items ── */
            const renderMenuItems = function(items) {
                if (!gridEl) return;
                const frag = document.createDocumentFragment();
                items.forEach(function(item) {
                    const el = document.createElement('article');
                    el.className = 'menu-card';
                    el.setAttribute('data-category-id', item.category_id || 0);
                    let html = '<div class="menu-image">';
                    if (item.image) {
                        html += '<a href="' + item.image + '" data-fancybox="menu-page" data-caption="' + (item.name || '') + '" class="image-zoom-link">';
                        html += '<img src="' + item.image + '" alt="' + (item.name || '') + '" loading="lazy">';
                        html += '<span class="zoom-indicator"><i class="ph-magnifying-glass-plus"></i></span>';
                        html += '</a>';
                    } else {
                        html += '<div class="menu-placeholder"><i class="ph-image"></i></div>';
                    }
                    if (item.badge) html += '<span class="menu-badge">' + item.badge + '</span>';
                    html += '</div>';
                    html += '<div class="menu-body">';
                    html += '<span>' + (item.category || '') + '</span>';
                    html += '<h3>' + (item.name || '') + '</h3>';
                    html += '<p>' + (item.description ? item.description.substring(0, 105) : '') + '</p>';
                    html += '<strong>' + (item.price || '') + '</strong>';
                    html += '</div>';
                    el.innerHTML = html;
                    frag.appendChild(el);
                });
                gridEl.appendChild(frag);
                initFancybox();
            };

            /* ── Fetch from API (only called for filter change or scroll-load) ── */
            const fetchItems = function(offset, append) {
                if (!gridEl) return;
                if (skeletonEl && append) skeletonEl.classList.add('is-visible');

                const params = new URLSearchParams({
                    category: currentFilter,
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
                            if (!hasMore) skeletonEl.remove();
                        }
                    })
                    .catch(function() {
                        if (!append && gridEl) gridEl.innerHTML = '<div class="empty-state">' + LOAD_ERROR + '</div>';
                        isLoading = false;
                        if (skeletonEl) skeletonEl.classList.remove('is-visible');
                    });
            };

            /* ── Filter change: re-fetch from offset 0 ── */
            const resetAndLoad = function(filter) {
                currentFilter = filter;
                visibleCount  = 0;
                hasMore       = true;
                isLoading     = false;
                fetchItems(0, false);
            };

            /* ── Infinite scroll: load next batch ── */
            const loadMore = function() {
                if (isLoading || !hasMore || !sentinelEl) return;
                isLoading = true;
                fetchItems(visibleCount, true);
            };

            /* ── Filter buttons ── */
            filterBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    filterBtns.forEach(function(b) { b.classList.remove('is-active'); });
                    btn.classList.add('is-active');
                    resetAndLoad(btn.getAttribute('data-filter'));
                });
            });

            /* ── Hero animation ── */
            if (window.gsap) {
                gsap.from('.page-hero .eyebrow, .page-hero h1, .page-hero p', {
                    y: 34, opacity: 0, duration: .9, stagger: .12, ease: 'power3.out'
                });
            }

            /* ── Init ── */
            initFancybox(); // bind initial server-rendered cards

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
