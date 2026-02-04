@extends('layouts.admin')

@section('content')
    <div class="mx-auto" style="max-width: 900px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 fw-black text-dark text-uppercase tracking-tight-custom mb-1">
                    Transaksi <span class="text-accent-gold">Baru</span>
                </h1>
                <p class="text-muted small fw-bold tracking-wide">Input data penyewaan busana.</p>
            </div>
            <a href="{{ route('admin.penyewaan.index') }}"
                class="btn btn-light fw-bold text-uppercase px-4 py-2 rounded-3 shadow-sm border" style="font-size: 0.75rem; letter-spacing: 1px;">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger border-0 border-start border-4 border-danger shadow-sm rounded-3 mb-4">
                <div class="d-flex align-items-start gap-3">
                    <i class="fas fa-exclamation-circle text-danger mt-1"></i>
                    <div>
                        <h4 class="h6 fw-bold text-uppercase tracking-wide mb-1">Terjadi Kesalahan</h4>
                        <ul class="mb-0 small fw-bold text-danger opacity-75 list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-warning border-0 border-start border-4 border-warning shadow-sm rounded-3 d-flex align-items-center gap-3 mb-4">
                <i class="fas fa-exclamation-triangle text-warning"></i>
                <p class="mb-0 fw-bold small text-warning">{{ session('error') }}</p>
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-5 overflow-hidden position-relative">
            <div class="position-absolute top-0 end-0 p-5 opacity-5 pointer-events-none">
                <i class="fas d-none d-md-block" style="font-size: 8rem; color: var(--primary-dark);"></i>
            </div>

            <div class="card-body p-4 p-md-5 position-relative z-1">
                <form action="{{ route('admin.penyewaan.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label text-dark fw-bold text-uppercase small tracking-widest mb-2">Nama Pelanggan</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 ps-3"><i class="fas fa-user-edit text-accent-gold"></i></span>
                            <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}"
                                class="form-control bg-light border-0 py-3 fw-bold"
                                placeholder="Ketik Nama Lengkap Penyewa..." required>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-dark fw-bold text-uppercase small tracking-widest mb-2">No. HP / WhatsApp</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 ps-3"><i class="fas fa-phone text-accent-gold"></i></span>
                                <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                                    class="form-control bg-light border-0 py-3 fw-bold"
                                    placeholder="Contoh: 08123456789" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-dark fw-bold text-uppercase small tracking-widest mb-2">Alamat Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 ps-3"><i class="fas fa-map-marker-alt text-accent-gold"></i></span>
                                <input type="text" name="alamat" value="{{ old('alamat') }}"
                                    class="form-control bg-light border-0 py-3 fw-bold"
                                    placeholder="Alamat domisili saat ini..." required>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-dark fw-bold text-uppercase small tracking-widest mb-2">Tanggal Sewa</label>
                            <input type="date" name="tanggal_sewa" value="{{ old('tanggal_sewa', date('Y-m-d')) }}"
                                class="form-control bg-light border-0 py-3 fw-bold">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-danger fw-bold text-uppercase small tracking-widest mb-2">Rencana Kembali</label>
                            <input type="date" name="tanggal_kembali_rencana"
                                value="{{ old('tanggal_kembali_rencana') }}"
                                class="form-control bg-danger bg-opacity-10 border-0 py-3 fw-bold text-danger"
                                required>
                        </div>
                    </div>

                    <div class="bg-light rounded-4 p-4 mb-5 border">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                            <h3 class="h6 text-accent-gold fw-black text-uppercase tracking-widest mb-0">
                                <i class="fas fa-tshirt me-2"></i> Daftar Busana
                            </h3>
                            <span class="text-uppercase text-muted fw-bold" style="font-size: 9px;">Pilih item yang disewa</span>
                        </div>

                        <div id="items-container" class="mb-3">
                            <div class="row g-3 item-row align-items-end mb-3">
                                <div class="col-8 col-md-9">
                                    <label class="form-label text-muted fw-bold text-uppercase" style="font-size: 9px;">Pilih Busana</label>
                                    <select name="id_baju[]" class="form-select border-0 shadow-sm rounded-3 fw-bold py-2" required>
                                        <option value="" disabled selected>-- Pilih Baju --</option>
                                        @foreach ($bajus as $b)
                                            <option value="{{ $b->id_baju }}">{{ $b->nama_baju }} (Stok: {{ $b->stok }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3 col-md-2 text-center">
                                     <label class="form-label text-muted fw-bold text-uppercase" style="font-size: 9px;">Jumlah</label>
                                    <input type="number" name="jumlah[]" min="1" value="1"
                                        class="form-control border-0 shadow-sm rounded-3 fw-bold py-2 text-center"
                                        required>
                                </div>
                                <div class="col-1">
                                    <button type="button"
                                        class="btn btn-outline-danger border-0 rounded-3 btn-remove p-2 opacity-0 ripple-none" disabled>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="btn-add-item"
                            class="btn btn-outline-dark w-100 py-2 border-2 border-dashed fw-bold text-uppercase small tracking-widest">
                            <i class="fas fa-plus me-2"></i> Tambah Item Lain
                        </button>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <button type="submit" class="btn btn-dark w-100 py-3 fw-bold text-uppercase shadow-sm" style="letter-spacing: 1px;">
                                <i class="fas fa-save me-2"></i> Proses Transaksi
                            </button>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.penyewaan.index') }}" class="btn btn-light w-100 py-3 fw-bold text-uppercase border shadow-sm" style="letter-spacing: 1px;">
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
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('items-container');
            const btnAdd = document.getElementById('btn-add-item');

            const getRowTemplate = () => `
                <div class="row g-3 item-row align-items-end mb-3 animate-fade-in">
                    <div class="col-8 col-md-9">
                        <select name="id_baju[]" class="form-select border-0 shadow-sm rounded-3 fw-bold py-2" required>
                            <option value="" disabled selected>-- Pilih Baju --</option>
                            @foreach ($bajus as $b)
                                <option value="{{ $b->id_baju }}">{{ $b->nama_baju }} (Stok: {{ $b->stok }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3 col-md-2 text-center">
                        <input type="number" name="jumlah[]" min="1" value="1" class="form-control border-0 shadow-sm rounded-3 fw-bold py-2 text-center" required>
                    </div>
                    <div class="col-1">
                        <button type="button" class="btn btn-outline-danger border-0 rounded-3 btn-remove p-2 shadow-sm ripple-none">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;

            btnAdd.addEventListener('click', function() {
                container.insertAdjacentHTML('beforeend', getRowTemplate());
            });

            container.addEventListener('click', function(e) {
                if (e.target.closest('.btn-remove')) {
                    const row = e.target.closest('.item-row');
                    if (document.querySelectorAll('.item-row').length > 1) {
                        row.remove();
                    }
                }
            });
        });
    </script>
@endpush
