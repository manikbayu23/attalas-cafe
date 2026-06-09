<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Attalas Cafe')</title>
    <link rel="icon" href="{{ asset('assets/images/attalas-logo.png') }}" type="image/png">
    <link href="{{ asset('admin/assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">

    <style>
        :root {
            --graphite-950: #101417;
            --graphite-800: #242b2f;
            --graphite-600: #4a5358;
            --mist-50: #f5f7f4;
            --mist-100: #e7ece7;
            --sage-500: #7f9b88;
            --sage-700: #526f5c;
            --text: #172023;
            --muted: #6d777a;
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
            background: var(--mist-50);
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
            gap: 24px;
            min-height: 68px;
            padding: 12px 14px 12px 22px;
            border: 1px solid rgba(255, 255, 255, 0.28);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.82);
            box-shadow: 0 18px 48px rgba(16, 20, 23, 0.14);
            backdrop-filter: blur(18px);
            pointer-events: auto;
            transition: min-height 0.28s ease, padding 0.28s ease, box-shadow 0.28s ease, background-color 0.28s ease;
        }

        .navbar.is-scrolled .nav-inner {
            min-height: 62px;
            padding-top: 9px;
            padding-bottom: 9px;
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 14px 36px rgba(16, 20, 23, 0.12);
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
            color: #4f5a5d;
            font-size: 0.94rem;
        }

        .nav-links a {
            padding: 9px 13px;
            border-radius: 999px;
        }

        .nav-links a:hover,
        .nav-links a.active {
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
            color: #fff;
        }

        .btn-ghost {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.28);
            backdrop-filter: blur(12px);
        }

        .mobile-toggle {
            display: none;
            width: 42px;
            height: 42px;
            border: 0;
            border-radius: 999px;
            background: var(--graphite-950);
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
            box-shadow: 0 18px 48px rgba(16, 20, 23, 0.16);
            backdrop-filter: blur(18px);
        }

        .mobile-menu.is-open {
            display: grid;
        }

        .mobile-menu a {
            padding: 13px 14px;
            border-radius: 16px;
            color: #4d5659;
            font-weight: 700;
        }

        .mobile-menu a:hover,
        .mobile-menu a.active {
            background: rgba(16, 20, 23, 0.08);
            color: var(--graphite-950);
        }

        .footer {
            padding: 44px 0;
            background: var(--graphite-950);
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

        @media (max-width: 992px) {
            .nav-links,
            .nav-cta {
                display: none;
            }

            .mobile-toggle {
                display: inline-grid;
                place-items: center;
            }
        }

        @media (max-width: 640px) {
            .footer-inner {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    @stack('style')
</head>

<body>
    <nav class="navbar" id="siteNavbar">
        <div class="container nav-inner">
            <a href="{{ route('home') }}" class="brand" aria-label="Attalas Cafe Home">
                <img src="{{ asset('assets/images/attalas-logo.png') }}" alt="Attalas Cafe Logo">
                <span>Attalas Cafe</span>
            </a>

            <div class="nav-links" aria-label="Main navigation">
                <a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="{{ Route::is('about') ? 'active' : '' }}">About Us</a>
                <a href="{{ route('menu') }}" class="{{ Route::is('menu') ? 'active' : '' }}">Menu</a>
                <a href="{{ route('gallery') }}" class="{{ Route::is('gallery') ? 'active' : '' }}">Gallery</a>
                <a href="{{ route('contact') }}" class="{{ Route::is('contact') ? 'active' : '' }}">Contact</a>
            </div>

            <button type="button" class="mobile-toggle" id="mobileMenuToggle" aria-label="Open main menu"
                aria-expanded="false">
                <i class="ph-list"></i>
            </button>

            <div class="mobile-menu" id="mobileMenu">
                <a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="{{ Route::is('about') ? 'active' : '' }}">About Us</a>
                <a href="{{ route('menu') }}" class="{{ Route::is('menu') ? 'active' : '' }}">Menu</a>
                <a href="{{ route('gallery') }}" class="{{ Route::is('gallery') ? 'active' : '' }}">Gallery</a>
                <a href="{{ route('contact') }}" class="{{ Route::is('contact') ? 'active' : '' }}">Contact</a>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="footer">
        <div class="container footer-inner">
            <div>
                <strong>Attalas Cafe</strong>
                <div>Premium coffee, scenic Kintamani view, and warm cafe experience.</div>
            </div>
            <div>&copy; {{ now()->year }} Attalas Cafe. All rights reserved.</div>
        </div>
    </footer>

    <a href="https://wa.me/6281234567890?text=Halo%20Attalas%20Cafe,%20saya%20ingin%20bertanya."
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
            window.addEventListener('scroll', updateNavbarPosition, { passive: true });

            if (toggle && menu) {
                toggle.addEventListener('click', function() {
                    const isOpen = menu.classList.toggle('is-open');
                    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                    toggle.innerHTML = isOpen ? '<i class="ph-x"></i>' : '<i class="ph-list"></i>';
                });
            }

            if (window.gsap) {
                gsap.registerPlugin(ScrollTrigger);
                gsap.from('.nav-inner', {
                    y: -28,
                    opacity: 0,
                    duration: 0.9,
                    ease: 'power3.out'
                });
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
