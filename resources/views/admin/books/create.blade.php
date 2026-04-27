@extends('layouts.admin')
@section('title', 'Tambah Buku')
@section('page-title', 'Tambah Buku')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Tambah Buku Baru</h4>
    <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">ISBN</label>
                    <input type="text" name="isbn" class="form-control @error('isbn') is-invalid @enderror" value="{{ old('isbn') }}">
                    @error('isbn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pengarang <span class="text-danger">*</span></label>
                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author') }}" required>
                    @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="publisher" class="form-control" value="{{ old('publisher') }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number" name="year" class="form-control" value="{{ old('year') }}" min="1000" max="{{ date('Y') }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', 0) }}" min="0" required>
                    @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Lokasi Rak</label>
                    <input type="text" name="shelf_location" class="form-control" value="{{ old('shelf_location') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cover Buku</label>
                    <input type="file" name="cover_image" class="form-control" accept="image/*">
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Buku</button>
        </form>
    </div>
</div>
@endsection
