@extends('layouts.admin')

@section('title', 'Detail Ulasan')

@section('content')
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Detail Ulasan</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="mb-1">{{ $review->customer_name }}</h5>
                        @if ($review->created_at)
                            <div class="text-muted small">{{ $review->created_at->format('d M Y H:i') }}</div>
                        @endif
                    </div>
                    <div>
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="ph-star{{ $i <= $review->rating ? '-fill text-warning' : ' text-muted' }}"></i>
                        @endfor
                    </div>
                </div>

                <p class="mb-3 text-muted" style="white-space: pre-line;">{{ $review->review }}</p>

                <div class="d-flex justify-content-between align-items-center">
                    <span class="badge bg-{{ $review->status ? 'success' : 'secondary' }}">
                        {{ $review->status ? 'Diterbitkan' : 'Disembunyikan' }}
                    </span>
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST"
                            class="review-delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
