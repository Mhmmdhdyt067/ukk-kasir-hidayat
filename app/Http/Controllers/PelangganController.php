<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggans = Pelanggan::all();
        return view('pelanggan.index', [
            'pelanggans' => $pelanggans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NamaPelanggan' => 'required|string|max:255',
            'Alamat' => 'required|string|max:255',
            'NomorTelepon' => 'required|numeric',
        ]);

        Pelanggan::create($request->all());

        return redirect('/pelanggan')->with('success', 'Berhasil Menambahkan Data Baru!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $pelanggan->update($request->all());

        return redirect('/pelanggan')->with('success', 'Berhasil Mengupdate Data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect('/pelanggan')->with('success', 'Berhasil Menghapus Data!');
    }
}
