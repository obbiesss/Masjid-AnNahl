@extends('admin.layouts.app')

@section('title', 'Edit Profil Masjid')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Edit Profil Masjid</h2>
    <a href="{{ route('admin.profile.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
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

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <div class="d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <div>Terdapat kesalahan dalam pengisian form. Silakan periksa kembali.</div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Tentang Masjid -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                        <i class="bi bi-building text-primary" style="font-size: 1.2rem;"></i>
                    </div>
                    <h5 class="mb-0 text-primary">Tentang Masjid</h5>
                </div>
                
                <div class="mb-4">
                    <label for="about_image" class="form-label fw-medium">Gambar Tentang Masjid</label>
                    <input type="file" 
                           name="about_image" 
                           id="about_image"
                           class="form-control @error('about_image') is-invalid @enderror" 
                           accept="image/*">
                    @error('about_image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Format: JPG, JPEG, PNG. Maksimal 2MB.</div>
                    
                    @if(!empty($profile->about_image))
                        <div class="mt-3">
                            <p class="text-muted mb-2">Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $profile->about_image) }}" 
                                 class="rounded-3 border" 
                                 style="width: 200px; height: 150px; object-fit: cover;"
                                 alt="Gambar Masjid">
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="about_text_1" class="form-label fw-medium">
                        Deskripsi Tentang Masjid (Bagian 1) 
                        <span class="text-danger">*</span>
                    </label>
                    <textarea name="about_text_1" 
                              id="about_text_1"
                              class="form-control @error('about_text_1') is-invalid @enderror" 
                              rows="4" 
                              placeholder="Tuliskan deskripsi tentang masjid..."
                              required>{{ old('about_text_1', $profile->about_text_1 ?? '') }}</textarea>
                    @error('about_text_1')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="about_text_2" class="form-label fw-medium">Deskripsi Tentang Masjid (Bagian 2)</label>
                    <textarea name="about_text_2" 
                              id="about_text_2"
                              class="form-control @error('about_text_2') is-invalid @enderror" 
                              rows="4" 
                              placeholder="Tuliskan deskripsi tambahan tentang masjid...">{{ old('about_text_2', $profile->about_text_2 ?? '') }}</textarea>
                    @error('about_text_2')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Divider -->
            <div class="border-top my-5"></div>

            <!-- Visi & Misi -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                        <i class="bi bi-bullseye text-success" style="font-size: 1.2rem;"></i>
                    </div>
                    <h5 class="mb-0 text-success">Visi & Misi</h5>
                </div>
                
                <div class="mb-4">
                    <label for="visi" class="form-label fw-medium">
                        Visi Masjid 
                        <span class="text-danger">*</span>
                    </label>
                    <textarea name="visi" 
                              id="visi"
                              class="form-control @error('visi') is-invalid @enderror" 
                              rows="3" 
                              placeholder="Tuliskan visi masjid..."
                              required>{{ old('visi', $profile->visi ?? '') }}</textarea>
                    @error('visi')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Gunakan enter untuk membuat paragraf baru</div>
                </div>

                <div class="mb-4">
                    <label for="misi" class="form-label fw-medium">
                        Misi Masjid 
                        <span class="text-danger">*</span>
                    </label>
                    <textarea name="misi" 
                              id="misi"
                              class="form-control @error('misi') is-invalid @enderror" 
                              rows="3" 
                              placeholder="Tuliskan misi masjid..."
                              required>{{ old('misi', $profile->misi ?? '') }}</textarea>
                    @error('misi')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Gunakan enter untuk membuat poin-poin misi</div>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-top my-5"></div>

            <!-- Statistik Masjid -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-warning bg-opacity-10 p-2 rounded-circle me-3">
                        <i class="bi bi-graph-up text-warning" style="font-size: 1.2rem;"></i>
                    </div>
                    <h5 class="mb-0 text-warning">Statistik Masjid</h5>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="capacity" class="form-label fw-medium">
                            Kapasitas Jamaah 
                            <span class="text-danger">*</span>
                        </label>
                        <input type="number" 
                               name="capacity" 
                               id="capacity"
                               class="form-control @error('capacity') is-invalid @enderror" 
                               value="{{ old('capacity', $profile->capacity ?? '') }}" 
                               placeholder="Contoh: 500"
                               required>
                        @error('capacity')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="year" class="form-label fw-medium">
                            Tahun Berdiri 
                            <span class="text-danger">*</span>
                        </label>
                        <input type="number" 
                               name="year" 
                               id="year"
                               class="form-control @error('year') is-invalid @enderror" 
                               value="{{ old('year', $profile->year ?? '') }}" 
                               placeholder="Contoh: 1990"
                               required>
                        @error('year')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label for="routine_activities" class="form-label fw-medium">
                        Kegiatan Rutin 
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           name="routine_activities" 
                           id="routine_activities"
                           class="form-control @error('routine_activities') is-invalid @enderror" 
                           value="{{ old('routine_activities', $profile->routine_activities ?? '') }}" 
                           placeholder="Contoh: Pengajian Mingguan, TPQ, dll"
                           required>
                    @error('routine_activities')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="public_info" class="form-label fw-medium">
                        Informasi Publik 
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           name="public_info" 
                           id="public_info"
                           class="form-control @error('public_info') is-invalid @enderror" 
                           value="{{ old('public_info', $profile->public_info ?? '') }}" 
                           placeholder="Contoh: Terbuka untuk umum"
                           required>
                    @error('public_info')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Divider -->
            <div class="border-top my-5"></div>

            <!-- Kontak -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-info bg-opacity-10 p-2 rounded-circle me-3">
                        <i class="bi bi-telephone text-info" style="font-size: 1.2rem;"></i>
                    </div>
                    <h5 class="mb-0 text-info">Kontak</h5>
                </div>
                
                <div>
                    <label for="whatsapp" class="form-label fw-medium">
                        Nomor WhatsApp 
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           name="whatsapp" 
                           id="whatsapp"
                           class="form-control @error('whatsapp') is-invalid @enderror" 
                           value="{{ old('whatsapp', $profile->whatsapp ?? '') }}" 
                           placeholder="Contoh: 6281234567890"
                           required>
                    @error('whatsapp')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Masukkan nomor tanpa tanda + atau spasi</div>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-top my-5"></div>

            <!-- Lokasi & Maps -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-danger bg-opacity-10 p-2 rounded-circle me-3">
                        <i class="bi bi-geo-alt text-danger" style="font-size: 1.2rem;"></i>
                    </div>
                    <h5 class="mb-0 text-danger">Lokasi & Maps</h5>
                </div>
                
                <div class="mb-4">
                    <label for="address" class="form-label fw-medium">
                        Alamat Lengkap 
                        <span class="text-danger">*</span>
                    </label>
                    <textarea name="address" 
                              id="address"
                              class="form-control @error('address') is-invalid @enderror" 
                              rows="3" 
                              placeholder="Tuliskan alamat lengkap masjid..."
                              required>{{ old('address', $profile->address ?? '') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="operating_hours" class="form-label fw-medium">
                        Jam Operasional 
                        <span class="text-danger">*</span>
                    </label>
                    <textarea name="operating_hours" 
                              id="operating_hours"
                              class="form-control @error('operating_hours') is-invalid @enderror" 
                              rows="2" 
                              placeholder="Contoh: Buka 24 Jam untuk Shalat&#10;Administrasi: 08.00 - 17.00 WIB"
                              required>{{ old('operating_hours', $profile->operating_hours ?? '') }}</textarea>
                    @error('operating_hours')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Gunakan enter untuk baris baru</div>
                </div>

                <div class="mb-4">
                    <label for="maps_embed" class="form-label fw-medium">
                        Embed Google Maps 
                        <span class="text-danger">*</span>
                    </label>
                    <textarea name="maps_embed" 
                              id="maps_embed"
                              class="form-control @error('maps_embed') is-invalid @enderror" 
                              rows="4" 
                              placeholder="Paste kode embed Google Maps di sini..."
                              required>{{ old('maps_embed', $profile->maps_embed ?? '') }}</textarea>
                    @error('maps_embed')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        Cara mendapatkan embed code:<br>
                        1. Buka Google Maps<br>
                        2. Cari lokasi masjid<br>
                        3. Klik "Share" → "Embed a map"<br>
                        4. Copy kode iframe dan paste di sini
                    </div>
                </div>

                <div>
                    <label for="maps_url" class="form-label fw-medium">
                        Google Maps URL 
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           name="maps_url" 
                           id="maps_url"
                           class="form-control @error('maps_url') is-invalid @enderror" 
                           value="{{ old('maps_url', $profile->maps_url ?? '') }}" 
                           placeholder="https://maps.google.com/?q=Alamat+Masjid"
                           required>
                    @error('maps_url')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Link untuk tombol "Buka di Google Maps"</div>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-top my-5"></div>

            <!-- Fasilitas -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-purple bg-opacity-10 p-2 rounded-circle me-3">
                        <i class="bi bi-building text-purple" style="font-size: 1.2rem;"></i>
                    </div>
                    <h5 class="mb-0 text-purple">Fasilitas</h5>
                </div>
                
                <div id="facilities-container">
                    @php
                        $facilities = $profile->facilities ?? [
                            ['name' => 'Ruang Shalat', 'icon' => 'bi-building', 'description' => 'Ruang shalat utama yang luas dan nyaman'],
                            ['name' => 'Tempat Wudhu', 'icon' => 'bi-droplet', 'description' => 'Fasilitas tempat wudhu yang bersih dan memadai'],
                            ['name' => 'Toilet', 'icon' => 'bi-door-open', 'description' => 'Toilet bersih dan terawat untuk kenyamanan jamaah'],
                            ['name' => 'Ruang Serbaguna', 'icon' => 'bi-grid-3x3', 'description' => 'Ruangan untuk kajian, diskusi, dan kegiatan keislaman'],
                            ['name' => 'Ruang DKM', 'icon' => 'bi-people', 'description' => 'Ruang khusus untuk pengurus DKM dalam mengelola masjid'],
                            ['name' => 'Area Parkir', 'icon' => 'bi-car-front', 'description' => 'Area parkir yang luas dan aman untuk kendaraan jamaah']
                        ];
                    @endphp
                    
                    @foreach($facilities as $index => $facility)
                    <div class="facility-item border rounded-3 p-4 mb-3 bg-light">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-medium">
                                    Nama Fasilitas 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="facility_name[]" 
                                       class="form-control" 
                                       value="{{ $facility['name'] }}" 
                                       placeholder="Contoh: Ruang Shalat"
                                       required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-medium">
                                    Icon 
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="facility_icon[]" class="form-select" required>
                                    <option value="bi-building" {{ $facility['icon'] == 'bi-building' ? 'selected' : '' }}>Gedung</option>
                                    <option value="bi-droplet" {{ $facility['icon'] == 'bi-droplet' ? 'selected' : '' }}>Air Wudhu</option>
                                    <option value="bi-door-open" {{ $facility['icon'] == 'bi-door-open' ? 'selected' : '' }}>Toilet</option>
                                    <option value="bi-grid-3x3" {{ $facility['icon'] == 'bi-grid-3x3' ? 'selected' : '' }}>Ruang</option>
                                    <option value="bi-people" {{ $facility['icon'] == 'bi-people' ? 'selected' : '' }}>Orang</option>
                                    <option value="bi-car-front" {{ $facility['icon'] == 'bi-car-front' ? 'selected' : '' }}>Parkir</option>
                                    <option value="bi-book" {{ $facility['icon'] == 'bi-book' ? 'selected' : '' }}>Buku</option>
                                    <option value="bi-mic" {{ $facility['icon'] == 'bi-mic' ? 'selected' : '' }}>Sound System</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-medium">
                                    Deskripsi 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="facility_description[]" 
                                       class="form-control" 
                                       value="{{ $facility['description'] }}" 
                                       placeholder="Deskripsi singkat"
                                       required>
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-outline-danger remove-facility w-100 h-100 d-flex align-items-center justify-content-center rounded-3" 
                                        {{ $index == 0 ? 'disabled' : '' }}>
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <button type="button" id="add-facility" class="btn btn-outline-primary mt-3 rounded-3">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Fasilitas
                </button>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end gap-3 pt-4 border-top">
                <a href="{{ route('admin.profile.index') }}" class="btn btn-outline-secondary rounded-3 px-4">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary rounded-3 px-4">
                    <i class="bi bi-check-circle me-1"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript untuk fasilitas -->
<script>
document.getElementById('add-facility').addEventListener('click', function() {
    const container = document.getElementById('facilities-container');
    const newItem = document.createElement('div');
    newItem.className = 'facility-item border rounded-3 p-4 mb-3 bg-light';
    newItem.innerHTML = `
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-medium">Nama Fasilitas <span class="text-danger">*</span></label>
                <input type="text" name="facility_name[]" class="form-control" placeholder="Contoh: Ruang Shalat" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Icon <span class="text-danger">*</span></label>
                <select name="facility_icon[]" class="form-select" required>
                    <option value="bi-building">Gedung</option>
                    <option value="bi-droplet">Air Wudhu</option>
                    <option value="bi-door-open">Toilet</option>
                    <option value="bi-grid-3x3">Ruang</option>
                    <option value="bi-people">Orang</option>
                    <option value="bi-car-front">Parkir</option>
                    <option value="bi-book">Buku</option>
                    <option value="bi-mic">Sound System</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Deskripsi <span class="text-danger">*</span></label>
                <input type="text" name="facility_description[]" class="form-control" placeholder="Deskripsi singkat" required>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-outline-danger remove-facility w-100 h-100 d-flex align-items-center justify-content-center rounded-3">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    container.appendChild(newItem);
});

// Remove facility
document.addEventListener('click', function(e) {
    const removeBtn = e.target.closest('.remove-facility');
    if (removeBtn && !removeBtn.disabled) {
        const facilityItem = removeBtn.closest('.facility-item');
        if (facilityItem) {
            facilityItem.remove();
        }
    }
});
</script>

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

/* CSS lainnya yang sudah ada di index.blade.php */
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