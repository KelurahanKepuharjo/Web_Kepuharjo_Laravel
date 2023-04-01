@extends('layouts.mainlayout')
@section('title', 'Master User')
<!-- partial -->
@section('content')
<div class="header-atas">
    <h4>Halaman Master User</h4>
    <button data-toggle="modal" name='tambah' data-target="#modal-tambah">Tambah data</button>
</div>
<div class="table_wrapper" style="overflow-x: scroll;">
    <table id="myTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Lengkap</th>
                    <th>Tempat Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Pekerjaan</th>
                    <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <form action="" method="post">
                @foreach ($data as $no => $value)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $value->nik }}</td>
                        <td>{{ $value->nama_lengkap }}</td>
                        <td>{{ $value->tempat_lahir }}, {{ $value->tgl_lahir }}</td>
                        <td>{{ $value->jenis_kelamin }}</td>
                        <td>{{ $value->pekerjaan }}</td>
                        <td>
                            <a class="btn btn-success btn-sm btn-icon-text mr-3" data-id="{{ $value->nik }}"
                                href="" data-toggle="modal" data-target="#myModal">
                                Preview Data
                            </a>
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Master User</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Tempat, Tanggal Lahir </label>
                                                <input type="text" name="ttl" class="form-control" value=""
                                                    maxlength="50" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>Kartu Keluarga</label>
                                                <input type="hidden" id="idsurat" value="{{ $value->kelurahan }}" />

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="button" class="btn btn-Success">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <a class="btn btn-warning fa fa-pencil" href="" data-toggle="modal"
                                data-target="#modal-edit{{ $value->no_kk }}">
                                Preview Data
                            </a> --}}
                            <a class="btn btn-danger icon-trash" name='Hapus' href="#" data-toggle="modal"
                                data-target="#modal-hapus" style="margin-left: 10px; " value="{{ $value->nik }}"
                                href="{{ url('masteruser') }}"></a>
                        </td>
                    </tr>
                @endforeach
            </form>
        </tbody>
    </table>
</div>

<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Master User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('simpanuser') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="nik" class="form-control" value="" maxlength="50"
                            required="" placeholder="NIK">
                    </div>
                    <div class="form-group">
                        <input type="text" name="nama_lengkap" class="form-control" value="" maxlength="50"
                            required="" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <input type="text" name="tempat_lahir" class="form-control" value="" maxlength="50"
                            required="" placeholder="Tempat Lahir">
                    </div>
                    <div class="form-group">
                        <input type="date" name="tgl_lahir" class="form-control" value="" maxlength="50"
                            required="" placeholder="Tanggal Lahir">
                    </div>
                    <div class="form-group">
                        <input type="text" name="jenis_kelamin" class="form-control" value="" maxlength="50"
                            required="" placeholder="Jenis Kelamin">
                    </div>
                    <div class="form-group">
                        <input type="text" name="pekerjaan" class="form-control" value="" maxlength="50"
                            required="" placeholder="Pekerjaan">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-Success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Master RT dan RW</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="">Yakin untuk Menghapus Data?</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    table {
        border-collapse: collapse;
        white-space: nowrap;
        min-width: 100%;
    }

    .header-atas {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header h4 {
        margin: 0;
    }

    .header button {
        margin-left: auto;
    }
</style>


<script>
    $(document).ready(function() {
        $('#myModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('no_kk');
            var modal = $(this);

            $.ajax({
                url: '/data/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    modal.find('.modal-body').html(response.data);
                }
            });
        });
    });
</script>
