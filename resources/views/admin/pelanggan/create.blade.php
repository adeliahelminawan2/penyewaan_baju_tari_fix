@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-black text-[#2B2118] tracking-tight">Tambah Pelanggan</h1>
                <p class="text-gray-500 mt-1 font-medium">Daun sirih, pinang dikunyah; Pelanggan baru, rezeki melimpah.</p>
            </div>
            <div class="w-16 h-1 bg-[#B37428] rounded-full"></div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-gray-200/50 overflow-hidden border border-gray-100">
            <div class="bg-[#2B2118] p-8 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <i class="fas fa-user-plus text-6xl text-[#B37428]"></i>
                </div>
                <h2 class="text-2xl font-bold text-white relative z-10 uppercase tracking-widest">Registrasi Pelanggan</h2>
                <p class="text-amber-200/60 text-sm italic mt-1 relative z-10 font-medium">
                    "Lengkapi data diri pelanggan dengan teliti"
                </p>
            </div>

            <form action="{{ route('admin.pelanggan.store') }}" method="POST" class="p-10 space-y-6">
                @csrf

                <div>
                    <label class="block text-[#2B2118] font-bold text-sm uppercase tracking-widest mb-3">Nama
                        Lengkap</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-[#B37428]">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" name="nama_pelanggan"
                            class="w-full bg-orange-50/30 border-2 border-gray-100 pl-12 pr-4 py-4 rounded-2xl focus:border-[#B37428] focus:bg-white outline-none transition-all duration-300 font-medium text-[#2B2118]"
                            placeholder="Contoh: Siti Rahmawati" required>
                    </div>
                </div>

                <div>
                    <label class="block text-[#2B2118] font-bold text-sm uppercase tracking-widest mb-3">Nomor
                        WhatsApp</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-[#B37428]">
                            <i class="fab fa-whatsapp text-lg font-bold"></i>
                        </span>
                        <input type="text" name="no_hp"
                            class="w-full bg-orange-50/30 border-2 border-gray-100 pl-12 pr-4 py-4 rounded-2xl focus:border-[#B37428] focus:bg-white outline-none transition-all duration-300 font-medium text-[#2B2118]"
                            placeholder="081234567890" required>
                    </div>
                </div>

                <div>
                    <label class="block text-[#2B2118] font-bold text-sm uppercase tracking-widest mb-3">Alamat
                        Domisili</label>
                    <div class="relative">
                        <span class="absolute top-4 left-4 text-[#B37428]">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <textarea name="alamat" rows="4"
                            class="w-full bg-orange-50/30 border-2 border-gray-100 pl-12 pr-4 py-4 rounded-2xl focus:border-[#B37428] focus:bg-white outline-none transition-all duration-300 font-medium text-[#2B2118]"
                            placeholder="Masukkan alamat lengkap pelanggan saat ini..." required></textarea>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-4 pt-6">
                    <button type="submit"
                        class="flex-1 bg-[#2B2118] text-white font-bold py-5 rounded-2xl hover:bg-[#B37428] transition-all duration-300 shadow-xl shadow-amber-900/20 flex items-center justify-center gap-3 group">
                        <i class="fas fa-save group-hover:scale-110 transition-transform"></i>
                        Simpan Data Pelanggan
                    </button>
                    <a href="{{ route('admin.pelanggan.index') }}"
                        class="px-10 py-5 bg-gray-100 text-gray-500 font-bold rounded-2xl hover:bg-gray-200 transition-all duration-300 text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
