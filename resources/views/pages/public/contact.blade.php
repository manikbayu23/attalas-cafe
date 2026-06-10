@extends('layouts.public')

@section('title', 'Contact Us - Attalas Cafe')

@section('content')
    <main>
        <section class="page-hero">
            <div class="container">
                <span class="eyebrow">Contact Us</span>
                <h1>Mari terhubung dengan Attalas Cafe.</h1>
                <p>Hubungi kami untuk pertanyaan, informasi menu, atau kunjungan ke cafe.</p>
            </div>
        </section>

        <section class="contact-section">
            <div class="container contact-grid">
                <div class="contact-info">
                    <div class="info-card">
                        <i class="ph-map-pin"></i>
                        <div><strong>Location</strong><span>Kintamani, Bali</span></div>
                    </div>
                    <div class="info-card">
                        <i class="ph-whatsapp-logo"></i>
                        <div><strong>WhatsApp</strong><span>+62 812-3456-7890</span></div>
                    </div>
                    <div class="info-card">
                        <i class="ph-clock"></i>
                        <div><strong>Opening Hours</strong><span>Setiap hari, 08.00 - 21.00 WITA</span></div>
                    </div>
                </div>

                <div class="contact-card">
                    <h2>Kirim pesan</h2>
                    <p>Form ini masih tampilan awal. Untuk sekarang, gunakan WhatsApp agar pesan langsung masuk.</p>
                    <form>
                        <input type="text" placeholder="Nama lengkap">
                        <input type="email" placeholder="Email">
                        <textarea rows="5" placeholder="Pesan"></textarea>
                        <a href="https://wa.me/6281234567890?text=Halo%20Attalas%20Cafe,%20saya%20ingin%20bertanya."
                            class="btn btn-primary" target="_blank" rel="noopener">Chat via WhatsApp</a>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('style')
    <style>
        .page-hero { padding:150px 0 86px; color:#fff; background:linear-gradient(90deg,rgba(17,29,28,.88),rgba(32,50,49,.46)),linear-gradient(135deg,var(--primary-950),var(--primary-800)); }
        .eyebrow { display:inline-block; margin-bottom:14px; color:rgba(255,255,255,.72); font-size:.78rem; font-weight:800; letter-spacing:.12em; text-transform:uppercase; }
        .page-hero h1 { max-width:900px; margin:0 0 18px; font-size:clamp(2.5rem,5vw,5rem); line-height:.98; letter-spacing:-.07em; }
        .page-hero p { max-width:620px; margin:0; color:rgba(255,255,255,.72); line-height:1.75; }
        .contact-section { padding:76px 0; }
        .contact-grid { display:grid; grid-template-columns:minmax(0,.85fr) minmax(0,1.15fr); gap:24px; }
        .contact-info { display:grid; gap:16px; }
        .info-card,.contact-card { background:#fff; border:1px solid rgba(16,20,23,.06); box-shadow:0 18px 44px rgba(16,20,23,.08); }
        .info-card { display:flex; gap:16px; align-items:flex-start; padding:24px; border-radius:26px; }
        .info-card i { display:grid; place-items:center; width:48px; height:48px; border-radius:18px; background:rgba(127,155,136,.16); color:var(--sage-700); font-size:1.45rem; flex:0 0 auto; }
        .info-card strong { display:block; margin-bottom:4px; }
        .info-card span,.contact-card p { color:var(--muted); line-height:1.7; }
        .contact-card { padding:30px; border-radius:30px; }
        .contact-card h2 { margin:0 0 8px; font-size:2rem; letter-spacing:-.05em; }
        .contact-card form { display:grid; gap:14px; margin-top:22px; }
        .contact-card input,.contact-card textarea { width:100%; border:1px solid rgba(16,20,23,.12); border-radius:18px; padding:14px 16px; font:inherit; background:var(--mist-50); }
        .contact-card textarea { resize:vertical; }
        @media (max-width: 860px) { .contact-grid { grid-template-columns:1fr; } }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (!window.gsap) return;
            gsap.from('.page-hero .eyebrow, .page-hero h1, .page-hero p', { y: 34, opacity: 0, duration: .9, stagger: .12, ease: 'power3.out' });
            gsap.from('.info-card, .contact-card', { y: 42, opacity: 0, duration: .8, stagger: .1, ease: 'power3.out', scrollTrigger: { trigger: '.contact-section', start: 'top 80%' } });
        });
    </script>
@endpush
