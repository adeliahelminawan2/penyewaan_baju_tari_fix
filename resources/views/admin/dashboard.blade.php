@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div
            class="bg-white p-8 rounded-[2rem] shadow-sm border-l-8 border-[#B37428] relative overflow-hidden group hover:shadow-xl transition-all">
            <div class="relative z-10">
                <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Total Koleksi</h3>
                <p class="text-4xl font-black text-[#2B2118]">{{ $jml_baju }}</p>
                <p class="text-[10px] text-gray-500 mt-2 font-bold uppercase">Busana Tersedia</p>
            </div>
            <i
                class="fas fa-tshirt absolute -right-4 -bottom-4 text-7xl text-gray-50 opacity-10 group-hover:text-[#B37428] group-hover:opacity-20 transition-all"></i>
        </div>

        <div
            class="bg-white p-8 rounded-[2rem] shadow-sm border-l-8 border-[#2B2118] relative overflow-hidden group hover:shadow-xl transition-all">
            <div class="relative z-10">
                <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Pelanggan</h3>
                <p class="text-4xl font-black text-[#2B2118]">{{ $jml_pelanggan }}</p>
                <p class="text-[10px] text-gray-500 mt-2 font-bold uppercase">Pernah Menyewa</p>
            </div>
            <i
                class="fas fa-users absolute -right-4 -bottom-4 text-7xl text-gray-50 opacity-10 group-hover:text-[#2B2118] group-hover:opacity-20 transition-all"></i>
        </div>

        <div
            class="bg-white p-8 rounded-[2rem] shadow-sm border-l-8 border-yellow-600 relative overflow-hidden group hover:shadow-xl transition-all">
            <div class="relative z-10">
                <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Sewa Aktif</h3>
                <p class="text-4xl font-black text-[#B37428]">{{ $jml_sewa_aktif }}</p>
                <p class="text-[10px] text-gray-500 mt-2 font-bold uppercase">Sedang Dipinjam</p>
            </div>
            <i
                class="fas fa-clock absolute -right-4 -bottom-4 text-7xl text-gray-50 opacity-10 group-hover:text-yellow-600 group-hover:opacity-20 transition-all"></i>
        </div>
    </div>

    <div class="mt-12 bg-[#2B2118] p-10 rounded-[3rem] text-center border-b-8 border-[#B37428] shadow-2xl">
        <div class="max-w-2xl mx-auto">
            <img src="{{ asset('img/LOGO.jpg') }}"
                class="w-20 h-20 mx-auto rounded-2xl border-2 border-[#B37428] mb-6 shadow-lg">
            <h2 class="text-2xl font-black text-[#B37428] uppercase tracking-[0.2em]">Selamat Datang, Administrator</h2>
            <p class="text-gray-400 mt-4 text-sm leading-relaxed italic">
                "Sistem Manajemen Inventaris Busana Laras siap digunakan. Kelola stok, pantau penyewaan, dan cetak laporan
                dengan mudah dalam satu dashboard terpadu."
            </p>
            <div class="mt-8 flex justify-center gap-4">
                <a href="{{ route('admin.penyewaan.create') }}"
                    class="bg-[#B37428] text-white px-8 py-3 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-white hover:text-[#B37428] transition-all">
                    Mulai Transaksi Baru
                </a>
            </div>
        </div>
    </div>
@endsection
