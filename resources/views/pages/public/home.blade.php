<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attalas Cafe - Coffee, Comfort, and Taste</title>
    <link rel="icon" href="{{ asset('assets/images/attalas-logo.png') }}" type="image/png">
    <link href="{{ asset('admin/assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        :root {
            --brown-950: #211008;
            --brown-900: #2b160d;
            --brown-700: #5a3720;
            --brown-500: #8b5a2b;
            --brown-300: #b77b45;
            --graphite-950: #101417;
            --graphite-800: #242b2f;
            --graphite-600: #4a5358;
            --cream-50: #fbf7f1;
            --cream-100: #f3e6d5;
            --text: #24150d;
            --muted: #7a6a5f;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--cream-50);
            color: var(--text);
        }

        img {
            max-width: 100%;
            display: block;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .container {
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
        }

        .navbar {
            position: fixed;
            top: 18px;
            left: 0;
            right: 0;
            z-index: 50;
            pointer-events: none;
            transition: top 0.28s ease, transform 0.28s ease;
        }

        .navbar.is-scrolled {
            top: 8px;
            transform: translateY(-2px);
        }

        .navbar .container {
            width: min(1320px, calc(100% - 28px));
        }

        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 14px 12px 22px;
            gap: 24px;
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.82);
            box-shadow: 0 18px 48px rgba(33, 16, 8, 0.16);
            backdrop-filter: blur(18px);
            pointer-events: auto;
            min-height: 68px;
            transition: min-height 0.28s ease, padding 0.28s ease, box-shadow 0.28s ease, background-color 0.28s ease;
        }

        .navbar.is-scrolled .nav-inner {
            min-height: 62px;
            padding-top: 9px;
            padding-bottom: 9px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 14px 36px rgba(33, 16, 8, 0.14);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .brand img {
            width: 38px;
            height: 38px;
            border-radius: 999px;
            object-fit: cover;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #5f4a3c;
            font-size: 0.94rem;
        }

        .nav-links a {
            padding: 9px 13px;
            border-radius: 999px;
        }

        .nav-links a:hover {
            background: rgba(16, 20, 23, 0.08);
            color: var(--graphite-950);
        }

        .mobile-toggle {
            display: none;
            width: 42px;
            height: 42px;
            border: 0;
            border-radius: 999px;
            background: var(--brown-900);
            color: #fff;
            font-size: 1.35rem;
            cursor: pointer;
        }

        .mobile-menu {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            left: 16px;
            right: 16px;
            padding: 10px;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 18px 48px rgba(33, 16, 8, 0.16);
            backdrop-filter: blur(18px);
        }

        .mobile-menu.is-open {
            display: grid;
        }

        .mobile-menu a {
            padding: 13px 14px;
            border-radius: 16px;
            color: #4d3b30;
            font-weight: 700;
        }

        .mobile-menu a:hover {
            background: rgba(16, 20, 23, 0.08);
            color: var(--graphite-950);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 999px;
            padding: 11px 18px;
            font-weight: 700;
            font-size: 0.92rem;
            transition: transform 0.15s ease, box-shadow 0.15s ease, background-color 0.15s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: var(--graphite-950);
            color: #fff;
            box-shadow: 0 14px 28px rgba(16, 20, 23, 0.24);
        }

        .btn-primary:hover {
            background: var(--graphite-800);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.14);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.24);
            backdrop-filter: blur(12px);
        }

        .hero {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at top right, rgba(159, 200, 179, 0.28), transparent 42%),
                linear-gradient(135deg, #0f1f1f, #354844);
            color: #fff;
            min-height: 760px;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 2;
            background-image: linear-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.04) 1px, transparent 1px);
            background-size: 44px 44px;
            opacity: 0.22;
            pointer-events: none;
        }

        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 1;
            background:
                linear-gradient(90deg, rgba(6, 18, 20, 0.74) 0%, rgba(14, 32, 33, 0.52) 40%, rgba(14, 32, 33, 0.18) 72%, rgba(6, 18, 20, 0.44) 100%),
                linear-gradient(180deg, rgba(6, 18, 20, 0.22) 0%, rgba(6, 18, 20, 0.08) 48%, rgba(6, 18, 20, 0.62) 100%);
            pointer-events: none;
        }

        .hero-video {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
            opacity: 0.88;
            transform: scale(1.02);
        }

        .hero-inner {
            position: relative;
            z-index: 3;
            min-height: 760px;
            display: flex;
            align-items: center;
            padding: 120px 0 90px;
        }

        .hero-content {
            max-width: 760px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 13px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 999px;
            color: rgba(255, 255, 255, 0.78);
            font-size: 0.8rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .hero h1 {
            font-size: clamp(2.6rem, 6vw, 5.6rem);
            line-height: 0.95;
            letter-spacing: -0.07em;
            margin: 0 0 22px;
        }

        .hero p {
            max-width: 620px;
            margin: 0 0 28px;
            color: rgba(255, 255, 255, 0.74);
            font-size: 1.05rem;
            line-height: 1.75;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 0;
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
            color: var(--brown-500);
            font-weight: 800;
            font-size: 0.8rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 9px;
        }

        .section-title {
            margin: 0;
            font-size: clamp(1.9rem, 3vw, 3rem);
            letter-spacing: -0.05em;
            color: var(--brown-900);
        }

        .section-copy {
            max-width: 560px;
            color: var(--muted);
            line-height: 1.7;
            margin: 0;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
        }

        .feature-card {
            padding: 24px;
            border-radius: 26px;
            background: #fff;
            box-shadow: 0 16px 38px rgba(43, 22, 13, 0.08);
            border: 1px solid rgba(139, 90, 43, 0.08);
        }

        .feature-card i {
            display: inline-grid;
            place-items: center;
            width: 46px;
            height: 46px;
            border-radius: 16px;
            background: rgba(139, 90, 43, 0.09);
            color: var(--brown-500);
            font-size: 1.45rem;
            margin-bottom: 18px;
        }

        .feature-card h3 {
            margin: 0 0 8px;
            color: var(--brown-900);
        }

        .feature-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.65;
            font-size: 0.93rem;
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
            border: 1px solid rgba(139, 90, 43, 0.08);
            box-shadow: 0 18px 42px rgba(43, 22, 13, 0.08);
        }

        .menu-image {
            position: relative;
            aspect-ratio: 4 / 3;
            background: var(--cream-100);
            overflow: hidden;
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

        .menu-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(33, 16, 8, 0.78);
            color: #fff;
            font-size: 0.72rem;
            font-weight: 800;
        }

        .menu-body {
            padding: 18px;
        }

        .menu-meta {
            color: var(--muted);
            font-size: 0.82rem;
            margin-bottom: 6px;
        }

        .menu-body h3 {
            margin: 0 0 8px;
            color: var(--brown-900);
        }

        .menu-body p {
            min-height: 44px;
            color: var(--muted);
            line-height: 1.55;
            margin: 0 0 16px;
            font-size: 0.92rem;
        }

        .menu-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .price {
            font-weight: 900;
            color: var(--brown-500);
        }

        .about-band {
            background:
                linear-gradient(135deg, rgba(43, 22, 13, 0.9), rgba(139, 90, 43, 0.86)),
                var(--brown-700);
            color: #fff;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 0.95fr 1.05fr;
            gap: 42px;
            align-items: center;
        }

        .about-panel {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .about-tile {
            min-height: 160px;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 18px;
            display: flex;
            flex-direction: column;
            justify-content: end;
        }

        .about-tile strong {
            font-size: 1.9rem;
            display: block;
        }

        .about-tile span {
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.9rem;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 14px;
        }

        .gallery-item {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            background: var(--cream-100);
            min-height: 170px;
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
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            inset: 0;
        }

        .reviews {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .review-card {
            padding: 24px;
            border-radius: 28px;
            background: #fff;
            border: 1px solid rgba(139, 90, 43, 0.08);
            box-shadow: 0 18px 42px rgba(43, 22, 13, 0.08);
        }

        .stars {
            color: #d99b29;
            margin-bottom: 14px;
        }

        .review-card p {
            color: var(--muted);
            line-height: 1.7;
            margin: 0 0 18px;
        }

        .review-card strong {
            color: var(--brown-900);
        }

        .reservation-cta {
            padding: 56px;
            border-radius: 34px;
            background:
                radial-gradient(circle at right, rgba(183, 123, 69, 0.32), transparent 36%),
                linear-gradient(135deg, var(--brown-900), var(--brown-500));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 28px;
            box-shadow: 0 24px 60px rgba(43, 22, 13, 0.2);
        }

        .reservation-cta h2 {
            margin: 0 0 10px;
            font-size: clamp(1.9rem, 3vw, 3rem);
            letter-spacing: -0.05em;
        }

        .reservation-cta p {
            margin: 0;
            color: rgba(255, 255, 255, 0.74);
            max-width: 580px;
            line-height: 1.7;
        }

        .footer {
            padding: 44px 0;
            background: var(--brown-950);
            color: rgba(255, 255, 255, 0.72);
        }

        .footer-inner {
            display: flex;
            justify-content: space-between;
            gap: 24px;
            align-items: center;
        }

        .footer strong {
            color: #fff;
        }

        .whatsapp-float {
            position: fixed;
            right: 24px;
            bottom: 24px;
            z-index: 60;
            width: 58px;
            height: 58px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            background: #25d366;
            color: #fff;
            box-shadow: 0 16px 34px rgba(37, 211, 102, 0.35);
            font-size: 1.75rem;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .whatsapp-float:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 20px 42px rgba(37, 211, 102, 0.42);
            color: #fff;
        }

        .empty-state {
            padding: 34px;
            border-radius: 24px;
            background: #fff;
            color: var(--muted);
            text-align: center;
            border: 1px dashed rgba(139, 90, 43, 0.22);
        }

        @media (max-width: 992px) {

            .nav-links,
            .nav-cta {
                display: none;
            }

            .mobile-toggle {
                display: inline-grid;
                place-items: center;
            }

            .about-grid {
                grid-template-columns: 1fr;
            }

            .features,
            .menu-grid,
            .reviews {
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
            .hero-inner {
                min-height: auto;
                padding: 54px 0 64px;
            }

            .features,
            .menu-grid,
            .reviews,
            .about-panel {
                grid-template-columns: 1fr;
            }

            .section {
                padding: 58px 0;
            }

            .section-header,
            .reservation-cta,
            .footer-inner {
                flex-direction: column;
                align-items: flex-start;
            }

            .reservation-cta {
                padding: 32px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar" id="siteNavbar">
        <div class="container nav-inner">
            <a href="{{ route('home') }}" class="brand" aria-label="Attalas Cafe Home">
                <img src="{{ asset('assets/images/attalas-logo.png') }}" alt="Attalas Cafe Logo">
                <span>Attalas Cafe</span>
            </a>

            <div class="nav-links" aria-label="Main navigation">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('about') }}">About Us</a>
                <a href="{{ route('menu') }}">Menu</a>
                <a href="{{ route('gallery') }}">Gallery</a>
                <a href="{{ route('reservation') }}">Reservation</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>

            <a href="{{ route('reservation') }}" class="btn btn-primary nav-cta">Book a Table</a>

            <button type="button" class="mobile-toggle" id="mobileMenuToggle" aria-label="Open main menu"
                aria-expanded="false">
                <i class="ph-list"></i>
            </button>

            <div class="mobile-menu" id="mobileMenu">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('about') }}">About Us</a>
                <a href="{{ route('menu') }}">Menu</a>
                <a href="{{ route('gallery') }}">Gallery</a>
                <a href="{{ route('reservation') }}">Reservation</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
        </div>
    </nav>

    <header class="hero">
        <video class="hero-video" autoplay muted loop playsinline
            poster="{{ asset('assets/images/attalas-logo.png') }}">
            <source src="{{ asset('assets/videos/attalas-hero.webm') }}" type="video/webm">
            <source src="{{ asset('assets/videos/attalas-hero.mp4') }}" type="video/mp4">
        </video>

        <div class="container hero-inner">
            <div class="hero-content">
                <div class="eyebrow"><i class="ph-coffee"></i> Premium cafe experience</div>
                <h1>Kopi hangat, rasa nikmat, suasana melekat.</h1>
                <p>
                    Temukan pengalaman bersantai yang lebih nyaman di Attalas Cafe. Dari kopi pilihan,
                    menu favorit, hingga ambience yang pas untuk ngobrol, kerja, atau sekadar menikmati hari.
                </p>

                <div class="hero-actions">
                    <a href="{{ route('menu') }}" class="btn btn-secondary"><i class="ph-fork-knife"></i>Lihat Menu</a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="section">
            <div class="container">
                <div class="features">
                    <div class="feature-card">
                        <i class="ph-coffee-bean"></i>
                        <h3>Specialty Coffee</h3>
                        <p>Kopi dengan karakter rasa yang dipilih untuk menemani setiap suasana.</p>
                    </div>
                    <div class="feature-card">
                        <i class="ph-armchair"></i>
                        <h3>Cozy Place</h3>
                        <p>Ruang nyaman untuk ngobrol, meeting ringan, atau bekerja santai.</p>
                    </div>
                    <div class="feature-card">
                        <i class="ph-bowl-food"></i>
                        <h3>Fresh Menu</h3>
                        <p>Pilihan menu yang cocok untuk brunch, makan siang, hingga camilan sore.</p>
                    </div>
                    <div class="feature-card">
                        <i class="ph-heart"></i>
                        <h3>Warm Service</h3>
                        <p>Pelayanan ramah agar setiap kunjungan terasa lebih dekat dan berkesan.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="menu">
            <div class="container">
                <div class="section-header">
                    <div>
                        <div class="section-kicker">Menu pilihan</div>
                        <h2 class="section-title">Favorit pelanggan Attalas.</h2>
                    </div>
                    <p class="section-copy">Beberapa menu unggulan yang sering jadi pilihan untuk menemani waktu santai
                        di cafe.</p>
                </div>

                @if ($featuredMenus->isEmpty())
                    <div class="empty-state">Belum ada menu featured yang ditampilkan.</div>
                @else
                    <div class="menu-grid">
                        @foreach ($featuredMenus as $menu)
                            <article class="menu-card">
                                <div class="menu-image">
                                    @if ($menu->image)
                                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}">
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
                                        <span class="price">{{ $menu->formatted_price }}</span>
                                        <i class="ph-arrow-up-right"></i>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section class="section about-band">
            <div class="container about-grid">
                <div>
                    <div class="section-kicker" style="color: rgba(255,255,255,.72)">Tentang kami</div>
                    <h2 class="section-title" style="color: #fff">Dibuat untuk rasa nyaman yang sederhana.</h2>
                    <p class="section-copy" style="color: rgba(255,255,255,.72); margin-top: 16px">
                        Attalas Cafe hadir sebagai tempat singgah untuk menikmati kopi, makanan, dan suasana yang
                        tenang.
                        Kami percaya bahwa pengalaman cafe terbaik datang dari detail kecil: aroma kopi, pelayanan
                        hangat,
                        dan ruang yang membuat kamu betah.
                    </p>
                </div>
                <div class="about-panel">
                    <div class="about-tile"><strong>01</strong><span>Coffee crafted daily</span></div>
                    <div class="about-tile"><strong>02</strong><span>Comfortable ambience</span></div>
                    <div class="about-tile"><strong>03</strong><span>Fresh menu selection</span></div>
                    <div class="about-tile"><strong>04</strong><span>Friendly experience</span></div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="section-header">
                    <div>
                        <div class="section-kicker">Gallery</div>
                        <h2 class="section-title">Momen hangat di Attalas.</h2>
                    </div>
                    <p class="section-copy">Intip suasana, menu, dan beberapa sudut favorit dari Attalas Cafe.</p>
                </div>

                @if ($galleryItems->isEmpty())
                    <div class="empty-state">Belum ada gallery yang ditampilkan.</div>
                @else
                    <div class="gallery-grid">
                        @foreach ($galleryItems as $gallery)
                            <div class="gallery-item">
                                <img src="{{ asset('storage/' . $gallery->image) }}"
                                    alt="{{ $gallery->title ?? 'Gallery Attalas Cafe' }}">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section class="section" style="padding-top: 0">
            <div class="container">
                <div class="section-header">
                    <div>
                        <div class="section-kicker">Review</div>
                        <h2 class="section-title">Cerita pelanggan kami.</h2>
                    </div>
                </div>

                @if ($reviews->isEmpty())
                    <div class="empty-state">Belum ada ulasan yang ditampilkan.</div>
                @else
                    <div class="reviews">
                        @foreach ($reviews as $review)
                            <article class="review-card">
                                <div class="stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="ph-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                </div>
                                <p>“{{ Str::limit($review->review, 150) }}”</p>
                                <strong>{{ $review->customer_name }}</strong>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section class="section" style="padding-top: 0">
            <div class="container">
                <div class="reservation-cta">
                    <div>
                        <h2>Siapkan meja terbaik untuk momen terbaikmu.</h2>
                        <p>Datang bersama teman, keluarga, atau pasangan. Reservasi lebih awal agar pengalamanmu lebih
                            nyaman.</p>
                    </div>
                    <a href="{{ route('reservation') }}" class="btn btn-secondary"><i
                            class="ph-calendar-check"></i>Reservasi Sekarang</a>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container footer-inner">
            <div>
                <strong>Attalas Cafe</strong>
                <div>Premium coffee, warm ambience, and modern cafe experience.</div>
            </div>
            <div>&copy; {{ now()->year }} Attalas Cafe. All rights reserved.</div>
        </div>
    </footer>

    <a href="https://wa.me/6281234567890?text=Halo%20Attalas%20Cafe,%20saya%20ingin%20bertanya%20atau%20reservasi."
        class="whatsapp-float" target="_blank" rel="noopener" aria-label="Chat Attalas Cafe via WhatsApp">
        <i class="ph-whatsapp-logo"></i>
    </a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('siteNavbar');
            const toggle = document.getElementById('mobileMenuToggle');
            const menu = document.getElementById('mobileMenu');

            function updateNavbarPosition() {
                if (!navbar) {
                    return;
                }

                navbar.classList.toggle('is-scrolled', window.scrollY > 12);
            }

            updateNavbarPosition();
            window.addEventListener('scroll', updateNavbarPosition, {
                passive: true
            });

            if (!toggle || !menu) {
                return;
            }

            toggle.addEventListener('click', function() {
                const isOpen = menu.classList.toggle('is-open');
                toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                toggle.innerHTML = isOpen ? '<i class="ph-x"></i>' : '<i class="ph-list"></i>';
            });

            if (window.gsap) {
                gsap.registerPlugin(ScrollTrigger);

                gsap.from('.nav-inner', {
                    y: -28,
                    opacity: 0,
                    duration: 0.9,
                    ease: 'power3.out'
                });

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
                    .from('.hero h1', {
                        y: 42,
                        opacity: 0,
                        duration: 1
                    }, 0.3)
                    .from('.hero p', {
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
                        trigger: '.hero',
                        start: 'top top',
                        end: 'bottom top',
                        scrub: true
                    }
                });

                const revealGroups = [
                    '.feature-card',
                    '.menu-card',
                    '.about-tile',
                    '.gallery-item',
                    '.review-card'
                ];

                revealGroups.forEach(function(selector) {
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

                gsap.utils.toArray('.section-header').forEach(function(header) {
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

                gsap.from('.reservation-cta', {
                    y: 46,
                    opacity: 0,
                    scale: 0.97,
                    duration: 0.9,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: '.reservation-cta',
                        start: 'top 84%',
                        toggleActions: 'play none none reverse'
                    }
                });
            }
        });
    </script>
</body>

</html>
