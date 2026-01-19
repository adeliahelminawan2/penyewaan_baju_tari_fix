<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::latest()->get();

        return view('admin.pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp' => 'required|unique:pelanggan,no_hp',
            'alamat' => 'required',
        ], [
            'no_hp.unique' => 'Nomor HP ini sudah terdaftar!',
            'required' => 'Kolom ini wajib diisi.',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('admin.pelanggan.index')->with('success', 'Pelanggan baru berhasil ditambahkan!');
    }

    // --- FITUR EDIT ---
    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    // --- FITUR UPDATE ---
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp' => 'required|unique:pelanggan,no_hp,'.$id.',id_pelanggan',
            'alamat' => 'required',
        ], [
            'no_hp.unique' => 'Nomor HP ini sudah digunakan pelanggan lain!',
            'required' => 'Kolom :attribute tidak boleh kosong.',
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('admin.pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui!');
    }

    // --- FITUR DELETE ---
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        if ($pelanggan->penyewaans()->count() > 0) {
            return back()->with('error', 'Pelanggan tidak bisa dihapus karena memiliki riwayat transaksi!');
        }

        $pelanggan->delete();

        return redirect()->route('admin.pelanggan.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}
