@extends('layouts.admin')

@section('title', 'Detail Menu - Attalas Cafe')

@section('content')
    <div class="content">
        <div class="mb-4">
            <h3>Detail Menu</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.menu.index') }}">Menu</a></li>
                    <li class="breadcrumb-item active">{{ $menu->name }}</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                @if ($menu->image)
                                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                        class="img-fluid rounded">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                        style="height: 300px;">
                                        <span class="text-muted">Tidak ada gambar</span>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h4 class="mb-3">{{ $menu->name }}</h4>

                                <div class="mb-3">
                                    <label class="text-muted">Kategori</label>
                                    <p class="mb-0">{{ $menu->category->name ?? '-' }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="text-muted">Harga</label>
                                    <p class="mb-0"><strong class="fs-5">{{ $menu->formatted_price }}</strong></p>
                                </div>

                                <div class="mb-3">
                                    <label class="text-muted">Status</label>
                                    <p class="mb-0">
                                        @if ($menu->status)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                        @endif
                                    </p>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <label class="text-muted">Best Seller</label>
                                        <p class="mb-0">
                                            @if ($menu->is_best_seller)
                                                <i class="ph-check-circle text-success fs-5"></i>
                                            @else
                                                <i class="ph-x-circle text-danger fs-5"></i>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <label class="text-muted">Featured</label>
                                        <p class="mb-0">
                                            @if ($menu->is_featured)
                                                <i class="ph-check-circle text-success fs-5"></i>
                                            @else
                                                <i class="ph-x-circle text-danger fs-5"></i>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label class="text-muted">Deskripsi</label>
                            <p class="mb-0">{{ $menu->description ?? '-' }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted">Urutan (Sort Order)</label>
                            <p class="mb-0">{{ $menu->sort_order }}</p>
                        </div>

                        <hr>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.menu.edit', $menu) }}" class="btn btn-info">
                                <i class="ph-pencil me-2"></i>Edit
                            </a>
                            <form action="{{ route('admin.menu.destroy', $menu) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="ph-trash me-2"></i>Hapus
                                </button>
                            </form>
                            <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">
                                <i class="ph-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
