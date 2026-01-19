@extends('layouts.admin')

@section('content')
    <div class="p-8">
        <div class="bg-[#2B2118] rounded-t-[2rem] p-8 text-center border-b-4 border-[#B37428]">
            <h1 class="text-3xl font-black text-white uppercase tracking-tighter">Proses Pengembalian Busana</h1>
            <p class="text-amber-200/60 text-xs uppercase tracking-[0.2em] mt-2 font-bold italic">"Denda dihitung otomatis
                berdasarkan hari keterlambatan"</p>
        </div>

        <div class="bg-white rounded-b-[2.5rem] shadow-2xl overflow-hidden p-10">
            <form action="{{ route('admin.pengembalian.store') }}" method="POST" class="space-y-8">
                @csrf
                <input type="hidden" name="id_penyewaan" value="{{ $penyewaan->id_penyewaan }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-6">
                        <h3 class="text-[#B37428] font-black uppercase text-xs tracking-widest border-b pb-2">Detail
                            Transaksi</h3>

                        <div>
                            <label class="block text-[#2B2118] text-[10px] font-black uppercase mb-2 ml-1">Pelanggan</label>
                            <div
                                class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl font-bold text-[#2B2118]">
                                {{ $penyewaan->nama_pelanggan }} </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[#2B2118] text-[10px] font-black uppercase mb-2 ml-1">Batas
                                    Kembali</label>
                                <input type="date" id="tgl_rencana" value="{{ $penyewaan->tanggal_kembali_rencana }}"
                                    class="w-full px-6 py-4 bg-red-50 border-2 border-red-100 rounded-2xl font-bold text-red-600 outline-none"
                                    readonly>
                            </div>
                            <div>
                                <label class="block text-[#2B2118] text-[10px] font-black uppercase mb-2 ml-1">Tgl Kembali
                                    (Realitas)</label>
                                <input type="date" id="tgl_kembali_real" name="tanggal_kembali"
                                    value="{{ date('Y-m-d') }}"
                                    class="w-full px-6 py-4 bg-orange-50/30 border-2 border-gray-100 rounded-2xl focus:border-[#B37428] focus:outline-none font-bold">
                            </div>
                        </div>

                        <div id="info_terlambat"
                            class="hidden animate-pulse bg-red-600 text-white p-4 rounded-2xl text-xs font-black uppercase text-center">
                            Terlambat <span id="jumlah_hari">0</span> Hari!
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h3 class="text-[#B37428] font-black uppercase text-xs tracking-widest border-b pb-2">Validasi
                            Kondisi</h3>

                        <div>
                            <label class="block text-[#2B2118] text-[10px] font-black uppercase mb-2 ml-1">Total Denda
                                (Otomatis)</label>
                            <div class="relative group">
                                <span
                                    class="absolute inset-y-0 left-0 flex items-center pl-4 text-[#B37428] font-black">Rp</span>
                                <input type="number" id="input_denda" name="denda" value="0"
                                    class="w-full pl-12 pr-4 py-4 bg-orange-50/30 border-2 border-gray-100 rounded-2xl focus:border-[#B37428] focus:outline-none font-bold text-[#2B2118]">
                            </div>
                            <p class="text-[9px] text-gray-400 mt-2 ml-1">*Denda: Rp 10.000 / hari keterlambatan</p>
                        </div>

                        <div>
                            <label class="block text-[#2B2118] text-[10px] font-black uppercase mb-2 ml-1">Keterangan
                                Kondisi</label>
                            <textarea name="keterangan" rows="3" placeholder="Catatan tambahan..."
                                class="w-full px-6 py-4 bg-orange-50/30 border-2 border-gray-100 rounded-2xl focus:border-[#B37428] focus:outline-none font-medium text-sm"></textarea>
                        </div>
                    </div>
                </div>

                <div class="pt-10 flex gap-4">
                    <a href="{{ route('admin.penyewaan.index') }}"
                        class="flex-1 bg-gray-100 text-gray-500 font-black py-5 rounded-2xl text-center text-xs tracking-widest uppercase">Batal</a>
                    <button type="submit"
                        class="flex-[2] bg-[#2B2118] text-white font-black py-5 rounded-2xl shadow-xl hover:bg-[#B37428] transition-all flex items-center justify-center gap-3 text-xs tracking-[0.2em]">
                        KONFIRMASI PENGEMBALIAN
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tglRencana = document.getElementById('tgl_rencana');
            const tglKembali = document.getElementById('tgl_kembali_real');
            const inputDenda = document.getElementById('input_denda');
            const infoTerlambat = document.getElementById('info_terlambat');
            const jumlahHariText = document.getElementById('jumlah_hari');

            function hitungDenda() {
                const d1 = new Date(tglRencana.value);
                const d2 = new Date(tglKembali.value);

                const diffTime = d2 - d1;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if (diffDays > 0) {
                    const dendaPerHari = 10000; 
                    inputDenda.value = diffDays * dendaPerHari;

                    infoTerlambat.classList.remove('hidden');
                    jumlahHariText.innerText = diffDays;
                } else {
                    inputDenda.value = 0;
                    infoTerlambat.classList.add('hidden');
                }
            }

            hitungDenda();

            tglKembali.addEventListener('change', hitungDenda);
        });
    </script>
@endsection
