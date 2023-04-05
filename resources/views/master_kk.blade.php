@extends('layouts.mainlayout')
@section('title', 'Master KK')

{{-- Section Content --}}
@section('content')
    <div class="header-atas" style="display: flex; justify-content: space-between; align-items: center;">
        <h4>Halaman Master KK</h4>
        <button data-toggle="modal" name='tambah' data-target="#modal-tambah">Tambah data</button>
    </div>
    <div class="table_wrapper" style=" overflow-x: scroll;">
        <table id="myTable" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No KK</th>
                    <th>Kepala Keluarga</th>
                    <th>Alamat</th>
                    <th>RT</th>
                    <th>RW</th>
                    <th>kelurahan</th>
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
                            <td>{{ $value->kelurahan }}</td>
                            <td>
                                <a class="btn btn-warning fa fa-pencil" data-id="" href="" style="color: white"
                                    data-toggle="modal" data-target="#modal-edit{{ $value->no_kk }}">
                                </a>
                                <a class="btn btn-danger icon-trash" name='Hapus' href="#" data-toggle="modal"
                                    data-target="#modal-hapus" style="margin-left: 10px; " value="{{ $value->no_kk }}"
                                    href="{{ url('masterkk') }}"></a>
                            </td>
                        </tr>
                    @endforeach
                </form>
            </tbody>
        </table>
    </div>


    {{-- Modal Tambah --}}
    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" autocomplete="off">
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
                            <label for="nomor-kartu"></label>
                            <input type="number" id="nomor-kartu" name="nokk" class="form-control" value=""
                                maxlength="16" required="" placeholder="Nomor KK" max="9999999999999999"
                                autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" name="kepala_keluarga" class="form-control" value="" maxlength="50"
                                required="" placeholder="Nama Kepala Keluarga" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" name="alamatkk" class="form-control" value="" maxlength="100"
                                required="" placeholder="Alamat" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="rt" class="form-control" placeholder="RT"
                                        autocomplete="off">
                                </div>
                                <div class="col">
                                    <input type="text" name="rw" class="form-control" placeholder="RW"
                                        autocomplete="off">
                                </div>
                                <div class="col">
                                    <input type="text" name="kdpos" class="form-control" placeholder="Kode Pos"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="kel" class="form-control" placeholder="Kelurahan"
                                        value="" maxlength="50" required="" autocomplete="off">
                                </div>
                                <div class="col">
                                    <input type="text" name="kec" class="form-control"
                                        placeholder="Kecamatan"value="" maxlength="50" required=""
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="kab" class="form-control"
                                        placeholder="Kabupaten"value="" maxlength="50" required=""
                                        autocomplete="off">
                                </div>
                                <div class="col">
                                    <input type="text" name="prov" class="form-control"
                                        placeholder="Provinsi"value="" maxlength="50" required=""
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">KK Tanggal</label>
                            <input type="date" class="form-control" name="tglkk" id="myDate" name="myDate"
                                placeholder="yyyy-mm-dd" min="1000-01-01" max="9999-12-31" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-Success"
                            style="background-color: rgb(0, 189, 0); color: white;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Batas Modal Tambah --}}

    {{-- Modal Hapus --}}
    @foreach ($data as $no => $value)
        <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" autocomplete="off">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Master KK</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="">Yakin untuk Menghapus Data {{ $value->nama_kepala_keluarga }} ?</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <a type="button" onclick="showNotification()"
                            href="{{ url($value->no_kk . '/hapus-masterkk') }}" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- Batas Modal Hapus --}}

    {{-- Modal Edit --}}
    @foreach ($data as $no => $value)
        <div class="modal fade" id="modal-edit{{ $value->no_kk }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Master KK haloooo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('update-masterkk/' . $value->no_kk) }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="text" name="nokk" class="form-control"
                                        value="{{ $value->no_kk }}" maxlength="50" required=""
                                        placeholder="Nomor KK" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="kepala_keluarga" class="form-control"
                                        value="{{ $value->nama_kepala_keluarga }}" maxlength="50" required=""
                                        placeholder="Nama Kepala Keluarga" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="alamatkk" class="form-control"
                                        value="{{ $value->alamat }}" maxlength="50" required="" placeholder="Alamat"
                                        autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="rt"
                                                value="{{ $value->rt }} "class="form-control" placeholder="RT"
                                                autocomplete="off">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="rw" value="{{ $value->rw }}"
                                                class="form-control" placeholder="RW">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="kdpos" value="{{ $value->kode_pos }}"
                                                class="form-control" placeholder="Kode Pos" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="kel" class="form-control"
                                                placeholder="Kelurahan" value="{{ $value->kelurahan }}" maxlength="50"
                                                required="" autocomplete="off">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="kec" class="form-control"
                                                placeholder="Kecamatan"value="{{ $value->kecamatan }}" maxlength="50"
                                                required="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="kab" class="form-control"
                                                placeholder="Kabupaten"value="{{ $value->kabupaten }}" maxlength="50"
                                                required="" autocomplete="off">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="prov" class="form-control"
                                                placeholder="Provinsi"value="{{ $value->provinsi }}" maxlength="50"
                                                required="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">KK Tanggal</label>
                                    <input type="date" class="form-control" value="{{ $value->kk_tgl }}"
                                        name="tglkk" id="myDate" name="myDate" placeholder="yyyy-mm-dd"
                                        min="1000-01-01" max="9999-12-31" autocomplete="off">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-Success"
                                    style="background-color: rgb(0, 189, 0); color: white;">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- Batas Modal Edit --}}
@endsection
{{-- Batas Section Content --}}
