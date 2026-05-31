@extends('layouts.admin')

@section('title', 'Gallery - Attalas Cafe')

@section('content')
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Gallery</h3>
                <p class="text-muted mb-0">Kelola foto-foto terbaik Attalas Cafe.</p>
            </div>
        </div>

        {{-- SweetAlert2 akan menampilkan flash success, tidak perlu alert Bootstrap di sini --}}

        <div class="card mb-4 rounded-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Upload Gallery (Drag & Drop)</h5>
                <small class="text-muted">Maksimal 4 MB per gambar, format JPG/PNG/GIF (disimpan sebagai WebP).</small>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.gallery.store') }}" method="POST" class="dropzone" id="gallery-dropzone">
                    @csrf
                </form>
            </div>
        </div>

        @if ($galleries->isEmpty())
            <div class="text-center text-muted py-5">
                Belum ada gambar di gallery.
            </div>
        @else
            <div class="gallery-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($galleries as $item)
                    <div class="col">
                        <div class="gallery-card h-100">
                            <div class="gallery-thumb-wrapper">
                                <img src="{{ asset('storage/' . $item->image) }}"
                                    alt="{{ $item->title ?? 'Gallery image' }}" class="gallery-thumb">
                                @if ($item->is_featured)
                                    <span class="badge bg-warning text-dark gallery-badge">Featured</span>
                                @endif
                            </div>
                            <div class="gallery-body d-flex flex-column">
                                <h6 class="gallery-title mb-1">{{ $item->title ?? 'Tanpa judul' }}</h6>
                                @if ($item->description)
                                    <p class="gallery-desc text-muted mb-2">{{ Str::limit($item->description, 80) }}</p>
                                @endif
                                <div class="mt-auto d-flex justify-content-between align-items-center small">
                                    <span class="badge bg-{{ $item->status ? 'success' : 'secondary' }}">
                                        {{ $item->status ? 'Tayang' : 'Arsip' }}
                                    </span>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.gallery.edit', $item) }}" class="btn btn-outline-primary">
                                            <i class="ph-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST"
                                            class="gallery-delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class="ph-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($galleries->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $galleries->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" />
    <style>
        #gallery-dropzone {
            border: 2px dashed #cbd5f5;
            border-radius: 10px;
            background: #f9fafb;
            padding: 1.5rem;
        }

        .dz-message {
            color: #6b7280;
            font-weight: 500;
        }

        .gallery-card {
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
            display: flex;
            flex-direction: column;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .gallery-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 35px rgba(15, 23, 42, 0.12);
        }

        .gallery-thumb-wrapper {
            position: relative;
            padding-top: 65%;
            overflow: hidden;
        }

        .gallery-thumb {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-badge {
            position: absolute;
            top: 0.75rem;
            left: 0.75rem;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .gallery-body {
            padding: 0.75rem 0.85rem 0.9rem;
        }

        .gallery-title {
            font-weight: 600;
        }

        .gallery-desc {
            font-size: 0.85rem;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Dropzone.autoDiscover = false;

        document.addEventListener('DOMContentLoaded', function() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            new Dropzone('#gallery-dropzone', {
                paramName: 'image',
                maxFilesize: 4, // MB
                acceptedFiles: 'image/*',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                },
                dictDefaultMessage: 'Lepaskan gambar di sini atau klik untuk memilih',
                init: function() {
                    this.on('queuecomplete', function() {
                        window.location.reload();
                    });
                }
            });

            // SweetAlert2: flash sukses
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: {!! json_encode(session('success')) !!},
                    timer: 2500,
                    showConfirmButton: false
                });
            @endif

            // SweetAlert2: konfirmasi hapus
            document.querySelectorAll('.gallery-delete-form').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Hapus gambar ini?',
                        text: 'Tindakan ini tidak dapat dibatalkan.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
