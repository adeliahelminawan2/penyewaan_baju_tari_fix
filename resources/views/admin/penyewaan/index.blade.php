@extends('layouts.admin')

@section('content')
    <div class="p-8">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-4xl font-black text-[#2B2118] tracking-tight uppercase">Data Penyewaan</h1>
                <p class="text-gray-500 font-medium mt-1">Kelola inventaris kostum tari dan baju adat secara real-time.</p>
            </div>
            <a href="{{ route('admin.penyewaan.create') }}"
                class="bg-[#2B2118] text-white px-8 py-4 rounded-2xl font-bold shadow-xl hover:bg-[#B37428] transition-all flex items-center gap-3">
                <span class="text-xl">+</span> Tambah Penyewaan
            </a>
        </div>

        @if (session('success'))
            <div id="success-alert"
                class="bg-green-500 text-white p-5 rounded-[1.5rem] mb-8 shadow-lg font-bold text-center animate-pulse">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-[3rem] shadow-2xl border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#2B2118] text-white">
                        <th class="p-7 text-[11px] font-black uppercase tracking-[0.2em]">Kode & Pelanggan</th>
                        <th class="p-7 text-[11px] font-black uppercase tracking-[0.2em]">Koleksi Busana</th>
                        <th class="p-7 text-[11px] font-black uppercase tracking-[0.2em] text-center">Status</th>
                        <th class="p-7 text-[11px] font-black uppercase tracking-[0.2em]">Catatan Kembali</th>
                        <th class="p-7 text-[11px] font-black uppercase tracking-[0.2em] text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($penyewaan as $item)
                        <tr class="hover:bg-orange-50/30 transition-colors">
                            <td class="p-7">
                                <div class="font-black text-[#2B2118] text-lg">{{ $item->kode_sewa }}</div>
                                <div class="text-[#B37428] font-bold text-sm uppercase mt-1 italic">
                                    {{ $item->nama_pelanggan }}
                            </td>

                            <td class="p-7">
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($item->details as $d)
                                        <span
                                            class="bg-gray-100 text-[#2B2118] px-3 py-1.5 rounded-lg text-xs font-bold border border-gray-200">
                                            {{ $d->baju->nama_baju }} <span class="text-[#B37428] ml-1">({{ $d->jumlah }}
                                                Pcs)</span>
                                        </span>
                                    @endforeach
                                </div>
                            </td>

                            <td class="p-7 text-center">
                                @if ($item->status == 'disewa')
                                    <span
                                        class="bg-orange-100 text-orange-600 px-5 py-2 rounded-full text-[10px] uppercase font-black tracking-widest border border-orange-200">
                                        Dalam Sewa
                                    </span>
                                @else
                                    <span
                                        class="bg-green-100 text-green-600 px-5 py-2 rounded-full text-[10px] uppercase font-black tracking-widest border border-green-200">
                                        Sudah Kembali
                                    </span>
                                @endif
                            </td>

                            <td class="p-7">
                                @if ($item->status == 'dikembalikan' || ($item->status == 'KEMBALI' && $item->pengembalian))
                                    <div class="text-xs font-bold text-gray-500 leading-relaxed italic">
                                        "{{ $item->pengembalian->keterangan ?? 'Kondisi Baik' }}"
                                    </div>
                                    @if ($item->pengembalian->denda > 0)
                                        <div
                                            class="inline-block mt-2 bg-red-50 text-red-600 px-2 py-1 rounded text-[10px] font-black border border-red-100">
                                            DENDA: Rp {{ number_format($item->pengembalian->denda, 0, ',', '.') }}
                                        </div>
                                    @endif
                                @else
                                    <span class="text-gray-300 font-bold italic text-xs">Belum ada catatan</span>
                                @endif
                            </td>

                            <td class="p-7 text-center">
                                <div class="flex justify-center gap-3">
                                    @if ($item->status == 'disewa')
                                        <a href="{{ route('admin.pengembalian.create', $item->id_penyewaan) }}"
                                            class="bg-[#B37428] text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase shadow-md hover:scale-105 transition-transform">
                                            Proses Kembali
                                        </a>
                                    @else
                                        <a href="{{ route('admin.penyewaan.nota', $item->id_penyewaan) }}" target="_blank"
                                            class="bg-[#2B2118] text-white p-2.5 rounded-xl hover:bg-blue-600 transition-colors shadow-md"
                                            title="Cetak Nota">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.transition = "all 0.8s ease";
                    alert.style.opacity = "0";
                    alert.style.transform = "translateY(-20px)";
                    setTimeout(() => alert.remove(), 800);
                }, 3000);
            }
        });
    </script>
@endsection
