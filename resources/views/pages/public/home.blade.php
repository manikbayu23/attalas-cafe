@extends('layouts.public')

@section('title', 'Attalas Cafe - Coffee, Comfort, and Kintamani View')

@section('content')
    <main>
        <header class="home-hero">
            <video class="hero-video" autoplay muted loop playsinline poster="{{ asset('assets/images/attalas-logo.png') }}">
                <source src="{{ asset('assets/videos/attalas-hero.mp4') }}" type="video/mp4">
            </video>

            <div class="container hero-inner">
                <div class="hero-content">
                    <span class="eyebrow"><i class="ph-mountains"></i> Kintamani scenic coffee experience</span>
                    <h1>Kopi hangat, udara sejuk, dan view Kintamani.</h1>
                    <p>
                        Nikmati suasana cafe yang tenang dengan sajian kopi, menu pilihan, dan panorama Kintamani
                        yang membuat waktu santai terasa lebih berkesan.
                    </p>
                    <div class="hero-actions">
                        <a href="#menu" class="btn btn-ghost"><i class="ph-arrow-down"></i>Explore</a>
                    </div>
                </div>
            </div>
        </header>

        <section class="section">
            <div class="container">
                <div class="features">
                    <div class="feature-card">
                        <i class="ph-coffee"></i>
                        <h3>Curated Coffee</h3>
                        <p>Kopi yang diracik untuk menemani suasana sejuk dan tenang di Kintamani.</p>
                    </div>
                    <div class="feature-card">
                        <i class="ph-mountains"></i>
                        <h3>Scenic View</h3>
                        <p>Panorama alam menjadi bagian dari pengalaman bersantai di Attalas Cafe.</p>
                    </div>
                    <div class="feature-card">
                        <i class="ph-fork-knife"></i>
                        <h3>Fresh Menu</h3>
                        <p>Pilihan menu yang cocok untuk sarapan, makan siang, hingga camilan sore.</p>
                    </div>
                    <div class="feature-card">
                        <i class="ph-heart"></i>
                        <h3>Warm Service</h3>
                        <p>Pelayanan ramah untuk membuat setiap kunjungan terasa nyaman dan personal.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="menu">
            <div class="container">
                <div class="section-header">
                    <div>
                        <span class="section-kicker">Menu pilihan</span>
                        <h2>Favorit pelanggan Attalas.</h2>
                    </div>
                    <p>Beberapa menu unggulan yang sering jadi pilihan untuk menemani waktu santai di cafe.</p>
                </div>

                @if ($featuredMenus->isEmpty())
                    <div class="empty-state">Belum ada menu featured yang ditampilkan.</div>
                @else
                    <div class="menu-grid">
                        @foreach ($featuredMenus as $menu)
                            <article class="menu-card">
                                <div class="menu-image">
                                    @if ($menu->image)
                                        <a href="{{ asset('storage/' . $menu->image) }}" data-fancybox="home-menu"
                                            data-caption="{{ $menu->name }} - {{ $menu->formatted_price }}"
                                            class="image-zoom-link">
                                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}">
                                            <span class="zoom-indicator"><i class="ph-magnifying-glass-plus"></i></span>
                                        </a>
                                    @endif
                                    @if ($menu->is_best_seller)
                                        <span class="menu-badge">Best Seller</span>
                                    @elseif ($menu->is_featured)
                                        <span class="menu-badge">Featured</span>
                                    @endif
                                </div>
                                <div class="menu-body">
                                    <div class="menu-meta">{{ $menu->category->name ?? 'Menu' }}</div>
                                    <h3>{{ $menu->name }}</h3>
                                    <p>{{ Str::limit($menu->description, 90) }}</p>
                                    <div class="menu-footer">
                                        <strong>{{ $menu->formatted_price }}</strong>
                                        <i class="ph-arrow-up-right"></i>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section class="about-band">
            <div class="container about-grid">
                <div>
                    <span class="section-kicker light">Tentang kami</span>
                    <h2>Dibuat untuk menikmati kopi dan view dengan lebih tenang.</h2>
                    <p>
                        Attalas Cafe hadir sebagai tempat singgah yang hangat di Kintamani. Kami memadukan sajian kopi,
                        makanan, dan ambience alami agar setiap kunjungan terasa santai, premium, dan berkesan.
                    </p>
                </div>
                <div class="about-metrics">
                    <div><strong>01</strong><span>Scenic ambience</span></div>
                    <div><strong>02</strong><span>Curated coffee</span></div>
                    <div><strong>03</strong><span>Fresh menu</span></div>
                    <div><strong>04</strong><span>Warm service</span></div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="section-header">
                    <div>
                        <span class="section-kicker">Gallery</span>
                        <h2>Momen hangat di Attalas.</h2>
                    </div>
                    <p>Intip suasana, menu, dan beberapa sudut favorit dari Attalas Cafe.</p>
                </div>

                @if ($galleryItems->isEmpty())
                    <div class="empty-state">Belum ada gallery yang ditampilkan.</div>
                @else
                    <div class="gallery-grid">
                        @foreach ($galleryItems as $gallery)
                            <div class="gallery-item">
                                <a href="{{ asset('storage/' . $gallery->image) }}" data-fancybox="home-gallery"
                                    data-caption="{{ $gallery->title ?? 'Gallery Attalas Cafe' }}" class="image-zoom-link">
                                    <img src="{{ asset('storage/' . $gallery->image) }}"
                                        alt="{{ $gallery->title ?? 'Gallery Attalas Cafe' }}">
                                    <span class="zoom-indicator"><i class="ph-magnifying-glass-plus"></i></span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section class="section reviews-section">
            <div class="container">
                <div class="section-header">
                    <div>
                        <span class="section-kicker">Review</span>
                        <h2>Cerita pelanggan kami.</h2>
                    </div>
                </div>

                @if ($reviews->isEmpty())
                    <div class="empty-state">Belum ada ulasan yang ditampilkan.</div>
                @else
                    <div class="review-carousel owl-carousel" id="reviewCarousel" aria-label="Customer reviews carousel">
                        @foreach ($reviews as $review)
                            @php
                                $reviewTitle =
                                    $review->rating >= 5
                                        ? 'Great day!'
                                        : ($review->rating >= 4
                                            ? 'Wonderful experience'
                                            : 'Nice visit');
                            @endphp
                            <article class="review-card google-review-card">
                                <div class="review-topline">
                                    <div class="reviewer-profile">
                                        <div class="review-avatar">
                                            {{ Str::upper(Str::substr($review->customer_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h3>{{ $review->customer_name }}</h3>
                                            <div class="stars" aria-label="{{ $review->rating }} out of 5 stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <span
                                                        class="google-star {{ $i <= $review->rating ? 'is-filled' : '' }}">★</span>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <time>{{ $review->created_at?->format('F Y') ?? 'November 2024' }}</time>
                                </div>

                                <h4>{{ $reviewTitle }}</h4>
                                <p>{{ Str::limit($review->review, 210) }}</p>

                                <div class="review-brand">
                                    <span class="maps-pin"><i class="ph-map-pin-fill"></i></span>
                                    <span>Google Maps</span>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    </main>
@endsection

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <style>
        .home-hero {
            position: relative;
            height: 100vh;
            overflow: hidden;
            color: #fff;
            background: linear-gradient(135deg, var(--primary-950), var(--primary-800));
        }

        .home-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 2;
            background-image: linear-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.04) 1px, transparent 1px);
            background-size: 44px 44px;
            opacity: 0.18;
            pointer-events: none;
        }

        .home-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 1;
            background:
                linear-gradient(90deg, rgba(17, 29, 28, 0.74), rgba(32, 50, 49, 0.5), rgba(32, 50, 49, 0.14)),
                linear-gradient(180deg, rgba(17, 29, 28, 0.18), rgba(17, 29, 28, 0.06), rgba(17, 29, 28, 0.62));
            pointer-events: none;
        }

        .hero-video {
            position: absolute;
            inset: 0;
            z-index: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.9;
            transform: scale(1.02);
        }

        .hero-inner {
            position: relative;
            z-index: 3;
            height: 100vh;
            display: flex;
            align-items: center;
            padding: 120px 0 90px;
        }

        .hero-content {
            max-width: 780px;
        }

        .eyebrow,
        .section-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .eyebrow {
            color: rgba(255, 255, 255, 0.76);
        }

        .hero-content h1 {
            margin: 0 0 22px;
            font-size: clamp(2.7rem, 6vw, 5.8rem);
            line-height: 0.95;
            letter-spacing: -0.075em;
        }

        .hero-content p {
            max-width: 640px;
            margin: 0 0 30px;
            color: rgba(255, 255, 255, 0.74);
            font-size: 1.05rem;
            line-height: 1.75;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .section {
            padding: 86px 0;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 24px;
            margin-bottom: 30px;
        }

        .section-kicker {
            color: var(--sage-700);
        }

        .section-header h2,
        .about-band h2 {
            margin: 0;
            font-size: clamp(1.9rem, 3vw, 3rem);
            line-height: 1.05;
            letter-spacing: -0.06em;
        }

        .section-header p {
            max-width: 540px;
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
        }

        .feature-card,
        .menu-card {
            background: #fff;
            border: 1px solid rgba(16, 20, 23, 0.06);
            box-shadow: 0 18px 44px rgba(16, 20, 23, 0.08);
        }

        .feature-card {
            padding: 24px;
            border-radius: 28px;
        }

        .feature-card i {
            display: inline-grid;
            place-items: center;
            width: 48px;
            height: 48px;
            margin-bottom: 18px;
            border-radius: 18px;
            background: rgba(127, 155, 136, 0.16);
            color: var(--sage-700);
            font-size: 1.45rem;
        }

        .feature-card h3,
        .menu-body h3 {
            margin: 0 0 8px;
        }

        .feature-card p,
        .menu-body p,
        .about-band p {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .menu-card {
            overflow: hidden;
            border-radius: 28px;
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
            transition: transform 0.18s ease;
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
            background: rgba(255, 255, 255, 0.86);
            color: var(--primary-900);
            backdrop-filter: blur(12px);
            box-shadow: 0 12px 28px rgba(16, 20, 23, 0.16);
            opacity: 0;
            transform: translateY(8px) scale(0.94);
            transition: opacity 0.18s ease, transform 0.18s ease;
        }

        .menu-image:hover .zoom-indicator,
        .gallery-item:hover .zoom-indicator {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .menu-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(16, 20, 23, 0.82);
            color: #fff;
            font-size: 0.72rem;
            font-weight: 800;
        }

        .menu-body {
            padding: 18px;
        }

        .menu-meta {
            margin-bottom: 6px;
            color: var(--muted);
            font-size: 0.82rem;
        }

        .menu-body p {
            min-height: 44px;
            margin-bottom: 16px;
        }

        .menu-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .about-band {
            padding: 86px 0;
            color: #fff;
            background:
                linear-gradient(90deg, rgba(17, 29, 28, 0.88), rgba(32, 50, 49, 0.68)),
                linear-gradient(135deg, var(--primary-950), var(--primary-800));
        }

        .about-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(320px, 0.9fr);
            gap: 46px;
            align-items: center;
        }

        .section-kicker.light {
            color: rgba(255, 255, 255, 0.68);
        }

        .about-band p {
            margin-top: 16px;
            color: rgba(255, 255, 255, 0.72);
        }

        .about-metrics {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .about-metrics div {
            min-height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: end;
            padding: 18px;
            border-radius: 26px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .about-metrics strong {
            font-size: 1.9rem;
        }

        .about-metrics span {
            color: rgba(255, 255, 255, 0.72);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 14px;
        }

        .gallery-item {
            position: relative;
            min-height: 170px;
            overflow: hidden;
            border-radius: 24px;
            background: var(--mist-100);
        }

        .gallery-item:nth-child(1),
        .gallery-item:nth-child(4) {
            grid-column: span 2;
            grid-row: span 2;
        }

        .gallery-item:nth-child(2),
        .gallery-item:nth-child(3),
        .gallery-item:nth-child(5),
        .gallery-item:nth-child(6) {
            grid-column: span 2;
        }

        .gallery-item img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.18s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .reviews-section {
            padding-top: 0;
        }

        .review-carousel .owl-stage-outer {
            padding: 4px 2px 28px;
        }

        .google-review-card {
            min-height: 390px;
            display: flex;
            flex-direction: column;
            padding: 24px;
            border-radius: 30px;
            background: #fff;
            border: 1px solid #e7eaeb;
            box-shadow: 0 1px 10px rgba(16, 20, 23, 0.07);
        }

        .review-topline {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .reviewer-profile {
            display: flex;
            gap: 14px;
            align-items: center;
            min-width: 0;
        }

        .review-avatar {
            width: 54px;
            height: 54px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            flex: 0 0 auto;
            background: linear-gradient(135deg, var(--primary-900), var(--primary-700));
            color: #fff;
            font-size: 1.35rem;
            font-weight: 800;
            box-shadow: 0 12px 26px rgba(32, 50, 49, 0.18);
        }

        .reviewer-profile h3 {
            margin: 0 0 7px;
            font-size: 1rem;
            font-weight: 800;
            color: var(--text);
        }

        .review-topline time {
            color: #9aa2a5;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        .stars {
            display: flex;
            gap: 2px;
            line-height: 1;
        }

        .google-star {
            font-size: 1.05rem;
            color: #d7dcde;
        }

        .google-star.is-filled {
            color: #fbbc04;
        }

        .google-review-card h4 {
            margin: 0 0 14px;
            color: var(--text);
            font-size: 1.35rem;
            line-height: 1.15;
            letter-spacing: -0.04em;
        }

        .google-review-card p {
            margin: 0;
            color: #6d777a;
            line-height: 1.75;
            font-size: 0.98rem;
        }

        .review-brand {
            margin-top: auto;
            padding-top: 22px;
            display: inline-flex;
            justify-content: flex-end;
            align-items: center;
            gap: 8px;
            color: #5f686b;
            font-size: 0.88rem;
            font-weight: 700;
        }

        .maps-pin {
            width: 30px;
            height: 30px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            color: #fff;
            background: linear-gradient(135deg, #4285f4, #34a853 48%, #fbbc05 74%, #ea4335);
            font-size: 1rem;
        }

        .review-carousel .owl-nav {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 2px;
        }

        .review-carousel .owl-nav button.owl-prev,
        .review-carousel .owl-nav button.owl-next {
            width: 44px;
            height: 44px;
            border-radius: 999px !important;
            background: #fff !important;
            border: 1px solid #e3e7e8 !important;
            color: var(--primary-900) !important;
            box-shadow: 0 10px 24px rgba(16, 20, 23, 0.07);
            font-size: 1.25rem !important;
        }

        .review-carousel .owl-dots {
            margin-top: 14px !important;
        }

        .review-carousel .owl-dot span {
            width: 8px !important;
            height: 8px !important;
            background: #ccd3d4 !important;
            transition: width 0.18s ease, background-color 0.18s ease;
        }

        .review-carousel .owl-dot.active span {
            width: 24px !important;
            background: var(--primary-900) !important;
        }

        .empty-state {
            padding: 34px;
            border-radius: 24px;
            background: #fff;
            color: var(--muted);
            text-align: center;
            border: 1px dashed rgba(16, 20, 23, 0.18);
        }

        @media (max-width: 992px) {

            .features,
            .menu-grid,
            .about-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .gallery-item,
            .gallery-item:nth-child(n) {
                grid-column: span 1;
                grid-row: span 1;
            }
        }

        @media (max-width: 640px) {

            .home-hero,
            .hero-inner {
                min-height: 640px;
            }

            .hero-inner {
                padding: 120px 0 64px;
            }

            .section,
            .about-band {
                padding: 58px 0;
            }

            .features,
            .menu-grid,
            .about-grid,
            .about-metrics {
                grid-template-columns: 1fr;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.Fancybox) {
                Fancybox.bind('[data-fancybox="home-menu"], [data-fancybox="home-gallery"]', {
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

            if (window.jQuery && jQuery.fn.owlCarousel) {
                jQuery('#reviewCarousel').owlCarousel({
                    loop: true,
                    margin: 22,
                    nav: true,
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 2000,
                    autoplayHoverPause: true,
                    smartSpeed: 650,
                    slideBy: 1,
                    navText: ['<i class="ph-arrow-left"></i>', '<i class="ph-arrow-right"></i>'],
                    responsive: {
                        0: {
                            items: 1
                        },
                        760: {
                            items: 2
                        },
                        1120: {
                            items: 3
                        }
                    }
                });
            }

            if (!window.gsap) {
                return;
            }

            gsap.timeline({
                    defaults: {
                        ease: 'power3.out'
                    }
                })
                .from('.eyebrow', {
                    y: 22,
                    opacity: 0,
                    duration: 0.75
                }, 0.15)
                .from('.hero-content h1', {
                    y: 42,
                    opacity: 0,
                    duration: 1
                }, 0.3)
                .from('.hero-content p', {
                    y: 30,
                    opacity: 0,
                    duration: 0.9
                }, 0.48)
                .from('.hero-actions .btn', {
                    y: 24,
                    opacity: 0,
                    duration: 0.75,
                    stagger: 0.12
                }, 0.62);

            gsap.to('.hero-video', {
                scale: 1.08,
                ease: 'none',
                scrollTrigger: {
                    trigger: '.home-hero',
                    start: 'top top',
                    end: 'bottom top',
                    scrub: true
                }
            });

            ['.feature-card', '.menu-card', '.about-metrics div', '.gallery-item', '.review-card'].forEach(function(
                selector) {
                gsap.utils.toArray(selector).forEach(function(item, index) {
                    gsap.from(item, {
                        y: 44,
                        opacity: 0,
                        duration: 0.8,
                        delay: (index % 4) * 0.06,
                        ease: 'power3.out',
                        scrollTrigger: {
                            trigger: item,
                            start: 'top 86%',
                            toggleActions: 'play none none reverse'
                        }
                    });
                });
            });

            gsap.utils.toArray('.section-header, .about-grid > div:first-child').forEach(function(header) {
                gsap.from(header.children, {
                    y: 26,
                    opacity: 0,
                    duration: 0.8,
                    stagger: 0.12,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: header,
                        start: 'top 84%',
                        toggleActions: 'play none none reverse'
                    }
                });
            });
        });
    </script>
@endpush
