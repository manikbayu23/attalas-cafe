@extends('layouts.admin')

@section('title', 'Dashboard - Attalas Cafe')
@section('page_name2', 'Dashboard')

@section('content')
    <div class="content">
        <div class="dashboard-hero mb-4">
            <div>
                <span class="dashboard-eyebrow">Attalas Cafe Management System</span>
                <h2 class="mb-2">Selamat datang, {{ Auth::user()->name ?? 'Admin' }}</h2>
                <p class="mb-0">
                    Kelola menu, kategori, galeri, ulasan, dan pengguna dari satu tempat dengan cepat.
                </p>
            </div>
            <div class="dashboard-hero-icon">
                <i class="ph-coffee"></i>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-xl">
                <div class="summary-card">
                    <div class="summary-icon bg-primary-800"><i class="ph-fork-knife"></i></div>
                    <div>
                        <div class="summary-label">Total Menu</div>
                        <div class="summary-value">{{ $stats['menus'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl">
                <div class="summary-card">
                    <div class="summary-icon bg-primary-700"><i class="ph-tag"></i></div>
                    <div>
                        <div class="summary-label">Kategori</div>
                        <div class="summary-value">{{ $stats['categories'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl">
                <div class="summary-card">
                    <div class="summary-icon bg-primary-900"><i class="ph-image"></i></div>
                    <div>
                        <div class="summary-label">Gallery</div>
                        <div class="summary-value">{{ $stats['galleries'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl">
                <div class="summary-card">
                    <div class="summary-icon bg-primary-800"><i class="ph-star"></i></div>
                    <div>
                        <div class="summary-label">Ulasan</div>
                        <div class="summary-value">{{ $stats['reviews'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl">
                <div class="summary-card">
                    <div class="summary-icon bg-primary-950"><i class="ph-users"></i></div>
                    <div>
                        <div class="summary-label">User</div>
                        <div class="summary-value">{{ $stats['users'] }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-xl-8">
                <div class="card h-100 dashboard-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Status Menu</h5>
                        <a href="{{ route('admin.menu.index') }}" class="btn btn-sm btn-light">Lihat Semua</a>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-sm-6 col-lg-3">
                                <div class="mini-stat">
                                    <span class="mini-label">Aktif</span>
                                    <strong>{{ $menuStatus['active'] }}</strong>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="mini-stat">
                                    <span class="mini-label">Nonaktif</span>
                                    <strong>{{ $menuStatus['inactive'] }}</strong>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="mini-stat">
                                    <span class="mini-label">Best Seller</span>
                                    <strong>{{ $menuStatus['best_seller'] }}</strong>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="mini-stat">
                                    <span class="mini-label">Featured</span>
                                    <strong>{{ $menuStatus['featured'] }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card h-100 dashboard-card">
                    <div class="card-header">
                        <h5 class="mb-0">Insight Singkat</h5>
                    </div>
                    <div class="card-body">
                        <div class="insight-row">
                            <span>Rata-rata rating</span>
                            <strong>{{ number_format($reviewInsight['average_rating'], 1) }}/5</strong>
                        </div>
                        <div class="insight-row">
                            <span>Ulasan aktif</span>
                            <strong>{{ $reviewInsight['active'] }}</strong>
                        </div>
                        <div class="insight-row">
                            <span>Ulasan featured</span>
                            <strong>{{ $reviewInsight['featured'] }}</strong>
                        </div>
                        <div class="insight-row">
                            <span>Gallery aktif</span>
                            <strong>{{ $galleryInsight['active'] }}</strong>
                        </div>
                        <div class="insight-row mb-0">
                            <span>Gallery featured</span>
                            <strong>{{ $galleryInsight['featured'] }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-xl-8">
                <div class="card dashboard-card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Menu Terbaru</h5>
                        <a href="{{ route('admin.menu.create') }}" class="btn btn-sm btn-primary">Tambah Menu</a>
                    </div>
                    <div class="card-body p-0">
                        @if ($latestMenus->isEmpty())
                            <div class="text-center text-muted py-4">Belum ada menu.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 align-middle">
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestMenus as $menu)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        @if ($menu->image)
                                                            <img src="{{ asset('storage/' . $menu->image) }}"
                                                                alt="{{ $menu->name }}" class="dashboard-menu-img">
                                                        @else
                                                            <div class="dashboard-menu-img placeholder-img"><i class="ph-image"></i></div>
                                                        @endif
                                                        <div>
                                                            <div class="fw-semibold">{{ $menu->name }}</div>
                                                            <div class="text-muted small">{{ Str::limit($menu->description, 40) }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $menu->category->name ?? '-' }}</td>
                                                <td>{{ $menu->formatted_price }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $menu->status ? 'success' : 'secondary' }}">
                                                        {{ $menu->status ? 'Aktif' : 'Nonaktif' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card dashboard-card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="quick-actions">
                            <a href="{{ route('admin.menu.create') }}" class="quick-action">
                                <i class="ph-plus-circle"></i><span>Tambah Menu</span>
                            </a>
                            <a href="{{ route('admin.menu-category.create') }}" class="quick-action">
                                <i class="ph-tag"></i><span>Tambah Kategori</span>
                            </a>
                            <a href="{{ route('admin.gallery.index') }}" class="quick-action">
                                <i class="ph-upload-simple"></i><span>Upload Gallery</span>
                            </a>
                            <a href="{{ route('admin.reviews.create') }}" class="quick-action">
                                <i class="ph-chat-centered-text"></i><span>Tambah Ulasan</span>
                            </a>
                            <a href="{{ route('admin.users.create') }}" class="quick-action">
                                <i class="ph-user-plus"></i><span>Tambah User</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-xl-6">
                <div class="card dashboard-card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Ulasan Terbaru</h5>
                        <a href="{{ route('admin.reviews.index') }}" class="btn btn-sm btn-light">Kelola</a>
                    </div>
                    <div class="card-body">
                        @forelse ($latestReviews as $review)
                            <div class="review-item">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <strong>{{ $review->customer_name }}</strong>
                                    <div class="review-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="ph-star{{ $i <= $review->rating ? '-fill text-warning' : ' text-muted' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p class="mb-0 text-muted small">{{ Str::limit($review->review, 110) }}</p>
                            </div>
                        @empty
                            <div class="text-center text-muted py-4">Belum ada ulasan.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card dashboard-card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Gallery Terbaru</h5>
                        <a href="{{ route('admin.gallery.index') }}" class="btn btn-sm btn-light">Lihat Gallery</a>
                    </div>
                    <div class="card-body">
                        @if ($latestGalleries->isEmpty())
                            <div class="text-center text-muted py-4">Belum ada gambar.</div>
                        @else
                            <div class="dashboard-gallery-grid">
                                @foreach ($latestGalleries as $gallery)
                                    <div class="dashboard-gallery-item">
                                        <img src="{{ asset('storage/' . $gallery->image) }}"
                                            alt="{{ $gallery->title ?? 'Gallery image' }}">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .dashboard-hero {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem;
            border-radius: 18px;
            background: radial-gradient(circle at top right, rgba(220, 231, 227, 0.45), transparent 45%),
                linear-gradient(135deg, var(--primary-950), var(--primary-800));
            color: #fff;
            box-shadow: 0 18px 40px rgba(17, 29, 28, 0.22);
        }

        .dashboard-eyebrow {
            display: inline-block;
            margin-bottom: 0.35rem;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.72);
        }

        .dashboard-hero-icon {
            width: 76px;
            height: 76px;
            border-radius: 24px;
            display: grid;
            place-items: center;
            background: rgba(255, 255, 255, 0.16);
            flex: 0 0 auto;
        }

        .dashboard-hero-icon i {
            font-size: 2.4rem;
        }

        .summary-card,
        .dashboard-card {
            border: 1px solid rgba(60, 89, 86, 0.08);
            box-shadow: 0 12px 28px rgba(17, 29, 28, 0.07);
        }

        .summary-card {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            padding: 1rem;
            border-radius: 16px;
            background: #fff;
            height: 100%;
        }

        .summary-icon {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            color: #fff;
            flex: 0 0 auto;
        }

        .summary-icon i {
            font-size: 1.35rem;
        }

        .summary-label {
            font-size: 0.78rem;
            color: #6b7280;
        }

        .summary-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-950);
        }

        .bg-primary-950 { background: var(--primary-950); }
        .bg-primary-900 { background: var(--primary-900); }
        .bg-primary-800 { background: var(--primary-800); }
        .bg-primary-700 { background: var(--primary-700); }

        .mini-stat {
            border-radius: 14px;
            padding: 1rem;
            background: rgba(60, 89, 86, 0.06);
        }

        .mini-label {
            display: block;
            color: #6b7280;
            font-size: 0.8rem;
            margin-bottom: 0.25rem;
        }

        .mini-stat strong {
            font-size: 1.6rem;
            color: var(--primary-950);
        }

        .insight-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.8rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px dashed rgba(60, 89, 86, 0.18);
        }

        .insight-row strong {
            color: var(--primary-800);
        }

        .dashboard-menu-img {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            object-fit: cover;
            background: var(--mist-50);
        }

        .placeholder-img {
            display: grid;
            place-items: center;
            color: var(--primary-800);
        }

        .quick-actions {
            display: grid;
            gap: 0.75rem;
        }

        .quick-action {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 0.9rem;
            border-radius: 14px;
            background: rgba(60, 89, 86, 0.06);
            color: var(--primary-950);
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.12s ease, background-color 0.12s ease;
        }

        .quick-action:hover {
            transform: translateX(3px);
            background: rgba(60, 89, 86, 0.12);
            color: var(--primary-950);
        }

        .quick-action i {
            font-size: 1.25rem;
            color: var(--primary-800);
        }

        .review-item {
            padding: 0.85rem 0;
            border-bottom: 1px solid rgba(60, 89, 86, 0.12);
        }

        .review-item:first-child {
            padding-top: 0;
        }

        .review-item:last-child {
            padding-bottom: 0;
            border-bottom: 0;
        }

        .review-stars i {
            font-size: 0.88rem;
        }

        .dashboard-gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.75rem;
        }

        .dashboard-gallery-item {
            position: relative;
            padding-top: 75%;
            overflow: hidden;
            border-radius: 14px;
            background: var(--mist-50);
        }

        .dashboard-gallery-item img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.15s ease;
        }

        .dashboard-gallery-item:hover img {
            transform: scale(1.04);
        }

        @media (max-width: 767px) {
            .dashboard-hero {
                align-items: flex-start;
            }

            .dashboard-hero-icon {
                display: none;
            }
        }
    </style>
@endpush
