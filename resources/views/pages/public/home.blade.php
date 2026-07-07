@extends('layouts.public')

@section('title', __('public.seo.home_title'))
@section('meta_description', __('public.seo.home_description'))

@section('content')
    <main>
        <header class="home-hero">
            <video class="hero-video" autoplay muted loop playsinline poster="{{ asset('assets/images/image-hero.png') }}">
                <source src="{{ asset('assets/videos/attalas-hero2.mp4') }}" type="video/mp4">
            </video>

            <div class="container hero-inner">
                <div class="hero-content">
                    <span class="eyebrow"><i class="ph-mountains"></i> {{ __('public.home.hero.eyebrow') }}</span>
                    <h1>{{ __('public.home.hero.h1') }}</h1>
                    <p>{{ __('public.home.hero.p') }}</p>
                    <div class="hero-actions">
                        <a href="#menu" class="btn btn-ghost"><i class="ph-arrow-down"></i>{{ __('public.home.hero.explore') }}</a>
                    </div>
                </div>
            </div>
        </header>

        <section class="section">
            <div class="container">
                <div class="features">
                    <div class="feature-card">
                        <i class="ph-coffee"></i>
                        <h3>{{ __('public.home.features.coffee_title') }}</h3>
                        <p>{{ __('public.home.features.coffee_desc') }}</p>
                    </div>
                    <div class="feature-card">
                        <i class="ph-mountains"></i>
                        <h3>{{ __('public.home.features.view_title') }}</h3>
                        <p>{{ __('public.home.features.view_desc') }}</p>
                    </div>
                    <div class="feature-card">
                        <i class="ph-fork-knife"></i>
                        <h3>{{ __('public.home.features.menu_title') }}</h3>
                        <p>{{ __('public.home.features.menu_desc') }}</p>
                    </div>
                    <div class="feature-card">
                        <i class="ph-heart"></i>
                        <h3>{{ __('public.home.features.service_title') }}</h3>
                        <p>{{ __('public.home.features.service_desc') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="menu">
            <div class="container">
                <div class="section-header">
                    <div>
                        <span class="section-kicker">{{ __('public.home.menu_section.kicker') }}</span>
                        <h2>{{ __('public.home.menu_section.h2') }}</h2>
                    </div>
                    <p>{{ __('public.home.menu_section.p') }}</p>
                </div>

                @if ($featuredMenus->isEmpty())
                    <div class="empty-state">{{ __('public.home.menu_section.empty_state') }}</div>
                @else
                    <div class="menu-grid">
                        @foreach ($featuredMenus as $menu)
                            @php
                                $cleanDesc = addslashes(str_replace(["\r", "\n"], ' ', $menu->description));
                                $imageSrc  = $menu->image ? asset('storage/' . $menu->image) : '';
                            @endphp
                            <article class="menu-card" onclick="openMenuModal('{{ addslashes($menu->name) }}', '{{ addslashes($menu->category->name ?? 'Menu') }}', '{{ $menu->formatted_price }}', '{{ $cleanDesc }}', '{{ $imageSrc }}')">
                                <div class="menu-image">
                                    @if ($menu->image)
                                        <div class="image-zoom-link">
                                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}">
                                            <span class="zoom-indicator"><i class="ph-magnifying-glass-plus"></i></span>
                                        </div>
                                    @endif
                                    @if ($menu->is_best_seller)
                                        <span class="menu-badge">{{ __('public.menu.badge.best_seller') }}</span>
                                    @elseif ($menu->is_featured)
                                        <span class="menu-badge">{{ __('public.menu.badge.featured') }}</span>
                                    @endif
                                </div>
                                <div class="menu-body">
                                    <div class="menu-meta">{{ $menu->category->name ?? 'Menu' }}</div>
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
                @endif
            </div>
        </section>

        <section class="about-band">
            <div class="container about-grid">
                <div>
                    <span class="section-kicker light">{{ __('public.home.about_band.kicker') }}</span>
                    <h2>{{ __('public.home.about_band.h2') }}</h2>
                    <p>{{ __('public.home.about_band.p') }}</p>
                </div>
                <div class="about-metrics">
                    <div><strong>01</strong><span>{{ __('public.home.about_band.metric_1') }}</span></div>
                    <div><strong>02</strong><span>{{ __('public.home.about_band.metric_2') }}</span></div>
                    <div><strong>03</strong><span>{{ __('public.home.about_band.metric_3') }}</span></div>
                    <div><strong>04</strong><span>{{ __('public.home.about_band.metric_4') }}</span></div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="section-header">
                    <div>
                        <span class="section-kicker">{{ __('public.home.gallery_section.kicker') }}</span>
                        <h2>{{ __('public.home.gallery_section.h2') }}</h2>
                    </div>
                    <p>{{ __('public.home.gallery_section.p') }}</p>
                </div>

                @if ($galleryItems->isEmpty())
                    <div class="empty-state">{{ __('public.home.gallery_section.empty_state') }}</div>
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
                        <span class="section-kicker">{{ __('public.home.reviews_section.kicker') }}</span>
                        <h2>{{ __('public.home.reviews_section.h2') }}</h2>
                    </div>
                </div>

                @if ($reviews->isEmpty())
                    <div class="empty-state">{{ __('public.home.reviews_section.empty_state') }}</div>
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
            padding: 26px 24px 28px;
            border-radius: 16px;
            transition: transform .22s ease, box-shadow .22s ease;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 28px 56px rgba(16, 20, 23, .13);
        }

        .feature-card i {
            display: inline-grid;
            place-items: center;
            width: 52px;
            height: 52px;
            margin-bottom: 20px;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(127, 155, 136, 0.18), rgba(127, 155, 136, 0.08));
            color: var(--sage-700);
            font-size: 1.55rem;
            box-shadow: inset 0 1px 0 rgba(255,255,255,.7);
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
            border-radius: 12px;
            border: 1px solid rgba(16, 20, 23, .06);
            box-shadow: 0 10px 30px rgba(16, 20, 23, .04);
            cursor: pointer;
            transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
        }

        .menu-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(16, 20, 23, .08);
            border-color: rgba(32, 50, 49, 0.15);
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
            padding: 16px 18px 18px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .menu-meta {
            color: var(--sage-700);
            font-size: 0.72rem;
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

        .menu-footer strong {
            font-size: 1rem;
            color: var(--primary-900);
            font-weight: 800;
        }

        .detail-trigger {
            width: 26px;
            height: 26px;
            border-radius: 999px;
            background: rgba(32, 50, 49, 0.05);
            color: var(--primary-900);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            line-height: 0;
            font-size: 0.85rem;
            transition: background-color 0.2s ease, transform 0.2s ease, color 0.2s ease;
        }

        .detail-trigger i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1em;
            height: 1em;
            line-height: 1;
        }

        .menu-card:hover .detail-trigger {
            background: var(--primary-900);
            color: #fff;
            transform: scale(1.1);
        }

        .about-band {
            padding: 86px 0;
            color: #fff;
            background:
                linear-gradient(135deg, rgba(17,29,28,0.92), rgba(32,50,49,0.76)),
                linear-gradient(135deg, var(--primary-950), var(--primary-800));
            position: relative;
            overflow: hidden;
        }

        /* decorative blob */
        .about-band::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at 80% 40%, rgba(127,155,136,0.13) 0%, transparent 60%);
            pointer-events: none;
        }

        .about-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(300px, 0.9fr);
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
            gap: 14px;
        }

        .about-metrics div {
            min-height: 140px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 18px;
            border-radius: 26px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(6px);
            transition: background .2s ease, border-color .2s ease;
        }

        .about-metrics div:hover {
            background: rgba(255, 255, 255, 0.13);
            border-color: rgba(255, 255, 255, 0.22);
        }

        .about-metrics strong {
            font-size: 2rem;
            line-height: 1;
            letter-spacing: -0.04em;
        }

        .about-metrics span {
            margin-top: 6px;
            color: rgba(255, 255, 255, 0.66);
            font-size: .85rem;
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
            border-radius: 16px;
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
            border-radius: 16px;
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
            .features {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

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

        /* ── Mobile: 2-col for everything ── */
        @media (max-width: 480px) {

            .section,
            .about-band {
                padding: 48px 0;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            /* Hero tighter */
            .home-hero,
            .hero-inner {
                min-height: 580px;
            }

            .hero-inner {
                padding: 110px 0 56px;
            }

            /* features: 2×2 grid */
            .features {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .feature-card {
                padding: 18px 16px 20px;
                border-radius: 22px;
            }

            .feature-card i {
                width: 42px;
                height: 42px;
                font-size: 1.25rem;
                margin-bottom: 14px;
                border-radius: 14px;
            }

            .feature-card h3 {
                font-size: .92rem;
            }

            .feature-card p {
                font-size: .82rem;
            }

            /* menu: 2-col */
            .menu-grid {
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

            /* about-band: stack vertically but keep metrics 2×2 */
            .about-grid {
                grid-template-columns: 1fr;
                gap: 28px;
            }

            .about-band h2 {
                font-size: 1.7rem;
            }

            .about-metrics {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px;
            }

            .about-metrics div {
                min-height: 110px;
                padding: 14px;
                border-radius: 20px;
            }

            .about-metrics strong {
                font-size: 1.55rem;
            }

            /* gallery home: 2-col */
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .gallery-item,
            .gallery-item:nth-child(n) {
                grid-column: span 1;
                grid-row: span 1;
                min-height: 130px;
            }

            .gallery-item {
                border-radius: 16px;
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
