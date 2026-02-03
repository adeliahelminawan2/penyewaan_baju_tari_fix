@extends('layouts.admin')

@section('content')
    <div class="mx-auto" style="max-width: 800px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 fw-black text-dark text-uppercase tracking-tight-custom mb-1">
                    Edit <span class="text-accent-gold">Pelanggan</span>
                </h1>
                <p class="text-muted small fw-bold tracking-wide">Perbarui informasi pelanggan setia Busana Laras.</p>
            </div>
            <a href="{{ route('admin.pelanggan.index') }}"
                class="btn btn-light fw-bold text-uppercase px-4 py-2 rounded-3 shadow-sm border" style="font-size: 0.75rem; letter-spacing: 1px;">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-5 overflow-hidden position-relative">
            <div class="position-absolute top-0 end-0 p-5 opacity-5 pointer-events-none">
                <i class="fas fa-user-edit d-none d-md-block" style="font-size: 8rem; color: var(--primary-dark);"></i>
            </div>

            <div class="card-body p-4 p-md-5 position-relative z-1">
                <form action="{{ route('admin.pelanggan.update', $pelanggan->id_pelanggan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label text-dark fw-bold text-uppercase small tracking-widest mb-2">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 ps-3"><i class="fas fa-user text-muted"></i></span>
                            <input type="text" name="nama_pelanggan" id="nama_pelanggan"
                                class="form-control bg-light border-0 py-3 fw-bold @error('nama_pelanggan') is-invalid @enderror"
                                placeholder="Masukkan nama pelanggan..." value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" required>
                            @error('nama_pelanggan')
                                <div class="invalid-feedback fw-bold small mt-2 ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-dark fw-bold text-uppercase small tracking-widest mb-2">Nomor Telepon / WA</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 ps-3"><i class="fas fa-phone text-muted"></i></span>
                            <input type="text" name="no_hp" id="no_hp"
                                class="form-control bg-light border-0 py-3 fw-bold @error('no_hp') is-invalid @enderror"
                                placeholder="Contoh: 08123456789" value="{{ old('no_hp', $pelanggan->no_hp) }}" required>
                            @error('no_hp')
                                <div class="invalid-feedback fw-bold small mt-2 ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label text-dark fw-bold text-uppercase small tracking-widest mb-2">Alamat Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 ps-3 pt-3 align-items-start"><i class="fas fa-map-marker-alt text-muted"></i></span>
                            <textarea name="alamat" id="alamat" rows="3"
                                class="form-control bg-light border-0 py-3 fw-bold @error('alamat') is-invalid @enderror"
                                placeholder="Ketik alamat lengkap pelanggan..." required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback fw-bold small mt-2 ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-dark w-100 py-3 fw-bold text-uppercase shadow-sm" style="letter-spacing: 1px;">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
