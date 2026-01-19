<?php

namespace App\Http\Controllers;

use App\Models\Baju;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BajuController extends Controller
{
    public function index()
    {
        $bajus = Baju::latest()->get();

        return view('admin.baju.index', compact('bajus'));
    }

    public function create()
    {
        return view('admin.baju.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_baju' => 'required',
            'harga_sewa' => 'required|numeric',
            'stok' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('baju', 'public');
        }

        Baju::create($data);

        return redirect()->route('admin.baju.index')->with('success', 'Baju berhasil ditambah!');
    }

    public function edit($id)
    {
        $baju = Baju::findOrFail($id);

        return view('admin.baju.edit', compact('baju'));
    }

    public function update(Request $request, $id)
    {
        $baju = Baju::findOrFail($id);

        $request->validate([
            'nama_baju' => 'required',
            'harga_sewa' => 'required|numeric',
            'stok' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($baju->foto && Storage::disk('public')->exists($baju->foto)) {
                Storage::disk('public')->delete($baju->foto);
            }
            $data['foto'] = $request->file('foto')->store('baju', 'public');
        }

        $baju->update($data);

        return redirect()->route('admin.baju.index')->with('success', 'Data baju berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $baju = Baju::findOrFail($id);
        $baju->delete();

        return redirect()->route('admin.baju.index')->with('success', 'Baju berhasil dihapus!');
    }
}
