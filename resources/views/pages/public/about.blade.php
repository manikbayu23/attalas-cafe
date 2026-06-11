@extends('layouts.public')

@section('title', 'About Us - Attalas Cafe')

@section('content')
    <main>
        <section class="about-hero" @style(['--hero-image: url(' . $heroImage . ')' => $heroImage])>
            <div class="container about-hero-inner">
                <div class="about-copy">
                    <span class="eyebrow">About Attalas Cafe</span>
                    <h1>Tempat menikmati kopi, udara Kintamani, dan view yang menenangkan.</h1>
                    <p>
                        Attalas Cafe hadir sebagai ruang singgah yang hangat di Kintamani. Kami memadukan sajian kopi,
                        menu pilihan, dan suasana alam yang membuat setiap kunjungan terasa lebih rileks dan berkesan.
                    </p>
                </div>

                <div class="about-visual">
                    <img src="{{ asset('assets/images/attalas-logo.png') }}" alt="Attalas Cafe">
                </div>
            </div>
        </section>

        <section class="about-section">
            <div class="container story-grid">
                <div>
                    <span class="section-kicker">Our Story</span>
                    <h2>Dibangun untuk momen sederhana yang terasa premium.</h2>
                </div>
                <div>
                    <p>
                        Kami percaya pengalaman cafe terbaik bukan hanya tentang minuman yang enak, tetapi juga tentang
                        tempat yang membuat pengunjung ingin tinggal lebih lama. Dari aroma kopi, suasana sejuk, sampai
                        pelayanan yang ramah, semuanya dirancang agar terasa natural dan nyaman.
                    </p>
                    <p>
                        Berada di kawasan Kintamani, Attalas Cafe ingin menjadi tempat yang cocok untuk menikmati pagi,
                        berbincang santai, bekerja sejenak, atau sekadar menikmati pemandangan dengan secangkir kopi.
                    </p>
                </div>
            </div>
        </section>

        <section class="about-section soft-section">
            <div class="container values-grid">
                <div class="value-card">
                    <i class="ph-mountains"></i>
                    <h3>Scenic Ambience</h3>
                    <p>Suasana Kintamani yang sejuk dan natural menjadi bagian utama dari pengalaman kami.</p>
                </div>
                <div class="value-card">
                    <i class="ph-coffee"></i>
                    <h3>Curated Coffee</h3>
                    <p>Kopi disajikan untuk menemani berbagai suasana, dari santai sampai produktif.</p>
                </div>
                <div class="value-card">
                    <i class="ph-heart"></i>
                    <h3>Warm Service</h3>
                    <p>Pelayanan ramah dan detail kecil yang membuat kunjungan terasa personal.</p>
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
            padding: 130px 0 76px;
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
            font-size: clamp(2.4rem, 5vw, 5rem);
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
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .value-card {
            padding: 28px;
            border-radius: 28px;
            background: #fff;
            border: 1px solid rgba(16, 20, 23, 0.06);
            box-shadow: 0 18px 44px rgba(16, 20, 23, 0.08);
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
            .story-grid,
            .values-grid {
                grid-template-columns: 1fr;
            }

            .about-visual {
                display: none;
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
