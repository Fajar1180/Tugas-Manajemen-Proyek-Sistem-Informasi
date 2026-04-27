@extends('layouts.admin')
@section('title', 'Peminjaman')
@section('page-title', 'Manajemen Peminjaman')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Daftar Peminjaman</h4>
    <a href="{{ route('admin.loans.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Buat Peminjaman</a>
</div>
<div class="card shadow-sm">
    <div class="card-header">
        <form method="GET" class="d-flex gap-2">
            <select name="status" class="form-select form-select-sm" style="max-width:150px;">
                <option value="">Semua Status</option>
                <option value="borrowed" {{ request('status') === 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
                <option value="returned" {{ request('status') === 'returned' ? 'selected' : '' }}>Dikembalikan</option>
            </select>
            <button type="submit" class="btn btn-sm btn-outline-primary">Filter</button>
            @if(request('status'))<a href="{{ route('admin.loans.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>@endif
        </form>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light"><tr><th>#</th><th>Anggota</th><th>Buku</th><th>Tgl Pinjam</th><th>Jatuh Tempo</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($loans as $loan)
                <tr>
                    <td>{{ $loan->id }}</td>
                    <td>{{ $loan->member->user->name ?? '-' }}</td>
                    <td>
                        @foreach($loan->loanItems as $item)
                            <span class="badge bg-secondary">{{ Str::limit($item->book->title ?? '', 20) }}</span>
                        @endforeach
                    </td>
                    <td>{{ $loan->loan_date->format('d/m/Y') }}</td>
                    <td>
                        {{ $loan->due_date->format('d/m/Y') }}
                        @if($loan->status === 'borrowed' && $loan->due_date->isPast())
                            <span class="badge bg-danger ms-1">Terlambat</span>
                        @endif
                    </td>
                    <td><span class="badge {{ $loan->status === 'borrowed' ? 'bg-warning text-dark' : 'bg-success' }}">{{ $loan->status === 'borrowed' ? 'Dipinjam' : 'Dikembalikan' }}</span></td>
                    <td>
                        <a href="{{ route('admin.loans.show', $loan) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        @if($loan->status === 'borrowed')
                            <a href="{{ route('admin.returns.create', $loan) }}" class="btn btn-sm btn-success"><i class="bi bi-arrow-return-left"></i></a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada peminjaman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $loans->links() }}</div>
</div>
@endsection
