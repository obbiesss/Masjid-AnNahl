@extends('admin.layouts.app')

@section('title', 'Edit Galeri')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Edit Galeri</h2>
    <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Judul Galeri <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    class="form-control @error('title') is-invalid @enderror" 
                    id="title" 
                    name="title" 
                    value="{{ old('title', $gallery->title) }}"
                    required
                >
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Media Saat Ini</label>
                @php
                    $media = $gallery->image ?? $gallery->video;
                    $ext = strtolower(pathinfo($media, PATHINFO_EXTENSION));
                    
                    $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                    $isVideo = in_array($ext, ['mp4','mov','avi','mkv','webm']);
                    
                    // Fix untuk path video yang tidak lengkap
                    $videoPath = $gallery->video;
                    if ($videoPath && !str_contains($videoPath, '/')) {
                        $videoPath = 'galleries/videos/' . $videoPath;
                    }
                    
                    $imagePath = $gallery->image;
                    if ($imagePath && !str_contains($imagePath, '/')) {
                        $imagePath = 'galleries/images/' . $imagePath;
                    }
                @endphp

                <div class="card" style="max-width: 500px;">
                    <div class="ratio ratio-16x9" style="background: #f8f9fa; overflow:hidden; border-radius: .5rem .5rem 0 0;">
                        @if ($isImage && $gallery->image)
                            <img 
                                src="{{ Storage::url($imagePath) }}" 
                                alt="{{ $gallery->title }}"
                                style="object-fit: cover;" 
                                class="w-100 h-100"
                                onerror="this.parentElement.innerHTML='<div class=\'d-flex justify-content-center align-items-center w-100 h-100 bg-light\'><i class=\'bi bi-image-fill text-muted\' style=\'font-size: 3rem;\'></i></div>'"
                            >
                        
                        @elseif ($isVideo && $gallery->video)
                            <video 
                                controls
                                preload="metadata"
                                class="w-100 h-100"
                                style="object-fit: contain; background: #000;"
                                playsinline
                            >
                                <source src="{{ Storage::url($videoPath) }}" type="video/mp4">
                                Browser Anda tidak mendukung video ini.
                            </video>
                        
                        @else
                            <div class="d-flex justify-content-center align-items-center w-100 h-100 bg-light">
                                <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="card-body">
                        @if($isVideo)
                            <span class="badge bg-primary">
                                <i class="bi bi-camera-video"></i> Video
                            </span>
                        @elseif($isImage)
                            <span class="badge bg-success">
                                <i class="bi bi-image"></i> Foto
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload Gambar Baru (Opsional)</label>
                <input 
                    type="file" 
                    class="form-control @error('image') is-invalid @enderror" 
                    id="image" 
                    name="image"
                    accept="image/*"
                    onchange="previewImage(event)"
                >
                <small class="text-muted">Format: JPG, PNG, GIF. Max 2MB</small>
                @error('image')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                
                {{-- Preview gambar baru --}}
                <div id="imagePreview" class="mt-2" style="display:none;">
                    <label class="form-label">Preview Gambar Baru:</label>
                    <div class="card" style="max-width: 500px;">
                        <img id="previewImg" src="" class="card-img-top" style="object-fit: cover; max-height: 300px;">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="video" class="form-label">Upload Video Baru (Opsional)</label>
                <input 
                    type="file" 
                    class="form-control @error('video') is-invalid @enderror" 
                    id="video" 
                    name="video"
                    accept="video/*"
                    onchange="previewVideo(event)"
                >
                <small class="text-muted">Format: MP4, AVI, MOV. Max 50MB</small>
                @error('video')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                
                {{-- Preview video baru --}}
                <div id="videoPreview" class="mt-2" style="display:none;">
                    <label class="form-label">Preview Video Baru:</label>
                    <div class="card" style="max-width: 500px;">
                        <video id="previewVid" controls class="card-img-top" style="max-height: 300px; background: #000;"></video>
                    </div>
                </div>
            </div>

            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i>
                <strong>Catatan:</strong> Jika Anda upload gambar/video baru, media lama akan otomatis terhapus.
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save"></i> Update Galeri
                </button>
                <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
            document.getElementById('videoPreview').style.display = 'none';
        }
        reader.readAsDataURL(file);
    }
}

function previewVideo(event) {
    const file = event.target.files[0];
    if (file) {
        const url = URL.createObjectURL(file);
        document.getElementById('previewVid').src = url;
        document.getElementById('videoPreview').style.display = 'block';
        document.getElementById('imagePreview').style.display = 'none';
    }
}
</script>
@endsection