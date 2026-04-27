@extends('layouts.member')
@section('title', 'Dashboard Member')
@section('content')
<h3 class="mb-4">Selamat Datang, {{ auth()->user()->name }}!</h3>
@if(!$member)
<div class="alert alert-warning">
    <i class="bi bi-exclamation-triangle"></i> Profil anggota belum dilengkapi. Hubungi admin untuk mendaftarkan data keanggotaan Anda.
</div>
@else
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 bg-primary text-white shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-book fs-1"></i>
                <h3>{{ $stats['total_loans'] }}</h3>
                <p class="mb-0">Total Peminjaman</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 bg-warning text-dark shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-arrow-left-right fs-1"></i>
                <h3>{{ $stats['active_loans'] }}</h3>
                <p class="mb-0">Sedang Dipinjam</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 bg-success text-white shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-check-circle fs-1"></i>
                <h3>{{ $stats['returned_loans'] }}</h3>
                <p class="mb-0">Sudah Dikembalikan</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 bg-danger text-white shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-clock-history fs-1"></i>
                <h3>{{ $stats['overdue_loans'] }}</h3>
                <p class="mb-0">Terlambat</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header"><h6 class="mb-0">Profil Saya</h6></div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr><th>NIM/NIDN</th><td>{{ $member->nim_nidn }}</td></tr>
                    <tr><th>Prodi</th><td>{{ $member->prodi ?? '-' }}</td></tr>
                    <tr><th>No. HP</th><td>{{ $member->no_hp ?? '-' }}</td></tr>
                    <tr><th>Alamat</th><td>{{ $member->alamat ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Peminjaman Aktif</h6>
                <a href="{{ route('member.loans.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead class="table-light"><tr><th>Buku</th><th>Jatuh Tempo</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse($loans->where('status','borrowed') as $loan)
                        <tr>
                            <td>{{ $loan->loanItems->first()?->book?->title ?? '-' }}</td>
                            <td>{{ $loan->due_date->format('d/m/Y') }}</td>
                            <td>
                                @if($loan->is_overdue)
                                    <span class="badge bg-danger">Terlambat</span>
                                @else
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center py-3 text-muted">Tidak ada peminjaman aktif.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
