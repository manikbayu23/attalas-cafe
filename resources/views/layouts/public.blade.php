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
            --primary-950: #111d1c;
            --primary-900: #203231;
            --primary-800: #2d4442;
            --primary-700: #3c5956;
            --primary-100: #dce7e3;
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
            border: 1px solid rgba(255, 255, 255, 0.635);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.62);
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
            background: rgba(32, 50, 49, 0.1);
            color: var(--primary-900);
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
            background: var(--primary-900);
            color: #fff;
            box-shadow: 0 14px 28px rgba(32, 50, 49, 0.24);
        }

        .btn-primary:hover {
            background: var(--primary-800);
            color: #fff;
        }

        .language-switcher {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px;
            border-radius: 999px;
            background: rgba(32, 50, 49, 0.08);
            border: 1px solid rgba(32, 50, 49, 0.1);
        }

        .language-switcher a {
            min-width: 40px;
            padding: 8px 10px;
            border-radius: 999px;
            color: var(--primary-900);
            font-size: 0.82rem;
            font-weight: 800;
            text-align: center;
        }

        .language-switcher a.active {
            background: var(--primary-900);
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
            background: var(--primary-900);
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
            background: rgba(255, 255, 255, 0.92);
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
            background: rgba(32, 50, 49, 0.1);
            color: var(--primary-900);
        }

        .footer {
            padding: 58px 0 28px;
            background: var(--primary-950);
            color: rgba(255, 255, 255, 0.72);
        }

        .footer-inner {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(0, 1fr) minmax(220px, 0.7fr);
            gap: 34px;
            align-items: start;
        }

        .footer strong {
            color: #fff;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 16px;
        }

        .footer-brand img {
            width: 58px;
            height: 58px;
            border-radius: 999px;
            object-fit: cover;
            background: rgba(255, 255, 255, 0.08);
        }

        .footer-brand strong {
            display: block;
            font-size: 1.1rem;
        }

        .footer-brand span {
            color: rgba(255, 255, 255, 0.58);
            font-size: 0.88rem;
        }

        .footer-copy {
            max-width: 390px;
            margin: 0;
            line-height: 1.75;
        }

        .footer-title {
            margin: 0 0 16px;
            color: #fff;
            font-size: 0.95rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .footer-contact {
            display: grid;
            gap: 12px;
        }

        .footer-contact a,
        .footer-contact div {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            color: rgba(255, 255, 255, 0.72);
            line-height: 1.55;
        }

        .footer-contact i {
            margin-top: 2px;
            color: var(--primary-100);
            font-size: 1.05rem;
        }

        .footer-socials {
            display: flex;
            gap: 10px;
        }

        .footer-socials a {
            width: 42px;
            height: 42px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
            font-size: 1.2rem;
            transition: transform 0.15s ease, background-color 0.15s ease;
        }

        .footer-socials a:hover {
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 0.16);
        }

        .footer-bottom {
            margin-top: 34px;
            padding-top: 22px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.52);
            font-size: 0.9rem;
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
            .nav-cta,
            .language-switcher.desktop-language {
                display: none;
            }

            .mobile-toggle {
                display: inline-grid;
                place-items: center;
            }
        }

        @media (max-width: 640px) {
            .footer-inner {
                grid-template-columns: 1fr;
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
                <a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">{{ __('public.nav.home') }}</a>
                <a href="{{ route('about') }}" class="{{ Route::is('about') ? 'active' : '' }}">{{ __('public.nav.about') }}</a>
                <a href="{{ route('menu') }}" class="{{ Route::is('menu') ? 'active' : '' }}">{{ __('public.nav.menu') }}</a>
                <a href="{{ route('gallery') }}" class="{{ Route::is('gallery') ? 'active' : '' }}">{{ __('public.nav.gallery') }}</a>
                <a href="{{ route('contact') }}" class="{{ Route::is('contact') ? 'active' : '' }}">{{ __('public.nav.contact') }}</a>
            </div>

            <div class="language-switcher desktop-language" aria-label="Language switcher">
                <a href="{{ route('language.switch', 'id') }}" class="{{ app()->getLocale() === 'id' ? 'active' : '' }}">ID</a>
                <a href="{{ route('language.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
            </div>

            <button type="button" class="mobile-toggle" id="mobileMenuToggle" aria-label="Open main menu"
                aria-expanded="false">
                <i class="ph-list"></i>
            </button>

            <div class="mobile-menu" id="mobileMenu">
                <a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">{{ __('public.nav.home') }}</a>
                <a href="{{ route('about') }}" class="{{ Route::is('about') ? 'active' : '' }}">{{ __('public.nav.about') }}</a>
                <a href="{{ route('menu') }}" class="{{ Route::is('menu') ? 'active' : '' }}">{{ __('public.nav.menu') }}</a>
                <a href="{{ route('gallery') }}" class="{{ Route::is('gallery') ? 'active' : '' }}">{{ __('public.nav.gallery') }}</a>
                <a href="{{ route('contact') }}" class="{{ Route::is('contact') ? 'active' : '' }}">{{ __('public.nav.contact') }}</a>
                <a href="{{ route('language.switch', 'id') }}" class="{{ app()->getLocale() === 'id' ? 'active' : '' }}">{{ __('public.language.id') }}</a>
                <a href="{{ route('language.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">{{ __('public.language.en') }}</a>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="footer">
        <div class="container">
            <div class="footer-inner">
                <div>
                    <div class="footer-brand">
                        <img src="{{ asset('assets/images/attalas-logo.png') }}" alt="Attalas Cafe Logo">
                        <div>
                            <strong>Attalas Cafe</strong>
                            <span>{{ __('public.footer.tagline') }}</span>
                        </div>
                    </div>
                    <p class="footer-copy">
                        {{ __('public.footer.description') }}
                    </p>
                </div>

                <div>
                    <h4 class="footer-title">{{ __('public.footer.contact') }}</h4>
                    <div class="footer-contact">
                        <div>
                            <i class="ph-map-pin"></i>
                            <span>Kintamani, Bangli, Bali, Indonesia</span>
                        </div>
                        <a href="https://wa.me/6281234567890" target="_blank" rel="noopener">
                            <i class="ph-whatsapp-logo"></i>
                            <span>+62 812-3456-7890</span>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="footer-title">{{ __('public.footer.social_media') }}</h4>
                    <div class="footer-socials">
                        <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram">
                            <i class="ph-instagram-logo"></i>
                        </a>
                        <a href="https://www.facebook.com/" target="_blank" rel="noopener" aria-label="Facebook">
                            <i class="ph-facebook-logo"></i>
                        </a>
                        <a href="https://wa.me/6281234567890" target="_blank" rel="noopener" aria-label="WhatsApp">
                            <i class="ph-whatsapp-logo"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                &copy; {{ now()->year }} Attalas Cafe. {{ __('public.footer.copyright') }}
            </div>
        </div>
    </footer>

    <a href="https://wa.me/6281234567890?text=Halo%20Attalas%20Cafe,%20saya%20ingin%20bertanya." class="whatsapp-float"
        target="_blank" rel="noopener" aria-label="Chat Attalas Cafe via WhatsApp">
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
