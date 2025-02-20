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
                <h3 class="card-label">Data Pelanggan
                    <span class="text-muted pt-2 font-size-sm d-block">List data pelanggan</span>
                </h3>
            </div>

            <button class="btn btn-sm btn-light-success font-weight-bold mr-2" data-toggle="modal" data-target="#addModal">Tambah Pelanggan</button>

        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable">
                <table class="datatable-table">
                    <thead class="datatable-head">
                        <tr class="datatable-row">
                            <th class="datatable-cell"><span style="width: 50px;">No</span></th>
                            <th class="datatable-cell"><span style="width: 170px;">Nama Pelanggan</span></th>
                            <th class="datatable-cell"><span style="width: 110px;">Alamat</span></th>
                            <th class="datatable-cell"><span style="width: 110px;">Nomor Telepon</span></th>
                            <th class="datatable-cell"><span style="width: 125px;">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="datatable-body">
                        @foreach ($pelanggans as $pelanggan)
                        <tr class="datatable-row">
                            <td class="datatable-cell"><span style="width: 50px;">{{ $loop->iteration }}</span></td>
                            <td class="datatable-cell"><span style="width: 170px;">{{ $pelanggan->NamaPelanggan }}</span></td>
                            <td class="datatable-cell"><span style="width: 110px;">{{ $pelanggan->Alamat }}</span></td>
                            <td class="datatable-cell"><span style="width: 110px;">{{ $pelanggan->NomorTelepon }}</span></td>
                            <td class="datatable-cell">
                                <button class="btn btn-icon btn-outline-success btn-edit" data-id="{{ $pelanggan->PelangganID }}" data-nama="{{ $pelanggan->NamaPelanggan }}" data-alamat="{{ $pelanggan->Alamat }}" data-telepon="{{ $pelanggan->NomorTelepon }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-icon btn-outline-danger btn-delete" data-id="{{ $pelanggan->PelangganID }}" data-nama="{{ $pelanggan->NamaPelanggan }}" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
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
                <h5 class="modal-title" id="editModalLabel">Edit Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editPelangganID" name="PelangganID">
                    <div class="form-group">
                        <label for="editNamaPelanggan">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="editNamaPelanggan" name="NamaPelanggan" required>
                    </div>
                    <div class="form-group">
                        <label for="editAlamat">Alamat</label>
                        <input type="text" class="form-control" id="editAlamat" name="Alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="editNomorTelepon">Nomor Telepon</label>
                        <input type="text" class="form-control" id="editNomorTelepon" name="NomorTelepon" required>
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
                    <p>Apakah Anda yakin ingin menghapus <b id="deleteNamaPelanggan"></b>?</p>
                    <input type="hidden" id="deletePelangganID" name="PelangganID">
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
                <h5 class="modal-title" id="addModalLabel">Tambah Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    @csrf
                    <div class="form-group">
                        <label for="addNamaPelanggan">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="addNamaPelanggan" required>
                    </div>
                    <div class="form-group">
                        <label for="addAlamat">Alamat</label>
                        <textarea class="form-control" id="addAlamat" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="addNomorTelepon">Nomor Telepon</label>
                        <input type="text" class="form-control" id="addNomorTelepon" required pattern="[0-9]+" title="Hanya angka diperbolehkan">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-light-success font-weight-bold mr-2" id="savePelanggan">Simpan</button>
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
            var alamat = $(this).data('alamat');
            var telepon = $(this).data('telepon');

            $('#editPelangganID').val(id);
            $('#editNamaPelanggan').val(nama);
            $('#editAlamat').val(alamat);
            $('#editNomorTelepon').val(telepon);

            $('#editForm').attr('action', '/pelanggan/' + id); // Update action form
            $('#editModal').modal('show');
        });

        // Menampilkan modal hapus dengan data pelanggan yang dipilih
        $('.btn-delete').click(function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');

            $('#deleteNamaPelanggan').text(nama);
            $('#deletePelangganID').val(id);
            $('#deleteForm').attr('action', '/pelanggan/' + id); // Update action form

            $('#deleteModal').modal('show');
        });

        $("#savePelanggan").click(function() {
            var data = {
                NamaPelanggan: $("#addNamaPelanggan").val(),
                Alamat: $("#addAlamat").val(),
                NomorTelepon: $("#addNomorTelepon").val(),
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                url: "/pelanggan",
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
