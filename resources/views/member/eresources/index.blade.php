@extends('layouts.member')
@section('title', 'E-Resources')
@section('content')
<h4 class="mb-4"><i class="bi bi-file-earmark-richtext"></i> E-Resources</h4>
<div class="row row-cols-1 row-cols-md-3 g-4">
    @forelse($resources as $res)
    <div class="col">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-start gap-3">
                    <div class="bg-{{ $res->type === 'file' ? 'primary' : 'info' }} text-white rounded p-2">
                        <i class="bi bi-{{ $res->type === 'file' ? 'file-earmark-pdf' : 'link-45deg' }} fs-4"></i>
                    </div>
                    <div>
                        <h6>{{ $res->title }}</h6>
                        <span class="badge bg-secondary">{{ strtoupper($res->type) }}</span>
                        @if($res->description)
                            <p class="text-muted small mt-2">{{ Str::limit($res->description, 100) }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('member.eresources.show', $res) }}" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                @if($res->type === 'link' && $res->url)
                    <a href="{{ $res->url }}" target="_blank" class="btn btn-sm btn-outline-success">Buka Link</a>
                @elseif($res->type === 'file' && $res->file_path)
                    <a href="{{ Storage::url($res->file_path) }}" target="_blank" class="btn btn-sm btn-outline-success">Unduh</a>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-12"><div class="alert alert-info">Belum ada E-Resource tersedia.</div></div>
    @endforelse
</div>
<div class="mt-4">{{ $resources->links() }}</div>
@endsection
