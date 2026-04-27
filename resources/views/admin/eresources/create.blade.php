@extends('layouts.admin')
@section('title', 'Tambah E-Resource')
@section('page-title', 'Tambah E-Resource')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Tambah E-Resource</h4>
    <a href="{{ route('admin.eresources.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card shadow-sm" style="max-width:700px;">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.eresources.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Judul <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Tipe <span class="text-danger">*</span></label>
                <select name="type" class="form-select @error('type') is-invalid @enderror" id="typeSelect" required>
                    <option value="">-- Pilih Tipe --</option>
                    <option value="file" {{ old('type') === 'file' ? 'selected' : '' }}>File</option>
                    <option value="link" {{ old('type') === 'link' ? 'selected' : '' }}>Link</option>
                </select>
                @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3" id="fileSection" style="display:none;">
                <label class="form-label">Upload File</label>
                <input type="file" name="file_path" class="form-control">
            </div>
            <div class="mb-3" id="urlSection" style="display:none;">
                <label class="form-label">URL</label>
                <input type="url" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url') }}" placeholder="https://...">
                @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
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
