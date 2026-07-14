<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Attalas Cafe Kintamani')</title>
    
    <!-- SEO Optimization -->
    <meta name="description" content="@yield('meta_description', __('public.seo.default_description'))">
    <meta name="keywords" content="@yield('meta_keywords', __('public.seo.default_keywords'))">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Attalas Cafe Kintamani')">
    <meta property="og:description" content="@yield('meta_description', __('public.seo.default_description'))">
    <meta property="og:image" content="@yield('meta_image', asset('assets/images/image-hero.png'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Attalas Cafe Kintamani')">
    <meta property="twitter:description" content="@yield('meta_description', __('public.seo.default_description'))">
    <meta property="twitter:image" content="@yield('meta_image', asset('assets/images/image-hero.png'))">

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
            white-space: nowrap;
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
            margin: 0;
            padding: 0;
            border-radius: 999px;
            background: var(--primary-900);
            color: #fff;
            font-size: 1.35rem;
            cursor: pointer;
            flex-shrink: 0;
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

        .social-icon-svg {
            width: 18px;
            height: 18px;
            fill: currentColor;
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
            width: 64px;
            height: 64px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #25d366 0%, #1fa852 100%);
            color: #fff;
            box-shadow: 0 18px 38px rgba(37, 211, 102, 0.34);
            border: 2px solid rgba(255, 255, 255, 0.24);
            font-size: 1.85rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
            animation: float-bounce 2.4s ease-in-out infinite;
        }

        .whatsapp-float::before {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: inherit;
            border: 1px solid rgba(37, 211, 102, 0.22);
            pointer-events: none;
        }

        .whatsapp-float:hover {
            transform: translateY(-4px) scale(1.04);
            box-shadow: 0 24px 50px rgba(37, 211, 102, 0.45);
            filter: brightness(1.05);
            color: #fff;
        }

        .whatsapp-float:active {
            transform: scale(0.96);
        }

        .whatsapp-tooltip {
            position: absolute;
            right: 76px;
            background: #25d366;
            color: #fff;
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 0.82rem;
            font-weight: 700;
            white-space: nowrap;
            box-shadow: 0 10px 24px rgba(37, 211, 102, 0.25);
            pointer-events: none;
            opacity: 0;
            transform: translateX(10px);
            transition: opacity 0.3s, transform 0.3s;
            animation: tooltip-bounce 12s infinite;
        }

        .whatsapp-tooltip::after {
            content: '';
            position: absolute;
            right: -6px;
            top: 50%;
            transform: translateY(-50%);
            border-width: 6px 0 6px 6px;
            border-style: solid;
            border-color: transparent transparent transparent #25d366;
        }

        @keyframes float-bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-6px);
            }
        }

        @keyframes tooltip-bounce {
            0%, 10%, 45%, 100% {
                opacity: 0;
                transform: translateX(10px);
            }
            15%, 40% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (max-width: 992px) {
            .nav-links,
            .nav-cta,
            .language-switcher.desktop-language {
                display: none;
            }

            .mobile-toggle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }
        }

        @media (max-width: 640px) {
            .footer-inner {
                grid-template-columns: 1fr;
            }
        }

        /* ── Menu Detail Modal ── */
        .menu-modal {
            position: fixed;
            inset: 0;
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            opacity: 0;
            visibility: hidden;
            transition: opacity .25s ease, visibility .25s ease;
        }

        .menu-modal.is-active {
            opacity: 1;
            visibility: visible;
        }

        .menu-modal-overlay {
            position: absolute;
            inset: 0;
            background: rgba(17, 29, 28, 0.65);
            backdrop-filter: blur(8px);
        }

        .menu-modal-container {
            position: relative;
            z-index: 2;
            width: min(640px, 100%);
            background: #white;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 34px 80px rgba(16, 20, 23, 0.35);
            overflow: hidden;
            transform: scale(0.94) translateY(14px);
            transition: transform .25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .menu-modal.is-active .menu-modal-container {
            transform: scale(1) translateY(0);
        }

        .menu-modal-close {
            position: absolute;
            top: 14px;
            right: 14px;
            z-index: 10;
            width: 36px;
            height: 36px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary-900);
            border: 1px solid rgba(16, 20, 23, 0.08);
            cursor: pointer;
            display: grid;
            place-items: center;
            box-shadow: 0 4px 12px rgba(16, 20, 23, 0.1);
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .menu-modal-close:hover {
            transform: scale(1.08) rotate(90deg);
            background: #fff;
        }

        .menu-modal-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        @media (max-width: 580px) {
            .menu-modal-content {
                grid-template-columns: 1fr;
            }
        }

        .menu-modal-image {
            aspect-ratio: 4 / 3;
            background: var(--mist-100);
            position: relative;
        }

        @media (min-width: 581px) {
            .menu-modal-image {
                height: 100%;
                aspect-ratio: unset;
            }
        }

        .menu-modal-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .menu-modal-image .menu-placeholder {
            width: 100%;
            height: 100%;
            display: grid;
            place-items: center;
            background: var(--mist-100);
            color: var(--sage-700);
            font-size: 3rem;
            min-height: 240px;
        }

        .menu-modal-body {
            padding: 22px;
            display: flex;
            flex-direction: column;
        }

        .menu-modal-category {
            font-size: 0.76rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .menu-modal-title {
            margin: 0 0 10px;
            font-size: 1.25rem;
            color: var(--primary-950);
            line-height: 1.25;
            letter-spacing: -0.03em;
        }

        .menu-modal-desc {
            margin: 0 0 20px;
            color: var(--muted);
            line-height: 1.6;
            font-size: 0.84rem;
        }

        .menu-modal-footer {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding-top: 14px;
            border-top: 1px solid rgba(16, 20, 23, 0.08);
        }

        .menu-modal-price-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .price-label {
            font-size: 0.74rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 800;
        }

        .menu-modal-price {
            font-size: 1.2rem;
            color: var(--primary-900);
            font-weight: 800;
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
                <a href="{{ route('home') }}"
                    class="{{ Route::is('home') ? 'active' : '' }}">{{ __('public.nav.home') }}</a>
                <a href="{{ route('about') }}"
                    class="{{ Route::is('about') ? 'active' : '' }}">{{ __('public.nav.about') }}</a>
                <a href="{{ route('menu') }}"
                    class="{{ Route::is('menu') ? 'active' : '' }}">{{ __('public.nav.menu') }}</a>
                <a href="{{ route('gallery') }}"
                    class="{{ Route::is('gallery') ? 'active' : '' }}">{{ __('public.nav.gallery') }}</a>
                <a href="{{ route('contact') }}"
                    class="{{ Route::is('contact') ? 'active' : '' }}">{{ __('public.nav.contact') }}</a>
            </div>

            <div class="language-switcher desktop-language" aria-label="Language switcher">
                <a href="{{ route('language.switch', 'id') }}"
                    class="{{ app()->getLocale() === 'id' ? 'active' : '' }}">ID</a>
                <a href="{{ route('language.switch', 'en') }}"
                    class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
            </div>

            <button type="button" class="mobile-toggle" id="mobileMenuToggle" aria-label="Open main menu"
                aria-expanded="false">
                <i class="ph-list"></i>
            </button>

            <div class="mobile-menu" id="mobileMenu">
                <a href="{{ route('home') }}"
                    class="{{ Route::is('home') ? 'active' : '' }}">{{ __('public.nav.home') }}</a>
                <a href="{{ route('about') }}"
                    class="{{ Route::is('about') ? 'active' : '' }}">{{ __('public.nav.about') }}</a>
                <a href="{{ route('menu') }}"
                    class="{{ Route::is('menu') ? 'active' : '' }}">{{ __('public.nav.menu') }}</a>
                <a href="{{ route('gallery') }}"
                    class="{{ Route::is('gallery') ? 'active' : '' }}">{{ __('public.nav.gallery') }}</a>
                <a href="{{ route('contact') }}"
                    class="{{ Route::is('contact') ? 'active' : '' }}">{{ __('public.nav.contact') }}</a>
                <a href="{{ route('language.switch', 'id') }}"
                    class="{{ app()->getLocale() === 'id' ? 'active' : '' }}">{{ __('public.language.id') }}</a>
                <a href="{{ route('language.switch', 'en') }}"
                    class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">{{ __('public.language.en') }}</a>
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
                            <span>Jl. Raya Penelokan, Batur Tengah, Kec. Kintamani, Kabupaten Bangli, Bali</span>
                        </div>
                        <a href="https://wa.me/6287748060549" target="_blank" rel="noopener">
                            <i class="ph-whatsapp-logo"></i>
                            <span>+62 877 4806 0549</span>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="footer-title">{{ __('public.footer.social_media') }}</h4>
                    <div class="footer-socials">
                        <a href="https://www.instagram.com/attalas_cafe/" target="_blank" rel="noopener"
                            aria-label="Instagram">
                            <i class="ph-instagram-logo"></i>
                        </a>
                        <a href="https://www.facebook.com/people/attalas_cafe/100087332373127/"
                            target="_blank" rel="noopener" aria-label="Facebook">
                            <i class="ph-facebook-logo"></i>
                        </a>
                        <a href="https://wa.me/6287748060549" target="_blank" rel="noopener" aria-label="WhatsApp">
                            <i class="ph-whatsapp-logo"></i>
                        </a>
                        <a href="https://www.tiktok.com/@attalascafe?_r=1&_t=ZS-97oCzxnLjrr" target="_blank"
                            rel="noopener" aria-label="TikTok">
                            <svg class="social-icon-svg" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M14.5 3h2.4a4.2 4.2 0 0 0 4.2 4.2v2.4a6.6 6.6 0 0 1-4.2-1.4v7.5a4.9 4.9 0 1 1-4.9-4.9c.3 0 .6 0 .9.1v2.5a2.4 2.4 0 1 0 1.7 2.3V3Z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                &copy; {{ now()->year }} Attalas Cafe. {{ __('public.footer.copyright') }}
            </div>
        </div>
    </footer>

    <a href="https://wa.me/6287748060549?text={{ rawurlencode(app()->getLocale() === 'id' ? 'Halo Attalas Cafe, saya ingin melakukan reservasi.' : 'Hello Attalas Cafe, I would like to make a reservation.') }}"
        class="whatsapp-float" target="_blank" rel="noopener" aria-label="Chat Attalas Cafe via WhatsApp">
        <i class="ph-whatsapp-logo"></i>
        <span class="whatsapp-tooltip">{{ app()->getLocale() === 'id' ? 'Reservasi Sekarang!' : 'Book Now!' }}</span>
    </a>
    <!-- Menu Detail Modal -->
    <div class="menu-modal" id="menuDetailModal" aria-hidden="true" role="dialog">
        <div class="menu-modal-overlay" onclick="closeMenuModal()"></div>
        <div class="menu-modal-container">
            <button type="button" class="menu-modal-close" onclick="closeMenuModal()" aria-label="Close modal">
                <i class="ph-x"></i>
            </button>
            <div class="menu-modal-content">
                <div class="menu-modal-image">
                    <img id="modalMenuImg" src="" alt="">
                    <div id="modalMenuPlaceholder" class="menu-placeholder" style="display: none;"><i class="ph-image"></i></div>
                </div>
                <div class="menu-modal-body">
                    <span class="menu-modal-category" id="modalMenuCategory"></span>
                    <h2 class="menu-modal-title" id="modalMenuTitle"></h2>
                    <p class="menu-modal-desc" id="modalMenuDesc"></p>
                    <div class="menu-modal-footer">
                        <div class="menu-modal-price-container">
                            <span class="price-label">{{ __('public.menu.price_label') }}</span>
                            <strong class="menu-modal-price" id="modalMenuPrice"></strong>
                        </div>
                        <a href="" id="modalMenuWA" class="btn btn-primary" target="_blank" rel="noopener" style="display: none;">
                            <i class="ph-whatsapp-logo"></i>
                            <span>{{ __('public.menu.order_label') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

            // Detail modal handler
            window.openMenuModal = function(name, category, price, desc, imageSrc) {
                const modal = document.getElementById('menuDetailModal');
                if (!modal) return;
                
                const imgEl = document.getElementById('modalMenuImg');
                const placeholderEl = document.getElementById('modalMenuPlaceholder');
                
                if (imageSrc) {
                    imgEl.src = imageSrc;
                    imgEl.alt = name;
                    imgEl.style.display = 'block';
                    if (placeholderEl) placeholderEl.style.display = 'none';
                } else {
                    imgEl.src = '';
                    imgEl.alt = '';
                    imgEl.style.display = 'none';
                    if (placeholderEl) placeholderEl.style.display = 'grid';
                }
                
                document.getElementById('modalMenuCategory').innerText = category || '';
                document.getElementById('modalMenuTitle').innerText = name || '';
                document.getElementById('modalMenuDesc').innerText = desc || '';
                document.getElementById('modalMenuPrice').innerText = price || '';
                
                // Set WhatsApp order link dynamically
                const waUrl = 'https://wa.me/6287748060549?text=' + encodeURIComponent('Halo Attalas Cafe, saya tertarik memesan menu ini:\n\n* ' + name + ' (' + price + ')');
                document.getElementById('modalMenuWA').href = waUrl;
                
                modal.classList.add('is-active');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            };
            
            window.closeMenuModal = function() {
                const modal = document.getElementById('menuDetailModal');
                if (!modal) return;
                
                modal.classList.remove('is-active');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            };
        });
    </script>
    @stack('scripts')
</body>

</html>
