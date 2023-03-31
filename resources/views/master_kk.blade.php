@extends('layouts.mainlayout')
@section('title', 'Master RT RW')
<!-- partial -->
@section('content')
    <div class="header-atas">
        <h4>Halaman Master KK</h4>
        <button data-toggle="modal" name='tambah' data-target="#modal-tambah">Tambah data</button>
    </div>
    <div class="table_wrapper" style="overflow-x: scroll;">
        <table id="myTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No KK</th>
                    <th>Kepala Keluarga</th>
                    <th>Alamat</th>
                    <th>RT</th>
                    <th>RW</th>
                    {{-- <th>Kd Pos</th> --}}
                    <th>kelurahan</th>
                    {{-- <th>kecamatan</th> --}}
                    {{-- <th>Kabupaten</th> --}}
                    {{-- <th>Provinsi</th> --}}
                    {{-- <th>KK Tgl</th> --}}
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <form action="masterkk" method="post">
                    @foreach ($data as $no => $value)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $value->no_kk }}</td>
                            <td>{{ $value->nama_kepala_keluarga }}</td>
                            <td>{{ $value->alamat }}</td>
                            <td>{{ $value->rt }}</td>
                            <td>{{ $value->rw }}</td>
                            {{-- <td>{{ $value->kode_pos }}</td> --}}
                            <td>{{ $value->kelurahan }}</td>
                            {{-- <td>{{ $value->kecamatan }}</td> --}}
                            {{-- <td>{{ $value->kabupaten }}</td> --}}
                            {{-- <td>{{ $value->provinsi }}</td> --}}
                            {{-- <td>{{ $value->kk_tgl }}</td> --}}
                            <td>
                                <a class="btn btn-success btn-sm btn-icon-text mr-3" data-id="{{ $value->no_kk }}"
                                    href="" data-toggle="modal" data-target="#myModal">
                                    Preview Data
                                </a>
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Master KK</h5>
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
                                    data-target="#modal-hapus" style="margin-left: 10px; " value="{{ $value->no_kk }}"
                                    href="{{ url('masterkk') }}"></a>
                            </td>
                        </tr>
                    @endforeach
                </form>
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>No KK</th>
                    <th>Kepala Keluarga</th>
                    <th>Alamat</th>
                    <th>RT</th>
                    <th>RW</th>
                    {{-- <th>Kd Pos</th> --}}
                    <th>kelurahan</th>
                    {{-- <th>kecamatan</th> --}}
                    {{-- <th>Kabupaten</th> --}}
                    {{-- <th>Provinsi</th> --}}
                    {{-- <th>KK Tgl</th> --}}
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Master KK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('simpankk') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="nokk" class="form-control" value="" maxlength="50"
                                required="" placeholder="Nomor KK">
                        </div>
                        <div class="form-group">
                            <input type="text" name="kepala_keluarga" class="form-control" value="" maxlength="50"
                                required="" placeholder="Nama Kepala Keluarga">
                        </div>
                        <div class="form-group">
                            <input type="text" name="alamatkk" class="form-control" value="" maxlength="50"
                                required="" placeholder="Alamat">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="rt" class="form-control" placeholder="RT">
                                </div>
                                <div class="col">
                                    <input type="text" name="rw" class="form-control" placeholder="RW">
                                </div>
                                <div class="col">
                                    <input type="text" name="kdpos" class="form-control" placeholder="Kode Pos">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="kel" class="form-control" placeholder="Kelurahan"
                                        value="" maxlength="50" required="">
                                </div>
                                <div class="col">
                                    <input type="text" name="kec" class="form-control"
                                        placeholder="Kecamatan"value="" maxlength="50" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="kab" class="form-control"
                                        placeholder="Kabupaten"value="" maxlength="50" required="">
                                </div>
                                <div class="col">
                                    <input type="text" name="prov" class="form-control"
                                        placeholder="Provinsi"value="" maxlength="50" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">KK Tanggal</label>
                            <!-- Input type date dengan format yyyy-mm-dd -->
                            <input type="date" class="form-control" name="tglkk" id="myDate" name="myDate"
                                placeholder="yyyy-mm-dd" min="1000-01-01" max="9999-12-31">
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Master KK</h5>
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
