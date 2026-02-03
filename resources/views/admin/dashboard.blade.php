@extends('layouts.admin')

@section('content')
    <div class="row g-4">
        <!-- Total Koleksi -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-5 h-100 position-relative overflow-hidden group" style="border-left: 8px solid var(--accent-gold) !important;">
                <div class="card-body p-4 position-relative z-1">
                    <h3 class="text-muted fw-bold text-uppercase mb-2" style="font-size: 0.75rem; letter-spacing: 2px;">Total Koleksi</h3>
                    <p class="h1 fw-black text-dark mb-1">{{ $jml_baju }}</p>
                    <p class="text-muted fw-bold text-uppercase mb-0" style="font-size: 10px;">Busana Tersedia</p>
                </div>
                <i class="fas fa-tshirt position-absolute" style="right: -10px; bottom: -10px; font-size: 5rem; color: var(--accent-gold); opacity: 0.1;"></i>
            </div>
        </div>

        <!-- Pelanggan -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-5 h-100 position-relative overflow-hidden group" style="border-left: 8px solid var(--primary-dark) !important;">
                <div class="card-body p-4 position-relative z-1">
                    <h3 class="text-muted fw-bold text-uppercase mb-2" style="font-size: 0.75rem; letter-spacing: 2px;">Pelanggan</h3>
                    <p class="h1 fw-black text-dark mb-1">{{ $jml_pelanggan }}</p>
                    <p class="text-muted fw-bold text-uppercase mb-0" style="font-size: 10px;">Pernah Menyewa</p>
                </div>
                <i class="fas fa-users position-absolute" style="right: -10px; bottom: -10px; font-size: 5rem; color: var(--primary-dark); opacity: 0.1;"></i>
            </div>
        </div>

        <!-- Sewa Aktif -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-5 h-100 position-relative overflow-hidden group" style="border-left: 8px solid #ca8a04 !important;">
                <div class="card-body p-4 position-relative z-1">
                    <h3 class="text-muted fw-bold text-uppercase mb-2" style="font-size: 0.75rem; letter-spacing: 2px;">Sewa Aktif</h3>
                    <p class="h1 fw-black text-accent-gold mb-1">{{ $jml_sewa_aktif }}</p>
                    <p class="text-muted fw-bold text-uppercase mb-0" style="font-size: 10px;">Sedang Dipinjam</p>
                </div>
                <i class="fas fa-clock position-absolute" style="right: -10px; bottom: -10px; font-size: 5rem; color: #ca8a04; opacity: 0.1;"></i>
            </div>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="mt-5 bg-primary-dark p-5 rounded-5 text-center shadow-lg position-relative" style="border-bottom: 8px solid var(--accent-gold);">
        <div class="mx-auto" style="max-width: 700px;">
            <img src="{{ asset('img/LOGO.jpg') }}" class="rounded-4 border border-2 border-accent-gold mb-4 shadow-lg" style="width: 80px; height: 80px;">
            <h2 class="h3 fw-black text-accent-gold text-uppercase mb-3" style="letter-spacing: 0.2em;">Selamat Datang, Administrator</h2>
            <p class="text-secondary mt-3 fst-italic" style="font-size: 0.9rem; line-height: 1.6;">
                "Sistem Manajemen Inventaris Busana Laras siap digunakan. Kelola stok, pantau penyewaan, dan cetak laporan
                dengan mudah dalam satu dashboard terpadu."
            </p>
            <div class="mt-4">
                <a href="{{ route('admin.penyewaan.create') }}" class="btn btn-warning fw-bold text-uppercase px-4 py-2" style="background-color: var(--accent-gold); border: none; color: white; font-size: 0.75rem; letter-spacing: 1px;">
                    Mulai Transaksi Baru
                </a>
            </div>
        </div>
    </div>
@endsection
