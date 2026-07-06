@extends('layouts.public')

@section('title', 'Gallery - Attalas Cafe')

@section('content')
    <main>
        <section class="page-hero" @style(['--hero-image: url(' . $heroImage . ')' => $heroImage])>
            <div class="container">
                <span class="eyebrow">Gallery</span>
                <h1>Momen, menu, dan view Attalas Cafe.</h1>
                <p>Lihat beberapa suasana terbaik dari Attalas Cafe dan Kintamani.</p>
            </div>
        </section>

        <section class="gallery-section">
            <div class="container">
                @if ($galleries->isEmpty())
                    <div class="empty-state">Belum ada gallery yang ditampilkan.</div>
                @else
                    @php $initialBatch = 12; @endphp
                    <div class="gallery-grid" id="galleryGrid">
                        @foreach ($galleries as $index => $gallery)
                            @php $isVisible = $index < $initialBatch; @endphp
                            <figure class="gallery-card{{ $isVisible ? '' : ' is-hidden' }}">
                                <a href="{{ asset('storage/' . $gallery->image) }}" data-fancybox="gallery-page"
                                    data-caption="{{ $gallery->title ?? 'Gallery Attalas Cafe' }}" class="image-zoom-link">
                                    <img src="{{ $isVisible ? asset('storage/' . $gallery->image) : 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==' }}"
                                        data-src="{{ asset('storage/' . $gallery->image) }}"
                                        alt="{{ $gallery->title ?? 'Attalas Cafe Gallery' }}" loading="lazy">
                                    <span class="zoom-indicator"><i class="ph-magnifying-glass-plus"></i></span>
                                </a>
                            </figure>
                        @endforeach
                    </div>

                    @if ($galleries->count() > $initialBatch)
                        <div class="gallery-loading" id="galleryLoading">Memuat lebih banyak...</div>
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

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .gallery-card {
            position: relative;
            margin: 0;
            min-height: 310px;
            overflow: hidden;
            border-radius: 28px;
            background: var(--mist-100);
            box-shadow: 0 18px 44px rgba(16, 20, 23, .08);
        }

        .gallery-card:nth-child(4n+1) {
            min-height: 430px;
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

        .empty-state,
        .gallery-loading {
            padding: 28px;
            border-radius: 24px;
            background: #fff;
            text-align: center;
            color: var(--muted);
        }

        .gallery-loading {
            margin-top: 24px;
        }

        .gallery-sentinel {
            height: 1px;
        }

        @media (max-width: 992px) {
            .gallery-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .gallery-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.Fancybox) {
                Fancybox.bind('[data-fancybox="gallery-page"]', {
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

            if (window.gsap) {
                gsap.from('.page-hero .eyebrow, .page-hero h1, .page-hero p', {
                    y: 34,
                    opacity: 0,
                    duration: .9,
                    stagger: .12,
                    ease: 'power3.out'
                });
                gsap.utils.toArray('.gallery-card').forEach(function(card, index) {
                    gsap.from(card, {
                        y: 44,
                        opacity: 0,
                        duration: .8,
                        delay: (index % 3) * .06,
                        ease: 'power3.out',
                        scrollTrigger: {
                            trigger: card,
                            start: 'top 86%'
                        }
                    });
                });
            }

            const galleryCards = Array.from(document.querySelectorAll('.gallery-card'));
            const loadingEl = document.getElementById('galleryLoading');
            const sentinelEl = document.getElementById('gallerySentinel');
            const batchSize = 6;
            let visibleCount = 0;
            let isLoading = false;

            const showNextBatch = () => {
                if (isLoading || !sentinelEl || visibleCount >= galleryCards.length) {
                    if (loadingEl) {
                        loadingEl.style.display = 'none';
                    }
                    return;
                }

                isLoading = true;
                if (loadingEl) {
                    loadingEl.style.display = 'block';
                }

                setTimeout(function() {
                    const nextCards = galleryCards.slice(visibleCount, visibleCount + batchSize);
                    nextCards.forEach(function(card) {
                        card.classList.remove('is-hidden');
                        const img = card.querySelector('img[data-src]');
                        if (img) {
                            img.setAttribute('src', img.getAttribute('data-src'));
                            img.removeAttribute('data-src');
                        }
                    });

                    visibleCount += nextCards.length;
                    isLoading = false;

                    if (visibleCount >= galleryCards.length && loadingEl) {
                        loadingEl.remove();
                    }
                }, 220);
            };

            if (sentinelEl) {
                const observer = new IntersectionObserver(function(entries) {
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
