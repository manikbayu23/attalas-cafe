@extends('layouts.admin')

@section('title', 'Kategori Menu - Attalas Cafe')
@section('page_name2', 'Kategori Menu')
@section('content')
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3>Kategori Menu</h3>
                <p class="text-muted mb-0">Kelola kategori menu untuk Attalas Cafe.</p>

            </div>
            <a href="{{ route('admin.menu-category.create') }}" class="btn btn-primary">
                <i class="ph-plus me-2"></i>Tambah Kategori
            </a>
        </div>

        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    @if (session('success'))
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: {!! json_encode(session('success')) !!},
                            timer: 3000,
                            showConfirmButton: false
                        });
                    @endif

                    @if (session('error'))
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: {!! json_encode(session('error')) !!},
                            timer: 3000,
                            showConfirmButton: false
                        });
                    @endif
                });
            </script>
        @endpush

        <div class="card rounded-0">
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th class="text-center">Tipe</th>
                            <th class="text-center">Jumlah Menu</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Urutan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td><code>{{ $category->slug }}</code></td>
                                <td class="text-center">
                                    @php
                                        $typeMeta = $categoryTypes[$category->type] ?? null;
                                    @endphp
                                    @if ($typeMeta)
                                        <span class="badge {{ $typeMeta['badge'] }}">{{ $typeMeta['label'] }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $category->type }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge bg-info">{{ $category->menus_count ?? $category->menus()->count() }}</span>
                                </td>
                                <td class="text-center">
                                    @if ($category->status)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $category->sort_order ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.menu-category.show', $category) }}"
                                        class="btn btn-sm btn-secondary" title="Lihat">
                                        <i class="ph-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.menu-category.edit', $category) }}" class="btn btn-sm btn-info"
                                        title="Edit">
                                        <i class="ph-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.menu-category.destroy', $category) }}" method="POST"
                                        style="display:inline-block;"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="ph-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Belum ada kategori menu. <a href="{{ route('admin.menu-category.create') }}">Tambah
                                        kategori sekarang</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
