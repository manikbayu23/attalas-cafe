@extends('layouts.public')

@section('title', __('public.seo.about_title'))
@section('meta_description', __('public.seo.about_description'))

@section('content')
    <main>
        <section class="about-hero" @style(['--hero-image: url(' . $heroImage . ')' => $heroImage])>
            <div class="container about-hero-inner">
                <div class="about-copy">
                    <span class="eyebrow">{{ __('public.about.hero.eyebrow') }}</span>
                    <h1>{{ __('public.about.hero.h1') }}</h1>
                    <p>{{ __('public.about.hero.p') }}</p>
                </div>

                <div class="about-visual">
                    <img src="{{ asset('assets/images/attalas-logo.png') }}" alt="Attalas Cafe">
                </div>
            </div>
        </section>

        <section class="about-section">
            <div class="container story-grid">
                <div>
                    <span class="section-kicker">{{ __('public.about.story.kicker') }}</span>
                    <h2>{{ __('public.about.story.h2') }}</h2>
                </div>
                <div>
                    <p>{{ __('public.about.story.p1') }}</p>
                    <p>{{ __('public.about.story.p2') }}</p>
                </div>
            </div>
        </section>

        <section class="about-section soft-section">
            <div class="container values-grid">
                <div class="value-card">
                    <i class="ph-mountains"></i>
                    <h3>{{ __('public.about.values.ambience_title') }}</h3>
                    <p>{{ __('public.about.values.ambience_desc') }}</p>
                </div>
                <div class="value-card">
                    <i class="ph-coffee"></i>
                    <h3>{{ __('public.about.values.coffee_title') }}</h3>
                    <p>{{ __('public.about.values.coffee_desc') }}</p>
                </div>
                <div class="value-card">
                    <i class="ph-fork-knife"></i>
                    <h3>{{ __('public.about.values.menu_title') }}</h3>
                    <p>{{ __('public.about.values.menu_desc') }}</p>
                </div>
                <div class="value-card">
                    <i class="ph-heart"></i>
                    <h3>{{ __('public.about.values.service_title') }}</h3>
                    <p>{{ __('public.about.values.service_desc') }}</p>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('style')
    <style>
        .about-hero {
            min-height: 620px;
            display: flex;
            align-items: center;
            padding: 160px 0 76px;
            color: #fff;
            background-image:
                linear-gradient(90deg, rgba(17, 29, 28, 0.86), rgba(32, 50, 49, 0.56), rgba(32, 50, 49, 0.22)),
                var(--hero-image),
                linear-gradient(135deg, var(--primary-950), var(--primary-800));
            background-size: cover;
            background-position: center;
        }

        .about-hero-inner {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(260px, 0.8fr);
            gap: 48px;
            align-items: center;
        }

        .eyebrow,
        .section-kicker {
            display: inline-block;
            margin-bottom: 14px;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .eyebrow {
            color: rgba(255, 255, 255, 0.72);
        }

        .about-copy h1 {
            max-width: 820px;
            margin: 0 0 20px;
            font-size: clamp(2.3rem, 4.5vw, 4.2rem);
            line-height: 0.98;
            letter-spacing: -0.07em;
        }

        .about-copy p {
            max-width: 650px;
            margin: 0;
            color: rgba(255, 255, 255, 0.74);
            line-height: 1.8;
            font-size: 1.02rem;
        }

        .about-visual {
            display: grid;
            place-items: center;
            aspect-ratio: 1;
            border-radius: 38px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.16);
            backdrop-filter: blur(14px);
            box-shadow: 0 28px 80px rgba(0, 0, 0, 0.22);
        }

        .about-visual img {
            width: min(230px, 58%);
            filter: drop-shadow(0 18px 34px rgba(0, 0, 0, 0.24));
        }

        .about-section {
            padding: 86px 0;
        }

        .story-grid {
            display: grid;
            grid-template-columns: minmax(0, 0.9fr) minmax(0, 1.1fr);
            gap: 48px;
        }

        .section-kicker {
            color: var(--sage-700);
        }

        .story-grid h2 {
            margin: 0;
            font-size: clamp(2rem, 3vw, 3.2rem);
            line-height: 1.05;
            letter-spacing: -0.06em;
        }

        .story-grid p {
            margin: 0 0 18px;
            color: var(--muted);
            line-height: 1.85;
        }

        .soft-section {
            background: var(--mist-100);
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 22px;
        }

        .value-card {
            padding: 28px;
            border-radius: 16px;
            background: #fff;
            border: 1px solid rgba(16, 20, 23, 0.06);
            box-shadow: 0 18px 44px rgba(16, 20, 23, 0.08);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .value-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 28px 56px rgba(16, 20, 23, .13);
        }

        .value-card i {
            display: inline-grid;
            place-items: center;
            width: 50px;
            height: 50px;
            margin-bottom: 20px;
            border-radius: 18px;
            background: rgba(127, 155, 136, 0.16);
            color: var(--sage-700);
            font-size: 1.55rem;
        }

        .value-card h3 {
            margin: 0 0 10px;
        }

        .value-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
        }

        @media (max-width: 900px) {
            .about-hero-inner,
            .story-grid {
                grid-template-columns: 1fr;
            }

            .values-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .about-visual {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .values-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .value-card {
                padding: 18px 16px 20px;
                border-radius: 16px;
            }

            .value-card i {
                width: 42px;
                height: 42px;
                font-size: 1.25rem;
                margin-bottom: 14px;
                border-radius: 14px;
            }

            .value-card h3 {
                font-size: .92rem;
            }

            .value-card p {
                font-size: .82rem;
                line-height: 1.6;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (!window.gsap) {
                return;
            }

            gsap.timeline({ defaults: { ease: 'power3.out' } })
                .from('.eyebrow', { y: 22, opacity: 0, duration: 0.75 }, 0.15)
                .from('.about-copy h1', { y: 42, opacity: 0, duration: 1 }, 0.3)
                .from('.about-copy p', { y: 30, opacity: 0, duration: 0.9 }, 0.48)
                .from('.about-visual', { y: 34, opacity: 0, scale: 0.96, duration: 0.9 }, 0.55);

            gsap.utils.toArray('.story-grid > *, .value-card').forEach(function(item) {
                gsap.from(item, {
                    y: 40,
                    opacity: 0,
                    duration: 0.8,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: item,
                        start: 'top 84%',
                        toggleActions: 'play none none reverse'
                    }
                });
            });
        });
    </script>
@endpush
