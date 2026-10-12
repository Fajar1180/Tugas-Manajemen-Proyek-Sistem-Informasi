@extends('layouts.admin')
@section('title', 'Proses Pengembalian')
@section('page-title', 'Proses Pengembalian Buku')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Proses Pengembalian</h4>
    <a href="{{ route('admin.loans.show', $loan) }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header"><h6 class="mb-0">Detail Peminjaman</h6></div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr><th>Anggota</th><td>{{ $loan->member->user->name }}</td></tr>
                    <tr><th>Tgl Pinjam</th><td>{{ $loan->loan_date->format('d/m/Y') }}</td></tr>
                    <tr><th>Jatuh Tempo</th><td>{{ $loan->due_date->format('d/m/Y') }}</td></tr>
                    <tr><th>Buku</th><td>
                        @foreach($loan->loanItems as $item)
                            <div>{{ $item->book->title }}</div>
                        @endforeach
                    </td></tr>
                </table>
            </div>
        </div>
        @if($lateDays > 0)
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <strong>Terlambat {{ $lateDays }} hari!</strong> Denda: <strong>Rp {{ number_format($fineAmount, 0, ',', '.') }}</strong>
        </div>
        @else
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i> Pengembalian tepat waktu. Tidak ada denda.
        </div>
        @endif
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header"><h6 class="mb-0">Form Pengembalian</h6></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.returns.store') }}">
                    @csrf
                    <input type="hidden" name="loan_id" value="{{ $loan->id }}">
                    <div class="mb-3">
                        <label class="form-label">Tanggal Pengembalian</label>
                        <input type="date" name="return_date" class="form-control" value="{{ $returnDate }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="note" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100"><i class="bi bi-arrow-return-left"></i> Konfirmasi Pengembalian</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
