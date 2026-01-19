@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto p-4">

        @if ($errors->any())
            <div class="bg-red-500 text-white p-5 mb-6 rounded-[2rem] shadow-lg border-b-4 border-red-700 animate-pulse">
                <div class="flex items-center mb-2">
                    <i class="fas fa-exclamation-circle text-xl mr-3"></i>
                    <p class="font-black uppercase tracking-wider text-sm">Ada kesalahan input:</p>
                </div>
                <ul class="list-disc ml-8 text-xs font-bold opacity-90">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-orange-600 text-white p-5 mb-6 rounded-[2rem] shadow-lg border-b-4 border-orange-800">
                <div class="flex items-center">
                    <i class="fas fa-database text-xl mr-3"></i>
                    <p class="font-bold text-sm italic">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-[2.5rem] shadow-2xl border border-gray-100 overflow-hidden">
            <div class="bg-[#2B2118] p-8 text-center relative">
                <div class="absolute left-6 top-1/2 -translate-y-1/2 opacity-20">
                    <i class="fas fa-file-invoice text-5xl text-white"></i>
                </div>
                <h2 class="text-white text-2xl font-black tracking-widest uppercase">Transaksi Sewa Baru</h2>
                <p class="text-amber-200/60 text-[10px] font-bold tracking-[0.3em] uppercase mt-1">
                    "Ketikkan nama pelanggan dan pilih busana"
                </p>
            </div>

            <div class="p-8 md:p-12">
                <form action="{{ route('admin.penyewaan.store') }}" method="POST">
                    @csrf

                    <div class="space-y-8">
                        <div>
                            <label class="block text-[#2B2118] text-[10px] font-black uppercase tracking-[0.2em] mb-3 ml-1">
                                Nama Pelanggan
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-[#B37428]">
                                    <i class="fas fa-user-edit"></i>
                                </span>
                                <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}"
                                    placeholder="Ketik Nama Lengkap Penyewa..."
                                    class="w-full pl-12 pr-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-[#B37428] focus:bg-white outline-none transition-all font-bold text-[#2B2118]"
                                    required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-[#2B2118] text-[10px] font-black uppercase tracking-[0.2em] mb-3 ml-1">
                                    Tanggal Sewa
                                </label>
                                <input type="date" name="tanggal_sewa" value="{{ old('tanggal_sewa', date('Y-m-d')) }}"
                                    class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-[#B37428] outline-none font-bold text-[#2B2118]"
                                    required>
                            </div>
                            <div>
                                <label
                                    class="block text-red-600 text-[10px] font-black uppercase tracking-[0.2em] mb-3 ml-1">
                                    Rencana Kembali
                                </label>
                                <input type="date" name="tanggal_kembali_rencana"
                                    value="{{ old('tanggal_kembali_rencana') }}"
                                    class="w-full px-6 py-4 bg-gray-50 border-2 border-red-100 rounded-2xl focus:border-red-500 outline-none font-bold text-red-600"
                                    required>
                            </div>
                        </div>

                        <div class="p-6 bg-orange-50/50 rounded-[2.5rem] border border-orange-100">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="md:col-span-2">
                                    <label
                                        class="block text-[#B37428] text-[10px] font-black uppercase tracking-[0.2em] mb-3 ml-1">
                                        Busana / Kostum
                                    </label>
                                    <select name="id_baju"
                                        class="w-full px-6 py-4 bg-white border-2 border-gray-100 rounded-2xl focus:border-[#B37428] outline-none font-bold text-[#2B2118]"
                                        required>
                                        <option value="" disabled selected>-- Pilih Baju --</option>
                                        @foreach ($bajus as $b)
                                            <option value="{{ $b->id_baju }}"
                                                {{ old('id_baju') == $b->id_baju ? 'selected' : '' }}>
                                                {{ $b->nama_baju }} (Stok: {{ $b->stok }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label
                                        class="block text-[#B37428] text-[10px] font-black uppercase tracking-[0.2em] mb-3 ml-1">
                                        Jumlah
                                    </label>
                                    <input type="number" name="jumlah" min="1" value="{{ old('jumlah', 1) }}"
                                        class="w-full px-6 py-4 bg-white border-2 border-gray-100 rounded-2xl focus:border-[#B37428] outline-none font-bold text-[#2B2118]"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row gap-4 pt-4">
                            <button type="submit"
                                class="flex-[2] bg-[#2B2118] text-white font-black py-5 rounded-2xl shadow-xl hover:bg-[#B37428] hover:shadow-amber-900/40 transition-all duration-300 uppercase text-xs tracking-[0.2em] flex items-center justify-center">
                                <i class="fas fa-save mr-2"></i> Simpan Transaksi
                            </button>
                            <a href="{{ route('admin.penyewaan.index') }}"
                                class="flex-1 bg-gray-100 text-gray-500 font-bold py-5 rounded-2xl text-center hover:bg-gray-200 transition-all uppercase text-xs tracking-widest flex items-center justify-center">
                                Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
