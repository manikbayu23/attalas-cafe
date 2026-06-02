@extends('layouts.admin')

@section('title', 'Detail Kategori Menu - Attalas Cafe')
@section('page_name1', 'Kategori Menu')
@section('page_name1_url', 'admin.menu-category.index')
@section('page_name2', 'Detail Kategori Menu')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Informasi Kategori</h5>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="text-muted">Nama Kategori</label>
                                <p class="mb-0"><strong>{{ $menuCategory->name }}</strong></p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted">Status</label>
                                <p class="mb-0">
                                    @if ($menuCategory->status)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="text-muted">Slug</label>
                                <p class="mb-0"><code>{{ $menuCategory->slug }}</code></p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted">Urutan</label>
                                <p class="mb-0">{{ $menuCategory->sort_order ?? '-' }}</p>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.menu-category.edit', $menuCategory) }}" class="btn btn-info">
                                <i class="ph-pencil me-2"></i>Edit
                            </a>
                            @if (!$menuCategory->menus()->exists())
                                <form action="{{ route('admin.menu-category.destroy', $menuCategory) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="ph-trash me-2"></i>Hapus
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-danger" disabled title="Kategori memiliki menu">
                                    <i class="ph-trash me-2"></i>Hapus
                                </button>
                            @endif
                            <a href="{{ route('admin.menu-category.index') }}" class="btn btn-secondary">
                                <i class="ph-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Menu dalam Kategori Ini ({{ $menuCategory->menus->count() }})</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Menu</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($menuCategory->menus as $menu)
                                    <tr>
                                        <td>{{ $menu->name }}</td>
                                        <td>{{ $menu->formatted_price }}</td>
                                        <td>
                                            @if ($menu->status)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-danger">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.menu.edit', $menu) }}" class="btn btn-sm btn-info">
                                                <i class="ph-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">
                                            Belum ada menu dalam kategori ini
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
