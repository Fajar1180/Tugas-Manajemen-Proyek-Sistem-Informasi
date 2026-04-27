@extends('layouts.admin')
@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Tambah Kategori</h4>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card shadow-sm" style="max-width:600px;">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
