@extends('layouts.admin')
@section('title', 'Detail Peminjaman')
@section('page-title', 'Detail Peminjaman')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Detail Peminjaman #{{ $loan->id }}</h4>
    <div>
        @if($loan->status === 'borrowed')
            <a href="{{ route('admin.returns.create', $loan) }}" class="btn btn-success"><i class="bi bi-arrow-return-left"></i> Proses Pengembalian</a>
        @endif
        <a href="{{ route('admin.loans.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header"><h6 class="mb-0">Informasi Peminjaman</h6></div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr><th width="140">Anggota</th><td>{{ $loan->member->user->name ?? '-' }}</td></tr>
                    <tr><th>NIM/NIDN</th><td>{{ $loan->member->nim_nidn ?? '-' }}</td></tr>
                    <tr><th>Tgl Pinjam</th><td>{{ $loan->loan_date->format('d/m/Y') }}</td></tr>
                    <tr><th>Jatuh Tempo</th><td>{{ $loan->due_date->format('d/m/Y') }}</td></tr>
                    <tr><th>Status</th><td>
                        <span class="badge {{ $loan->status === 'borrowed' ? 'bg-warning text-dark' : 'bg-success' }} fs-6">
                            {{ $loan->status === 'borrowed' ? 'Dipinjam' : 'Dikembalikan' }}
                        </span>
                        @if($loan->status === 'borrowed' && $loan->due_date->isPast())
                            <span class="badge bg-danger">Terlambat {{ now()->diffInDays($loan->due_date) }} hari</span>
                        @endif
                    </td></tr>
                    @if($loan->note)
                        <tr><th>Catatan</th><td>{{ $loan->note }}</td></tr>
                    @endif
                </table>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-header"><h6 class="mb-0">Buku yang Dipinjam</h6></div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead class="table-light"><tr><th>Judul</th><th>Pengarang</th><th>Qty</th></tr></thead>
                    <tbody>
                        @foreach($loan->loanItems as $item)
                        <tr>
                            <td>{{ $item->book->title ?? '-' }}</td>
                            <td>{{ $item->book->author ?? '-' }}</td>
                            <td>{{ $item->qty }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        @if($loan->loanReturn)
        <div class="card shadow-sm mb-4">
            <div class="card-header"><h6 class="mb-0">Informasi Pengembalian</h6></div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr><th width="140">Tgl Kembali</th><td>{{ $loan->loanReturn->return_date->format('d/m/Y') }}</td></tr>
                    <tr><th>Keterlambatan</th><td>{{ $loan->loanReturn->late_days }} hari</td></tr>
                    <tr><th>Total Denda</th><td>Rp {{ number_format($loan->loanReturn->fine_amount, 0, ',', '.') }}</td></tr>
                    <tr><th>Sudah Dibayar</th><td>Rp {{ number_format($loan->loanReturn->total_paid, 0, ',', '.') }}</td></tr>
                    <tr><th>Sisa Denda</th><td>
                        <span class="badge {{ $loan->loanReturn->remaining_fine > 0 ? 'bg-danger' : 'bg-success' }} fs-6">
                            Rp {{ number_format($loan->loanReturn->remaining_fine, 0, ',', '.') }}
                        </span>
                    </td></tr>
                </table>
            </div>
        </div>
        @if($loan->loanReturn->fine_amount > 0 && $loan->loanReturn->remaining_fine > 0)
        <div class="card shadow-sm">
            <div class="card-header"><h6 class="mb-0">Pembayaran Denda</h6></div>
            <div class="card-body">
                @foreach($loan->loanReturn->finePayments as $pay)
                <div class="d-flex justify-content-between small border-bottom pb-1 mb-1">
                    <span>{{ $pay->pay_date->format('d/m/Y') }} - {{ ucfirst($pay->method) }}</span>
                    <span>Rp {{ number_format($pay->amount, 0, ',', '.') }}</span>
                </div>
                @endforeach
                <form method="POST" action="{{ route('admin.fine-payments.store') }}" class="mt-3">
                    @csrf
                    <input type="hidden" name="return_id" value="{{ $loan->loanReturn->id }}">
                    <div class="row g-2">
                        <div class="col-6">
                            <input type="date" name="pay_date" class="form-control form-control-sm" value="{{ now()->toDateString() }}" required>
                        </div>
                        <div class="col-6">
                            <input type="number" name="amount" class="form-control form-control-sm" placeholder="Jumlah (Rp)" value="{{ $loan->loanReturn->remaining_fine }}" required>
                        </div>
                        <div class="col-6">
                            <select name="method" class="form-select form-select-sm">
                                <option value="cash">Tunai</option>
                                <option value="transfer">Transfer</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-sm btn-success w-100">Bayar Denda</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif
        @endif
    </div>
</div>
@endsection
