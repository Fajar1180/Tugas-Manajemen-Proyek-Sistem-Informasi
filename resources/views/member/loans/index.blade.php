@extends('layouts.member')
@section('title', 'Peminjaman Saya')
@section('content')
<h4 class="mb-4">Peminjaman Saya</h4>
<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light"><tr><th>#</th><th>Buku</th><th>Tgl Pinjam</th><th>Jatuh Tempo</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($loans as $loan)
                <tr>
                    <td>{{ $loan->id }}</td>
                    <td>
                        @foreach($loan->loanItems as $item)
                            <div class="small">{{ $item->book->title ?? '-' }}</div>
                        @endforeach
                    </td>
                    <td>{{ $loan->loan_date->format('d/m/Y') }}</td>
                    <td>{{ $loan->due_date->format('d/m/Y') }}</td>
                    <td>
                        @if($loan->status === 'returned')
                            <span class="badge bg-success">Dikembalikan</span>
                        @elseif($loan->is_overdue)
                            <span class="badge bg-danger">Terlambat</span>
                        @else
                            <span class="badge bg-warning text-dark">Dipinjam</span>
                        @endif
                    </td>
                    <td><a href="{{ route('member.loans.show', $loan) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a></td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada riwayat peminjaman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(method_exists($loans, 'links'))
    <div class="card-footer">{{ $loans->links() }}</div>
    @endif
</div>
@endsection
