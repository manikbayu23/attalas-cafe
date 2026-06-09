@extends('layouts.public')

@section('title', 'Menu - Attalas Cafe')

@section('content')
    <main>
        <section class="page-hero">
            <div class="container">
                <span class="eyebrow">Our Menu</span>
                <h1>Menu pilihan untuk menikmati suasana Kintamani.</h1>
                <p>Kopi, makanan, dan minuman yang disiapkan untuk menemani waktu santai di Attalas Cafe.</p>
            </div>
        </section>

        <section class="menu-section">
            <div class="container">
                @if ($menus->isEmpty())
                    <div class="empty-state">Belum ada menu yang ditampilkan.</div>
                @else
                    <div class="menu-grid">
                        @foreach ($menus as $menu)
                            <article class="menu-card">
                                <div class="menu-image">
                                    @if ($menu->image)
                                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}">
                                    @else
                                        <div class="menu-placeholder"><i class="ph-image"></i></div>
                                    @endif
                                    @if ($menu->is_best_seller)
                                        <span class="menu-badge">Best Seller</span>
                                    @elseif ($menu->is_featured)
                                        <span class="menu-badge">Featured</span>
                                    @endif
                                </div>
                                <div class="menu-body">
                                    <span>{{ $menu->category->name ?? 'Menu' }}</span>
                                    <h3>{{ $menu->name }}</h3>
                                    <p>{{ Str::limit($menu->description, 105) }}</p>
                                    <strong>{{ $menu->formatted_price }}</strong>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    @if ($menus->hasPages())
                        <div class="pagination-wrap">{{ $menus->links() }}</div>
                    @endif
                @endif
            </div>
        </section>
    </main>
@endsection

@push('style')
    <style>
        .page-hero {
            padding: 150px 0 86px;
            color: #fff;
            background: linear-gradient(90deg, rgba(6, 18, 20, 0.88), rgba(14, 32, 33, 0.58)), linear-gradient(135deg, #0f1f1f, #354844);
        }

        .eyebrow {
            display: inline-block;
            margin-bottom: 14px;
            color: rgba(255,255,255,.72);
            font-size: .78rem;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .page-hero h1 {
            max-width: 880px;
            margin: 0 0 18px;
            font-size: clamp(2.5rem, 5vw, 5rem);
            line-height: .98;
            letter-spacing: -.07em;
        }

        .page-hero p {
            max-width: 620px;
            margin: 0;
            color: rgba(255,255,255,.72);
            line-height: 1.75;
        }

        .menu-section {
            padding: 76px 0;
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
            border: 1px solid rgba(16,20,23,.06);
            box-shadow: 0 18px 44px rgba(16,20,23,.08);
        }

        .menu-image {
            position: relative;
            aspect-ratio: 4 / 3;
            background: var(--mist-100);
            overflow: hidden;
        }

        .menu-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .18s ease;
        }

        .menu-card:hover .menu-image img {
            transform: scale(1.05);
        }

        .menu-placeholder {
            width: 100%;
            height: 100%;
            display: grid;
            place-items: center;
            color: var(--sage-700);
            font-size: 2rem;
        }

        .menu-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(16,20,23,.82);
            color: #fff;
            font-size: .72rem;
            font-weight: 800;
        }

        .menu-body {
            padding: 18px;
        }

        .menu-body span {
            display: block;
            margin-bottom: 6px;
            color: var(--muted);
            font-size: .82rem;
        }

        .menu-body h3 {
            margin: 0 0 8px;
        }

        .menu-body p {
            min-height: 52px;
            margin: 0 0 16px;
            color: var(--muted);
            line-height: 1.65;
        }

        .menu-body strong {
            color: var(--graphite-950);
            font-size: 1.08rem;
        }

        .empty-state, .pagination-wrap {
            padding: 28px;
            border-radius: 24px;
            background: #fff;
            text-align: center;
            color: var(--muted);
        }

        .pagination-wrap {
            margin-top: 28px;
        }

        @media (max-width: 992px) { .menu-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 640px) { .menu-grid { grid-template-columns: 1fr; } }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (!window.gsap) return;
            gsap.from('.page-hero .eyebrow, .page-hero h1, .page-hero p', { y: 34, opacity: 0, duration: .9, stagger: .12, ease: 'power3.out' });
            gsap.utils.toArray('.menu-card').forEach(function(card, index) {
                gsap.from(card, { y: 44, opacity: 0, duration: .8, delay: (index % 3) * .06, ease: 'power3.out', scrollTrigger: { trigger: card, start: 'top 86%' } });
            });
        });
    </script>
@endpush
