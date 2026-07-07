@extends('layouts.public')

@section('title', __('public.seo.contact_title'))
@section('meta_description', __('public.seo.contact_description'))

@section('content')
    <main>
        <section class="page-hero" @style(['--hero-image: url(' . $heroImage . ')' => $heroImage])>
            <div class="container">
                <span class="eyebrow">{{ __('public.contact.hero.eyebrow') }}</span>
                <h1>{{ __('public.contact.hero.h1') }}</h1>
                <p>{{ __('public.contact.hero.p') }}</p>
            </div>
        </section>

        <section class="contact-section">
            <div class="container contact-grid">
                <div class="contact-info">
                    <div class="info-card info-card-location">
                        <div class="icon-wrapper icon-location">
                            <i class="ph-map-pin"></i>
                        </div>
                        <div class="card-content">
                            <strong>{{ __('public.contact.info.location_label') }}</strong>
                            <span>Jl. Raya Penelokan, Batur Tengah, Kec. Kintamani, Kabupaten Bangli, Bali</span>
                        </div>
                    </div>
                    <div class="info-card info-card-whatsapp">
                        <div class="icon-wrapper icon-whatsapp">
                            <i class="ph-whatsapp-logo"></i>
                        </div>
                        <div class="card-content">
                            <strong>{{ __('public.contact.info.whatsapp_label') }}</strong>
                            <span>+62 877 4806 0549</span>
                        </div>
                    </div>
                    <div class="info-card info-card-clock">
                        <div class="icon-wrapper icon-clock">
                            <i class="ph-clock"></i>
                        </div>
                        <div class="card-content">
                            <strong>{{ __('public.contact.info.opening_hours_label') }}</strong>
                            <span>{{ __('public.contact.info.opening_hours_value') }}</span>
                        </div>
                    </div>
                    <a href="https://www.tiktok.com/@attalascafe?_r=1&_t=ZS-97oCzxnLjrr" target="_blank" rel="noopener"
                        class="info-card info-card-tiktok social-link-card">
                        <div class="icon-wrapper icon-tiktok">
                            <svg class="social-icon-svg" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M14.5 3h2.4a4.2 4.2 0 0 0 4.2 4.2v2.4a6.6 6.6 0 0 1-4.2-1.4v7.5a4.9 4.9 0 1 1-4.9-4.9c.3 0 .6 0 .9.1v2.5a2.4 2.4 0 1 0 1.7 2.3V3Z" />
                            </svg>
                        </div>
                        <div class="card-content">
                            <strong>TikTok</strong>
                            <span>@attalascafe</span>
                        </div>
                    </a>
                    <a href="https://www.instagram.com/attalascafe" target="_blank" rel="noopener"
                        class="info-card info-card-instagram social-link-card">
                        <div class="icon-wrapper icon-instagram">
                            <i class="ph-instagram-logo"></i>
                        </div>
                        <div class="card-content">
                            <strong>Instagram</strong>
                            <span>@attalascafe</span>
                        </div>
                    </a>
                </div>

                <div class="contact-card">
                    <h2>{{ __('public.contact.form.h2') }}</h2>
                    <p>{{ __('public.contact.form.p') }}</p>
                    <form>
                        <input type="text" placeholder="{{ __('public.contact.form.name_placeholder') }}">
                        <input type="email" placeholder="{{ __('public.contact.form.email_placeholder') }}">
                        <textarea rows="5" placeholder="{{ __('public.contact.form.message_placeholder') }}"></textarea>
                        <a href="https://wa.me/6287748060549?text=Halo%20Attalas%20Cafe,%20saya%20ingin%20bertanya."
                            class="btn btn-primary" target="_blank" rel="noopener">{{ __('public.contact.form.whatsapp_btn') }}</a>
                    </form>
                </div>
            </div>
        </section>

        <section class="map-section">
            <div class="container">
                <div class="map-card">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.2626025838836!2d115.34794147506892!3d-8.276641291757661!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd1f579afd7161f%3A0xc4036299583a290a!2sATTALAS%20CAFE!5e0!3m2!1sid!2sid!4v1781182076446!5m2!1sid!2sid"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('style')
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

        .contact-section {
            padding: 76px 0;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: minmax(0, .85fr) minmax(0, 1.15fr);
            gap: 24px;
        }

        .contact-info {
            display: grid;
            gap: 16px;
        }

        .info-card,
        .contact-card,
        .map-card {
            /* Let GSAP control opacity for animations */
        }

        .page-hero .eyebrow,
        .page-hero h1,
        .page-hero p {
            /* Let GSAP control opacity for animations */
        }

        .info-card {
            background: #fff;
            border: 1px solid rgba(16, 20, 23, .06);
            box-shadow: 0 18px 44px rgba(16, 20, 23, .08);
            display: flex;
            gap: 16px;
            align-items: center;
            padding: 24px;
            border-radius: 26px;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            pointer-events: none;
        }

        .info-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 26px 56px rgba(16, 20, 23, .14);
        }

        .icon-wrapper {
            display: grid;
            place-items: center;
            width: 64px;
            height: 64px;
            border-radius: 20px;
            font-size: 28px;
            flex: 0 0 auto;
            position: relative;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        /* Location - Turquoise/Teal */
        .icon-location {
            background: linear-gradient(135deg, #06B6D4, #0891B2);
            color: #fff;
        }

        .info-card-location:hover .icon-location {
            box-shadow: 0 12px 32px rgba(6, 182, 212, 0.35);
        }

        /* WhatsApp - Green */
        .icon-whatsapp {
            background: linear-gradient(135deg, #22C55E, #16A34A);
            color: #fff;
        }

        .info-card-whatsapp:hover .icon-whatsapp {
            box-shadow: 0 12px 32px rgba(34, 197, 94, 0.35);
        }

        /* Clock - Amber/Orange */
        .icon-clock {
            background: linear-gradient(135deg, #F59E0B, #D97706);
            color: #fff;
        }

        .info-card-clock:hover .icon-clock {
            box-shadow: 0 12px 32px rgba(245, 158, 11, 0.35);
        }

        /* TikTok - Black with accent */
        .icon-tiktok {
            background: linear-gradient(135deg, #1a1a1a, #000);
            color: #fff;
        }

        .info-card-tiktok:hover .icon-tiktok {
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.4);
        }

        /* Instagram - Purple/Pink */
        .icon-instagram {
            background: linear-gradient(135deg, #EC4899, #DB2777);
            color: #fff;
        }

        .info-card-instagram:hover .icon-instagram {
            box-shadow: 0 12px 32px rgba(236, 72, 153, 0.35);
        }

        .icon-wrapper svg {
            width: 100%;
            height: 100%;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            gap: 4px;
            position: relative;
            z-index: 1;
        }

        .info-card strong {
            display: block;
            font-size: 1rem;
            font-weight: 600;
            color: #1a1a1a;
        }

        .info-card span {
            color: var(--muted);
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .social-link-card {
            text-decoration: none;
            color: inherit;
        }

        .contact-card,
        .contact-card p {
            color: var(--muted);
            line-height: 1.7;
        }

        .contact-card {
            padding: 30px;
            border-radius: 30px;
            background: linear-gradient(135deg, #fff 0%, #f9fafb 100%);
            border: 1px solid rgba(16, 20, 23, .08);
            box-shadow: 0 18px 44px rgba(16, 20, 23, .08);
        }

        .contact-card h2 {
            margin: 0 0 8px;
            font-size: 2rem;
            letter-spacing: -.05em;
            background: linear-gradient(135deg, var(--primary-900), var(--primary-700));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .contact-card form {
            display: grid;
            gap: 14px;
            margin-top: 22px;
        }

        .contact-card input,
        .contact-card textarea {
            width: 100%;
            border: 2px solid rgba(16, 20, 23, .08);
            border-radius: 18px;
            padding: 14px 16px;
            font: inherit;
            background: #fff;
            transition: all 0.3s ease;
        }

        .contact-card input:focus,
        .contact-card textarea:focus {
            outline: none;
            border-color: var(--primary-600);
            box-shadow: 0 0 0 3px rgba(127, 155, 136, 0.1);
            background: #fff;
        }

        .contact-card textarea {
            resize: vertical;
        }

        .map-section {
            padding: 0 0 76px;
        }

        .map-card {
            overflow: hidden;
            border-radius: 30px;
            background: #fff;
            border: 1px solid rgba(16, 20, 23, .06);
            box-shadow: 0 18px 44px rgba(16, 20, 23, .08);
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .map-card:hover {
            box-shadow: 0 26px 56px rgba(16, 20, 23, .14);
        }

        .map-card iframe {
            display: block;
            width: 100%;
            min-height: 450px;
        }

        @media (max-width: 860px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if GSAP is loaded
            if (!window.gsap) {
                console.warn('GSAP library not loaded');
                return;
            }

            // Animate hero section elements - always visible
            gsap.fromTo('.page-hero .eyebrow, .page-hero h1, .page-hero p', {
                y: 34,
                opacity: 0,
            }, {
                y: 0,
                opacity: 1,
                duration: .9,
                stagger: .12,
                ease: 'power3.out'
            });

            // Animate contact info cards with scroll trigger
            if (window.ScrollTrigger) {
                gsap.registerPlugin(ScrollTrigger);

                gsap.fromTo('.info-card', {
                    y: 42,
                    opacity: 0,
                }, {
                    y: 0,
                    opacity: 1,
                    duration: .8,
                    stagger: .12,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: '.contact-section',
                        start: 'top 85%',
                    }
                });

                gsap.fromTo('.contact-card', {
                    y: 42,
                    opacity: 0,
                }, {
                    y: 0,
                    opacity: 1,
                    duration: .8,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: '.contact-card',
                        start: 'top 85%',
                    }
                });

                gsap.fromTo('.map-card', {
                    y: 42,
                    opacity: 0,
                }, {
                    y: 0,
                    opacity: 1,
                    duration: .8,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: '.map-section',
                        start: 'top 85%',
                    }
                });
            } else {
                // Fallback animation without scroll trigger
                gsap.fromTo('.info-card', {
                    y: 42,
                    opacity: 0,
                }, {
                    y: 0,
                    opacity: 1,
                    duration: .8,
                    stagger: .1,
                    ease: 'power3.out',
                    delay: 0.3
                });

                gsap.fromTo('.contact-card', {
                    y: 42,
                    opacity: 0,
                }, {
                    y: 0,
                    opacity: 1,
                    duration: .8,
                    ease: 'power3.out',
                    delay: 0.8
                });

                gsap.fromTo('.map-card', {
                    y: 42,
                    opacity: 0,
                }, {
                    y: 0,
                    opacity: 1,
                    duration: .8,
                    ease: 'power3.out',
                    delay: 1.3
                });
            }
        });
    </script>
@endpush
