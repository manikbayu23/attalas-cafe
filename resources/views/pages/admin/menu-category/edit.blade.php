@extends('layouts.admin')

@section('title', 'Edit Kategori Menu - Attalas Cafe')
@section('page_name1', 'Kategori Menu')
@section('page_name1_url', 'admin.menu-category.index')
@section('page_name2', 'Edit Kategori Menu')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.menu-category.update', $menuCategory) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Kategori <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $menuCategory->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" class="form-control" value="{{ $menuCategory->slug }}" disabled>
                                <small class="text-muted">Slug otomatis dihasilkan dari nama kategori</small>
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">Tipe Kategori <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                    @foreach ($typeOptions as $key => $label)
                                        <option value="{{ $key }}" {{ old('type', $menuCategory->type) == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status" name="status"
                                        value="1" {{ old('status', $menuCategory->status) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">
                                        Aktif
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Urutan (Sort Order)</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                    id="sort_order" name="sort_order"
                                    value="{{ old('sort_order', $menuCategory->sort_order) }}" min="0">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ph-check me-2"></i>Perbarui
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
