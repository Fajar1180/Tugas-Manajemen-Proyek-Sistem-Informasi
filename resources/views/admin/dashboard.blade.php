@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6>Total Buku</h6><h2>{{ $stats['total_books'] }}</h2></div>
                    <i class="bi bi-book fs-1 opacity-50"></i>
                </div>
                <small>{{ $stats['total_stock'] }} total stok</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6>Total Anggota</h6><h2>{{ $stats['total_members'] }}</h2></div>
                    <i class="bi bi-people fs-1 opacity-50"></i>
                </div>
                <small>Anggota terdaftar</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-warning text-dark">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6>Peminjaman Aktif</h6><h2>{{ $stats['active_loans'] }}</h2></div>
                    <i class="bi bi-arrow-left-right fs-1 opacity-50"></i>
                </div>
                <small>Sedang dipinjam</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-danger text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6>Terlambat</h6><h2>{{ $stats['overdue_loans'] }}</h2></div>
                    <i class="bi bi-clock-history fs-1 opacity-50"></i>
                </div>
                <small>Melewati batas waktu</small>
            </div>
        </div>
    </div>
</div>
<div class="row g-4">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header"><h6 class="mb-0">Buku Populer</h6></div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead class="table-light"><tr><th>Judul</th><th>Pengarang</th><th>Dipinjam</th></tr></thead>
                    <tbody>
                        @forelse($popularBooks as $book)
                        <tr>
                            <td>{{ Str::limit($book->title, 30) }}</td>
                            <td>{{ $book->author }}</td>
                            <td><span class="badge bg-primary">{{ $book->loan_items_count }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Belum ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header"><h6 class="mb-0">Peminjaman Terbaru</h6></div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead class="table-light"><tr><th>Anggota</th><th>Buku</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse($recentLoans as $loan)
                        <tr>
                            <td>{{ $loan->member->user->name ?? '-' }}</td>
                            <td>{{ $loan->loanItems->first()?->book?->title ? Str::limit($loan->loanItems->first()->book->title, 20) : '-' }}</td>
                            <td>
                                <span class="badge {{ $loan->status === 'borrowed' ? 'bg-warning text-dark' : 'bg-success' }}">
                                    {{ $loan->status === 'borrowed' ? 'Dipinjam' : 'Dikembalikan' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Belum ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
