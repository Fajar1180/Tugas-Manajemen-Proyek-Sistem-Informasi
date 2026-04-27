@extends('layouts.admin')
@section('title', 'Edit E-Resource')
@section('page-title', 'Edit E-Resource')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Edit E-Resource</h4>
    <a href="{{ route('admin.eresources.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card shadow-sm" style="max-width:700px;">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.eresources.update', $eresource) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Judul <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $eresource->title) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tipe</label>
                <select name="type" class="form-select" id="typeSelect">
                    <option value="file" {{ $eresource->type === 'file' ? 'selected' : '' }}>File</option>
                    <option value="link" {{ $eresource->type === 'link' ? 'selected' : '' }}>Link</option>
                </select>
            </div>
            <div class="mb-3" id="fileSection" style="{{ $eresource->type === 'file' ? '' : 'display:none;' }}">
                <label class="form-label">Upload File Baru</label>
                @if($eresource->file_path)<small class="text-muted d-block">File saat ini: {{ basename($eresource->file_path) }}</small>@endif
                <input type="file" name="file_path" class="form-control">
            </div>
            <div class="mb-3" id="urlSection" style="{{ $eresource->type === 'link' ? '' : 'display:none;' }}">
                <label class="form-label">URL</label>
                <input type="url" name="url" class="form-control" value="{{ old('url', $eresource->url) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $eresource->description) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
        </form>
    </div>
</div>
@push('scripts')
<script>
document.getElementById('typeSelect').addEventListener('change', function() {
    document.getElementById('fileSection').style.display = this.value === 'file' ? 'block' : 'none';
    document.getElementById('urlSection').style.display = this.value === 'link' ? 'block' : 'none';
});
</script>
@endpush
@endsection
