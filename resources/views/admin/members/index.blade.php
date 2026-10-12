@extends('layouts.admin')
@section('title', 'Anggota')
@section('page-title', 'Manajemen Anggota')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Daftar Anggota</h4>
    <a href="{{ route('admin.members.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Anggota</a>
</div>
<div class="card shadow-sm">
    <div class="card-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama/email/NIM..." value="{{ request('search') }}" style="max-width:300px;">
            <button type="submit" class="btn btn-sm btn-outline-primary">Cari</button>
            @if(request('search'))<a href="{{ route('admin.members.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>@endif
        </form>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light"><tr><th>Nama</th><th>Email</th><th>NIM/NIDN</th><th>Prodi</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($members as $member)
                <tr>
                    <td>{{ $member->user->name ?? '-' }}</td>
                    <td>{{ $member->user->email ?? '-' }}</td>
                    <td>{{ $member->nim_nidn }}</td>
                    <td>{{ $member->prodi ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.members.show', $member) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('admin.members.edit', $member) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('admin.members.destroy', $member) }}" class="d-inline" onsubmit="return confirm('Hapus anggota ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada anggota.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $members->links() }}</div>
</div>
@endsection
