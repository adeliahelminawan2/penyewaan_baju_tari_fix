@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-black text-[#2B2118] tracking-tight">Edit Koleksi Busana</h1>
                <p class="text-gray-500 mt-1 font-medium">Perbarui informasi detail kostum dan stok barang.</p>
            </div>
            <div class="w-16 h-1 bg-[#B37428] rounded-full"></div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-gray-200/50 overflow-hidden border border-gray-100">
            <div class="bg-[#2B2118] p-8 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <i class="fas fa-tshirt text-6xl text-[#B37428]"></i>
                </div>
                <h2 class="text-2xl font-bold text-white relative z-10 uppercase tracking-widest">Update Data Produk</h2>
                <p class="text-amber-200/60 text-sm italic mt-1 relative z-10 font-medium">
                    "Pastikan informasi harga dan stok selalu akurat"
                </p>
            </div>

            <form action="{{ route('admin.baju.update', $baju->id_baju) }}" method="POST" enctype="multipart/form-data"
                class="p-10 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-[#2B2118] font-bold text-sm uppercase tracking-widest mb-3">Nama Busana /
                        Kostum</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-[#B37428]">
                            <i class="fas fa-tshirt"></i>
                        </span>
                        <input type="text" name="nama_baju" value="{{ old('nama_baju', $baju->nama_baju) }}"
                            class="w-full bg-orange-50/30 border-2 border-gray-100 pl-12 pr-4 py-4 rounded-2xl focus:border-[#B37428] focus:bg-white outline-none transition-all duration-300 font-medium text-[#2B2118]"
                            placeholder="Contoh: Tari Piring Lengkap" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[#2B2118] font-bold text-sm uppercase tracking-widest mb-3">Harga Sewa
                            (Rp)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-[#B37428] font-bold">
                                Rp
                            </span>
                            <input type="number" name="harga_sewa" value="{{ old('harga_sewa', $baju->harga_sewa) }}"
                                class="w-full bg-orange-50/30 border-2 border-gray-100 pl-12 pr-4 py-4 rounded-2xl focus:border-[#B37428] focus:bg-white outline-none transition-all duration-300 font-medium text-[#2B2118]"
                                placeholder="50000" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[#2B2118] font-bold text-sm uppercase tracking-widest mb-3">Jumlah
                            Stok</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-[#B37428]">
                                <i class="fas fa-boxes"></i>
                            </span>
                            <input type="number" name="stok" value="{{ old('stok', $baju->stok) }}"
                                class="w-full bg-orange-50/30 border-2 border-gray-100 pl-12 pr-4 py-4 rounded-2xl focus:border-[#B37428] focus:bg-white outline-none transition-all duration-300 font-medium text-[#2B2118]"
                                placeholder="10" required>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-[2rem] border-2 border-dashed border-gray-200">
                    <label
                        class="block text-[#2B2118] font-bold text-sm uppercase tracking-widest mb-4 text-center">Manajemen
                        Foto</label>

                    <div class="flex flex-col md:flex-row items-center gap-6">
                        @if ($baju->foto)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $baju->foto) }}"
                                    class="w-32 h-40 object-cover rounded-2xl shadow-md border-4 border-white">
                                <div
                                    class="absolute inset-0 bg-black/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="text-white text-[10px] font-bold uppercase tracking-tighter">Foto Saat
                                        Ini</span>
                                </div>
                            </div>
                        @endif

                        <div class="flex-1 w-full">
                            <p class="text-xs text-gray-500 mb-2 font-medium italic">* Kosongkan jika tidak ingin mengganti
                                foto</p>
                            <input type="file" name="foto"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-2xl file:border-0 file:text-sm file:font-bold file:bg-[#B37428] file:text-white hover:file:bg-[#2B2118] file:transition-all"
                                accept="image/*">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-4 pt-6">
                    <button type="submit"
                        class="flex-1 bg-[#2B2118] text-white font-bold py-5 rounded-2xl hover:bg-[#B37428] transition-all duration-300 shadow-xl shadow-amber-900/20 flex items-center justify-center gap-3 group">
                        <i class="fas fa-sync-alt group-hover:rotate-180 transition-transform duration-500"></i>
                        Perbarui Koleksi
                    </button>
                    <a href="{{ route('admin.baju.index') }}"
                        class="px-10 py-5 bg-gray-100 text-gray-500 font-bold rounded-2xl hover:bg-gray-200 transition-all duration-300 text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
