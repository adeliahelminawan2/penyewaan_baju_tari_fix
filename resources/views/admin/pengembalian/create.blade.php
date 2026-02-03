@extends('layouts.admin')

@section('content')
    <div class="mx-auto" style="max-width: 900px;">
        <div class="card border-0 shadow-sm rounded-5 overflow-hidden mb-5">
            <div class="bg-primary-dark p-5 text-center border-bottom border-4 border-accent-gold position-relative">
                <i class="fas fa-undo-alt position-absolute top-50 start-50 translate-middle opacity-10 text-white" style="font-size: 10rem;"></i>
                <h1 class="h3 fw-black text-white text-uppercase tracking-tight-custom mb-2 position-relative z-1">
                    Proses <span class="text-accent-gold">Pengembalian</span>
                </h1>
                <p class="text-white-50 small fw-bold text-uppercase tracking-widest mb-0 position-relative z-1">
                    Denda dihitung otomatis berdasarkan hari keterlambatan
                </p>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.pengembalian.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_penyewaan" value="{{ $penyewaan->id_penyewaan }}">

                    <div class="row g-5">
                        <div class="col-md-6">
                            <h3 class="h6 text-accent-gold fw-black text-uppercase tracking-widest mb-4 pb-2 border-bottom">
                                Detail Transaksi
                            </h3>

                            <div class="mb-4">
                                <label class="form-label text-dark fw-bold text-uppercase small tracking-widest mb-2">Pelanggan</label>
                                <div class="bg-light p-3 rounded-4 fw-black text-dark border">
                                    <i class="fas fa-user me-2 text-muted"></i>
                                    {{ $penyewaan->pelanggan->nama_pelanggan ?? 'Nama Tidak Ditemukan' }}
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="form-label text-dark fw-bold text-uppercase small tracking-widest mb-2">Batas Kembali</label>
                                    <input type="date" id="tgl_rencana" value="{{ $penyewaan->tanggal_kembali_rencana }}"
                                        class="form-control bg-danger bg-opacity-10 border-0 py-3 fw-bold text-danger text-center"
                                        readonly>
                                </div>
                                <div class="col-6">
                                    <label class="form-label text-dark fw-bold text-uppercase small tracking-widest mb-2">Tgl Kembali</label>
                                    <input type="date" id="tgl_kembali_real" name="tanggal_kembali"
                                        value="{{ date('Y-m-d') }}"
                                        class="form-control bg-light border-0 py-3 fw-bold text-dark text-center">
                                </div>
                            </div>

                            <div id="info_terlambat" class="d-none animate-pulse alert alert-danger border-0 shadow-sm rounded-4 text-center py-3">
                                <h4 class="h6 fw-black text-uppercase mb-0">
                                    <i class="fas fa-exclamation-triangle me-2"></i> Terlambat <span id="jumlah_hari">0</span> Hari!
                                </h4>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h3 class="h6 text-accent-gold fw-black text-uppercase tracking-widest mb-4 pb-2 border-bottom">
                                Validasi Kondisi
                            </h3>

                            <div class="mb-4">
                                <label class="form-label text-dark fw-bold text-uppercase small tracking-widest mb-2">Total Denda (Otomatis)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0 ps-3 fw-black text-accent-gold">Rp</span>
                                    <input type="number" id="input_denda" name="denda" value="0"
                                        class="form-control bg-light border-0 py-3 fw-black text-dark" readonly>
                                </div>
                                <p class="text-muted fw-bold mt-2 ps-2" style="font-size: 9px;">* Denda: Rp 10.000 / hari keterlambatan</p>
                            </div>

                            <div class="mb-0">
                                <label class="form-label text-dark fw-bold text-uppercase small tracking-widest mb-2">Keterangan Kondisi</label>
                                <textarea name="keterangan" rows="3" placeholder="Catatan tambahan (contoh: Kostum kotor)..."
                                    class="form-control bg-light border-0 py-3 fw-bold"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-5">
                        <div class="col-md-8 offset-md-2 text-center">
                            <div class="d-flex gap-3">
                                <a href="{{ route('admin.penyewaan.index') }}"
                                    class="btn btn-light fw-bold text-uppercase px-4 py-3 rounded-4 shadow-sm border flex-fill">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="btn btn-dark fw-black text-uppercase px-5 py-3 rounded-4 shadow-lg flex-fill" style="letter-spacing: 2px;">
                                    Konfirmasi Kembali
                                </button>
                            </div>
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
            const tglRencana = document.getElementById('tgl_rencana');
            const tglKembali = document.getElementById('tgl_kembali_real');
            const inputDenda = document.getElementById('input_denda');
            const infoTerlambat = document.getElementById('info_terlambat');
            const jumlahHariText = document.getElementById('jumlah_hari');

            function hitungDenda() {
                const d1 = new Date(tglRencana.value);
                const d2 = new Date(tglKembali.value);

                // Set hours to 0 to compare dates only
                d1.setHours(0,0,0,0);
                d2.setHours(0,0,0,0);

                const diffTime = d2 - d1;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if (diffDays > 0) {
                    const dendaPerHari = 10000; 
                    inputDenda.value = diffDays * dendaPerHari;

                    infoTerlambat.classList.remove('d-none');
                    jumlahHariText.innerText = diffDays;
                } else {
                    inputDenda.value = 0;
                    infoTerlambat.classList.add('d-none');
                }
            }

            hitungDenda();

            tglKembali.addEventListener('change', hitungDenda);
        });
    </script>
@endpush
