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
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'jaminan' => 'required|string|max:255',
            'id_baju' => 'required|array',
            'id_baju.*' => 'exists:baju,id_baju',
            'jumlah' => 'required|array',
            'jumlah.*' => 'integer|min:1',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali_rencana' => 'required|date',
            'total_bayar' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $items = [];
            $bajuIds = $request->id_baju;
            $jumlahs = $request->jumlah;
            $totalHarga = 0;

            foreach ($bajuIds as $index => $idBaju) {
                $jumlah = $jumlahs[$index];
                $baju = Baju::findOrFail($idBaju);
                
                if ($baju->stok < $jumlah) {
                    return back()->with('error', "Stok untuk {$baju->nama_baju} tidak mencukupi! (Sisa: {$baju->stok})")->withInput();
                }

                $subtotal = $baju->harga_sewa * $jumlah;
                $totalHarga += $subtotal;

                $items[] = [
                    'baju' => $baju,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal
                ];
            }

            $kodeSewa = 'INV-'.date('Ymd').'-'.strtoupper(Str::random(4));

            $penyewaan = Penyewaan::create([
                'kode_sewa' => $kodeSewa,
                'nama_pelanggan' => $request->nama_pelanggan,
                'no_hp' => $request->no_hp ?? '-',
                'alamat' => $request->alamat ?? '-',
                'jaminan' => $request->jaminan,
                'tanggal_sewa' => $request->tanggal_sewa,
                'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
                'total_harga' => $totalHarga,
                'total_bayar' => $request->total_bayar,
                'status' => 'disewa',
            ]);

            foreach ($items as $item) {
                $baju = $item['baju'];
                $jumlah = $item['jumlah'];
                $subtotal = $item['subtotal'];

                DetailPenyewaan::create([
                    'id_penyewaan' => $penyewaan->id_penyewaan,
                    'id_baju' => $baju->id_baju,
                    'jumlah' => $jumlah,
                    'harga_sewa' => $baju->harga_sewa,
                    'subtotal' => $subtotal,
                ]);

                $baju->decrement('stok', $jumlah);
            }

            DB::commit();

            return redirect()->route('admin.penyewaan.index')
                ->with('success', 'Transaksi berhasil disimpan! Kode: '.$kodeSewa);

        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', 'Terjadi kesalahan: '.$e->getMessage())->withInput();
        }
    }

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
