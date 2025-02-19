<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $penjualanData = DetailPenjualan::selectRaw('DATE(penjualan.TanggalPenjualan) as tanggal, SUM(detailpenjualan.JumlahProduk) as total_produk')
            ->join('penjualan', 'detailpenjualan.PenjualanID', '=', 'penjualan.PenjualanID')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get();

        // Pisahkan hasil query menjadi dua array
        $chartsprodukterjual = $penjualanData->pluck('total_produk')->toArray();
        $chartstanggalterjual = $penjualanData->map(function ($item) {
            return Carbon::parse($item->tanggal)->translatedFormat('l, d F Y');
        })->toArray();



        $pelanggans = Pelanggan::all();
        $produks = Produk::all();
        $penjualans = Penjualan::all();
        $detailPenjualans = DetailPenjualan::sum('JumlahProduk');


        return view('dashboard.index', [
            'pelanggans' => $pelanggans,
            'produks' => $produks,
            'penjualans' => $penjualans,
            'detailPenjualans' => $detailPenjualans,
            'chartsprodukterjual' => $chartsprodukterjual,
            'chartstanggalterjual' => $chartstanggalterjual,
            'penjualanData' => $penjualanData,
        ]);
    }
}
