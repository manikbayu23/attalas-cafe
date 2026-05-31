@extends('layouts.admin')

@section('title', 'Ulasan - Attalas Cafe')
@section('page_name2', 'Ulasan')

@section('content')
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="mb-1">Ulasan Pelanggan</h3>
                <p class="text-muted mb-0">Kelola ulasan dan rating untuk Attalas Cafe.</p>
            </div>
            <a href="{{ route('admin.reviews.create') }}" class="btn btn-primary">
                <i class="ph-plus me-2"></i>Buat Ulasan Baru
            </a>
        </div>

        @if ($reviews->isEmpty())
            <div class="text-center text-muted py-5">
                Belum ada ulasan.
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3">
                @foreach ($reviews as $review)
                    <div class="col">
                        <div class="review-card border rounded-3 h-100 d-flex flex-column p-3">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <div class="fw-semibold">{{ $review->customer_name }}</div>
                                    @if ($review->created_at)
                                        <div class="text-muted small">
                                            {{ $review->created_at->format('d M Y H:i') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="review-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="ph-star{{ $i <= $review->rating ? '-fill text-warning' : ' text-muted' }} small"></i>
                                    @endfor
                                </div>
                            </div>

                            <p class="mb-2 text-muted flex-grow-1" style="white-space: pre-line;">
                                {{ Str::limit($review->review, 140) }}
                            </p>

                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="col-6">
                                    <span class="badge bg-{{ $review->status ? 'success' : 'secondary' }}">
                                        {{ $review->status ? 'Diterbitkan' : 'Disembunyikan' }}
                                    </span>
                                </div>
                                <div class="col-6 d-flex gap-1 justify-content-end ">
                                    <a href="{{ route('admin.reviews.edit', $review) }}"
                                        class="btn btn-outline-primary btn-sm"><i class="ph-pencil"></i> </a>
                                    <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST"
                                        class="review-delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm"><i
                                                class="ph-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($reviews->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $reviews->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection

@push('style')
    <style>
        .review-card {
            background: #ffffff;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.08);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .review-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.12);
        }

        .review-stars i {
            font-size: 0.95rem;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: {!! json_encode(session('success')) !!},
                    timer: 2500,
                    showConfirmButton: false
                });
            @endif

            document.querySelectorAll('.review-delete-form').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Hapus ulasan ini?',
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
