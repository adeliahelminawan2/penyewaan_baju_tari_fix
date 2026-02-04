@extends('layouts.admin')

@section('content')
    <div class="mx-auto" style="max-width: 900px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 fw-black text-dark text-uppercase tracking-tight-custom mb-1">
                    Detail <span class="text-accent-gold">Transaksi</span>
                </h1>
                <p class="text-muted small fw-bold tracking-wide">Informasi lengkap penyewaan busana.</p>
            </div>
            <div class="d-flex gap-2">
                <button onclick="window.print()" class="btn btn-dark fw-bold text-uppercase px-4 py-2 rounded-3 shadow-sm" style="font-size: 0.75rem; letter-spacing: 1px;">
                    <i class="fas fa-print me-2 text-accent-gold"></i> Cetak Nota
                </button>
                <a href="{{ route('admin.penyewaan.index') }}"
                    class="btn btn-light fw-bold text-uppercase px-4 py-2 rounded-3 shadow-sm border" style="font-size: 0.75rem; letter-spacing: 1px;">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-5 overflow-hidden position-relative">
            <div class="bg-primary-dark p-5 text-center position-relative overflow-hidden mb-0">
                <div class="position-absolute top-50 start-50 translate-middle opacity-10 text-white" style="font-size: 15rem;">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <div class="position-relative z-1">
                    <p class="text-accent-gold text-uppercase fw-black small tracking-widest mb-2">Kode Sewa</p>
                    <h2 class="h1 fw-black text-white text-uppercase tracking-wider mb-0">{{ $penyewaan->kode_sewa }}</h2>
                </div>
            </div>

            <div class="card-body p-4 p-md-5">
                <div class="row g-4 mb-5 pb-5 border-bottom">
                    <div class="col-md-6">
                        <p class="text-muted text-uppercase fw-black small tracking-widest mb-2">Data Penyewa</p>
                        <h3 class="h4 fw-black text-dark mb-2 text-uppercase">{{ $penyewaan->nama_pelanggan }}</h3>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge {{ $penyewaan->status == 'disewa' ? 'bg-warning text-dark' : 'bg-success' }} text-uppercase fw-bold rounded-pill px-3 py-2" style="font-size: 10px; letter-spacing: 1px;">
                                <i class="fas {{ $penyewaan->status == 'disewa' ? 'fa-clock' : 'fa-check-circle' }} me-1"></i>
                                {{ $penyewaan->status == 'disewa' ? 'Dalam Sewa' : 'Sudah Kembali' }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="mb-3">
                            <p class="text-muted text-uppercase fw-black small tracking-widest mb-1">Tanggal Sewa</p>
                            <h4 class="h5 fw-black text-dark mb-0">
                                {{ date('d F Y', strtotime($penyewaan->tanggal_sewa)) }}
                            </h4>
                        </div>
                        <div>
                            <p class="text-danger text-uppercase fw-black small tracking-widest mb-1">Batas Pengembalian</p>
                            <h4 class="h5 fw-black text-danger mb-0">
                                {{ date('d F Y', strtotime($penyewaan->tanggal_kembali_rencana)) }}
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <h3 class="h6 text-accent-gold fw-black text-uppercase tracking-widest mb-4">
                        <i class="fas fa-tshirt me-2"></i> Daftar Koleksi Busana
                    </h3>
                    
                    <div class="row g-3">
                        @foreach ($penyewaan->details as $detail)
                            <div class="col-12">
                                <div class="card border-0 bg-light rounded-4 overflow-hidden border-start border-4 border-accent-gold hover-shadow-custom transition-all">
                                    <div class="card-body p-4 d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="h5 fw-black text-dark mb-1 text-uppercase">{{ $detail->baju->nama_baju }}</h4>
                                            <p class="text-muted small fw-bold text-uppercase mb-0" style="letter-spacing: 1px;">
                                                {{ $detail->jumlah }} Pcs <i class="fas fa-times mx-2 opacity-50"></i> <span class="text-accent-gold">Rp {{ number_format($detail->harga_sewa, 0, ',', '.') }}</span>
                                            </p>
                                        </div>
                                        <div class="text-end">
                                            <span class="h5 fw-black text-dark mb-0">
                                                Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card border-0 bg-primary-dark rounded-4 shadow-lg overflow-hidden position-relative group">
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-accent-gold opacity-10 animate-pulse"></div>
                    <div class="card-body p-4 d-flex justify-content-between align-items-center position-relative z-1">
                        <span class="h6 fw-black text-white text-uppercase tracking-widest mb-0 opacity-75">Total Pembayaran</span>
                        <h3 class="h2 fw-black text-accent-gold mb-0">
                            Rp {{ number_format($penyewaan->details->sum('subtotal'), 0, ',', '.') }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-shadow-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            background-color: #fff !important;
        }

        @media print {
            .no-print, .sidebar, header, nav, .btn, form, a {
                display: none !important;
            }

            body, .main-wrapper, .content-wrapper, .container-fluid, .mx-auto {
                background: white !important;
                margin: 0 !important;
                padding: 0 !important;
                left: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
            }

            .main-wrapper {
                margin-left: 0 !important;
            }
            
            .card {
                border: 2px solid #dee2e6 !important;
                border-radius: 0 !important;
                box-shadow: none !important;
            }

            .bg-primary-dark {
                background-color: #2B2118 !important;
                color: white !important;
                -webkit-print-color-adjust: exact !important;
            }

            .text-accent-gold {
                color: #B37428 !important;
            }

            .badge {
                border: 1px solid #000 !important;
                color: #000 !important;
                background: none !important;
            }
        }
    </style>
@endsection
