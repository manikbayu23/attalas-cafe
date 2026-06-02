@extends('layouts.admin')

@section('title', 'Tambah Kategori Menu - Attalas Cafe')
@section('page_name1', 'Kategori Menu')
@section('page_name1_url', 'admin.menu-category.index')
@section('page_name2', 'Tambah Kategori Menu')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.menu-category.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Kategori <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status" name="status"
                                        value="1" {{ old('status', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">
                                        Aktif
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Urutan (Sort Order)</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                    id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ph-check me-2"></i>Simpan
                                </button>
                                <a href="{{ route('admin.menu-category.index') }}" class="btn btn-secondary">
                                    <i class="ph-arrow-left me-2"></i>Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
