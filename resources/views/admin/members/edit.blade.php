@extends('layouts.admin')
@section('title', 'Edit Anggota')
@section('page-title', 'Edit Anggota')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Edit Anggota</h4>
    <a href="{{ route('admin.members.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.members.update', $member) }}">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $member->user->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $member->user->email) }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">NIM/NIDN <span class="text-danger">*</span></label>
                    <input type="text" name="nim_nidn" class="form-control" value="{{ old('nim_nidn', $member->nim_nidn) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Program Studi</label>
                    <input type="text" name="prodi" class="form-control" value="{{ old('prodi', $member->prodi) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">No. HP</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $member->no_hp) }}">
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $member->alamat) }}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
        </form>
    </div>
</div>
@endsection
