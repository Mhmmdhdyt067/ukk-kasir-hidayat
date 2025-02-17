<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::all();
        return view('produk.index', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'NamaProduk' => 'required|string|max:255',
            'Harga' => 'required|numeric',
            'Stok' => 'required|integer',
        ]);

        Produk::create($request->all());
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'NamaProduk' => 'required|string|max:255',
            'Harga' => 'required|numeric',
            'Stok' => 'required|integer',
        ]);

        $produk->update($request->all());

        return redirect('/produk')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect('/produk')->with('success', 'Produk berhasil dihapus!');
    }
}
