@extends('layouts.admin')
@section('title', 'Buat Peminjaman')
@section('page-title', 'Buat Peminjaman')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Buat Peminjaman Baru</h4>
    <a href="{{ route('admin.loans.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.loans.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Anggota <span class="text-danger">*</span></label>
                <select name="member_id" class="form-select @error('member_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Anggota --</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->user->name }} ({{ $member->nim_nidn }})
                        </option>
                    @endforeach
                </select>
                @error('member_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Pilih Buku <span class="text-danger">*</span></label>
                <div class="border rounded p-3" style="max-height:300px;overflow-y:auto;">
                    @forelse($books as $book)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="book_ids[]" value="{{ $book->id }}" id="book{{ $book->id }}"
                            {{ in_array($book->id, old('book_ids', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="book{{ $book->id }}">
                            {{ $book->title }} - {{ $book->author }}
                            <span class="badge bg-success">Stok: {{ $book->stock }}</span>
                        </label>
                    </div>
                    @empty
                    <p class="text-muted">Tidak ada buku tersedia.</p>
                    @endforelse
                </div>
                @error('book_ids')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Catatan</label>
                <textarea name="note" class="form-control" rows="2">{{ old('note') }}</textarea>
            </div>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Durasi peminjaman: <strong>{{ config('library.loan_days', 7) }} hari</strong>. Denda keterlambatan: <strong>Rp {{ number_format(config('library.fine_per_day', 1000)) }}/hari</strong>.
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Buat Peminjaman</button>
        </form>
    </div>
</div>
@endsection
