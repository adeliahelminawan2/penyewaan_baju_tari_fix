@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto p-4">
        <div class="bg-white rounded-[2.5rem] shadow-2xl border border-gray-100 overflow-hidden">
            <div class="bg-[#2B2118] p-8 text-center">
                <h2 class="text-white text-xl font-black uppercase tracking-widest">Detail Transaksi</h2>
                <p class="text-amber-200/60 text-[10px] font-bold mt-1">{{ $penyewaan->kode_sewa }}</p>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-2 gap-8 mb-8 pb-8 border-b border-dashed border-gray-200">
                    <div>
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Penyewa</label>
                        <p class="text-[#2B2118] font-black uppercase text-lg">{{ $penyewaan->nama_pelanggan }}</p>
                    </div>
                    <div class="text-right">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Tanggal Sewa</label>
                        <p class="text-gray-600 font-bold">
                            {{ \Carbon\Carbon::parse($penyewaan->tanggal_sewa)->format('d M Y') }}</p>
                    </div>
                </div>

                <div class="space-y-4 mb-8">
                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest block mb-2">Koleksi
                        Busana</label>
                    @foreach ($penyewaan->details as $detail)
                        <div class="flex justify-between items-center bg-gray-50 p-4 rounded-2xl">
                            <div>
                                <p class="font-black text-[#2B2118] uppercase text-sm">{{ $detail->baju->nama_baju }}</p>
                                <p class="text-[10px] text-[#B37428] font-bold">{{ $detail->jumlah }} Pcs x Rp
                                    {{ number_format($detail->harga_sewa, 0, ',', '.') }}</p>
                            </div>
                            <p class="font-black text-[#2B2118]">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="bg-orange-50 p-6 rounded-[2rem] flex justify-between items-center mb-8">
                    <span class="font-black uppercase text-xs text-[#B37428]">Total Pembayaran</span>
                    <span class="text-2xl font-black text-[#2B2118]">Rp
                        {{ number_format($penyewaan->details->sum('subtotal'), 0, ',', '.') }}</span>
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('admin.laporan.index') }}"
                        class="flex-1 text-center py-4 bg-gray-100 text-gray-500 rounded-2xl font-bold uppercase text-[10px] tracking-widest hover:bg-gray-200 transition-all">Kembali
                        ke Laporan</a>
                    <button onclick="window.print()"
                        class="flex-1 py-4 bg-[#B37428] text-white rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-lg shadow-amber-900/20">Cetak
                        Nota</button>
                </div>
            </div>
        </div>
    </div>
@endsection
