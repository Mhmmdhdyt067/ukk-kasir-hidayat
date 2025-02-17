@extends('layout.app')

@section('content')
<div class="container my-3">
    <h2 class="text-center">Detail Penjualan {{ $penjualan->PenjualanID }}</h2>
    <table style="font-family: Arial, sans-serif; font-size: 18px; margin-bottom: 20px;">
        <thead>
            <tr>
                <th style="width: 25%; height:35px; font-family: 'Arial', sans-serif; padding-bottom: 1px">Nama Pelanggan</th>
                <th style="padding-bottom: 1px">: {{ $penjualan->pelanggan->NamaPelanggan }}</th>
            </tr>
            <tr>
                <th style="width: 25%;height:35px; padding-bottom: 1px">Tanggal</th>
                <th style="padding-bottom: 1px">: {{ \Carbon\Carbon::parse($penjualan->TanggalPenjualan)->translatedFormat('l, d F Y') }}
                </th>
            </tr>
            <tr>
                <th style="width: 25%;height:35px; padding-bottom: 1px">Total Harga</th>
                <th style="padding-bottom: 1px">: Rp {{ number_format($penjualan->TotalHarga, 0, ',', '.') }}</th>
            </tr>
        </thead>
    </table>

    <h4>Produk yang Terjual</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah Produk</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualan->details as $detail)
            <tr>
                <td>{{ $detail->produk->NamaProduk }}</td>
                <td>{{ $detail->JumlahProduk }}</td>
                <td>Rp {{ number_format($detail->produk->Harga, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($detail->Subtotal, 0, ',', '.') }}</td>
                <td>
                    <button class="btn btn-sm btn-clean btn-icon btn-delete" data-id="{{ $detail->DetailID }}" data-nama="{{ $detail->produk->NamaProduk }}" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>

    <h4>Tambah Produk</h4>
    <form action="{{ route('detail-penjualan.update', $penjualan->PenjualanID) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Produk</label>
            <select name="ProdukID" class="form-control">
                @foreach($produks as $produk)
                <option value="{{ $produk->ProdukID }}">{{ $produk->NamaProduk }} (Stok: {{ $produk->Stok }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="JumlahProduk" class="form-control" min="1" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus <b id="deleteNamaProduk"></b>?</p>
                    <input type="hidden" id="deleteProdukID" name="PelangganID">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.btn-delete').click(function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');

            $('#deleteNamaProduk').text(nama);
            $('#deleteProdukID').val(id);
            $('#deleteForm').attr('action', '/detail-penjualan/' + id); // Update action form

            $('#deleteModal').modal('show');
        });
    });
</script>
@endsection