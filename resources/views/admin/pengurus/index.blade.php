@extends('admin.layouts.app')

@section('title', 'Kelola Pengurus')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Kelola Pengurus</h2>
    <a href="{{ route('admin.pengurus.create') }}" class="btn btn-warning">
        <i class="bi bi-plus-circle"></i> Tambah Pengurus
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($pengurus->count() > 0)
            <div class="row g-3">
                @foreach($pengurus as $p)
                    <div class="col-md-4 col-lg-3">
                        <div class="card h-100">
                            <!-- Foto Pengurus -->
                            <div class="text-center p-3">
                                <img src="{{ $p->foto ? asset('storage/' . $p->foto) : 'https://placehold.co/150x150/667eea/ffffff?text=' . urlencode(substr($p->nama, 0, 1)) }}" 
                                     class="rounded-circle shadow-sm" 
                                     width="100" height="100"
                                     style="object-fit: cover;"
                                     alt="{{ $p->nama }}"
                                     onerror="this.src='https://placehold.co/150x150/667eea/ffffff?text=' + encodeURIComponent('{{ substr($p->nama, 0, 1) }}')">
                            </div>
                            
                            <div class="card-body text-center">
                                <h6 class="card-title fw-bold mb-2">{{ $p->nama }}</h6>
                                <p class="text-primary mb-2">{{ $p->jabatan }}</p>
                                
                                @if($p->kontak)
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-whatsapp text-success"></i>
                                    {{ $p->kontak }}
                                </p>
                                @endif
                                
                                <small class="text-muted">
                                    <i class="bi bi-sort-numeric-up"></i>
                                    Urutan: {{ $p->urutan }}
                                </small>
                            </div>
                            
                            <div class="card-footer bg-white border-top">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('admin.pengurus.edit', $p->id) }}" 
                                       class="btn btn-sm btn-warning flex-fill">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.pengurus.destroy', $p->id) }}" 
                                          method="POST" 
                                          class="flex-fill"
                                          onsubmit="return confirm('Yakin ingin menghapus pengurus ini?')">
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
        @else
            <div class="text-center py-5">
                <i class="bi bi-people" style="font-size: 4rem; color: #cbd5e1;"></i>
                <h5 class="mt-3 text-muted">Belum Ada Pengurus</h5>
                <p class="text-muted">Klik tombol "Tambah Pengurus" untuk menambah data pertama</p>
                <a href="{{ route('admin.pengurus.create') }}" class="btn btn-warning mt-2">
                    <i class="bi bi-plus-circle"></i> Tambah Pengurus
                </a>
            </div>
        @endif
    </div>
</div>
@endsection