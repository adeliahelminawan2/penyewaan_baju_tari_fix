<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penyewaan::with(['details.baju']);

        if ($request->tgl_mulai && $request->tgl_selesai) {
            $query->whereBetween('tanggal_sewa', [$request->tgl_mulai, $request->tgl_selesai]);
        }

        $laporan = $query->orderBy('tanggal_sewa', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $grandTotal = $laporan->sum('total_harga');

        return view('admin.laporan.index', compact('laporan', 'grandTotal'));
    }
}
