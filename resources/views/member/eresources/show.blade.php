@extends('layouts.member')
@section('title', $eresource->title)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>{{ $eresource->title }}</h4>
    <a href="{{ route('member.eresources.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card shadow-sm" style="max-width:700px;">
    <div class="card-body">
        <table class="table table-borderless">
            <tr><th width="120">Judul</th><td>{{ $eresource->title }}</td></tr>
            <tr><th>Tipe</th><td><span class="badge bg-primary">{{ strtoupper($eresource->type) }}</span></td></tr>
            @if($eresource->description)
            <tr><th>Deskripsi</th><td>{{ $eresource->description }}</td></tr>
            @endif
        </table>
        <div class="mt-3">
            @if($eresource->type === 'link' && $eresource->url)
                <a href="{{ $eresource->url }}" target="_blank" class="btn btn-success"><i class="bi bi-box-arrow-up-right"></i> Buka Link</a>
            @elseif($eresource->type === 'file' && $eresource->file_path)
                <a href="{{ Storage::url($eresource->file_path) }}" target="_blank" class="btn btn-primary"><i class="bi bi-download"></i> Unduh File</a>
            @endif
        </div>
    </div>
</div>
@endsection
