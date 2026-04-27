@extends('layouts.app')
@section('title', 'Katalog Buku')
@section('content')
<div class="row mb-4">
    <div class="col-12"><h2><i class="bi bi-search"></i> Katalog Buku (OPAC)</h2><hr></div>
</div>
<div class="row mb-4">
    <div class="col-12">
        <form method="GET" class="row g-3">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Cari judul, pengarang, ISBN..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Cari</button>
            </div>
        </form>
    </div>
</div>
<div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
    @forelse($books as $book)
    <div class="col">
        <div class="card h-100 shadow-sm">
            @if($book->cover_image)
                <img src="{{ Storage::url($book->cover_image) }}" class="card-img-top" style="height:200px;object-fit:cover;" alt="{{ $book->title }}">
            @else
                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height:200px;">
                    <i class="bi bi-book text-white" style="font-size:3rem;"></i>
                </div>
            @endif
            <div class="card-body">
                <h6 class="card-title">{{ $book->title }}</h6>
                <p class="card-text text-muted small">{{ $book->author }}</p>
                @if($book->category)
                    <span class="badge bg-info text-dark">{{ $book->category->name }}</span>
                @endif
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                    {{ $book->stock > 0 ? 'Tersedia ('.$book->stock.')' : 'Tidak Tersedia' }}
                </span>
                <a href="{{ route('opac.show', $book) }}" class="btn btn-sm btn-outline-primary">Detail</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12"><div class="alert alert-info">Tidak ada buku yang ditemukan.</div></div>
    @endforelse
</div>
<div class="mt-4">{{ $books->links() }}</div>
@endsection
