@extends('admin.layouts.app')

@section('title', 'Kelola Galeri')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Kelola Galeri</h2>
    <a href="{{ route('admin.galleries.create') }}" class="btn btn-warning">
        <i class="bi bi-plus-circle"></i> Tambah Galeri
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($galleries->count() > 0)
            <div class="row g-3">

                @foreach($galleries as $gallery)
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 h-100">

                        @php
                            $media = $gallery->image ?? $gallery->video;
                            $ext = strtolower(pathinfo($media, PATHINFO_EXTENSION));

                            $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                            $isVideo = in_array($ext, ['mp4','mov','avi','mkv','webm']);
                            
                            // Fix untuk path video yang tidak lengkap
                            $videoPath = $gallery->video;
                            if ($videoPath && !str_contains($videoPath, '/')) {
                                // Jika hanya nama file tanpa folder, tambahkan path default
                                $videoPath = 'galleries/videos/' . $videoPath;
                            }
                        @endphp

                        <div class="ratio ratio-16x9 position-relative" style="background: #f8f9fa; overflow:hidden; border-radius: .5rem .5rem 0 0;">
                            @if ($isImage && $gallery->image)
                                <img 
                                    src="{{ Storage::url($gallery->image) }}" 
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
                            <h6 class="card-title text-truncate" title="{{ $gallery->title }}">
                                {{ $gallery->title }}
                            </h6>
                            <small class="text-muted">
                                <i class="bi bi-calendar3"></i>
                                {{ $gallery->created_at->format('d M Y') }}
                            </small>
                            
                            @if($isVideo)
                                <div class="mt-2">
                                    <span class="badge bg-primary">
                                        <i class="bi bi-camera-video"></i> Video
                                    </span>
                                </div>
                            @elseif($isImage)
                                <div class="mt-2">
                                    <span class="badge bg-success">
                                        <i class="bi bi-image"></i> Foto
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="card-footer bg-white border-top">
                            <div class="d-flex gap-2 justify-content-center">
                                <a 
                                    href="{{ route('admin.galleries.edit', $gallery->id) }}" 
                                    class="btn btn-sm btn-warning w-50"
                                >
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <form 
                                    action="{{ route('admin.galleries.destroy', $gallery->id) }}" 
                                    method="POST" 
                                    class="w-50"
                                    onsubmit="return confirm('Yakin ingin menghapus galeri ini?')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach

            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $galleries->links() }}
            </div>

        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: #cbd5e1;"></i>
                <h5 class="mt-3 text-muted">Belum Ada Galeri</h5>
                <p class="text-muted">Klik tombol "Tambah Galeri" untuk menambah foto pertama</p>
                <a href="{{ route('admin.galleries.create') }}" class="btn btn-warning mt-2">
                    <i class="bi bi-plus-circle"></i> Tambah Galeri
                </a>
            </div>
        @endif
    </div>
</div>

{{-- Optional: Add custom styles for better video display --}}
<style>
    video {
        background-color: #000;
    }
    
    .card:hover {
        transform: translateY(-5px);
        transition: transform 0.2s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
    }
</style>
@endsection