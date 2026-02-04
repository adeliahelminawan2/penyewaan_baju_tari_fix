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
        $penyewaan = Penyewaan::with(['details.baju', 'pelanggan'])
            ->findOrFail($id);

        return view('admin.pengembalian.create', compact('penyewaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_kembali' => 'required|date',
            'denda' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $penyewaan = Penyewaan::findOrFail($request->id_penyewaan);

            DB::table('pengembalian')->insert([
                'id_penyewaan' => $request->id_penyewaan,
                'tanggal_kembali' => $request->tanggal_kembali,
                'denda' => $request->denda ,
                'keterangan' => $request->keterangan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

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
