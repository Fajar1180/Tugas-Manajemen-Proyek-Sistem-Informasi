@extends('layouts.admin')
@section('title', 'Detail Anggota')
@section('page-title', 'Detail Anggota')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Detail Anggota</h4>
    <div>
        <a href="{{ route('admin.members.edit', $member) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
        <a href="{{ route('admin.members.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:80px;height:80px;">
                    <i class="bi bi-person-fill text-white fs-1"></i>
                </div>
                <h5>{{ $member->user->name }}</h5>
                <p class="text-muted">{{ $member->user->email }}</p>
                <table class="table table-sm text-start">
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
            <div class="card-header"><h6 class="mb-0">Riwayat Peminjaman</h6></div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead class="table-light"><tr><th>Tanggal</th><th>Buku</th><th>Jatuh Tempo</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse($member->loans as $loan)
                        <tr>
                            <td>{{ $loan->loan_date->format('d/m/Y') }}</td>
                            <td>{{ $loan->loanItems->first()?->book?->title ?? '-' }}</td>
                            <td>{{ $loan->due_date->format('d/m/Y') }}</td>
                            <td><span class="badge {{ $loan->status === 'borrowed' ? 'bg-warning text-dark' : 'bg-success' }}">{{ $loan->status === 'borrowed' ? 'Dipinjam' : 'Dikembalikan' }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-3 text-muted">Belum ada riwayat peminjaman.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
