@extends('layouts.admin')
@section('title', $book->title)
@section('page-title', 'Detail Buku')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Detail Buku</h4>
    <div>
        <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
        <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        @if($book->cover_image)
            <img src="{{ Storage::url($book->cover_image) }}" class="img-fluid rounded shadow" alt="{{ $book->title }}">
        @else
            <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="height:250px;">
                <i class="bi bi-book text-white" style="font-size:4rem;"></i>
            </div>
        @endif
    </div>
    <div class="col-md-9">
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><th width="150">Judul</th><td>{{ $book->title }}</td></tr>
                    <tr><th>Pengarang</th><td>{{ $book->author }}</td></tr>
                    <tr><th>ISBN</th><td>{{ $book->isbn ?? '-' }}</td></tr>
                    <tr><th>Penerbit</th><td>{{ $book->publisher ?? '-' }}</td></tr>
                    <tr><th>Tahun</th><td>{{ $book->year ?? '-' }}</td></tr>
                    <tr><th>Kategori</th><td>{{ $book->category->name ?? '-' }}</td></tr>
                    <tr><th>Lokasi Rak</th><td>{{ $book->shelf_location ?? '-' }}</td></tr>
                    <tr><th>Stok</th><td><span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }} fs-6">{{ $book->stock }} eksemplar</span></td></tr>
                </table>
                @if($book->description)
                    <hr><p>{{ $book->description }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
