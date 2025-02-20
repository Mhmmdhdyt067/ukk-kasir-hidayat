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
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Data Produk
                    <span class="text-muted pt-2 font-size-sm d-block">List data Produk</span>
                </h3>
            </div>

            <button class="btn btn-sm btn-light-success font-weight-bold mr-2" data-toggle="modal" data-target="#addModal">Tambah Produk</button>

        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable">
                <table class="datatable-table">
                    <thead class="datatable-head">
                        <tr class="datatable-row">
                            <th class="datatable-cell"><span style="width: 50px;">No</span></th>
                            <th class="datatable-cell"><span style="width: 170px;">Nama Produk</span></th>
                            <th class="datatable-cell"><span style="width: 110px;">Harga</span></th>
                            <th class="datatable-cell"><span style="width: 110px;">Stok</span></th>
                            <th class="datatable-cell"><span style="width: 125px;">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="datatable-body">
                        @foreach ($produks as $produk)
                        <tr class="datatable-row">
                            <td class="datatable-cell"><span style="width: 50px;">{{ $loop->iteration }}</span></td>
                            <td class="datatable-cell"><span style="width: 170px;">{{ $produk->NamaProduk }}</span></td>
                            <td class="datatable-cell"><span style="width: 110px;">Rp. {{ $produk->Harga }}</span></td>
                            <td class="datatable-cell"><span style="width: 110px;">{{ $produk->Stok }}</span></td>
                            <td class="datatable-cell"><span style="width: 125px;">
                                    <button class="btn btn-icon btn-outline-success btn-edit" data-id="{{ $produk->ProdukID }}" data-nama="{{ $produk->NamaProduk }}" data-harga="{{ $produk->Harga }}" data-stok="{{ $produk->Stok }}" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-icon btn-outline-danger btn-delete" data-id="{{ $produk->ProdukID }}" data-nama="{{ $produk->NamaProduk }}" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editProdukID" name="ProdukID">
                    <div class="form-group">
                        <label for="editNamaProduk">Nama Produk</label>
                        <input type="text" class="form-control" id="editNamaProduk" name="NamaProduk" required>
                    </div>
                    <div class="form-group">
                        <label for="editHarga">Harga</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                            <span class="input-group-btn input-group-prepend">
                            </span>
                            <input id="kt_touchspin_2" type="text" class="editHarga form-control" value="0" name="Harga" placeholder="Masukkan Harga">
                            <span class="input-group-btn input-group-append">
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editStok">Stok</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                            <input id="kt_touchspin_4" type="text" class="editStok form-control bootstrap-touchspin-vertical-btn" value="0" name="Stok" placeholder="Masukkan Stok">
                            <span class="input-group-btn-vertical">
                            </span>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
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
                    <input type="hidden" id="deleteProdukID" name="ProdukID">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    @csrf
                    <div class="form-group">
                        <label for="addNamaProduk">Nama Produk</label>
                        <input type="text" class="form-control" id="addNamaProduk" required>
                    </div>

                    <div class="form-group">
                        <label for="addHarga">Harga</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                            <span class="input-group-btn input-group-prepend">
                            </span>
                            <input id="kt_touchspin_2" type="text" class="addHarga form-control" name="Harga" placeholder="Masukkan Harga">
                            <span class="input-group-btn input-group-append">
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="addStok">Stok</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                            <input id="kt_touchspin_4" type="text" class="addStok form-control bootstrap-touchspin-vertical-btn" name="Stok" placeholder="Masukkan Stok">
                            <span class="input-group-btn-vertical">
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-light-success font-weight-bold mr-2" id="saveProduk">Simpan</button>
            </div>
        </div>
    </div>
</div>



<!-- JavaScript untuk modal -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Menampilkan modal edit dengan data pelanggan yang dipilih
        $('.btn-edit').click(function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var harga = $(this).data('harga');
            var stok = $(this).data('stok');

            $('#editProdukID').val(id);
            $('#editNamaProduk').val(nama);
            $('.editHarga').val(harga);
            $('.editStok').val(stok);

            $('#editForm').attr('action', '/produk/' + id); // Update action form
            $('#editModal').modal('show');
        });

        // Menampilkan modal hapus dengan data produk yang dipilih
        $('.btn-delete').click(function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');

            $('#deleteNamaProduk').text(nama);
            $('#deleteProdukID').val(id);
            $('#deleteForm').attr('action', '/produk/' + id); // Update action form

            $('#deleteModal').modal('show');
        });

        $("#saveProduk").click(function() {
            var data = {
                NamaProduk: $("#addNamaProduk").val(),
                Harga: $(".addHarga").val(),
                Stok: $(".addStok").val(),
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                url: "/produk",
                type: "POST",
                data: data,
                success: function(response) {
                    location.reload();
                }
            });
        });
    });



    // Handle Tambah Data
</script>
@endsection
