@extends('layouts.admin')

@section('title', 'Menu - Attalas Cafe')
@section('page_name2', 'Menu')
@push('scripts')
    <style>
        .menu-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #f1f1f1;
            transition: .25s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
        }

        .menu-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, .12);
        }

        .menu-image-wrapper {
            aspect-ratio: 1 / 0.8;
            overflow: hidden;
            background: #f8f8f8;
        }

        .menu-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s ease;
        }

        .menu-card:hover .menu-image {
            transform: scale(1.05);
        }

        .menu-placeholder {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-title {
            font-size: 14px;
            font-weight: 500;
            line-height: 1.45;
            min-height: 40px;

            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .menu-price {
            font-size: 18px;
            font-weight: 700;
            color: #ee4d2d;
            /* ala Shopee */
        }

        .badge-shopee {
            font-size: 11px;
            padding: 6px 10px;
            border-radius: 999px;
        }

        .dropdown-menu {
            border-radius: 14px;
        }
    </style>
@endpush
@section('content')
    <div class="content">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
            <div>
                <h4 class="mb-1 fw-semibold">
                    Menu Attalas Cafe
                </h4>

                <p class="text-muted mb-0">
                    {{ $menus->total() ?? $menus->count() }} menu tersedia
                </p>
            </div>

            <div class="mt-3 mt-md-0">
                <a href="{{ route('admin.menu.create') }}" class="btn btn-primary ">

                    <i class="ph-plus me-1"></i>
                    Tambah Menu
                </a>
            </div>

        </div>

        <div class="card border-0 shadow-sm mb-4 rounded-0">
            <div class="card-body">

                {{-- HEADER --}}

                {{-- FILTER --}}
                <form method="GET" class="row g-3">

                    <div class="col-md-4">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Cari menu...">
                    </div>

                    <div class="col-md-3">
                        <select name="category" class="form-select">
                            <option value="">Semua Kategori</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="sort" class="form-select">
                            <option value="">Sortir</option>
                            <option value="name_asc" @selected(request('sort') == 'name_asc')>
                                Nama A-Z
                            </option>
                            <option value="name_desc" @selected(request('sort') == 'name_desc')>
                                Nama Z-A
                            </option>
                            <option value="price_asc" @selected(request('sort') == 'price_asc')>
                                Harga Terendah
                            </option>
                            <option value="price_desc" @selected(request('sort') == 'price_desc')>
                                Harga Tertinggi
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-light border w-100">
                            Filter
                        </button>
                    </div>

                </form>

            </div>
        </div>
        @if ($menus->isEmpty())
            <div class="text-center text-muted py-4">
                Belum ada menu. <a href="{{ route('admin.menu.create') }}">Tambah menu sekarang</a>
            </div>
        @else
            <div class="row row-cols-2 row-cols-md-3 row-cols-xl-4 g-3">

                @foreach ($menus as $menu)
                    <div class="col">

                        <div class="menu-card position-relative h-100">

                            {{-- BADGES --}}
                            <div class="position-absolute top-0 start-0 p-2 z-3 d-flex gap-1">

                                @if ($menu->is_best_seller)
                                    <span class="badge badge-shopee bg-danger">
                                        Best Seller
                                    </span>
                                @endif

                                @if ($menu->is_featured)
                                    <span class="badge badge-shopee bg-warning text-dark">
                                        Featured
                                    </span>
                                @endif
                            </div>

                            {{-- IMAGE --}}
                            <div class="menu-image-wrapper">

                                @if ($menu->image)
                                    <img src="{{ asset('storage/' . $menu->image) }}" class="menu-image"
                                        alt="{{ $menu->name }}" loading="lazy">
                                @else
                                    <div class="menu-placeholder">
                                        <i class="ph-image text-muted fs-1"></i>
                                    </div>
                                @endif

                            </div>

                            {{-- CONTENT --}}
                            <div class="p-3">

                                {{-- TITLE --}}
                                <h6 class="menu-title mb-0">
                                    {{ $menu->name }}
                                </h6>

                                {{-- CATEGORY --}}
                                <small class="text-muted d-block mb-2">
                                    {{ $menu->category->name ?? '-' }}
                                </small>

                                {{-- PRICE --}}
                                <div class="d-flex justify-content-between align-items-center">

                                    <div class="col-8">
                                        <div class="menu-price">
                                            {{ $menu->formatted_price }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $menu->status ? 'Aktif' : 'Tidak Aktif' }}
                                        </small>
                                    </div>

                                    {{-- ACTION --}}
                                    <div class="col-4 text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm rounded-circle shadow-sm p-2"
                                                data-bs-toggle="dropdown">

                                                <i class="ph-dots-three-outline"></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">

                                                <li>
                                                    <a href="{{ route('admin.menu.edit', $menu) }}" class="dropdown-item">
                                                        <i class="ph-pencil me-2"></i>
                                                        Edit
                                                    </a>
                                                </li>

                                                <li>
                                                    <form action="{{ route('admin.menu.destroy', $menu) }}" method="POST"
                                                        onsubmit="return confirm('Hapus menu ini?')">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="dropdown-item text-danger">

                                                            <i class="ph-trash me-2"></i>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($menus->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $menus->links() }}
            </div>
        @endif
    </div>
@endsection
