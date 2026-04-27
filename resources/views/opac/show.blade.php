@extends('layouts.app')
@section('title', $book->title)
@section('content')
<div class="row">
    <div class="col-md-3">
        @if($book->cover_image)
            <img src="{{ Storage::url($book->cover_image) }}" class="img-fluid rounded shadow" alt="{{ $book->title }}">
        @else
            <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="height:300px;">
                <i class="bi bi-book text-white" style="font-size:4rem;"></i>
            </div>
        @endif
    </div>
    <div class="col-md-9">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('opac.index') }}">Katalog</a></li>
                <li class="breadcrumb-item active">{{ $book->title }}</li>
            </ol>
        </nav>
        <h2>{{ $book->title }}</h2>
        <table class="table table-bordered">
            <tr><th width="150">Pengarang</th><td>{{ $book->author }}</td></tr>
            <tr><th>Penerbit</th><td>{{ $book->publisher ?? '-' }}</td></tr>
            <tr><th>Tahun</th><td>{{ $book->year ?? '-' }}</td></tr>
            <tr><th>ISBN</th><td>{{ $book->isbn ?? '-' }}</td></tr>
            <tr><th>Kategori</th><td>{{ $book->category->name ?? '-' }}</td></tr>
            <tr><th>Lokasi Rak</th><td>{{ $book->shelf_location ?? '-' }}</td></tr>
            <tr><th>Ketersediaan</th><td>
                <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }} fs-6">
                    {{ $book->stock > 0 ? 'Tersedia ('.$book->stock.' eks)' : 'Tidak Tersedia' }}
                </span>
            </td></tr>
        </table>
        @if($book->description)
            <div class="card mt-3"><div class="card-header">Deskripsi</div><div class="card-body">{{ $book->description }}</div></div>
        @endif
        <a href="{{ route('opac.index') }}" class="btn btn-secondary mt-3"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>
@endsection
