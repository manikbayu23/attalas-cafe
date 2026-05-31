@extends('layouts.admin')

@section('title', 'Buat Ulasan Baru')

@section('content')
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Buat Ulasan Baru</h3>
        </div>

        <div class="card">
            <div class="card-body" style="max-width: 720px;">
                <form action="{{ route('admin.reviews.store') }}" method="POST" class="row g-3">
                    @csrf

                    <div class="col-12">
                        <label for="customer_name" class="form-label">Nama Pengguna</label>
                        <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}"
                            class="form-control" required>
                        @error('customer_name')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="rating" class="form-label">Rating</label>
                        <select id="rating" name="rating" class="form-select" required>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" @selected(old('rating') == $i)>{{ $i }} ★
                                </option>
                            @endfor
                        </select>
                        @error('rating')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="1" @selected(old('status') == '1')>Diterbitkan</option>
                            <option value="0" @selected(old('status') == '0')>Disembunyikan</option>
                        </select>
                        @error('status')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="review" class="form-label">Komentar</label>
                        <textarea id="review" name="review" rows="4" class="form-control" required>{{ old('review') }}</textarea>
                        @error('review')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
