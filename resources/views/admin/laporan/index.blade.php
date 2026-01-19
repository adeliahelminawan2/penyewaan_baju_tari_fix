@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="flex no-print" style="justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <h1 style="font-size: 2rem; font-weight: 900; color: #2B2118; margin: 0;">Laporan Penyewaan</h1>
                <p style="color: #6b7280;">Tinjau histori transaksi dan total pendapatan Busana Laras secara real-time.</p>
            </div>

            <button onclick="window.print()" class="no-print"
                style="background: #B37428; color: white; padding: 10px 20px; border-radius: 12px; border: none; font-weight: bold; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: 0.3s; box-shadow: 0 4px 14px rgba(179, 116, 40, 0.3);">
                <i class="fas fa-print"></i> Cetak Laporan
            </button>
        </div>

        <div class="flex" style="gap: 20px; margin-bottom: 2rem;">
            <div
                style="background: white; padding: 25px; border-radius: 25px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); flex: 1; border-left: 6px solid #B37428;">
                <p
                    style="color: #6b7280; margin: 0; font-weight: bold; font-size: 0.8rem; text-transform: uppercase; tracking: 0.1em;">
                    Total Transaksi</p>
                <h3 style="margin: 10px 0 0 0; font-size: 1.8rem; color: #2B2118; font-weight: 900;">{{ $laporan->count() }}
                    <span style="font-size: 1rem; color: #9ca3af; font-weight: normal;">Sewa</span></h3>
            </div>

            <div
                style="background: white; padding: 25px; border-radius: 25px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); flex: 1; border-left: 6px solid #2B2118;">
                <p
                    style="color: #6b7280; margin: 0; font-weight: bold; font-size: 0.8rem; text-transform: uppercase; tracking: 0.1em;">
                    Total Omzet</p>
                <h3 style="margin: 10px 0 0 0; font-size: 1.8rem; color: #B37428; font-weight: 900;">
                    Rp {{ number_format($grandTotal, 0, ',', '.') }}
                </h3>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-sm no-print" style="margin-bottom: 2rem; border: 1px solid #f3f4f6;">
            <form action="{{ route('admin.laporan.index') }}" method="GET" class="flex"
                style="gap: 1.5rem; align-items: flex-end;">
                <div style="flex: 1;">
                    <label
                        style="display: block; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; margin-bottom: 10px; color: #2B2118; tracking: 0.1em;">Dari
                        Tanggal</label>
                    <input type="date" name="tgl_mulai" value="{{ request('tgl_mulai') }}"
                        style="width: 100%; padding: 14px; border-radius: 15px; border: 1px solid #eee; background: #fcfcfc; color: #2B2118; font-weight: 600;">
                </div>
                <div style="flex: 1;">
                    <label
                        style="display: block; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; margin-bottom: 10px; color: #2B2118; tracking: 0.1em;">Sampai
                        Tanggal</label>
                    <input type="date" name="tgl_selesai" value="{{ request('tgl_selesai') }}"
                        style="width: 100%; padding: 14px; border-radius: 15px; border: 1px solid #eee; background: #fcfcfc; color: #2B2118; font-weight: 600;">
                </div>
                <div class="flex" style="gap: 10px;">
                    <button type="submit"
                        style="background: #2B2118; color: white; padding: 14px 30px; border-radius: 15px; border: none; font-weight: 800; cursor: pointer; transition: 0.3s; text-transform: uppercase; font-size: 0.75rem;">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <a href="{{ route('admin.laporan.index') }}"
                        style="background: #f3f4f6; color: #4b5563; padding: 14px 20px; border-radius: 15px; text-decoration: none; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; display: flex; align-items: center;">Reset</a>
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-[2.5rem] border border-gray-100 shadow-xl bg-white">
            <table class="w-full text-left" style="border-collapse: separate; border-spacing: 0;">
                <thead>
                    <tr class="bg-[#2B2118] text-white">
                        <th class="px-8 py-6 uppercase text-[10px] font-black tracking-[0.2em]">No. Nota</th>
                        <th class="px-8 py-6 uppercase text-[10px] font-black tracking-[0.2em]">Pelanggan</th>
                        <th class="px-8 py-6 uppercase text-[10px] font-black tracking-[0.2em]">Tanggal Sewa</th>
                        <th class="px-8 py-6 uppercase text-[10px] font-black tracking-[0.2em] text-right">Total Bayar</th>
                        <th class="px-8 py-6 uppercase text-[10px] font-black tracking-[0.2em] text-center no-print">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($laporan as $row)
                        <tr class="hover:bg-orange-50/30 transition-all group">
                            <td class="px-8 py-5">
                                <span class="font-black text-[#B37428] uppercase tracking-tighter text-sm">
                                    {{ $row->kode_sewa }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="font-black text-[#2B2118] uppercase text-sm">{{ $row->nama_pelanggan }}</div>
                                <div
                                    class="text-[9px] px-2 py-0.5 inline-block rounded-full font-bold uppercase tracking-widest mt-1 {{ $row->status == 'disewa' ? 'bg-orange-100 text-orange-600' : 'bg-green-100 text-green-600' }}">
                                    {{ $row->status }}
                                </div>
                            </td>
                            <td class="px-8 py-5 text-gray-500 font-bold text-sm">
                                {{ \Carbon\Carbon::parse($row->tanggal_sewa)->format('d M Y') }}
                            </td>
                            <td class="px-8 py-5 text-right">
                                <span class="font-black text-[#2B2118] text-base">
                                    Rp
                                    {{ number_format($row->calculated_total ?? $row->details->sum('subtotal'), 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-center no-print">
                                <a href="{{ route('admin.penyewaan.show', $row->id_penyewaan) }}"
                                    class="inline-flex items-center justify-center w-11 h-11 bg-gray-50 text-[#2B2118] rounded-2xl hover:bg-[#2B2118] hover:text-white transition-all shadow-sm border border-gray-100"
                                    title="Lihat Histori Lengkap">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-10 text-center text-gray-400 font-bold italic">
                                Tidak ada data transaksi untuk periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50/80">
                        <td colspan="3"
                            class="px-8 py-8 text-center font-black uppercase text-[11px] tracking-[0.3em] text-gray-400">
                            Ringkasan Pendapatan</td>
                        <td class="px-8 py-8 text-right font-black text-[#B37428] text-2xl">
                            Rp {{ number_format($grandTotal, 0, ',', '.') }}
                        </td>
                        <td class="no-print"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
                padding: 0 !important;
            }

            .container-fluid {
                width: 100% !important;
                padding: 0 !important;
            }

            .shadow-xl {
                box-shadow: none !important;
                border: 1px solid #000 !important;
            }

            .rounded-[2.5rem],
            .rounded-[2rem] {
                border-radius: 0 !important;
            }

            th {
                background-color: #2B2118 !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
            }

            tr {
                border-bottom: 1px solid #eee !important;
            }
        }
    </style>
@endsection
