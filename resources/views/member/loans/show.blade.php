@extends('layouts.member')
@section('title', 'Detail Peminjaman')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Detail Peminjaman #{{ $loan->id }}</h4>
    <a href="{{ route('member.loans.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header"><h6 class="mb-0">Informasi Peminjaman</h6></div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr><th>Tgl Pinjam</th><td>{{ $loan->loan_date->format('d/m/Y') }}</td></tr>
                    <tr><th>Jatuh Tempo</th><td>{{ $loan->due_date->format('d/m/Y') }}</td></tr>
                    <tr><th>Status</th><td>
                        @if($loan->status === 'returned')
                            <span class="badge bg-success">Dikembalikan</span>
                        @elseif($loan->is_overdue)
                            <span class="badge bg-danger">Terlambat</span>
                        @else
                            <span class="badge bg-warning text-dark">Dipinjam</span>
                        @endif
                    </td></tr>
                </table>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-header"><h6 class="mb-0">Buku</h6></div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead class="table-light"><tr><th>Judul</th><th>Pengarang</th></tr></thead>
                    <tbody>
                        @foreach($loan->loanItems as $item)
                        <tr><td>{{ $item->book->title ?? '-' }}</td><td>{{ $item->book->author ?? '-' }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if($loan->loanReturn)
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header"><h6 class="mb-0">Informasi Pengembalian</h6></div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr><th>Tgl Kembali</th><td>{{ $loan->loanReturn->return_date->format('d/m/Y') }}</td></tr>
                    <tr><th>Keterlambatan</th><td>{{ $loan->loanReturn->late_days }} hari</td></tr>
                    <tr><th>Denda</th><td>Rp {{ number_format($loan->loanReturn->fine_amount, 0, ',', '.') }}</td></tr>
                    <tr><th>Dibayar</th><td>Rp {{ number_format($loan->loanReturn->total_paid, 0, ',', '.') }}</td></tr>
                    <tr><th>Sisa</th><td>
                        <span class="badge {{ $loan->loanReturn->remaining_fine > 0 ? 'bg-danger' : 'bg-success' }}">
                            Rp {{ number_format($loan->loanReturn->remaining_fine, 0, ',', '.') }}
                        </span>
                    </td></tr>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
