<?php

namespace App\Http\Controllers;

use App\Models\Baju;
use App\Models\Pengembalian;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function create($id)
    {
        $penyewaan = Penyewaan::with(['details.baju'])
            ->findOrFail($id);

        return view('admin.pengembalian.create', compact('penyewaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penyewaan' => 'required|exists:penyewaan,id_penyewaan',
            'tanggal_kembali' => 'required|date',
            'denda' => 'nullable|numeric|min:0',
            'pelunasan' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $penyewaan = Penyewaan::findOrFail($request->id_penyewaan);
            $denda = $request->denda ?? 0;
            $pelunasan = $request->pelunasan ?? 0;

            DB::table('pengembalian')->insert([
                'id_penyewaan' => $request->id_penyewaan,
                'tanggal_kembali' => $request->tanggal_kembali,
                'denda' => $denda,
                'pelunasan' => $pelunasan,
                'keterangan' => $request->keterangan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Jika ada denda, tambahkan ke total_harga penyewaan
            if ($denda > 0) {
                $penyewaan->increment('total_harga', $denda);
            }

            // Tambahkan pelunasan ke total_bayar penyewaan
            if ($pelunasan > 0) {
                $penyewaan->increment('total_bayar', $pelunasan);
            }

            $penyewaan->update(['status' => 'dikembalikan']);

            foreach ($penyewaan->details as $detail) {
                $baju = Baju::find($detail->id_baju);
                if ($baju) {
                    $baju->increment('stok', $detail->jumlah);
                }
            }

            DB::commit();

            return redirect()->route('admin.penyewaan.index')->with('success', 'Berhasil! Baju telah kembali dan stok diperbarui.');

        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', 'Gagal: '.$e->getMessage());
        }
    }
}
