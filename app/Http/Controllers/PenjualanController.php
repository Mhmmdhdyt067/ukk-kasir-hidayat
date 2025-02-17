<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penjualan::query()->with('pelanggan');

        // Filter berdasarkan tanggal jika ada input
        if ($request->filled('tanggal')) {
            $query->whereDate('TanggalPenjualan', $request->tanggal);
        }

        // Filter berdasarkan pelanggan jika ada input
        if ($request->filled('pelanggan_id')) {
            $query->where('PelangganID', $request->pelanggan_id);
        }

        // Filter berdasarkan total harga (termahal/termurah)
        if ($request->filled('sort_harga')) {
            $query->orderBy('TotalHarga', $request->sort_harga);
        }

        $penjualans = $query->get();
        $pelanggans = Pelanggan::all();

        return view('penjualan.index', compact('penjualans', 'pelanggans'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'TanggalPenjualan' => 'required|date',
            'PelangganID' => 'required|exists:pelanggan,PelangganID',
        ]);

        Penjualan::create([
            'TanggalPenjualan' => $request->TanggalPenjualan,
            'PelangganID' => $request->PelangganID,
            'TotalHarga' => 0, // Total dihitung dari detail penjualan nanti
        ]);

        return redirect('/penjualan')->with('success', 'Penjualan berhasil ditambahkan!');
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'TanggalPenjualan' => 'required|date',
            'PelangganID' => 'required|exists:pelanggan,PelangganID',
        ]);

        $penjualan->update($request->all());

        return redirect('/penjualan')->with('success', 'Penjualan berhasil diperbarui!');
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();

        return redirect('/penjualan')->with('success', 'Penjualan berhasil dihapus!');
    }
}
