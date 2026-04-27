@extends('layouts.admin')
@section('title', 'E-Resources')
@section('page-title', 'Manajemen E-Resources')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Daftar E-Resources</h4>
    <a href="{{ route('admin.eresources.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah E-Resource</a>
</div>
<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light"><tr><th>Judul</th><th>Tipe</th><th>Deskripsi</th><th>Diupload oleh</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($resources as $res)
                <tr>
                    <td>{{ $res->title }}</td>
                    <td><span class="badge {{ $res->type === 'file' ? 'bg-primary' : 'bg-info text-dark' }}">{{ strtoupper($res->type) }}</span></td>
                    <td class="text-muted">{{ Str::limit($res->description, 50) }}</td>
                    <td>{{ $res->uploader->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.eresources.edit', $res) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('admin.eresources.destroy', $res) }}" class="d-inline" onsubmit="return confirm('Hapus E-Resource ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada E-Resource.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $resources->links() }}</div>
</div>
@endsection
