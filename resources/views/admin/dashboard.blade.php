@extends('layouts.admin')

@section('content')
    <div class="mt-5 bg-primary-dark p-5 rounded-5 text-center shadow-lg position-relative"
        style="border-bottom: 8px solid var(--accent-gold);">
        <div class="mx-auto" style="max-width: 700px;">
            <img src="{{ asset('img/LOGO.jpg') }}" class="rounded-4 border border-2 border-accent-gold mb-4 shadow-lg"
                style="width: 80px; height: 80px;">
            <h2 class="h3 fw-black text-accent-gold text-uppercase mb-3" style="letter-spacing: 0.2em;">Selamat Datang,
                Administrator</h2>
            <div class="mt-4">
                <a href="{{ route('admin.penyewaan.create') }}" class="btn btn-warning fw-bold text-uppercase px-4 py-2"
                    style="background-color: var(--accent-gold); border: none; color: white; font-size: 0.75rem; letter-spacing: 1px;">
                    Mulai Transaksi Baru
                </a>
            </div>
        </div>


        <i class="fas fa-user-shield position-absolute"
            style="right: -20px; bottom: -20px; font-size: 8rem; color: white; opacity: 0.1;"></i>
    </div>
    <div class="row g-7 mt-4 mb-5">
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-5 h-100 position-relative"
                style="border-left: 8px solid var(--accent-gold) !important;">
                <div class="card-body p-4 position-relative z-1">
                    <h3 class="text-muted fw-bold text-uppercase mb-2" style="font-size: 0.75rem; letter-spacing: 2px;">
                        Total Koleksi</h3>
                    <p class="h1 fw-black text-dark mb-1">{{ $jml_baju }}</p>
                    <p class="text-muted fw-bold text-uppercase mb-0" style="font-size: 10px;">Busana Tersedia</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-5 h-100 position-relative overflow-hidden group"
                style="border-left: 8px solid var(--primary-dark) !important;">
                <div class="card-body p-4 position-relative z-1">
                    <h3 class="text-muted fw-bold text-uppercase mb-2" style="font-size: 0.75rem; letter-spacing: 2px;">
                        Pelanggan</h3>
                    <p class="h1 fw-black text-dark mb-1">{{ $jml_pelanggan }}</p>
                    <p class="text-muted fw-bold text-uppercase mb-0" style="font-size: 10px;">Pernah Menyewa</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-5 h-100 position-relative overflow-hidden group"
                style="border-left: 8px solid #ca8a04 !important;">
                <div class="card-body p-4 position-relative z-1">
                    <h3 class="text-muted fw-bold text-uppercase mb-2" style="font-size: 0.75rem; letter-spacing: 2px;">Sewa
                        Aktif</h3>
                    <p class="h1 fw-black text-accent-gold mb-1">{{ $jml_sewa_aktif }}</p>
                    <p class="text-muted fw-bold text-uppercase mb-0" style="font-size: 10px;">Sedang Dipinjam</p>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
