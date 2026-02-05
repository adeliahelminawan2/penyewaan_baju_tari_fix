@extends('layouts.admin')

@section('content')
    <div class="no-print d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-black text-dark text-uppercase tracking-tight-custom mb-1">
                Laporan <span class="text-accent-gold">Penyewaan</span>
            </h1>
            <p class="text-muted small fw-bold tracking-wide mb-0">Tinjau histori transaksi dan total pendapatan secara real-time.</p>
        </div>
        <button onclick="window.print()" class="btn btn-dark fw-bold text-uppercase px-4 py-2 rounded-3 shadow-sm" style="font-size: 0.75rem; letter-spacing: 1px;">
            <i class="fas fa-print me-2 text-accent-gold"></i> Cetak Laporan
        </button>
    </div>

    <div class="row g-4 mb-4 no-print">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-5 overflow-hidden border-start border-5 border-accent-gold">
                <div class="card-body p-4">
                    <p class="text-muted small fw-black text-uppercase tracking-widest mb-1">Total Transaksi</p>
                    <h3 class="fw-black text-dark mb-0">
                        {{ $laporan->count() }} <span class="h6 text-muted fw-bold text-uppercase">Sewa</span>
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-5 overflow-hidden border-start border-5 border-primary-dark">
                <div class="card-body p-4">
                    <p class="text-muted small fw-black text-uppercase tracking-widest mb-1">Total Omzet</p>
                    <h3 class="fw-black text-accent-gold mb-0">
                        Rp {{ number_format($grandTotal, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-5 mb-4 no-print border">
        <div class="card-body p-4">
            <form action="{{ route('admin.laporan.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label text-dark fw-black text-uppercase small tracking-widest mb-2">Dari Tanggal</label>
                    <input type="date" name="tgl_mulai" value="{{ request('tgl_mulai') }}"
                        class="form-control bg-light border-0 py-3 fw-bold">
                </div>
                <div class="col-md-4">
                    <label class="form-label text-dark fw-black text-uppercase small tracking-widest mb-2">Sampai Tanggal</label>
                    <input type="date" name="tgl_selesai" value="{{ request('tgl_selesai') }}"
                        class="form-control bg-light border-0 py-3 fw-bold">
                </div>
                <div class="col-md-4">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-dark fw-black text-uppercase py-3 px-4 rounded-3 flex-fill shadow-sm" style="font-size: 0.75rem;">
                            <i class="fas fa-filter me-2 text-accent-gold"></i> Filter
                        </button>
                        <a href="{{ route('admin.laporan.index') }}" class="btn btn-light fw-bold text-uppercase py-3 px-3 rounded-3 border" style="font-size: 0.75rem;">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-5 overflow-hidden mb-5">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="laporanTable">
                <thead class="bg-primary-dark text-white">
                    <tr>
                        <th class="p-4 text-uppercase small fw-bold" style="letter-spacing: 1px;">No. Nota</th>
                        <th class="p-4 text-uppercase small fw-bold" style="letter-spacing: 1px;">Pelanggan</th>
                        <th class="p-4 text-uppercase small fw-bold" style="letter-spacing: 1px;">Tanggal Sewa</th>
                        <th class="p-4 text-uppercase small fw-bold text-end" style="letter-spacing: 1px;">Total Bayar</th>
                        <th class="p-4 text-uppercase small fw-bold text-center no-print" style="letter-spacing: 1px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($laporan as $row)
                        <tr>
                            <td class="p-4">
                                <span class="fw-black text-accent-gold text-uppercase tracking-tighter">
                                    {{ $row->kode_sewa }}
                                </span>
                            </td>
                            <td class="p-4">
                                <div class="d-print-none">
                                    <div class="fw-black text-dark text-uppercase small mb-1">{{ $row->nama_pelanggan }}</div>
                                    <span class="badge {{ $row->status == 'disewa' ? 'bg-warning text-dark' : 'bg-success' }} text-uppercase fw-bold rounded-pill" style="font-size: 8px;">
                                        {{ $row->status }}
                                    </span>
                                </div>
                                <div class="d-none d-print-block">
                                    <div class="fw-bold">{{ $row->nama_pelanggan }}</div>
                                    <div class="small">({{ $row->status }})</div>
                                </div>
                            </td>
                            <td class="p-4 text-muted fw-bold">
                                {{ date('d M Y', strtotime($row->tanggal_sewa)) }}
                            </td>
                            <td class="p-4 text-end">
                                <span class="fw-black text-dark">
                                    Rp {{ number_format($row->total_harga, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="p-4 text-center no-print">
                                <a href="{{ route('admin.penyewaan.show', $row->id_penyewaan) }}"
                                    class="btn btn-light btn-sm rounded-3 border shadow-sm p-2"
                                    title="Lihat Detail">
                                    <i class="fas fa-eye text-primary"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-5 text-center text-muted fw-bold italic">
                                Tidak ada data transaksi untuk periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-light">
                    <tr>
                        <td colspan="3" class="p-4 text-center fw-black text-uppercase small tracking-widest text-muted">Ringkasan Pendapatan</td>
                        <td class="p-4 text-end fw-black text-accent-gold h4 mb-0">
                            Rp {{ number_format($grandTotal, 0, ',', '.') }}
                        </td>
                        <td class="no-print"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <style>
        @media print {
            .no-print, .sidebar, header, nav, .btn, form {
                display: none !important;
            }

            body, .main-wrapper, .content-wrapper, .container-fluid {
                background: white !important;
                margin: 0 !important;
                padding: 0 !important;
                left: 0 !important;
                width: 100% !important;
            }

            .main-wrapper {
                margin-left: 0 !important;
            }
            
            .card {
                border: none !important;
                box-shadow: none !important;
            }

            table {
                width: 100% !important;
                border: 1px solid #dee2e6 !important;
            }

            th, td {
                border: 1px solid #dee2e6 !important;
                padding: 10px !important;
                color: black !important;
            }

            th {
                background-color: #343a40 !important;
                color: white !important;
                -webkit-print-color-adjust: exact !important;
            }

            .text-accent-gold {
                color: #B37428 !important;
            }
        }
    </style>
@endsection
