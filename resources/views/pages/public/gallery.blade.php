@extends('layouts.public')

@section('title', 'Gallery - Attalas Cafe')

@section('content')
    <main>
        <section class="page-hero">
            <div class="container">
                <span class="eyebrow">Gallery</span>
                <h1>Momen, menu, dan view Attalas Cafe.</h1>
                <p>Lihat beberapa suasana terbaik dari Attalas Cafe dan Kintamani.</p>
            </div>
        </section>

        <section class="gallery-section">
            <div class="container">
                @if ($galleries->isEmpty())
                    <div class="empty-state">Belum ada gallery yang ditampilkan.</div>
                @else
                    <div class="gallery-grid">
                        @foreach ($galleries as $gallery)
                            <figure class="gallery-card">
                                <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title ?? 'Attalas Cafe Gallery' }}">
                                @if ($gallery->title)
                                    <figcaption>{{ $gallery->title }}</figcaption>
                                @endif
                            </figure>
                        @endforeach
                    </div>

                    @if ($galleries->hasPages())
                        <div class="pagination-wrap">{{ $galleries->links() }}</div>
                    @endif
                @endif
            </div>
        </section>
    </main>
@endsection

@push('style')
    <style>
        .page-hero { padding: 150px 0 86px; color:#fff; background: linear-gradient(90deg, rgba(17,29,28,.88), rgba(32,50,49,.46)), linear-gradient(135deg,var(--primary-950),var(--primary-800)); }
        .eyebrow { display:inline-block; margin-bottom:14px; color:rgba(255,255,255,.72); font-size:.78rem; font-weight:800; letter-spacing:.12em; text-transform:uppercase; }
        .page-hero h1 { max-width:900px; margin:0 0 18px; font-size:clamp(2.5rem,5vw,5rem); line-height:.98; letter-spacing:-.07em; }
        .page-hero p { max-width:620px; margin:0; color:rgba(255,255,255,.72); line-height:1.75; }
        .gallery-section { padding:76px 0; }
        .gallery-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:18px; }
        .gallery-card { position:relative; margin:0; min-height:310px; overflow:hidden; border-radius:28px; background:var(--mist-100); box-shadow:0 18px 44px rgba(16,20,23,.08); }
        .gallery-card:nth-child(4n+1) { min-height:430px; }
        .gallery-card img { width:100%; height:100%; object-fit:cover; position:absolute; inset:0; transition:transform .2s ease; }
        .gallery-card:hover img { transform:scale(1.05); }
        .gallery-card figcaption { position:absolute; left:16px; right:16px; bottom:16px; padding:12px 14px; border-radius:18px; background:rgba(255,255,255,.84); backdrop-filter:blur(12px); font-weight:700; }
        .empty-state,.pagination-wrap { padding:28px; border-radius:24px; background:#fff; text-align:center; color:var(--muted); }
        .pagination-wrap { margin-top:28px; }
        @media (max-width: 992px) { .gallery-grid { grid-template-columns:repeat(2,minmax(0,1fr)); } }
        @media (max-width: 640px) { .gallery-grid { grid-template-columns:1fr; } }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (!window.gsap) return;
            gsap.from('.page-hero .eyebrow, .page-hero h1, .page-hero p', { y: 34, opacity: 0, duration: .9, stagger: .12, ease: 'power3.out' });
            gsap.utils.toArray('.gallery-card').forEach(function(card, index) {
                gsap.from(card, { y: 44, opacity: 0, duration: .8, delay: (index % 3) * .06, ease: 'power3.out', scrollTrigger: { trigger: card, start: 'top 86%' } });
            });
        });
    </script>
@endpush
