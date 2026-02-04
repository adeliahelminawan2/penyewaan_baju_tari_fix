@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-black text-dark text-uppercase tracking-tight-custom mb-1">
                Data <span class="text-accent-gold">Penyewaan</span>
            </h1>
            <p class="text-muted small fw-bold tracking-wide mb-0">Pantau status peminjaman secara real-time.</p>
        </div>
        <a href="{{ route('admin.penyewaan.create') }}"
            class="btn btn-dark fw-bold text-uppercase px-4 py-2 rounded-3 shadow-sm" style="font-size: 0.75rem; letter-spacing: 1px;">
            <i class="fas fa-plus me-2"></i> Tambah Penyewaan
        </a>
    </div>

    @if (session('success'))
        <div id="success-alert" class="alert alert-success border-0 border-start border-4 border-success shadow-sm rounded-3 d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 p-2 rounded-circle text-success">
                    <i class="fas fa-check"></i>
                </div>
                <p class="mb-0 fw-bold small text-success">{{ session('success') }}</p>
            </div>
            <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-5 overflow-hidden border-start border-5 border-primary-dark mb-5">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-primary-dark text-white">
                    <tr>
                        <th class="p-4 text-uppercase small fw-bold" style="letter-spacing: 1px;">Kode & Pelanggan</th>
                        <th class="p-4 text-uppercase small fw-bold" style="letter-spacing: 1px;">Koleksi Busana</th>
                        <th class="p-4 text-uppercase small fw-bold text-center" style="letter-spacing: 1px;">Status</th>
                        <th class="p-4 text-uppercase small fw-bold" style="letter-spacing: 1px;">Catatan / Denda</th>
                        <th class="p-4 text-uppercase small fw-bold text-center" style="letter-spacing: 1px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach ($penyewaan as $item)
                        <tr class="group">
                            <td class="p-4">
                                <div class="fw-black text-dark h5 mb-1">{{ $item->kode_sewa }}</div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-user text-accent-gold" style="font-size: 10px;"></i>
                                    <span class="text-uppercase text-muted fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">{{ $item->nama_pelanggan }}</span>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($item->details as $d)
                                        <span class="badge bg-light text-dark border border-secondary border-opacity-10 px-3 py-2 rounded-3 fw-bold d-flex align-items-center gap-2" style="font-size: 11px;">
                                            <i class="fas fa-tshirt text-muted"></i>
                                            {{ $d->baju->nama_baju }}
                                            <span class="badge bg-primary-dark text-white rounded-1 ms-1" style="font-size: 9px;">{{ $d->jumlah }}</span>
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                @if ($item->status == 'disewa')
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-4 py-2 rounded-pill fw-bold text-uppercase" style="font-size: 10px; letter-spacing: 1px;">
                                        <i class="fas fa-clock me-1"></i> Dalam Sewa
                                    </span>
                                @else
                                    <span class="badge bg-success bg-opacity-10 text-success px-4 py-2 rounded-pill fw-bold text-uppercase" style="font-size: 10px; letter-spacing: 1px;">
                                        <i class="fas fa-check-circle me-1"></i> Kembali
                                    </span>
                                @endif
                            </td>
                            <td class="p-4">
                                @if ($item->status == 'dikembalikan' || ($item->status == 'KEMBALI' && $item->pengembalian))
                                    <div class="small text-muted fst-italic mb-1">
                                        "{{ $item->pengembalian->keterangan ?? 'Kondisi Baik' }}"
                                    </div>
                                    @if ($item->pengembalian->denda > 0)
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10 px-2 py-1 text-uppercase fw-bold" style="font-size: 9px;">
                                            Denda: Rp {{ number_format($item->pengembalian->denda, 0, ',', '.') }}
                                        </span>
                                    @endif
                                @else
                                    <span class="text-muted opacity-25 fw-bold">-</span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                @if ($item->status == 'disewa')
                                    <a href="{{ route('admin.pengembalian.create', $item->id_penyewaan) }}"
                                        class="btn btn-warning btn-sm fw-black text-uppercase px-3 py-2 rounded-3 shadow-sm" style="background-color: var(--accent-gold); color: white; font-size: 9px; letter-spacing: 1px;">
                                        Proses Kembali
                                    </a>
                                @else
                                    <a href="{{ route('admin.penyewaan.nota', $item->id_penyewaan) }}" target="_blank"
                                        class="btn btn-dark btn-sm rounded-3 shadow-sm p-2"
                                        title="Cetak Nota">
                                        <i class="fas fa-print"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($penyewaan->isEmpty())
            <div class="p-5 text-center">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 100px; height: 100px;">
                    <i class="fas fa-clipboard-list text-muted h2 mb-0 opacity-25"></i>
                </div>
                <h3 class="fw-black text-dark mb-2 text-uppercase">Belum Ada Transaksi</h3>
                <p class="text-muted mb-0 mx-auto" style="max-width: 400px;">Data penyewaan akan muncul di sini setelah transaksi dilakukan.</p>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var notif = document.getElementById('success-alert');
            if (notif) {
                setTimeout(function() {
                    notif.style.display = 'none';
                }, 3000);
            }
        });
    </script>
@endpush
