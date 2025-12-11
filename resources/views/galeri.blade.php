@extends('layouts.app')

@section('title', 'Galeri - Masjid An Nahl')

@section('content')
{{-- Hero Section --}}
<section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bold mb-3">Galeri Masjid An Nahl</h1>
            <p class="lead mb-0">Dokumentasi kegiatan dan momen berharga di Masjid An Nahl</p>
        </div>
    </div>
</section>

{{-- Gallery Grid --}}
<section class="py-5">
    <div class="container">
        @if($galleries->count() > 0)
            <div class="row g-4">
                @foreach($galleries as $gallery)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100 gallery-card">
                        @php
                            $media = $gallery->image ?? $gallery->video;
                            $ext = strtolower(pathinfo($media, PATHINFO_EXTENSION));
                            
                            $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                            $isVideo = in_array($ext, ['mp4','mov','avi','mkv','webm']);
                            
                            // Fix untuk path yang tidak lengkap
                            $videoPath = $gallery->video;
                            if ($videoPath && !str_contains($videoPath, '/')) {
                                $videoPath = 'galleries/videos/' . $videoPath;
                            }
                            
                            $imagePath = $gallery->image;
                            if ($imagePath && !str_contains($imagePath, '/')) {
                                $imagePath = 'galleries/images/' . $imagePath;
                            }
                        @endphp

                        <div class="ratio ratio-16x9 position-relative" style="background: #f8f9fa; overflow:hidden; border-radius: .5rem .5rem 0 0; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modal{{ $gallery->id }}">
                            @if ($isImage && $gallery->image)
                                <img 
                                    src="{{ Storage::url($imagePath) }}" 
                                    alt="{{ $gallery->title }}"
                                    style="object-fit: cover;" 
                                    class="w-100 h-100 gallery-img"
                                    onerror="this.parentElement.innerHTML='<div class=\'d-flex justify-content-center align-items-center w-100 h-100 bg-light\'><i class=\'bi bi-image-fill text-muted\' style=\'font-size: 3rem;\'></i></div>'"
                                >
                                
                                {{-- Zoom overlay untuk gambar --}}
                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center gallery-overlay">
                                    <i class="bi bi-zoom-in text-white" style="font-size: 3rem;"></i>
                                </div>
                            
                            @elseif ($isVideo && $gallery->video)
                                <video 
                                    preload="metadata"
                                    class="w-100 h-100"
                                    style="object-fit: contain; background: #000;"
                                    playsinline
                                >
                                    <source src="{{ Storage::url($videoPath) }}" type="video/mp4">
                                </video>
                                
                                {{-- Play button overlay --}}
                                <div class="position-absolute top-50 start-50 translate-middle" style="display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-play-circle-fill text-white" style="font-size: 4rem; opacity: 0.9; text-shadow: 0 2px 8px rgba(0,0,0,0.5);"></i>
                                </div>
                            
                            @else
                                <div class="d-flex justify-content-center align-items-center w-100 h-100 bg-light">
                                    <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">{{ $gallery->title }}</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <small class="text-muted">
                                    <i class="bi bi-calendar3"></i>
                                    {{ $gallery->created_at->format('d M Y') }}
                                </small>
                                
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
                </div>

                {{-- Modal untuk preview full --}}
                <div class="modal fade" id="modal{{ $gallery->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $gallery->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                @if ($isImage && $gallery->image)
                                    <img 
                                        src="{{ Storage::url($imagePath) }}" 
                                        alt="{{ $gallery->title }}"
                                        class="w-100"
                                        style="object-fit: contain; max-height: 80vh;"
                                    >
                                @elseif ($isVideo && $gallery->video)
                                    <video 
                                        controls
                                        class="w-100"
                                        style="background: #000; max-height: 80vh;"
                                        playsinline
                                    >
                                        <source src="{{ Storage::url($videoPath) }}" type="video/mp4">
                                        Browser Anda tidak mendukung video ini.
                                    </video>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <small class="text-muted me-auto">
                                    <i class="bi bi-calendar3"></i>
                                    {{ $gallery->created_at->format('d F Y, H:i') }}
                                </small>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $galleries->links() }}
            </div>

        @else
            <div class="text-center py-5">
                <i class="bi bi-images" style="font-size: 5rem; color: #cbd5e1;"></i>
                <h3 class="mt-4 text-muted">Galeri Belum Tersedia</h3>
                <p class="text-muted">Galeri akan segera diisi dengan dokumentasi kegiatan masjid</p>
            </div>
        @endif
    </div>
</section>

{{-- Custom Styles --}}
<style>
.gallery-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.gallery-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.gallery-img {
    transition: transform 0.3s ease;
}

.gallery-card:hover .gallery-img {
    transform: scale(1.05);
}

.gallery-overlay {
    background: rgba(0,0,0,0.5);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-card:hover .gallery-overlay {
    opacity: 1;
}

.modal-content {
    border-radius: 1rem;
    overflow: hidden;
}
</style>
@endsection