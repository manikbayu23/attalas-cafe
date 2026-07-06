@extends('layouts.public')

@section('title', 'Menu - Attalas Cafe')

@section('content')
    <main>
        <section class="page-hero" @style(['--hero-image: url(' . $heroImage . ')' => $heroImage])>
            <div class="container">
                <span class="eyebrow">Our Menu</span>
                <h1>Menu pilihan untuk menikmati suasana Kintamani.</h1>
                <p>Kopi, makanan, dan minuman yang disiapkan untuk menemani waktu santai di Attalas Cafe.</p>
            </div>
        </section>

        <section class="menu-section">
            <div class="container">
                @if ($menus->isEmpty())
                    <div class="empty-state">Belum ada menu yang ditampilkan.</div>
                @else
                    @php $initialBatch = 12; @endphp
                    <div class="menu-filters" role="tablist" aria-label="Filter menu">
                        <button type="button" class="filter-pill is-active" data-filter="all">
                            <i class="ph-squares-four"></i><span>All</span>
                        </button>
                        @foreach ($categories as $category)
                            <button type="button" class="filter-pill" data-filter="{{ $category->id }}">
                                <i class="{{ $category->icon }}"></i><span>{{ $category->name }}</span>
                            </button>
                        @endforeach
                    </div>

                    <div class="menu-grid" id="menuGrid">
                        @foreach ($menus as $index => $menu)
                            @php $isVisible = $index < $initialBatch; @endphp
                            <article class="menu-card{{ $isVisible ? '' : ' is-hidden' }}"
                                data-category-id="{{ $menu->menu_category_id ?? 0 }}">
                                <div class="menu-image">
                                    @if ($menu->image)
                                        <a href="{{ asset('storage/' . $menu->image) }}" data-fancybox="menu-page"
                                            data-caption="{{ $menu->name }}" class="image-zoom-link">
                                            <img src="{{ $isVisible ? asset('storage/' . $menu->image) : 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==' }}"
                                                data-src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                                loading="lazy">
                                            <span class="zoom-indicator"><i class="ph-magnifying-glass-plus"></i></span>
                                        </a>
                                    @else
                                        <div class="menu-placeholder"><i class="ph-image"></i></div>
                                    @endif
                                    @if ($menu->is_best_seller)
                                        <span class="menu-badge">Best Seller</span>
                                    @elseif ($menu->is_featured)
                                        <span class="menu-badge">Featured</span>
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

                    @if ($menus->count() > $initialBatch)
                        <div class="menu-skeleton-container" id="menuSkeletonContainer">
                            <div class="menu-card skeleton-card"></div>
                            <div class="menu-card skeleton-card"></div>
                            <div class="menu-card skeleton-card"></div>
                            <div class="menu-card skeleton-card"></div>
                            <div class="menu-card skeleton-card"></div>
                            <div class="menu-card skeleton-card"></div>
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

        .menu-skeleton-container {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
            margin-top: 24px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .menu-skeleton-container.is-visible {
            opacity: 1;
            visibility: visible;
        }

        .skeleton-card {
            position: relative;
            background: #d9d9d9;
            overflow: hidden;
            border-radius: 28px;
            box-shadow: 0 18px 44px rgba(16, 20, 23, .08);
        }

        .skeleton-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg,
                    transparent 0%,
                    rgba(255, 255, 255, 0.6) 25%,
                    rgba(255, 255, 255, 1) 50%,
                    rgba(255, 255, 255, 0.6) 75%,
                    transparent 100%);
            animation: skeleton-shimmer 1.8s infinite;
            z-index: 1;
            pointer-events: none;
        }

        @keyframes skeleton-shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .menu-sentinel {
            height: 1px;
        }

        @media (max-width: 992px) {
            .menu-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .menu-skeleton-container {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .menu-grid {
                grid-template-columns: 1fr;
            }

            .menu-skeleton-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuApiUrl = '{{ route('menu.data') }}';
            const gridEl = document.getElementById('menuGrid');
            const filterButtons = Array.from(document.querySelectorAll('.filter-pill'));
            const skeletonContainer = document.getElementById('menuSkeletonContainer');
            const sentinelEl = document.getElementById('menuSentinel');
            const batchSize = 6;
            let currentFilter = 'all';
            let visibleCount = document.querySelectorAll('.menu-card:not(.is-hidden)').length;
            let isLoading = false;
            let hasMore = true;
            let observer = null;

            const initFancybox = function() {
                if (window.Fancybox) {
                    Fancybox.bind('[data-fancybox="menu-page"]', {
                        animated: true,
                        dragToClose: true,
                        Images: {
                            zoom: true,
                        },
                        Toolbar: {
                            display: {
                                left: [],
                                middle: [],
                                right: ['close'],
                            },
                        },
                    });
                }
            };

            const loadCardImage = function(card) {
                const img = card.querySelector('img[data-src]');
                if (!img) {
                    return;
                }

                const src = img.getAttribute('data-src');
                if (src) {
                    img.setAttribute('src', src);
                    img.removeAttribute('data-src');
                }
            };

            const renderMenuItems = function(items) {
                if (!gridEl) {
                    return;
                }

                const fragment = document.createDocumentFragment();
                items.forEach(function(item) {
                    const article = document.createElement('article');
                    article.className = 'menu-card';
                    article.innerHTML = [
                        '<div class="menu-image">',
                        item.image ? '<a href="' + item.image +
                        '" data-fancybox="menu-page" data-caption="' + (item.name || 'Menu') +
                        '" class="image-zoom-link">' :
                        '<div class="menu-placeholder"><i class="ph-image"></i></div>',
                        item.image ?
                        '<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" data-src="' +
                        item.image + '" alt="' + (item.name || 'Menu') + '" loading="lazy">' : '',
                        item.image ?
                        '<span class="zoom-indicator"><i class="ph-magnifying-glass-plus"></i></span>' :
                        '',
                        item.image ? '</a>' : '',
                        item.badge ? '<span class="menu-badge">' + item.badge + '</span>' : '',
                        '</div>',
                        '<div class="menu-body">',
                        '<span>' + (item.category || 'Menu') + '</span>',
                        '<h3>' + (item.name || 'Menu') + '</h3>',
                        '<p>' + (item.description ? item.description.substring(0, 105) : '') +
                        '</p>',
                        '<strong>' + (item.price || '') + '</strong>',
                        '</div>'
                    ].join('');
                    fragment.appendChild(article);
                });

                gridEl.appendChild(fragment);
                initFancybox();
                gridEl.querySelectorAll('.menu-card').forEach(function(card) {
                    loadCardImage(card);
                });
            };

            const clearGrid = function() {
                if (gridEl) {
                    gridEl.innerHTML = '';
                }
            };

            const fetchMenuItems = function(offset, append) {
                if (!gridEl) {
                    return;
                }

                if (skeletonContainer && append) {
                    skeletonContainer.classList.add('is-visible');
                }

                const params = new URLSearchParams({
                    category: currentFilter,
                    offset: String(offset),
                    limit: String(batchSize)
                });

                fetch(menuApiUrl + '?' + params.toString(), {
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                    .then(function(response) {
                        if (!response.ok) {
                            throw new Error('Request failed');
                        }
                        return response.json();
                    })
                    .then(function(data) {
                        if (!append) {
                            clearGrid();
                        }

                        if (data.items && data.items.length) {
                            renderMenuItems(data.items);
                        } else if (!append) {
                            if (gridEl) {
                                gridEl.innerHTML =
                                    '<div class="empty-state">Tidak Ada menu.</div>';
                            }
                        }

                        visibleCount = offset + (data.items ? data.items.length : 0);
                        hasMore = Boolean(data.hasMore);
                        isLoading = false;

                        if (skeletonContainer) {
                            skeletonContainer.classList.remove('is-visible');
                            if (!hasMore) {
                                skeletonContainer.remove();
                            }
                        }
                    })
                    .catch(function() {
                        if (!append && gridEl) {
                            gridEl.innerHTML =
                                '<div class="empty-state">Gagal memuat menu. Silakan coba lagi.</div>';
                        }
                        isLoading = false;
                        if (skeletonContainer) {
                            skeletonContainer.classList.remove('is-visible');
                        }
                    });
            };

            const resetAndLoad = function(filter) {
                currentFilter = filter;
                visibleCount = 0;
                hasMore = true;
                isLoading = false;
                fetchMenuItems(0, false);
            };

            const showNextBatch = function() {
                if (isLoading || !hasMore || !sentinelEl) {
                    return;
                }

                isLoading = true;
                fetchMenuItems(visibleCount, true);
            };

            filterButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    filterButtons.forEach(function(item) {
                        item.classList.remove('is-active');
                    });
                    button.classList.add('is-active');
                    resetAndLoad(button.getAttribute('data-filter'));
                });
            });

            if (window.gsap) {
                gsap.from('.page-hero .eyebrow, .page-hero h1, .page-hero p', {
                    y: 34,
                    opacity: 0,
                    duration: .9,
                    stagger: .12,
                    ease: 'power3.out'
                });
            }

            initFancybox();
            resetAndLoad('all');

            if (sentinelEl) {
                observer = new IntersectionObserver(function(entries) {
                    if (entries[0] && entries[0].isIntersecting) {
                        showNextBatch();
                    }
                }, {
                    rootMargin: '400px 0px'
                });

                observer.observe(sentinelEl);
            }
        });
    </script>
@endpush
