@extends('layouts.mainlayout')
@section('title', 'Master KK')
@include('sweetalert::alert')

@section('content')
    <div id="myDiv1">
        <div class="header-atas" style="display: flex; justify-content: space-between; align-items: center;">
            @php
                $nama = session()->get('nama');
                $akses = session()->get('hak_akses');
                $rt = session()->get('rt');
                $rw = session()->get('rw');
            @endphp
            <h4 class="font-weight-bold text-dark" >Master KK</h4>
            <button data-toggle="modal" name='tambah' data-target="#modal-tambahkk">Tambah data</button>
        </div>
        <!-- isi div -->
        <div>
            @if (session::has('success'))
                <script>
                    toastr.success('Data Berhasil Ditambahkan', '')
                </script>
            @endif
            @if (session::has('successedit'))
                <script>
                    toastr.success('Data Berhasil Diperbarui', '')
                </script>
            @endif
            @if ($errors->any())
                <script>
                    toastr.error('Cek Kembali Data yang Anda Input', 'Data Gagal Ditambahkan')
                </script>
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
                        <th>RW</th>
                        <th>RT</th>
                        {{-- <th>kelurahan</th> --}}
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="masterkk" method="post">
                        @foreach ($data as $no => $value)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $value->no_kk }}</td>
                                <td>{{ $value->nama_lengkap }}</td>
                                <td>{{ $value->alamat }}</td>
                                <td>{{ $value->rw }}</td>
                                <td>{{ $value->rt }}</td>
                                {{-- <td>{{ $value->kelurahan }}</td> --}}
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

    {{-- Modal Tambah kk --}}
    <div class="modal fade" id="modal-tambahkk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" autocomplete="off">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kartu Keluarga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('simpankk') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nomor-kartu"></label>
                            <input type="number" id="nomor-kartu" name="nokk"
                                class="form-control
                            @error('nokk') is-invalid
                            @enderror"
                                value="{{ old('nokk') }}" placeholder="Nomor KK" autocomplete="off">
                            @error('nokk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nomor-kartu"></label>
                            <input type="number" id="nomor-kartu" name="nik"
                                class="form-control
                            @error('nik') is-invalid

                            @enderror"
                                value="{{ old('nik') }}" placeholder="NIK Kepala Keluarga" autocomplete="off">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="kepala_keluarga"
                                class="form-control
                            @error('kepala_keluarga') is-invalid

                            @enderror"
                                value="{{ old('kepala_keluarga') }}" placeholder="Nama Kepala Keluarga" autocomplete="off">
                            @error('kepala_keluarga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="alamatkk"
                                class="form-control
                            @error('alamatkk') is-invalid

                            @enderror"
                                value="{{ old('alamatkk') }}" placeholder="Alamat" autocomplete="off">
                            @error('alamatkk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="rt"
                                        class="form-control
                                    @error('rt') is-invalid

                                    @enderror"
                                        value="{{ old('rt') }}" placeholder="RT" autocomplete="off">
                                    @error('rt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input type="text" name="rw"
                                        class="form-control
                                    @error('rw') is-invalid

                                    @enderror"
                                        value="{{ old('rw') }}" placeholder="RW" autocomplete="off">
                                    @error('rw')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="">Kelurahan</label>
                                    <input type="text" name="kel" class="form-control" placeholder="Kabupaten"
                                        value="Kepuharjo" maxlength="50" required="" autocomplete="off" readonly>
                                </div>
                                <div class="col">
                                    <label for="">Kode Pos</label>
                                    <input type="text" name="kdpos" class="form-control" placeholder="Kecamatan"
                                        value="67316" maxlength="50" required="" autocomplete="off" readonly>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="">Kabupaten</label>
                                    <input type="text" name="kab" class="form-control" placeholder="Kabupaten"
                                        value="Lumajang" maxlength="50" required="" autocomplete="off" readonly>
                                </div>
                                <div class="col">
                                    <label for="">Kecamatan</label>
                                    <input type="text" name="kec" class="form-control" placeholder="Kecamatan"
                                        value="Lumajang" maxlength="50" required="" autocomplete="off" readonly>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="">Provinsi</label>
                                    <input type="text" name="prov" class="form-control" placeholder="Provinsi"
                                        value="Jawa Timur" maxlength="50" required="" autocomplete="off" readonly>
                                </div>
                                <div class="col">
                                    <label for="">KK Tanggal</label>
                                    <input type="date"
                                        class="form-control  @error('tglkk') is-invalid
                                    @enderror"
                                        value="{{ old('tglkk') }}" name="tglkk" id="myDate"
                                        placeholder="yyyy-mm-dd" min="1000-01-01" max="9999-12-31" autocomplete="off">
                                    @error('tglkk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Kartu Keluarga</h5>
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
                                    <input type="text" name="nokkedit"
                                        class="form-control
                                    @error('nokkedit')is-invalid
                                    @enderror"
                                        value="{{ old('nokkedit', $value->no_kk) }}" placeholder="Nomor KK"
                                        autocomplete="off">
                                    @error('nokkedit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nomor-kartu"></label>
                                    <input type="number" id="nomor-kartu" name="nikedit"
                                        class="form-control
                                    @error('nikedit') is-invalid

                                    @enderror"
                                        value="{{ old('nikedit', $value->nik) }}" required=""
                                        placeholder="NIK Kepala Keluuarga" autocomplete="off">
                                    @error('nikedit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Kepala Keluarga</label>
                                    <input type="text" name="kepala_keluargaedit"
                                        class="form-control
                                    @error('kepala_keluargaedit')is-invalid

                                    @enderror"
                                        value="{{ old('kepala_keluargaedit', $value->nama_lengkap) }}"
                                        placeholder="Nama Kepala Keluarga" autocomplete="off" readonly>
                                    @error('kepala_keluargaedit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input type="text" name="alamatkkedit"
                                        class="form-control
                                    @error('alamatkkedit')is-invalid

                                    @enderror"
                                        value="{{ old('alamatedit', $value->alamat) }}" placeholder="Alamat"
                                        autocomplete="off">
                                    @error('alamatkkedit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">RT</label>
                                            <input type="text" name="rtedit"
                                                value="{{ old('rtedit', $value->rt) }} "
                                                class="form-control
                                                @error('rtedit')is-invalid

                                                @enderror"
                                                placeholder="RT" autocomplete="off">
                                            @error('rtedit')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label for="">RW</label>
                                            <input type="text" name="rwedit" value="{{ old('rwedit', $value->rw) }}"
                                                class="form-control" placeholder="RW">
                                        </div>
                                        <div class="col">
                                            <label for="">Kode Pos</label>
                                            <input type="text" name="kdposedit" value="{{ $value->kode_pos }}"
                                                class="form-control" placeholder="Kode Pos" autocomplete="off" readonly>
                                            @error('rwedit')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">Kelurahan</label>
                                            <input type="text" name="keledit" class="form-control"
                                                placeholder="Kelurahan" value="{{ $value->kelurahan }}"
                                                autocomplete="off" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="">Kecamatan</label>
                                            <input type="text" name="kecedit" class="form-control"
                                                placeholder="Kecamatan" value="{{ $value->kecamatan }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">Kabupaten</label>
                                            <input type="text" name="kabedit" class="form-control"
                                                placeholder="Kabupaten" value="{{ $value->kabupaten }}"
                                                autocomplete="off" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="">Provinsi</label>
                                            <input type="text" name="provedit" class="form-control"
                                                placeholder="Provinsi" value="{{ $value->provinsi }}" autocomplete="off"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">KK Tanggal</label>
                                    <input type="date" class="form-control" value="{{ $value->kk_tgl }}"
                                        name="tglkkedit" id="myDate" name="myDate" placeholder="yyyy-mm-dd"
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


{{-- toast cdn --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- jquery cdn --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
