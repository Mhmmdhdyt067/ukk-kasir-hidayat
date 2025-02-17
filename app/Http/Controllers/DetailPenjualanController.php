<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class DetailPenjualanController extends Controller
{

    public function edit($id)
    {
        $penjualan = Penjualan::with('details.produk')->findOrFail($id);
        $produks = Produk::all();

        return view('detailpenjualan.index', [
            'penjualan' => $penjualan,
            'produks' => $produks
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ProdukID' => 'required|exists:produk,ProdukID',
            'JumlahProduk' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $id) {
            $produk = Produk::findOrFail($request->ProdukID);

            if ($produk->Stok < $request->JumlahProduk) {
                return back()->withErrors(['msg' => 'Stok tidak mencukupi']);
            }

            // Cek apakah produk sudah ada di detail penjualan
            $detail = DetailPenjualan::where('PenjualanID', $id)
                ->where('ProdukID', $request->ProdukID)
                ->first();

            $subtotal = $produk->Harga * $request->JumlahProduk;

            if ($detail) {
                // Jika sudah ada, update jumlah dan subtotal
                $detail->increment('JumlahProduk', $request->JumlahProduk);
                $detail->increment('Subtotal', $subtotal);
            } else {
                // Jika belum ada, buat entri baru
                DetailPenjualan::create([
                    'PenjualanID' => $id,
                    'ProdukID' => $request->ProdukID,
                    'JumlahProduk' => $request->JumlahProduk,
                    'Subtotal' => $subtotal,
                ]);
            }

            // Kurangi stok produk
            $produk->decrement('Stok', $request->JumlahProduk);

            // Update total harga di penjualan
            $penjualan = Penjualan::findOrFail($id);
            $penjualan->increment('TotalHarga', $subtotal);
        });

        return back()->with('success', 'Detail penjualan ditambahkan!');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $detail = DetailPenjualan::findOrFail($id);
            $penjualan = Penjualan::findOrFail($detail->PenjualanID);
            $produk = Produk::findOrFail($detail->ProdukID);

            $produk->increment('Stok', $detail->JumlahProduk);
            $penjualan->decrement('TotalHarga', $detail->Subtotal);

            $detail->delete();
        });

        return back()->with('success', 'Produk dihapus dari detail penjualan!');
    }
}
