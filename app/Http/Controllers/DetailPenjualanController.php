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

        try {
            DB::beginTransaction();

            $produk = Produk::findOrFail($request->ProdukID);

            if ($produk->Stok < $request->JumlahProduk) {
                return back()->withErrors(['msg' => 'Stok tidak mencukupi!']);
            }

            $detail = DetailPenjualan::where('PenjualanID', $id)
                ->where('ProdukID', $request->ProdukID)
                ->first();

            $subtotal = $produk->Harga * $request->JumlahProduk;

            if ($detail) {
                $detail->increment('JumlahProduk', $request->JumlahProduk);
                $detail->increment('Subtotal', $subtotal);
            } else {
                DetailPenjualan::create([
                    'PenjualanID' => $id,
                    'ProdukID' => $request->ProdukID,
                    'JumlahProduk' => $request->JumlahProduk,
                    'Subtotal' => $subtotal,
                ]);
            }

            $produk->decrement('Stok', $request->JumlahProduk);

            $penjualan = Penjualan::findOrFail($id);
            $penjualan->increment('TotalHarga', $subtotal);

            DB::commit();

            return back()->with('success', 'Produk berhasil ditambahkan ke penjualan');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['success' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
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
