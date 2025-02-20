@extends('layout.app')

@section('content')
<div class="container my-3">
    @if (session('success'))
    <div class="alert alert-custom alert-primary" role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning"></i>
        </div>
        <div class="alert-text">{{ session('success') }}</div>
    </div>
    @endif

    <form method="GET" action="{{ route('penjualan.index') }}">
        <div class="row align-content-center">
            <!-- Filter Tanggal -->
            <div class="col-md-3">
                <label>Tanggal:</label>
                <input type="date" class="form-control" name="tanggal" value="{{ request('tanggal') }}">
            </div>

            <!-- Filter Pelanggan -->
            <div class="col-md-3">
                <label>Pelanggan:</label>
                <select class="form-control" name="pelanggan_id">
                    <option value="">-- Semua --</option>
                    @foreach ($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->PelangganID }}"
                        {{ request('pelanggan_id') == $pelanggan->PelangganID ? 'selected' : '' }}>
                        {{ $pelanggan->NamaPelanggan }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Urutkan Total Harga -->
            <div class="col-md-3">
                <label>Urutkan Harga:</label>
                <select class="form-control" name="sort_harga">
                    <option value="">-- Pilih --</option>
                    <option value="asc" {{ request('sort_harga') == 'asc' ? 'selected' : '' }}>Termurah</option>
                    <option value="desc" {{ request('sort_harga') == 'desc' ? 'selected' : '' }}>Termahal</option>
                </select>
            </div>

            <!-- Tombol Filter -->
            <div class="col-md-3">
                <br>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Data Penjualan
                    <span class="text-muted pt-2 font-size-sm d-block">List transaksi penjualan</span>
                </h3>
            </div>
            <button class="btn btn-sm btn-light-success font-weight-bold mr-2" data-toggle="modal" data-target="#addModal">Tambah Penjualan</button>
        </div>
        <div class="card-body">
            <div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable">
                <table class="datatable-table">
                    <thead class="datatable-head">
                        <tr class="datatable-row">
                            <th class="datatable-cell"><span style="width: 50px;">No</span></th>
                            <th class="datatable-cell"><span style="width: 170px;">Tanggal</span></th>
                            <th class="datatable-cell"><span style="width: 110px;">Nama Pelanggan</span></th>
                            <th class="datatable-cell"><span style="width: 110px;">Total Harga</span></th>
                            <th class="datatable-cell"><span style="width: 170px;">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="datatable-body">
                        @foreach ($penjualans as $penjualan)
                        <tr class="datatable-row">
                            <td class="datatable-cell"><span style="width: 50px;">{{ $loop->iteration }}</span></td>
                            <td class="datatable-cell"><span style="width: 170px;">{{ \Carbon\Carbon::parse($penjualan->TanggalPenjualan)->translatedFormat('l, d F Y') }}</span></td>
                            <td class="datatable-cell"><span style="width: 110px;">{{ $penjualan->pelanggan->NamaPelanggan }}</span></td>
                            <td class="datatable-cell"><span style="width: 110px;">Rp. {{ number_format($penjualan->TotalHarga, 0, ',', '.') }}</span></td>
                            <td class="datatable-cell"><span style="width: 170px;">
                                    <a href="{{ route('detail-penjualan.edit', $penjualan->PenjualanID) }}" class="btn btn-sm btn-primary" title="Detail">Detail</a>
                                    <button class="btn btn-icon btn-outline-success btn-edit" data-id="{{ $penjualan->PenjualanID }}" data-tanggal="{{ $penjualan->TanggalPenjualan }}" data-pelanggan="{{ $penjualan->PelangganID }}" data-total="{{ $penjualan->TotalHarga }}" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-icon btn-outline-danger btn-delete" data-id="{{ $penjualan->PenjualanID }}" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Penjualan -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('penjualan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="TanggalPenjualan">Tanggal</label>
                        <input type="date" class="form-control" name="TanggalPenjualan" required>
                    </div>
                    <div class="form-group">
                        <label for="PelangganID">Pelanggan</label>
                        <select class="form-control" name="PelangganID">
                            @foreach ($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->PelangganID }}">{{ $pelanggan->NamaPelanggan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Penjualan -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editPenjualanID" name="PenjualanID">
                    <div class="form-group">
                        <label for="TanggalPenjualan">Tanggal</label>
                        <input type="date" class="form-control" id="editTanggalPenjualan" name="TanggalPenjualan" required>
                    </div>
                    <div class="form-group">
                        <label for="editPelangganID">Pelanggan</label>
                        <select class="form-control" id="editPelangganID" name="PelangganID">
                            @foreach ($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->PelangganID }}">{{ $pelanggan->NamaPelanggan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Penjualan -->
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus transaksi ini?</p>
                    <input type="hidden" id="deletePenjualanID" name="PenjualanID">
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
        $('.btn-edit').click(function() {
            var id = $(this).data('id');
            var tanggal = $(this).data('tanggal');
            var pelanggan = $(this).data('pelanggan');
            var total = $(this).data('total');

            $('#editPenjualanID').val(id);
            $('#editTanggalPenjualan').val(tanggal);
            $('#editPelangganID').val(pelanggan);
            $('#editTotalHarga').val(total);

            $('#editForm').attr('action', '/penjualan/' + id);
            $('#editModal').modal('show');
        });

        $('.btn-delete').click(function() {
            var id = $(this).data('id');
            $('#deletePenjualanID').val(id);
            $('#deleteForm').attr('action', '/penjualan/' + id);
            $('#deleteModal').modal('show');
        });
    });
</script>
@endsection
