@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Dashboard</h2>
    <div class="text-muted">
        <i class="bi bi-calendar3"></i>
        {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Kegiatan</h6>
                        <h3 class="mb-0">{{ $stats['activities'] }}</h3>
                    </div>
                    <div class="text-primary">
                        <i class="bi bi-calendar-event" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stats-card emerald">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Berita</h6>
                        <h3 class="mb-0">{{ $stats['news'] }}</h3>
                    </div>
                    <div class="text-success">
                        <i class="bi bi-newspaper" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stats-card amber">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Galeri</h6>
                        <h3 class="mb-0">{{ $stats['galleries'] }}</h3>
                    </div>
                    <div class="text-warning">
                        <i class="bi bi-images" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stats-card rose">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Rekening Donasi</h6>
                        <h3 class="mb-0">{{ $stats['donations'] }}</h3>
                    </div>
                    <div class="text-danger">
                        <i class="bi bi-cash-coin" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Data -->
<div class="row g-4">
    <!-- Recent Activities -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Kegiatan Terbaru</h5>
                <a href="{{ route('admin.activities.index') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body">
                @if($recentActivities->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentActivities as $activity)
                            <div class="list-group-item px-0">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">{{ $activity->title }}</h6>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar3"></i>
                                            @php
                                                try {
                                                    $date = \Carbon\Carbon::parse($activity->date);
                                                    echo $date->isoFormat('D MMM YYYY');
                                                } catch (\Exception $e) {
                                                    echo $activity->date;
                                                }
                                            @endphp
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt"></i>
                                            {{ $activity->place }}
                                        </small>
                                    </div>
                                    <span class="badge bg-{{ $activity->type == 'rutin' ? 'primary' : 'success' }}">
                                        {{ ucfirst($activity->type) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                        <p class="mt-2">Belum ada kegiatan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent News -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Berita Terbaru</h5>
                <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body">
                @if($recentNews->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentNews as $news)
                            <div class="list-group-item px-0">
                                <div class="d-flex">
                                    @if($news->image)
                                        <img src="{{ Storage::url($news->image) }}" 
                                             alt="{{ $news->title }}" 
                                             class="rounded me-3"
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" 
                                             style="width: 60px; height: 60px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ Str::limit($news->title, 50) }}</h6>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar3"></i>
                                            {{ \Carbon\Carbon::parse($news->date)->isoFormat('D MMM YYYY') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                        <p class="mt-2">Belum ada berita</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Aksi Cepat</h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-2">
                <a href="{{ route('admin.activities.create') }}" class="btn btn-outline-primary w-100">
                    <i class="bi bi-calendar-plus me-1"></i>
                    Kegiatan
                </a>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.news.create') }}" class="btn btn-outline-success w-100">
                    <i class="bi bi-newspaper me-1"></i>
                    Berita
                </a>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.galleries.create') }}" class="btn btn-outline-warning w-100">
                    <i class="bi bi-images me-1"></i>
                    Galeri
                </a>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.donations.create') }}" class="btn btn-outline-danger w-100">
                    <i class="bi bi-cash-coin me-1"></i>
                    Donasi
                </a>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.profile.index') }}" class="btn btn-outline-info w-100">
                    <i class="bi bi-pencil me-1"></i>
                    Profil
                </a>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.pengurus.create') }}" class="btn btn-outline-dark w-100">
                    <i class="bi bi-people me-1"></i>
                    Pengurus
                </a>
            </div>
        </div>
    </div>
</div>
@endsection