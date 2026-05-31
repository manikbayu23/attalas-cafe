@extends('layouts.admin')

@section('title', 'Edit Gallery - Attalas Cafe')

@section('content')
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Edit Gallery</h3>
        </div>

        <div class="card">
            <div class="card-body gallery-edit-form">
                <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $gallery->title) }}" placeholder="Contoh: Latte Art Corner">
                                @error('title')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" rows="4" class="form-control" placeholder="Ceritakan sedikit tentang foto ini...">{{ old('description', $gallery->description) }}</textarea>
                                @error('description')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Featured</label>
                                    <select name="is_featured" class="form-select">
                                        <option value="0" @selected(!old('is_featured', $gallery->is_featured))>Tidak</option>
                                        <option value="1" @selected(old('is_featured', $gallery->is_featured))>Ya</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="1" @selected(old('status', $gallery->status))>Tayang</option>
                                        <option value="0" @selected(!old('status', $gallery->status))>Arsip</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Urutan</label>
                                    <input type="number" name="sort_order" class="form-control"
                                        value="{{ old('sort_order', $gallery->sort_order) }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Gambar Saat Ini</label>
                                <div class="gallery-edit-preview">
                                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title ?? 'Gallery image' }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ganti Gambar (opsional)</label>
                                <input type="file" name="image" class="form-control">
                                <div class="form-text">JPG/PNG/GIF, maksimal 4 MB. Akan dikonversi ke WebP.</div>
                                @error('image')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .gallery-edit-form {
            max-width: 1000px;
            margin: 0 auto;
        }

        .gallery-edit-preview {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.12);
        }

        .gallery-edit-preview img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }
    </style>
@endpush
