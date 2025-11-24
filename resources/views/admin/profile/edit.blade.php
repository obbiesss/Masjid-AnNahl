@extends('admin.layouts.app')

@section('title', 'Edit Profil Masjid')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Edit Profil Masjid</h2>
    <a href="{{ route('admin.profile.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Profil
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        Terdapat kesalahan dalam pengisian form. Silakan periksa kembali.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Tentang Masjid -->
            <div class="mb-5">
                <h5 class="card-title mb-4 border-bottom pb-3 text-success">
                    <i class="bi bi-building me-2"></i>Tentang Masjid
                </h5>
                
                <div class="mb-4">
                    <label for="about_image" class="form-label">Gambar Tentang Masjid</label>
                    <input type="file" 
                           name="about_image" 
                           id="about_image"
                           class="form-control @error('about_image') is-invalid @enderror" 
                           accept="image/*">
                    @error('about_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Format: JPG, JPEG, PNG. Maksimal 2MB.</div>
                    
                    @if(!empty($profile->about_image))
                        <div class="mt-3">
                            <p class="text-muted mb-2">Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $profile->about_image) }}" 
                                 class="rounded border" 
                                 style="width: 200px; height: 150px; object-fit: cover;"
                                 alt="Gambar Masjid">
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="about_text_1" class="form-label">Deskripsi Tentang Masjid (Bagian 1) <span class="text-danger">*</span></label>
                    <textarea name="about_text_1" 
                              id="about_text_1"
                              class="form-control @error('about_text_1') is-invalid @enderror" 
                              rows="4" 
                              placeholder="Tuliskan deskripsi tentang masjid..."
                              required>{{ old('about_text_1', $profile->about_text_1 ?? '') }}</textarea>
                    @error('about_text_1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="about_text_2" class="form-label">Deskripsi Tentang Masjid (Bagian 2)</label>
                    <textarea name="about_text_2" 
                              id="about_text_2"
                              class="form-control @error('about_text_2') is-invalid @enderror" 
                              rows="4" 
                              placeholder="Tuliskan deskripsi tambahan tentang masjid...">{{ old('about_text_2', $profile->about_text_2 ?? '') }}</textarea>
                    @error('about_text_2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr>

            <!-- Visi & Misi -->
            <div class="mb-5">
                <h5 class="card-title mb-4 border-bottom pb-3 text-success">
                    <i class="bi bi-bullseye me-2"></i>Visi & Misi
                </h5>
                
                <div class="mb-4">
                    <label for="visi" class="form-label">Visi Masjid <span class="text-danger">*</span></label>
                    <textarea name="visi" 
                              id="visi"
                              class="form-control @error('visi') is-invalid @enderror" 
                              rows="3" 
                              placeholder="Tuliskan visi masjid..."
                              required>{{ old('visi', $profile->visi ?? '') }}</textarea>
                    @error('visi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Gunakan enter untuk membuat paragraf baru</div>
                </div>

                <div class="mb-4">
                    <label for="misi" class="form-label">Misi Masjid <span class="text-danger">*</span></label>
                    <textarea name="misi" 
                              id="misi"
                              class="form-control @error('misi') is-invalid @enderror" 
                              rows="3" 
                              placeholder="Tuliskan misi masjid..."
                              required>{{ old('misi', $profile->misi ?? '') }}</textarea>
                    @error('misi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Gunakan enter untuk membuat poin-poin misi</div>
                </div>
            </div>

            <hr>

            <!-- Statistik Masjid -->
            <div class="mb-5">
                <h5 class="card-title mb-4 border-bottom pb-3 text-success">
                    <i class="bi bi-graph-up me-2"></i>Statistik Masjid
                </h5>
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="capacity" class="form-label">Kapasitas Jamaah <span class="text-danger">*</span></label>
                        <input type="number" 
                               name="capacity" 
                               id="capacity"
                               class="form-control @error('capacity') is-invalid @enderror" 
                               value="{{ old('capacity', $profile->capacity ?? '') }}" 
                               placeholder="Contoh: 500"
                               required>
                        @error('capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label for="year" class="form-label">Tahun Berdiri <span class="text-danger">*</span></label>
                        <input type="number" 
                               name="year" 
                               id="year"
                               class="form-control @error('year') is-invalid @enderror" 
                               value="{{ old('year', $profile->year ?? '') }}" 
                               placeholder="Contoh: 1990"
                               required>
                        @error('year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="routine_activities" class="form-label">Kegiatan Rutin <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="routine_activities" 
                           id="routine_activities"
                           class="form-control @error('routine_activities') is-invalid @enderror" 
                           value="{{ old('routine_activities', $profile->routine_activities ?? '') }}" 
                           placeholder="Contoh: Pengajian Mingguan, TPQ, dll"
                           required>
                    @error('routine_activities')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="public_info" class="form-label">Informasi Publik <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="public_info" 
                           id="public_info"
                           class="form-control @error('public_info') is-invalid @enderror" 
                           value="{{ old('public_info', $profile->public_info ?? '') }}" 
                           placeholder="Contoh: Terbuka untuk umum"
                           required>
                    @error('public_info')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr>

            <!-- Kontak -->
            <div class="mb-5">
                <h5 class="card-title mb-4 border-bottom pb-3 text-success">
                    <i class="bi bi-telephone me-2"></i>Kontak
                </h5>
                
                <div class="mb-4">
                    <label for="whatsapp" class="form-label">Nomor WhatsApp <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="whatsapp" 
                           id="whatsapp"
                           class="form-control @error('whatsapp') is-invalid @enderror" 
                           value="{{ old('whatsapp', $profile->whatsapp ?? '') }}" 
                           placeholder="Contoh: 6281234567890"
                           required>
                    @error('whatsapp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Masukkan nomor tanpa tanda + atau spasi</div>
                </div>
            </div>

            <hr>

            <!-- Lokasi & Maps -->
            <div class="mb-5">
                <h5 class="card-title mb-4 border-bottom pb-3 text-success">
                    <i class="bi bi-geo-alt me-2"></i>Lokasi & Maps
                </h5>
                
                <div class="mb-4">
                    <label for="address" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                    <textarea name="address" 
                              id="address"
                              class="form-control @error('address') is-invalid @enderror" 
                              rows="3" 
                              placeholder="Tuliskan alamat lengkap masjid..."
                              required>{{ old('address', $profile->address ?? 'Jl. Jenderal Sudirman KM 3, Kotabumi, Kec. Purwakarta, Kota Cilegon, Banten 42435, Indonesia') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jam Operasional -->
                <div class="mb-4">
                    <label for="operating_hours" class="form-label">Jam Operasional <span class="text-danger">*</span></label>
                    <textarea name="operating_hours" 
                              id="operating_hours"
                              class="form-control @error('operating_hours') is-invalid @enderror" 
                              rows="2" 
                              placeholder="Contoh: Buka 24 Jam untuk Shalat&#10;Administrasi: 08.00 - 17.00 WIB"
                              required>{{ old('operating_hours', $profile->operating_hours ?? 'Buka 24 Jam untuk Shalat' . "\n" . 'Administrasi: 08.00 - 17.00 WIB') }}</textarea>
                    @error('operating_hours')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Gunakan enter untuk baris baru</div>
                </div>

                <div class="mb-4">
                    <label for="maps_embed" class="form-label">Embed Google Maps <span class="text-danger">*</span></label>
                    <textarea name="maps_embed" 
                              id="maps_embed"
                              class="form-control @error('maps_embed') is-invalid @enderror" 
                              rows="4" 
                              placeholder="Paste kode embed Google Maps di sini..."
                              required>{{ old('maps_embed', $profile->maps_embed ?? '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.037200799374!2d106.1504741750117!3d-6.125511993865611!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e418adaa4f7f563%3A0x950ec58123df8596!2sUniversitas%20Sultan%20Ageng%20Tirtayasa%20(UNTIRTA)%20Kampus%20Cilegon!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" width="100%" height="100%" style="border:0; border-radius: 12px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>') }}</textarea>
                    @error('maps_embed')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        Cara mendapatkan embed code:<br>
                        1. Buka Google Maps<br>
                        2. Cari lokasi masjid<br>
                        3. Klik "Share" → "Embed a map"<br>
                        4. Copy kode iframe dan paste di sini
                    </div>
                </div>

                <!-- Google Maps URL -->
                <div class="mb-4">
                    <label for="maps_url" class="form-label">Google Maps URL <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="maps_url" 
                           id="maps_url"
                           class="form-control @error('maps_url') is-invalid @enderror" 
                           value="{{ old('maps_url', $profile->maps_url ?? 'https://maps.google.com/?q=Masjid+Al+Mutaallimin+Fakultas+Teknik+Untirta') }}" 
                           placeholder="https://maps.google.com/?q=Alamat+Masjid"
                           required>
                    @error('maps_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Link untuk tombol "Buka di Google Maps"</div>
                </div>
            </div>

            <hr>

            <!-- Fasilitas -->
            <div class="mb-5">
                <h5 class="card-title mb-4 border-bottom pb-3 text-success">
                    <i class="bi bi-building me-2"></i>Fasilitas Masjid
                </h5>
                
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
                    <div class="facility-item border rounded p-3 mb-3">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Nama Fasilitas <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="facility_name[]" 
                                       class="form-control" 
                                       value="{{ $facility['name'] }}" 
                                       placeholder="Contoh: Ruang Shalat"
                                       required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Icon <span class="text-danger">*</span></label>
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
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="facility_description[]" 
                                       class="form-control" 
                                       value="{{ $facility['description'] }}" 
                                       placeholder="Deskripsi singkat"
                                       required>
                            </div>
                            <div class="col-md-1 d-flex align-items-end mb-3">
                                <button type="button" class="btn btn-danger btn-sm remove-facility w-100 h-100 d-flex align-items-center justify-content-center" {{ $index == 0 ? 'disabled' : '' }}>
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <button type="button" id="add-facility" class="btn btn-outline-success btn-sm">
                    <i class="bi bi-plus-circle"></i> Tambah Fasilitas
                </button>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.profile.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
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
    newItem.className = 'facility-item border rounded p-3 mb-3';
    newItem.innerHTML = `
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Nama Fasilitas <span class="text-danger">*</span></label>
                <input type="text" name="facility_name[]" class="form-control" placeholder="Contoh: Ruang Shalat" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Icon <span class="text-danger">*</span></label>
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
            <div class="col-md-4 mb-3">
                <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                <input type="text" name="facility_description[]" class="form-control" placeholder="Deskripsi singkat" required>
            </div>
            <div class="col-md-1 d-flex align-items-end mb-3">
                <button type="button" class="btn btn-danger btn-sm remove-facility w-100 h-100 d-flex align-items-center justify-content-center">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    container.appendChild(newItem);
});

// Remove facility - FIXED VERSION
document.addEventListener('click', function(e) {
    // Cek jika yang diklik adalah tombol remove atau elemen di dalamnya
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
.facility-item {
    background-color: #f8f9fa;
    transition: all 0.3s ease;
}

.facility-item:hover {
    background-color: #e9ecef;
}

/* Improve form styling dengan warna hijau */
.form-control:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
}

.form-select:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
}

.visi-misi-text {
    white-space: pre-line;
    line-height: 1.6;
}

/* Pastikan tombol delete bisa diklik di seluruh area */
.remove-facility {
    min-height: 38px;
    display: flex !important;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    border: 1px solid #dc3545;
}

/* Hover effect untuk tombol delete */
.remove-facility:hover:not(:disabled) {
    background-color: #dc3545 !important;
    border-color: #dc3545 !important;
    color: white;
}

/* Style untuk tombol yang disabled */
.remove-facility:disabled {
    background-color: #6c757d !important;
    border-color: #6c757d !important;
    cursor: not-allowed;
    opacity: 0.6;
}
</style>
@endsection