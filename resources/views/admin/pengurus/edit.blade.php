@extends('admin.layouts.app')

@section('title', 'Edit Pengurus')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Edit Pengurus</h2>
    <a href="{{ route('admin.pengurus.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.pengurus.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" 
                               name="nama" 
                               value="{{ old('nama', $pengurus->nama) }}"
                               placeholder="Contoh: Ahmad Fauzi"
                               required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('jabatan') is-invalid @enderror" 
                               id="jabatan" 
                               name="jabatan" 
                               value="{{ old('jabatan', $pengurus->jabatan) }}"
                               placeholder="Contoh: Ketua DKM"
                               required>
                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="kontak" class="form-label">Nomor WhatsApp</label>
                        <input type="text" 
                               class="form-control @error('kontak') is-invalid @enderror" 
                               id="kontak" 
                               name="kontak" 
                               value="{{ old('kontak', $pengurus->kontak) }}"
                               placeholder="Contoh: 6281234567890">
                        @error('kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="urutan" class="form-label">Urutan Tampil</label>
                        <input type="number" 
                               class="form-control @error('urutan') is-invalid @enderror" 
                               id="urutan" 
                               name="urutan" 
                               value="{{ old('urutan', $pengurus->urutan) }}"
                               placeholder="0">
                        @error('urutan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto Profil</label>
                
                @if($pengurus->foto)
                    <div class="mb-3">
                        <p class="small text-muted mb-2">Foto saat ini:</p>
                        <img src="{{ asset('storage/' . $pengurus->foto) }}" 
                             alt="{{ $pengurus->nama }}" 
                             class="img-thumbnail rounded-circle"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                @endif
                
                <input type="file" 
                       class="form-control @error('foto') is-invalid @enderror" 
                       id="foto" 
                       name="foto"
                       accept="image/*"
                       onchange="previewImage(event)">
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                
                <!-- Image Preview -->
                <div class="mt-3" id="imagePreview" style="display: none;">
                    <p class="small text-muted mb-2">Preview Foto Baru:</p>
                    <img id="preview" src="" alt="Preview" class="img-thumbnail rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.pengurus.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endpush