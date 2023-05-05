@extends('layouts.mainlayouts')
@section('title', 'Master RT RW')
<!-- partial -->
@section('content')
    <div class="header-atas">
        @php
            $nama = session()->get('nama');
            $akses = session()->get('hak_akses');
            $rt = session()->get('rt');
            $rw = session()->get('rw');
        @endphp
        <h4>Halaman Master RT</h4>

        <button data-toggle="modal" name='tambah' data-target="#modal-tambah">Tambah Data</i></button>
    </div>
    <div class="table_wrapper" style="overflow-x: scroll;">
        <table id="myTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama RW</th>
                    <th>RT</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <form action="" method="post">
                    @foreach ($datartrw as $no => $value)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $value->nama_lengkap }}</td>
                            <td>{{ $value->rt }}</td>
                            <td>Ketua RT</td>
                            {{-- <td>{{ $value->alamat }}</td>
                            <td>{{ $value->no_hp }}</td>
                            <td>{{ $value->rt }}</td> --}}
                            {{-- <td>{{ $value->rw }}</td> --}}
                            <td>
                                {{-- <a class="btn btn-warning fa fa-pencil" style="color:white;" href=""
                                    data-toggle="modal" data-target="#modal-edit{{ $value->nik }}">
                                </a>
                                <a class="btn btn-danger icon-trash" name='Hapus' href="#" data-toggle="modal"
                                    data-target="#modal-hapus" style="margin-left: 10px; " value="{{ $value->nik }}"
                                    href="{{ url('masterrtrw') }}"></a> --}}
                                <div class="dropdown">
                                    <button class="btn icon-cog dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        style="background-color: #00AAAA; color: white;">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" data-id="" href="" data-toggle="modal"
                                            data-target="#modal-edit{{ $value->no_kk }}">Edit</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#modal-hapus{{ $value->no_kk }}" value="{{ $value->no_kk }}"
                                            href="{{ url('masterkk') }}">Hapus</a>
                                        {{-- <button class="dropdown-item" type="button" value="isi value button"
                                                onclick="showDiv1(); showDiv2(); isiTextfield('{{ $value->no_kk }}'); isiTextfield2('{{ $value->nama_kepala_keluarga }}');">Tambah
                                                data
                                                Keluarga</button> --}}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </form>
            </tbody>
        </table>
    </div>

    {{-- coba modal tambah rt rw --}}
    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <div class="row mt-2">
                        <div class="col-lg-12">
                            <div class="form-group d-inline-flex">
                                <label for="pencarian"></label>
                                <input type="text" id="input" class="form-control" placeholder="Ketikkan NIK...">
                                <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                            <div id="read"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    @foreach ($datartrw as $no => $value)
        <div class="modal fade" id="modal-edit{{ $value->nik }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Master RT dan RW</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('update-masterrtrw/' . $value->nik) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" name="nik" class="form-control" value="{{ $value->nik }}"
                                    maxlength="50" required="" placeholder="NIK" autocomplete="off" disabled>
                            </div>
                            <div class="form-group">
                                <input type="text" name="nama_lengkap" class="form-control"
                                    value="{{ $value->nama_lengkap }}" maxlength="50" required=""
                                    placeholder="Nama Lengkap" autocomplete="off" disabled>
                            </div>
                            <div class="form-group">
                                <input type="text" name="alamat" class="form-control" value="{{ $value->alamat }}"
                                    maxlength="50" required="" placeholder="Alamat" autocomplete="off" disabled>
                            </div>
                            <div class="form-group">
                                <input type="text" name="no_hp" class="form-control" value="{{ $value->no_hp }}"
                                    maxlength="50" required="" placeholder="No HP" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="rt" class="form-control"
                                            value="{{ $value->rt }}" placeholder="RT" autocomplete="off">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="rw" class="form-control"
                                            value="{{ $value->rw }}" placeholder="RW" autocomplete="off">
                                    </div>
                                </div>
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
    @endforeach
    {{-- batas modal edit --}}

    {{-- Modal Hapus --}}
    @foreach ($datartrw as $no => $value)
        <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" autocomplete="off">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Master RT RW</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="">Yakin untuk Menghapus Data {{ $value->nama_lengkap }} ?</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <a type="button" onclick="showNotification()"
                            href="{{ url($value->nik . '/hapus-masterrtrw') }}" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- Batas Modal Hapus --}}
@endsection

<style media="screen">
    .button {
        width: 100%;
        height: 50px;
    }

    .left {
        float: left;
        display: block;
    }

    .right {
        float: right;
        display: block;
    }

    .button ul a {
        margin: 10px;
        padding: 10px;
        background: rgb(116, 181, 12);
        color: white;
    }
</style>

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

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function() {
        readData()
        $('#input').keyup(function() {
            var strcari = $("#input").val();
            if (strcari != "") {
                $("#read").html('<p class="text-muted">Menunggu Mencari Data ...</p>')
                $.ajax_rt({
                    type: "get",
                    url: "{{ url('ajaxrt') }}",
                    data: "nik=" + strcari,
                    success: function(data) {
                        $("#read").html(data);
                    }
                });
            } else {
                readData()
            }
        });
    });

    function readData() {
        $.get("{{ url('read') }}", {}, function(data, status) {
            $("#read").html(data);
        });
    }
</script>
