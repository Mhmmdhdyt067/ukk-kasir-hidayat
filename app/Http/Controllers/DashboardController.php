<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;

class DashboardController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::all();
        $produks = Produk::all();
        $penjualans = Penjualan::all();
        $detailPenjualans = DetailPenjualan::sum('JumlahProduk');


        return view('dashboard.index', [
            'pelanggans' => $pelanggans,
            'produks' => $produks,
            'penjualans' => $penjualans,
            'detailPenjualans' => $detailPenjualans,
        ]);
    }
}
