<?php

namespace App\Http\Controllers;

use App\Models\Baju;
use App\Models\DetailPenyewaan;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PenyewaanController extends Controller
{
    public function index()
    {
        $penyewaan = Penyewaan::with(['details.baju', 'pengembalian'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.penyewaan.index', compact('penyewaan'));
    }

    public function create()
    {
        $bajus = Baju::where('stok', '>', 0)->get();

        return view('admin.penyewaan.create', compact('bajus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'id_baju' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali_rencana' => 'required|date',
        ]);

        try {
            DB::beginTransaction();

            $baju = Baju::findOrFail($request->id_baju);
            if ($baju->stok < $request->jumlah) {
                return back()->with('error', 'Stok tidak mencukupi!')->withInput();
            }

            $kodeSewa = 'INV-'.date('Ymd').'-'.strtoupper(Str::random(4));

            $penyewaan = Penyewaan::create([
                'kode_sewa' => $kodeSewa,
                'nama_pelanggan' => $request->nama_pelanggan,
                'tanggal_sewa' => $request->tanggal_sewa,
                'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
                'status' => 'DISEWA',
            ]);

            $subtotal = $baju->harga_sewa * $request->jumlah;

            DetailPenyewaan::create([
                'id_penyewaan' => $penyewaan->id_penyewaan,
                'id_baju' => $request->id_baju,
                'jumlah' => $request->jumlah,
                'harga_sewa' => $baju->harga_sewa,
                'subtotal' => $subtotal,
            ]);

            $baju->decrement('stok', $request->jumlah);

            DB::commit();

            return redirect()->route('admin.penyewaan.index')
                ->with('success', 'Transaksi berhasil disimpan! Kode: '.$kodeSewa);

        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', 'Terjadi kesalahan: '.$e->getMessage())->withInput();
        }
    }

    // Fungsi untuk menampilkan Histori Detail
    public function show($id)
    {
        $penyewaan = Penyewaan::with(['details.baju', 'pengembalian'])
            ->findOrFail($id);

        return view('admin.penyewaan.show', compact('penyewaan'));
    }

    public function cetakNota($id)
    {
        $penyewaan = Penyewaan::with(['details.baju'])->findOrFail($id);

        return view('admin.penyewaan.nota', compact('penyewaan'));
    }
}
