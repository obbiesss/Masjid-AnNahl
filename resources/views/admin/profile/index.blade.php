@extends('admin.layouts.app')

@section('title', 'Kelola Profil Masjid')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Kelola Profil Masjid</h2>
    <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary rounded-3 px-4">
        <i class="bi bi-pencil-square me-1"></i> Edit Profil
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <div class="d-flex align-items-center">
        <i class="bi bi-check-circle-fill me-2"></i>
        <div>{{ session('success') }}</div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row g-4">
    <!-- Informasi Utama -->
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white border-0">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 p-2 rounded-circle me-3">
                        <i class="bi bi-info-circle-fill" style="font-size: 1.2rem;"></i>
                    </div>
                    <h5 class="mb-0">Informasi Umum</h5>
                </div>
            </div>
            <div class="card-body p-4">
                @if($profile)
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="bg-light rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-1">Kapasitas Jamaah</small>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-people text-primary me-2"></i>
                                    <h6 class="mb-0">{{ $profile->capacity ?? 'Belum diisi' }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-1">Tahun Berdiri</small>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-calendar text-primary me-2"></i>
                                    <h6 class="mb-0">{{ $profile->year ?? 'Belum diisi' }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted d-block mb-1">Kegiatan Rutin</small>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-activity text-primary me-2"></i>
                                    <h6 class="mb-0">{{ $profile->routine_activities ?? 'Belum diisi' }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted d-block mb-1">Informasi Publik</small>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-info-square text-primary me-2"></i>
                                    <h6 class="mb-0">{{ $profile->public_info ?? 'Belum diisi' }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted d-block mb-1">WhatsApp</small>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-whatsapp text-success me-2"></i>
                                    <h6 class="mb-0">{{ $profile->whatsapp ?? 'Belum diisi' }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="bg-light rounded-circle p-4 d-inline-block mb-3">
                            <i class="bi bi-building text-muted" style="font-size: 2rem;"></i>
                        </div>
                        <h5 class="text-muted">Profil Masjid Belum Diisi</h5>
                        <p class="text-muted mb-4">Klik tombol "Edit Profil" untuk mengisi data pertama</p>
                        <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">
                            <i class="bi bi-pencil-square me-1"></i> Mulai Isi Profil
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tentang Masjid -->
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-success text-white border-0">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 p-2 rounded-circle me-3">
                        <i class="bi bi-building" style="font-size: 1.2rem;"></i>
                    </div>
                    <h5 class="mb-0">Tentang Masjid</h5>
                </div>
            </div>
            <div class="card-body p-4">
                @if($profile && $profile->about_text_1)
                    <div class="mb-4">
                        <small class="text-muted d-block mb-2">Deskripsi Utama</small>
                        <div class="bg-light rounded-3 p-3">
                            <p class="mb-0" style="text-align: justify; line-height: 1.6;">{{ $profile->about_text_1 }}</p>
                        </div>
                    </div>
                    @if($profile->about_text_2)
                    <div>
                        <small class="text-muted d-block mb-2">Deskripsi Tambahan</small>
                        <div class="bg-light rounded-3 p-3">
                            <p class="mb-0" style="text-align: justify; line-height: 1.6;">{{ $profile->about_text_2 }}</p>
                        </div>
                    </div>
                    @endif
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-file-text text-muted" style="font-size: 2rem;"></i>
                        <p class="text-muted mt-2 mb-0">Deskripsi masjid belum diisi</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Visi & Misi -->
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-warning text-dark border-0">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 p-2 rounded-circle me-3">
                        <i class="bi bi-bullseye" style="font-size: 1.2rem;"></i>
                    </div>
                    <h5 class="mb-0">Visi & Misi</h5>
                </div>
            </div>
            <div class="card-body p-4">
                @if($profile)
                    <div class="mb-4">
                        <small class="text-muted d-block mb-2">Visi</small>
                        <div class="bg-light rounded-3 p-3">
                            <p class="mb-0" style="text-align: justify; line-height: 1.6; white-space: pre-line;">
                                {{ $profile->visi ? $profile->visi : 'Belum diisi' }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted d-block mb-2">Misi</small>
                        <div class="bg-light rounded-3 p-3">
                            <p class="mb-0" style="text-align: justify; line-height: 1.6; white-space: pre-line;">
                                {{ $profile->misi ? $profile->misi : 'Belum diisi' }}
                            </p>
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-bullseye text-muted" style="font-size: 2rem;"></i>
                        <p class="text-muted mt-2 mb-0">Visi dan misi belum diisi</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Lokasi & Maps -->
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-danger text-white border-0">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 p-2 rounded-circle me-3">
                        <i class="bi bi-geo-alt-fill" style="font-size: 1.2rem;"></i>
                    </div>
                    <h5 class="mb-0">Lokasi & Maps</h5>
                </div>
            </div>
            <div class="card-body p-4">
                @if($profile)
                    <div class="mb-4">
                        <small class="text-muted d-block mb-2">Alamat</small>
                        <div class="bg-light rounded-3 p-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-geo-alt text-danger me-2 mt-1"></i>
                                <p class="mb-0">{{ $profile->address ?? 'Belum diisi' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <small class="text-muted d-block mb-2">Jam Operasional</small>
                        <div class="bg-light rounded-3 p-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-clock text-danger me-2 mt-1"></i>
                                <p class="mb-0" style="white-space: pre-line;">{{ $profile->operating_hours ? $profile->operating_hours : 'Belum diisi' }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted d-block mb-2">Google Maps URL</small>
                        <div class="bg-light rounded-3 p-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-link-45deg text-danger me-2"></i>
                                @if($profile->maps_url)
                                    <a href="{{ $profile->maps_url }}" target="_blank" class="text-decoration-none">
                                        {{ Str::limit($profile->maps_url, 50) }}
                                    </a>
                                @else
                                    <span class="text-muted">Belum diisi</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-geo-alt text-muted" style="font-size: 2rem;"></i>
                        <p class="text-muted mt-2 mb-0">Informasi lokasi belum diisi</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Gambar Masjid -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-info text-white border-0">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 p-2 rounded-circle me-3">
                        <i class="bi bi-image" style="font-size: 1.2rem;"></i>
                    </div>
                    <h5 class="mb-0">Gambar Masjid</h5>
                </div>
            </div>
            <div class="card-body p-4 text-center">
                @if($profile && $profile->about_image)
                    <img src="{{ asset('storage/' . $profile->about_image) }}" 
                         class="img-fluid rounded-3" 
                         alt="Gambar Masjid"
                         style="max-height: 250px; object-fit: cover; width: 100%;">
                    <p class="text-muted mt-3 mb-0">
                        <i class="bi bi-check-circle-fill text-success me-1"></i>
                        Gambar tersedia
                    </p>
                @else
                    <div class="py-4">
                        <div class="bg-light rounded-circle p-4 d-inline-block mb-3">
                            <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                        </div>
                        <p class="text-muted mb-0">Belum ada gambar</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Fasilitas -->
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-purple text-white border-0">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 p-2 rounded-circle me-3">
                        <i class="bi bi-list-check" style="font-size: 1.2rem;"></i>
                    </div>
                    <h5 class="mb-0">Fasilitas</h5>
                </div>
            </div>
            <div class="card-body p-4">
                @if($profile && $profile->facilities)
                    <div class="row g-3">
                        @foreach($profile->facilities as $facility)
                            <div class="col-12">
                                <div class="bg-light rounded-3 p-3">
                                    <div class="d-flex align-items-start">
                                        <!-- Icon dari data yang dipilih -->
                                        <div class="bg-purple bg-opacity-10 p-2 rounded-circle me-3">
                                            <i class="{{ $facility['icon'] ?? 'bi-building' }} text-purple" style="font-size: 1.2rem;"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">{{ $facility['name'] }}</h6>
                                            <small class="text-muted">{{ $facility['description'] }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <div class="bg-light rounded-circle p-4 d-inline-block mb-3">
                            <i class="bi bi-list-check text-muted" style="font-size: 2rem;"></i>
                        </div>
                        <p class="text-muted mb-0">Belum ada fasilitas</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Action Card -->
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-body p-4 text-center">
                <div class="bg-primary bg-opacity-10 rounded-3 p-4 mb-4">
                    <i class="bi bi-building text-primary" style="font-size: 2.5rem;"></i>
                </div>
                <h5>Perbarui Profil Masjid</h5>
                <p class="text-muted mb-4">Kelola semua informasi profil masjid dengan mudah</p>
                <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary rounded-3 px-4">
                    <i class="bi bi-pencil-square me-1"></i> Edit Profil
                </a>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --purple: #6f42c1;
}

.bg-purple {
    background-color: var(--purple) !important;
}

.text-purple {
    color: var(--purple) !important;
}

.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.card-header {
    border-radius: 0.75rem 0.75rem 0 0 !important;
    padding: 1rem 1.5rem !important;
}

.bg-light {
    background-color: #f8f9fa !important;
}

.rounded-3 {
    border-radius: 0.75rem !important;
}

.btn-primary {
    padding: 0.5rem 1.5rem;
    font-weight: 500;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
}

/* Tambahan untuk icon fasilitas */
.bg-purple.bg-opacity-10 {
    background-color: rgba(111, 66, 193, 0.1) !important;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
@endsection