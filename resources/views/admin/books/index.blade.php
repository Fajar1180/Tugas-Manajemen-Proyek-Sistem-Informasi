@extends('layouts.admin')
@section('title', 'Manajemen Buku')
@section('page-title', 'Manajemen Buku')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Daftar Buku</h4>
    <a href="{{ route('admin.books.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Buku</a>
</div>
<div class="card shadow-sm">
    <div class="card-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari judul/pengarang/ISBN..." value="{{ request('search') }}" style="max-width:300px;">
            <button type="submit" class="btn btn-sm btn-outline-primary">Cari</button>
            @if(request('search'))<a href="{{ route('admin.books.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>@endif
        </form>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>ISBN</th><th>Judul</th><th>Pengarang</th><th>Kategori</th><th>Stok</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td class="small text-muted">{{ $book->isbn ?? '-' }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->category->name ?? '-' }}</td>
                    <td><span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }}">{{ $book->stock }}</span></td>
                    <td>
                        <a href="{{ route('admin.books.show', $book) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('admin.books.destroy', $book) }}" class="d-inline" onsubmit="return confirm('Hapus buku ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">Tidak ada buku ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $books->links() }}</div>
</div>
@endsection
