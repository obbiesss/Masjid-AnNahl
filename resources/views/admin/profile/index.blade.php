@extends('admin.layouts.app')

@section('title', 'Kelola Profil Masjid')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Kelola Profil Masjid</h2>
    <a href="{{ route('admin.profile.edit') }}" class="btn btn-success">
        <i class="bi bi-pencil-square"></i> Edit Profil
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <!-- Informasi Utama -->
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-info-circle me-2"></i>Informasi Umum
                </h5>
            </div>
            <div class="card-body">
                @if($profile)
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Kapasitas Jamaah:</strong>
                            <p class="mb-0">{{ $profile->capacity ?? 'Belum diisi' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Tahun Berdiri:</strong>
                            <p class="mb-0">{{ $profile->year ?? 'Belum diisi' }}</p>
                        </div>
                        <div class="col-12 mb-3">
                            <strong>Kegiatan Rutin:</strong>
                            <p class="mb-0">{{ $profile->routine_activities ?? 'Belum diisi' }}</p>
                        </div>
                        <div class="col-12 mb-3">
                            <strong>Informasi Publik:</strong>
                            <p class="mb-0">{{ $profile->public_info ?? 'Belum diisi' }}</p>
                        </div>
                        <div class="col-12 mb-3">
                            <strong>WhatsApp:</strong>
                            <p class="mb-0">{{ $profile->whatsapp ?? 'Belum diisi' }}</p>
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-building display-4 text-muted"></i>
                        <h5 class="mt-3 text-muted">Profil Masjid Belum Diisi</h5>
                        <p class="text-muted">Klik tombol "Edit Profil" untuk mengisi data pertama</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tentang Masjid -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-building me-2"></i>Tentang Masjid
                </h5>
            </div>
            <div class="card-body">
                @if($profile && $profile->about_text_1)
                    <div class="mb-3">
                        <strong>Deskripsi 1:</strong>
                        <p class="mb-0 visi-misi-text">{{ $profile->about_text_1 }}</p>
                    </div>
                    @if($profile->about_text_2)
                    <div class="mb-3">
                        <strong>Deskripsi 2:</strong>
                        <p class="mb-0 visi-misi-text">{{ $profile->about_text_2 }}</p>
                    </div>
                    @endif
                @else
                    <p class="text-muted mb-0">Deskripsi masjid belum diisi</p>
                @endif
            </div>
        </div>

        <!-- Visi & Misi -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-bullseye me-2"></i>Visi & Misi
                </h5>
            </div>
            <div class="card-body">
                @if($profile)
                    <div class="mb-4">
                        <strong>Visi:</strong>
                        <p class="mb-0 visi-misi-text">{{ $profile->visi ? $profile->visi : 'Belum diisi' }}</p>
                    </div>
                    <div class="mb-0">
                        <strong>Misi:</strong>
                        <p class="mb-0 visi-misi-text">{{ $profile->misi ? $profile->misi : 'Belum diisi' }}</p>
                    </div>
                @else
                    <p class="text-muted mb-0">Visi dan misi belum diisi</p>
                @endif
            </div>
        </div>

        <!-- Lokasi & Maps -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-geo-alt me-2"></i>Lokasi & Maps
                </h5>
            </div>
            <div class="card-body">
                @if($profile)
                    <div class="mb-3">
                        <strong>Alamat:</strong>
                        <p class="mb-0">{{ $profile->address ?? 'Belum diisi' }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Jam Operasional:</strong>
                        <p class="mb-0 visi-misi-text">{{ $profile->operating_hours ? $profile->operating_hours : 'Belum diisi' }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Google Maps URL:</strong>
                        <p class="mb-0">
                            @if($profile->maps_url)
                                <a href="{{ $profile->maps_url }}" target="_blank" class="text-decoration-none">
                                    {{ $profile->maps_url }}
                                </a>
                            @else
                                Belum diisi
                            @endif
                        </p>
                    </div>
                @else
                    <p class="text-muted mb-0">Informasi lokasi belum diisi</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Gambar Masjid -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-image me-2"></i>Gambar Masjid
                </h5>
            </div>
            <div class="card-body text-center">
                @if($profile && $profile->about_image)
                    <img src="{{ asset('storage/' . $profile->about_image) }}" 
                         class="img-fluid rounded" 
                         alt="Gambar Masjid"
                         style="max-height: 200px; object-fit: cover;">
                    <p class="text-muted mt-2 mb-0">Gambar saat ini</p>
                @else
                    <div class="py-4">
                        <i class="bi bi-image display-4 text-muted"></i>
                        <p class="text-muted mt-2 mb-0">Belum ada gambar</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Fasilitas -->
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-list-check me-2"></i>Fasilitas
                </h5>
            </div>
            <div class="card-body">
                @if($profile && $profile->facilities)
                    <div class="list-group list-group-flush">
                        @foreach($profile->facilities as $facility)
                            <div class="list-group-item d-flex align-items-center px-0">
                                <i class="{{ $facility['icon'] ?? 'bi-building' }} text-success me-3"></i>
                                <div>
                                    <strong class="d-block">{{ $facility['name'] }}</strong>
                                    <small class="text-muted">{{ $facility['description'] }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted mb-0">Belum ada fasilitas yang ditambahkan</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="card mt-4">
    <div class="card-body text-center">
        <a href="{{ route('admin.profile.edit') }}" class="btn btn-success btn-lg">
            <i class="bi bi-pencil-square me-2"></i>Edit Profil Masjid
        </a>
        <p class="text-muted mt-2 mb-0">Kelola semua informasi profil masjid di sini</p>
    </div>
</div>

<style>
.visi-misi-text {
    white-space: pre-line;
    line-height: 1.6;
    text-align: justify;
}
</style>
@endsection