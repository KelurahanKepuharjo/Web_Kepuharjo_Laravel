@extends('layouts.mainlayout')
@section('title', 'Master KK')
@include('sweetalert::alert')

{{-- Section Content --}}
@section('content')
    {{-- Page 1 halaman master KK --}}
    <div id="myDiv1">
        <div class="header-atas" style="display: flex; justify-content: space-between; align-items: center;">
            <h4>Halaman Master KK</h4>
            <button data-toggle="modal" name='tambah' data-target="#modal-tambahkk">Tambah data</button>
        </div>
        <!-- isi div -->
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success" id="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="close" data-dismiss="alert">X</button>
                </div>
            @endif
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
                                    <div class="dropdown">
                                        <button class="btn icon-cog dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            style="background-color: #00AAAA; color: white;">
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" data-id="" href="" data-toggle="modal"
                                                data-target="#modal-edit{{ $value->no_kk }}">Edit KK</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#modal-hapus{{ $value->no_kk }}" value="{{ $value->no_kk }}"
                                                href="{{ url('masterkk') }}">Hapus KK</a>
                                            <form action="" method="get">
                                                <a class="dropdown-item" name="kk" value="{{ $value->no_kk }}"
                                                    href="{{ url('masterkkmas/' . $value->id) }}">Tambah
                                                    Anggota KK</a>
                                            </form>
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
    </div>
    {{-- Batas Page 1 Halaman master KK --}}

    {{-- Modal Tambah kk --}}
    <div class="modal fade" id="modal-tambahkk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
    {{-- Batas Modal Tambah kk --}}

    {{-- Modal Hapus kk --}}
    @foreach ($data as $no => $value)
        <div class="modal fade" id="modal-hapus{{ $value->no_kk }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" autocomplete="off">
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
    {{-- Batas Modal Hapus kk --}}

    {{-- Modal Edit kk --}}
    @foreach ($data as $no => $value)
        <div class="modal fade" id="modal-edit{{ $value->no_kk }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Master KK</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('update-masterkk/' . $value->no_kk) }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">No Kartu Keluarga</label>
                                    <input type="text" name="nokk" class="form-control"
                                        value="{{ $value->no_kk }}" maxlength="50" required=""
                                        placeholder="Nomor KK" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="">Kepala Keluarga</label>
                                    <input type="text" name="kepala_keluarga" class="form-control"
                                        value="{{ $value->nama_kepala_keluarga }}" maxlength="50" required=""
                                        placeholder="Nama Kepala Keluarga" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input type="text" name="alamatkk" class="form-control"
                                        value="{{ $value->alamat }}" maxlength="50" required="" placeholder="Alamat"
                                        autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">RT</label>
                                            <input type="text" name="rt"
                                                value="{{ $value->rt }} "class="form-control" placeholder="RT"
                                                autocomplete="off">
                                        </div>
                                        <div class="col">
                                            <label for="">RW</label>
                                            <input type="text" name="rw" value="{{ $value->rw }}"
                                                class="form-control" placeholder="RW">
                                        </div>
                                        <div class="col">
                                            <label for="">Kode Pos</label>
                                            <input type="text" name="kdpos" value="{{ $value->kode_pos }}"
                                                class="form-control" placeholder="Kode Pos" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">Kelurahan</label>
                                            <input type="text" name="kel" class="form-control"
                                                placeholder="Kelurahan" value="{{ $value->kelurahan }}" maxlength="50"
                                                required="" autocomplete="off">
                                        </div>
                                        <div class="col">
                                            <label for="">Kecamatan</label>
                                            <input type="text" name="kec" class="form-control"
                                                placeholder="Kecamatan"value="{{ $value->kecamatan }}" maxlength="50"
                                                required="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">Kabupaten</label>
                                            <input type="text" name="kab" class="form-control"
                                                placeholder="Kabupaten"value="{{ $value->kabupaten }}" maxlength="50"
                                                required="" autocomplete="off">
                                        </div>
                                        <div class="col">
                                            <label for="">Provinsi</label>
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
        {{-- batad modal edit kk --}}
    @endforeach
@endsection
{{-- Batas Section Content --}}

<script>
    function showDiv1() {
        var div = document.getElementById("myDiv1");
        if (div.style.display === "none") {
            div.style.display = "block";
        } else {
            div.style.display = "none";
        }
    }

    function showDiv2() {
        var div = document.getElementById("myDiv2");
        if (div.style.display === "none") {
            div.style.display = "block";
        } else {
            div.style.display = "none";
        }
    }
</script>

<script type="text/javascript">
    $("document").ready(function() {
        setTimeout(function() {
            $("alert").remove();
        }, 1);
    });
</script>

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function() {
        readData()
        $('#input').keyup(function() {
            var strcari = $("#input").val();
            if (strcari != "") {
                $("#read").html('<p class="text-muted">Menunggu Mencari Data ...</p>')
                $.ajax({
                    type: "get",
                    url: "{{ url('ajax') }}",
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


<script>
    function isiTextfield(nilai) {
        document.getElementById("input").value = nilai;
    }

    var input = document.querySelector('#input'); // mengambil elemen input

    input.addEventListener('keyup', function(event) {
        if (event.keyCode === 13) { // cek jika tombol yang ditekan adalah tombol "Enter"
            event.preventDefault(); // membatalkan perilaku default tombol "Enter"
            document.querySelector('form').submit(); // melakukan submit form
        }
    });
</script>

<script>
    function isiTextfield2(nilai) {
        document.getElementById("input2").value = nilai;
    }

    var input = document.querySelector('#input'); // mengambil elemen input

    input.addEventListener('keyup', function(event) {
        if (event.keyCode === 13) { // cek jika tombol yang ditekan adalah tombol "Enter"
            event.preventDefault(); // membatalkan perilaku default tombol "Enter"
            document.querySelector('form').submit(); // melakukan submit form
        }
    });
</script>

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
