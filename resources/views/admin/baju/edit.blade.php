@extends('layouts.admin')

@section('content')
    <div class="mx-auto" style="max-width: 900px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 fw-black text-dark text-uppercase tracking-tight-custom mb-1">
                    Edit <span class="text-accent-gold">Koleksi</span>
                </h1>
                <p class="text-muted small fw-bold tracking-wide">Perbarui detail busana ID: #{{ $baju->id_baju }}</p>
            </div>
            <a href="{{ route('admin.baju.index') }}"
                class="btn btn-light fw-bold text-uppercase px-4 py-2 rounded-3 shadow-sm border" style="font-size: 0.75rem; letter-spacing: 1px;">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-5 overflow-hidden position-relative">
            <div class="position-absolute top-0 end-0 p-5 opacity-5 pointer-events-none">
                <i class="fas d-none d-md-block" style="font-size: 8rem; color: var(--primary-dark);"></i>
            </div>

            <div class="card-body p-4 p-md-5 position-relative z-1">
                <form action="{{ route('admin.baju.update', $baju->id_baju) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label text-dark fw-bold text-uppercase small tracking-widest mb-2">Nama Baju / Kostum</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 ps-3"><i class="fas fa-tshirt text-muted"></i></span>
                            <input type="text" name="nama_baju" value="{{ old('nama_baju', $baju->nama_baju) }}"
                                class="form-control bg-light border-0 py-3 fw-bold"
                                placeholder="Contoh: Tari Piring" required>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-dark fw-bold text-uppercase small tracking-widest mb-2">Harga Sewa (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 ps-3 fw-bold text-muted">Rp</span>
                                <input type="number" name="harga_sewa" value="{{ old('harga_sewa', $baju->harga_sewa) }}"
                                    class="form-control bg-light border-0 py-3 fw-bold"
                                    placeholder="50000" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-dark fw-bold text-uppercase small tracking-widest mb-2">Jumlah Stok</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 ps-3"><i class="fas fa-boxes text-muted"></i></span>
                                <input type="number" name="stok" value="{{ old('stok', $baju->stok) }}"
                                    class="form-control bg-light border-0 py-3 fw-bold"
                                    placeholder="50" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label text-dark fw-bold text-uppercase small tracking-widest mb-2">Manajemen Foto</label>
                        <div class="bg-light rounded-4 p-4 border mb-3">
                            <div class="row align-items-center">
                                @if ($baju->foto)
                                    <div class="col-auto">
                                        <div class="position-relative">
                                            <img src="{{ asset('storage/' . $baju->foto) }}" class="rounded-3 shadow-sm border border-2 border-white" style="width: 100px; height: 130px; object-fit: cover;">
                                            <span class="position-absolute bottom-0 start-50 translate-middle-x badge bg-dark text-white text-uppercase fw-bold mb-n2" style="font-size: 8px;">Saat Ini</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="col">
                                    <div class="position-relative overflow-hidden rounded-4 border-2 border-dashed border-secondary border-opacity-25 bg-white p-3 text-center cursor-pointer hover-border-gold transition-all" id="drop-area">
                                        <i class="fas fa-cloud-upload-alt text-muted mb-1"></i>
                                        <p class="text-muted small fw-bold mb-0">Klik untuk Ganti Foto</p>
                                        <input type="file" name="foto"
                                            class="position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer"
                                            accept="image/*" onchange="previewImage(event)">
                                    </div>
                                    <p class="text-muted mt-2 mb-0 italic" style="font-size: 10px;">* Biarkan kosong jika tidak ingin mengubah foto</p>
                                </div>
                            </div>
                        </div>

                        <div id="preview-wrapper" class="d-none mt-4 text-center">
                            <div class="position-relative d-inline-block">
                                <img id="img-preview" class="rounded-3 shadow-lg border border-3 border-white" style="height: 150px; object-fit: cover;">
                                <div class="position-absolute translate-middle top-0 start-100 bg-success rounded-circle border border-2 border-white d-flex align-items-center justify-content-center text-white" style="width: 25px; height: 25px;">
                                    <i class="fas fa-check" style="font-size: 10px;"></i>
                                </div>
                            </div>
                            <p class="text-success fw-bold small text-uppercase tracking-widest mt-2">Pratinjau Foto Baru</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <button type="submit" class="btn btn-dark w-100 py-3 fw-bold text-uppercase shadow-sm" style="letter-spacing: 1px;">
                                <i class="fas fa-sync-alt me-2"></i> Perbarui Koleksi
                            </button>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.baju.index') }}" class="btn btn-light w-100 py-3 fw-bold text-uppercase border shadow-sm" style="letter-spacing: 1px;">
                                Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const output = document.getElementById('img-preview');
            const wrapper = document.getElementById('preview-wrapper');

            reader.onload = function() {
                if (reader.readyState === 2) {
                    output.src = reader.result;
                    wrapper.classList.remove('d-none');
                }
            }

            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
@endpush

@push('styles')
    <style>
        .hover-border-gold:hover {
            border-color: var(--accent-gold) !important;
            background-color: rgba(179, 116, 40, 0.05) !important;
        }
    </style>
@endpush
