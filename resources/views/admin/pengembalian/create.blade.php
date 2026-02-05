@extends('layouts.admin')

@section('content')
    <div class="mx-auto" style="max-width: 900px;">
        <div class="card border-0 shadow-sm rounded-5 overflow-hidden mb-5">
            <div class="bg-primary-dark p-5 text-center border-bottom border-4 border-accent-gold position-relative">
                <i class="fas position-absolute top-50 start-50 translate-middle opacity-10 text-white" style="font-size: 10rem;"></i>
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
                                    {{ $penyewaan->nama_pelanggan }}
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

                            <div class="bg-dark text-white rounded-4 p-4 mb-4">
                                <h3 class="h6 text-accent-gold fw-black text-uppercase tracking-widest mb-3 pb-2 border-bottom border-secondary">
                                    Ringkasan Pembayaran
                                </h3>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="small opacity-75">Sisa Sewa Baju</span>
                                    @php $sisaSewa = $penyewaan->total_harga - $penyewaan->total_bayar; @endphp
                                    <span class="fw-bold">Rp {{ number_format($sisaSewa, 0, ',', '.') }}</span>
                                    <input type="hidden" id="sisa_sewa_val" value="{{ $sisaSewa }}">
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="small opacity-75">Denda Keterlambatan</span>
                                    <span class="fw-bold text-warning" id="display_denda">Rp 0</span>
                                </div>
                                <hr class="my-3 opacity-25">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <span class="fw-black text-uppercase small">Total Tagihan</span>
                                    <span class="h4 fw-black text-accent-gold mb-0" id="display_total_tagihan">Rp {{ number_format($sisaSewa, 0, ',', '.') }}</span>
                                </div>

                                <label class="form-label text-white-50 fw-bold text-uppercase small tracking-widest mb-2">Jumlah Bayar Pelunasan</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-white bg-opacity-10 border-0 text-white">Rp</span>
                                    <input type="number" name="pelunasan" id="input_pelunasan" value="{{ old('pelunasan', $sisaSewa) }}"
                                        class="form-control bg-white bg-opacity-10 border-0 py-3 fw-black text-white"
                                        placeholder="0">
                                </div>
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
            const displayDenda = document.getElementById('display_denda');
            const displayTotalTagihan = document.getElementById('display_total_tagihan');
            const inputPelunasan = document.getElementById('input_pelunasan');
            const sisaSewaVal = parseInt(document.getElementById('sisa_sewa_val').value) || 0;
            const infoTerlambat = document.getElementById('info_terlambat');
            const jumlahHariText = document.getElementById('jumlah_hari');

            // Kita buat input hidden untuk denda karena tampilan dipindah ke display
            const hiddenDenda = document.createElement('input');
            hiddenDenda.type = 'hidden';
            hiddenDenda.name = 'denda';
            document.querySelector('form').appendChild(hiddenDenda);
 
            const formatRupiah = (number) => {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(number);
            };

            function hitungDenda() {
                const d1 = new Date(tglRencana.value);
                const d2 = new Date(tglKembali.value);
 
                d1.setHours(0,0,0,0);
                d2.setHours(0,0,0,0);
 
                const diffTime = d2 - d1;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                
                let denda = 0;
                if (diffDays > 0) {
                    const dendaPerHari = 5000; 
                    denda = diffDays * dendaPerHari;
 
                    infoTerlambat.classList.remove('d-none');
                    jumlahHariText.innerText = diffDays;
                } else {
                    infoTerlambat.classList.add('d-none');
                }

                hiddenDenda.value = denda;
                displayDenda.innerText = formatRupiah(denda);
                
                const totalTagihan = sisaSewaVal + denda;
                displayTotalTagihan.innerText = formatRupiah(totalTagihan);
                inputPelunasan.value = totalTagihan;
            }
 
            hitungDenda();
 
            tglKembali.addEventListener('change', hitungDenda);
        });
    </script>
@endpush
