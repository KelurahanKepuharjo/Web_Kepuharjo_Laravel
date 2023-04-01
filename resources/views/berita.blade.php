@extends('layouts.mainlayout')
@section('title', 'Berita')
<!-- partial -->
@section('content')
    <div class="header-atas">
        <h4 class="font-weight-bold text-dark">Ini Halaman Berita</h4>
        <button data-toggle="modal" name='tambah' data-target="#modal-tambah">Tambah data</button>
    </div>
        <div class="table_wrapper" style="overflow-x: scroll;">
            <table id="myTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Id berita</th>
                        <th>Judul</th>
                        <th>Sub title</th>
                        <th>Deskripsi</th>
                        <th>Created_at</th>
                        {{-- <th>Update_at</th> --}}
                        {{-- <th>Kd Pos</th> --}}
                        {{-- <th>kelurahan</th> --}}
                        {{-- <th>kecamatan</th> --}}
                        {{-- <th>Kabupaten</th> --}}
                        {{-- <th>Provinsi</th> --}}
                        {{-- <th>KK Tgl</th> --}}
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="berita" method="post">
                        @foreach ($data as $no => $value)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $value->judul }}</td>
                                <td>{{ $value->sub_title }}</td>
                                <td>{{ $value->deskripsi }}</td>
                                <td>{{ $value->created_at }}</td>
                                {{-- <td>{{ $value->update_at }}</td> --}}
                                {{-- <td>{{ $value->kode_pos }}</td> --}}
                                {{-- <td>{{ $value->kelurahan }}</td> --}}
                                {{-- <td>{{ $value->kecamatan }}</td> --}}
                                {{-- <td>{{ $value->kabupaten }}</td> --}}
                                {{-- <td>{{ $value->provinsi }}</td> --}}
                                {{-- <td>{{ $value->kk_tgl }}</td> --}}
                                <td>
                                    <a class="btn btn-warning fa fa-pencil" data-id="{{ $value->judul }}"
                                        href="" data-toggle="modal" data-target="#myModal">
                                    </a>

                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Master Berita</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Deskripsi </label>
                                                        <input type="text" name="ttl" class="form-control" value=""
                                                            maxlength="50" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>berita</label>
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
                                        data-target="#modal-hapus" style="margin-left: 10px; " value="{{ $value->judul }}"
                                        href="{{ url('masterberita') }}"></a>
                                </td>
                            </tr>
                        @endforeach
                    </form>
                </tbody>
                {{-- <tfoot>
                    <tr> --}}
                        {{-- <th>Id</th>
                        <th>Judul</th>
                        <th>Sub title</th>
                        <th>Deskripsi</th>
                        <th>Created_at</th>
                        <th>Update_at</th> --}}
                        {{-- <th>Kd Pos</th> --}}
                        {{-- <th>kelurahan</th> --}}
                        {{-- <th>kecamatan</th> --}}
                        {{-- <th>Kabupaten</th> --}}
                        {{-- <th>Provinsi</th> --}}
                        {{-- <th>KK Tgl</th> --}}
                        {{-- <th>Aksi</th> --}}
                    {{-- </tr>
                </tfoot> --}}
            </table>
        </div>

        <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Master Berita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('simpanberita') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="judul" class="form-control" value="" maxlength="50"
                                required="" placeholder="Judul Berita">
                        </div>
                        <div class="form-group">
                            <input type="text" name="subtitle" class="form-control" value="" maxlength="50"
                                required="" placeholder="Sub Title">
                        </div>
                        <div class="form-group">
                            <input type="text" name="deskripsi" class="form-control" value="" maxlength="50"
                                required="" placeholder="Deskripsi">
                        </div>

                        {{-- <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="kel" class="form-control" placeholder="Kelurahan"
                                        value="" maxlength="50" required="">
                                </div>
                                <div class="col">
                                    <input type="text" name="kec" class="form-control"
                                        placeholder="Kecamatan"value="" maxlength="50" required="">
                                </div> --}}
                            {{-- </div>
                        </div> --}}
                        {{-- <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="kab" class="form-control"
                                        placeholder="Kabupaten"value="" maxlength="50" required="">
                                </div>
                                <div class="col">
                                    <input type="text" name="prov" class="form-control"
                                        placeholder="Provinsi"value="" maxlength="50" required="">
                                </div> --}}
                            {{-- </div>
                        </div> --}}
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <!-- Input type date dengan format yyyy-mm-dd -->
                            <input type="date" class="form-control" name="tgl" id="myDate" name="myDate"
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Master Berita</h5>
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
            var id = button.data('judul');
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
