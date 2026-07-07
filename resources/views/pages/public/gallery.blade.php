@extends('layouts.public')

@section('title', __('public.seo.gallery_title'))
@section('meta_description', __('public.seo.gallery_description'))

@section('content')
    <main>
        <section class="page-hero" @style(['--hero-image: url(' . $heroImage . ')' => $heroImage])>
            <div class="container">
                <span class="eyebrow">{{ __('public.gallery.hero.eyebrow') }}</span>
                <h1>{{ __('public.gallery.hero.h1') }}</h1>
                <p>{{ __('public.gallery.hero.p') }}</p>
            </div>
        </section>

        <section class="gallery-section">
            <div class="container">
                @if ($galleries->isEmpty())
                    <div class="empty-state">{{ __('public.gallery.empty_state') }}</div>
                @else
                    @php
                        $initialBatch  = 12;
                        $hasMoreGallery = $galleries->count() > $initialBatch;
                    @endphp
                    <div class="gallery-grid" id="galleryGrid">
                        @foreach ($galleries->take($initialBatch) as $gallery)
                            <figure class="gallery-card">
                                <a href="{{ asset('storage/' . $gallery->image) }}" data-fancybox="gallery-page"
                                    data-caption="{{ $gallery->title ?? 'Gallery Attalas Cafe' }}" class="image-zoom-link">
                                    <img src="{{ asset('storage/' . $gallery->image) }}"
                                        alt="{{ $gallery->title ?? 'Attalas Cafe Gallery' }}" loading="lazy">
                                    <span class="zoom-indicator"><i class="ph-magnifying-glass-plus"></i></span>
                                </a>
                            </figure>
                        @endforeach

                        {{-- Hidden cards for JS batch reveal --}}
                        @foreach ($galleries->skip($initialBatch) as $gallery)
                            <figure class="gallery-card is-hidden">
                                <a href="{{ asset('storage/' . $gallery->image) }}" data-fancybox="gallery-page"
                                    data-caption="{{ $gallery->title ?? 'Gallery Attalas Cafe' }}" class="image-zoom-link">
                                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw=="
                                        data-src="{{ asset('storage/' . $gallery->image) }}"
                                        alt="{{ $gallery->title ?? 'Attalas Cafe Gallery' }}" loading="lazy">
                                    <span class="zoom-indicator"><i class="ph-magnifying-glass-plus"></i></span>
                                </a>
                            </figure>
                        @endforeach
                    </div>

                    @if ($hasMoreGallery)
                        <div class="gallery-skeleton-container" id="gallerySkeletonContainer">
                            @for ($s = 0; $s < 6; $s++)
                            <div class="skeleton-card">
                                <div class="sk-image"></div>
                            </div>
                            @endfor
                        </div>
                        <div class="gallery-sentinel" id="gallerySentinel" aria-hidden="true"></div>
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
            background-image: linear-gradient(90deg, rgba(17, 29, 28, .88), rgba(32, 50, 49, .48), rgba(32, 50, 49, .18)), var(--hero-image), linear-gradient(135deg, var(--primary-950), var(--primary-800));
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
            max-width: 900px;
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

        .gallery-section {
            padding: 76px 0;
        }

        /* ── Gallery grid ── */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .gallery-card {
            position: relative;
            margin: 0;
            min-height: 260px;
            overflow: hidden;
            border-radius: 28px;
            background: var(--mist-100);
            box-shadow: 0 18px 44px rgba(16, 20, 23, .08);
        }

        /* Every 4th card is taller for visual rhythm (tablet+) */
        @media (min-width: 641px) {
            .gallery-card:nth-child(4n+1) {
                min-height: 400px;
            }
        }

        .gallery-card.is-hidden {
            display: none;
        }

        .image-zoom-link {
            position: absolute;
            inset: 0;
            display: block;
            overflow: hidden;
            color: inherit;
        }

        .gallery-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            inset: 0;
            transition: transform .2s ease;
        }

        .gallery-card:hover img {
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

        .gallery-card:hover .zoom-indicator {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .empty-state {
            padding: 28px;
            border-radius: 24px;
            background: #fff;
            text-align: center;
            color: var(--muted);
        }

        /* ── Skeleton loader ── */
        .gallery-skeleton-container {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-top: 18px;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity .3s ease, visibility .3s ease;
        }

        .gallery-skeleton-container.is-visible {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .skeleton-card {
            border-radius: 28px;
            overflow: hidden;
            background: var(--mist-100);
            box-shadow: 0 18px 44px rgba(16, 20, 23, .06);
        }

        @keyframes sk-shimmer {
            0%   { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .sk-image {
            position: relative;
            min-height: 260px;
            background: #e4e7ea;
            overflow: hidden;
        }

        .sk-image::after {
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

        .gallery-sentinel { height: 1px; }

        /* ── Responsive ── */
        @media (max-width: 992px) {
            .gallery-grid,
            .gallery-skeleton-container {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        /* 2 columns on mobile (≤ 480px) */
        @media (max-width: 480px) {
            .gallery-grid,
            .gallery-skeleton-container {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px;
            }

            .gallery-card {
                min-height: 160px;
                border-radius: 18px;
            }

            .skeleton-card {
                border-radius: 18px;
            }

            .sk-image {
                min-height: 160px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            /* ── Fancybox ── */
            if (window.Fancybox) {
                Fancybox.bind('[data-fancybox="gallery-page"]', {
                    animated: true,
                    dragToClose: true,
                    Images: { zoom: true },
                    Toolbar: { display: { left: [], middle: [], right: ['close'] } },
                });
            }

            /* ── Hero animation ── */
            if (window.gsap) {
                gsap.from('.page-hero .eyebrow, .page-hero h1, .page-hero p', {
                    y: 34, opacity: 0, duration: .9, stagger: .12, ease: 'power3.out'
                });
            }

            /* ── Infinite scroll ── */
            const galleryGrid  = document.getElementById('galleryGrid');
            const skeletonEl   = document.getElementById('gallerySkeletonContainer');
            const sentinelEl   = document.getElementById('gallerySentinel');
            const BATCH        = 6;
            let isLoading      = false;
            let hasMore        = !!sentinelEl;

            const revealCards = function() {
                const hidden = galleryGrid.querySelectorAll('.gallery-card.is-hidden');
                const batch  = Array.from(hidden).slice(0, BATCH);

                batch.forEach(function(card) {
                    card.classList.remove('is-hidden');
                    // swap placeholder src with real src
                    const img = card.querySelector('img[data-src]');
                    if (img) {
                        img.src = img.getAttribute('data-src');
                        img.removeAttribute('data-src');
                    }
                    // GSAP entrance
                    if (window.gsap) {
                        gsap.from(card, {
                            y: 40, opacity: 0, duration: .7, ease: 'power3.out',
                            scrollTrigger: { trigger: card, start: 'top 88%' }
                        });
                    }
                });

                return batch.length;
            };

            const loadMore = function() {
                if (isLoading || !hasMore) return;
                isLoading = true;
                if (skeletonEl) skeletonEl.classList.add('is-visible');

                setTimeout(function() {
                    const revealed = revealCards();

                    if (skeletonEl) skeletonEl.classList.remove('is-visible');

                    // no more hidden cards?
                    if (galleryGrid.querySelectorAll('.gallery-card.is-hidden').length === 0) {
                        hasMore = false;
                        if (sentinelEl) sentinelEl.remove();
                        if (skeletonEl)  skeletonEl.remove();
                    }

                    isLoading = false;
                }, 280);
            };

            if (sentinelEl) {
                new IntersectionObserver(function(entries) {
                    if (entries[0] && entries[0].isIntersecting && !isLoading && hasMore) loadMore();
                }, { rootMargin: '400px 0px', threshold: 0 }).observe(sentinelEl);
            }

            /* Initial entrance animation for visible cards */
            if (window.gsap && window.ScrollTrigger) {
                gsap.registerPlugin(ScrollTrigger);
                galleryGrid.querySelectorAll('.gallery-card:not(.is-hidden)').forEach(function(card, i) {
                    gsap.from(card, {
                        y: 40, opacity: 0, duration: .7,
                        delay: (i % 3) * .05,
                        ease: 'power3.out',
                        scrollTrigger: { trigger: card, start: 'top 88%' }
                    });
                });
            }
        });
    </script>
@endpush
