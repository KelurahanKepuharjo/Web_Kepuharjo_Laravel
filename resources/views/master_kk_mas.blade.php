@extends('layouts.mainlayouts')
@section('title', 'Master KK')

{{-- Section Content --}}
@section('content')

    {{-- Page 2 Halaman master Masyarakat --}}

    <div class="header-atas">
        <h4>Halaman Master User</h4>
        <button data-toggle="modal" data-target="#modal-tambahmas">Tambah data</button>
    </div>
    <div class="table_wrapper" style="overflow-x: scroll;">
        <table id="myTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No KK</th>
                    <th>NIK</th>
                    <th>Nama Lengkap</th>
                    <th>Status Keluarga</th>
                    <th>Tempat Tanggal Lahir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <form action="" method="post">
                    @foreach ($data as $no => $value)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $value->no_kk }}</td>
                            <td>{{ $value->nik }}</td>
                            <td>{{ $value->nama_lengkap }}</td>
                            <td>{{ $value->status_keluarga }}</td>
                            <td>{{ $value->tempat_lahir }}, {{ $value->tgl_lahir }}</td>
                            <td>
                                <a class="btn btn-warning fa fa-pencil" style="color:white;" href=""
                                    data-toggle="modal" data-target="#modal-edit{{ $value->nik }}">
                                </a>
                                <a class="btn btn-danger icon-trash" name='Hapus' href="#" data-toggle="modal"
                                    data-target="#modal-hapus{{ $value->nik }}" style="margin-left: 10px; "
                                    href="{{ url('masteruser') }}"></a>
                            </td>
                        </tr>
                    @endforeach
                </form>
            </tbody>
        </table>

        {{-- Batas Page 2  --}}

        {{-- modal tambah user --}}
        <div class="modal fade" id="modal-tambahmas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                            <input type="hidden" id="input" name="nokk" class="form-control" maxlength="50"
                                required="" value="{{ $nomor_kk }}" autocomplete="off" readonly>
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" name="nik" class="form-control" value="" maxlength="50"
                                    required="" placeholder="NIK" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" value="" maxlength="50"
                                    required="" placeholder="Nama Lengkap" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <div class="col">
                                    <select class="form-control" name="kelamin" autocomplete="off"
                                        id="exampleFormControlSelect1">
                                        <option>Pilih</option>
                                        <option>Laki Laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control" value=""
                                        maxlength="50" required="" placeholder="Tempat Lahir" autocomplete="off">
                                </div>
                                <div class="col">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" class="form-control" value=""
                                        maxlength="50" required="" placeholder="Tanggal Lahir" autocomplete="off">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label>Agama</label>
                                    <div class="col">
                                        <select class="form-control" name="agama" autocomplete="off"
                                            id="exampleFormControlSelect1">
                                            <option>Pilih</option>
                                            <option>Islam</option>
                                            <option>Kristen Protestan</option>
                                            <option>Katolik</option>
                                            <option>Hindu</option>
                                            <option>Buddha</option>
                                            <option>Konghucu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label>Pendidikan</label>
                                    <div class="col">
                                        <select class="form-control" name="pendidikan" autocomplete="off"
                                            id="exampleFormControlSelect1">
                                            <option>Pilih</option>
                                            <option>Tidak/Belum Sekolah</option>
                                            <option>Belum Tamat SD/Sederajat</option>
                                            <option>Tamat SD/Sederajat</option>
                                            <option>SLTP/Sederajat</option>
                                            <option>SLTA/Sederajat</option>
                                            <option>Diploma I/II</option>
                                            <option>Diploma III/S.Muda</option>
                                            <option>Diploma IV/Strata I</option>
                                            <option>Strata II</option>
                                            <option>Strata III</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control" value=""
                                    maxlength="50" required="" placeholder="Pekerjaan" autocomplete="off">
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label>Golongan Darah</label>
                                    <div class="col">
                                        <select class="form-control" name="gol_darah" autocomplete="off"
                                            id="exampleFormControlSelect1">
                                            <option>Pilih</option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>O</option>
                                            <option>AB</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label>Status Perkawinan</label>
                                    <div class="col">
                                        <select class="form-control" name="status_perkawinan" autocomplete="off"
                                            id="exampleFormControlSelect1">
                                            <option>Pilih</option>
                                            <option>Belum Kawin</option>
                                            <option>Kawin</option>
                                            <option>Cerai</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Perkawinan</label>
                                <input type="date" name="tgl_perkawinan" class="form-control" value=""
                                    maxlength="50" required="" placeholder="Tanggal Perkawinan" autocomplete="off">
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label>Status Keluarga</label>
                                    <div class="col">
                                        <select class="form-control" name="status_keluarga" autocomplete="off"
                                            id="exampleFormControlSelect1">
                                            <option>Pilih</option>
                                            <option>Kepala Keluarga</option>
                                            <option>Istri</option>
                                            <option>Anak</option>
                                            <option>Wali</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label>Kewarganegaraan</label>
                                    <div class="col">
                                        <select class="form-control" name="kewarganegaraan" autocomplete="off"
                                            id="exampleFormControlSelect1">
                                            <option>Pilih</option>
                                            <option>WNI</option>
                                            <option>WNA</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label>No Paspor</label>
                                    <input type="text" name="no_paspor" class="form-control" value=""
                                        maxlength="50" required="" placeholder="No Paspor" autocomplete="off">
                                </div>
                                <div class="col">
                                    <label>No KITAP</label>
                                    <input type="text" name="no_kitap" class="form-control" value=""
                                        maxlength="50" required="" placeholder="No KITAP" autocomplete="off">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label>Nama Ayah</label>
                                    <input type="text" name="nama_ayah" class="form-control" value=""
                                        maxlength="50" required="" placeholder="Nama Ayah" autocomplete="off">
                                </div>
                                <div class="col">
                                    <label>Nama Ibu</label>
                                    <input type="text" name="nama_ibu" class="form-control" value=""
                                        maxlength="50" required="" placeholder="Nama Ibu" autocomplete="off">
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
        {{-- batas modal tambah user --}}

        {{-- modal edit user --}}
        @foreach ($data as $no => $value)
            <div class="modal fade" id="modal-edit{{ $value->nik }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Master User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('update-masteruser/' . $value->nik) }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" name="nik" class="form-control"
                                        value="{{ $value->nik }}" maxlength="50" required="" placeholder="NIK">
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control"
                                        value="{{ $value->nama_lengkap }}" maxlength="50" required=""
                                        placeholder="Nama Lengkap" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control"
                                        value="{{ $value->tempat_lahir }}" maxlength="50" required=""
                                        placeholder="Tempat Lahir" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" class="form-control"
                                        value="{{ $value->tgl_lahir }}" maxlength="50" required=""
                                        placeholder="Tanggal Lahir" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Agama</label>
                                    <div class="col">
                                        <select class="form-control" name="agama" value="{{ $value->agama }}"
                                            autocomplete="off" id="exampleFormControlSelect1">
                                            <option>{{ $value->agama }}</option>
                                            <option disabled></option>
                                            <option>Islam</option>
                                            <option>Kristen Protestan</option>
                                            <option>Katolik</option>
                                            <option>Hindu</option>
                                            <option>Buddha</option>
                                            <option>Konghucu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pendidikan</label>
                                    <div class="col">
                                        <select class="form-control" name="pendidikan" value="{{ $value->pendidikan }}"
                                            autocomplete="off" id="exampleFormControlSelect1">
                                            <option>{{ $value->pendidikan }}</option>
                                            <option disabled></option>
                                            <option>Tidak/Belum Sekolah</option>
                                            <option>Belum Tamat SD/Sederajat</option>
                                            <option>Tamat SD/Sederajat</option>
                                            <option>SLTP/Sederajat</option>
                                            <option>SLTA/Sederajat</option>
                                            <option>Diploma I/II</option>
                                            <option>Diploma III/S.Muda</option>
                                            <option>Diploma IV/Strata I</option>
                                            <option>Strata II</option>
                                            <option>Strata III</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <div class="col">
                                        <select class="form-control" name="kelamin" value="{{ $value->jenis_kelamin }}"
                                            autocomplete="off" id="exampleFormControlSelect1">
                                            <option>{{ $value->jenis_kelamin }}</option>
                                            <option>Laki Laki</option>
                                            <option>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" name="pekerjaan" class="form-control"
                                        value="{{ $value->pekerjaan }}" maxlength="50" required=""
                                        placeholder="Pekerjaan" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Golongan Darah</label>
                                    <div class="col">
                                        <select class="form-control" name="gol_darah"
                                            value="{{ $value->golongan_darah }}" autocomplete="off"
                                            id="exampleFormControlSelect1">
                                            <option>{{ $value->golongan_darah }}</option>
                                            <option disabled></option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>O</option>
                                            <option>AB</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Status Perkawinan</label>
                                    <div class="col">
                                        <select class="form-control" name="status_perkawinan"
                                            value="{{ $value->status_perkawinan }}" autocomplete="off"
                                            id="exampleFormControlSelect1">
                                            <option>{{ $value->status_perkawinan }}</option>
                                            <option disabled></option>
                                            <option>Belum Kawin</option>
                                            <option>Kawin</option>
                                            <option>Cerai</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Perkawinan</label>
                                    <input type="date" name="tgl_perkawinan" class="form-control"
                                        value="{{ $value->tgl_perkawinan }}" maxlength="50" required=""
                                        placeholder="Tanggal Perkawinan" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Status Keluarga</label>
                                    <input type="text" name="status_keluarga" class="form-control"
                                        value="{{ $value->status_keluarga }}" maxlength="50" required=""
                                        placeholder="Status Keluarga" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Kewarganegaraan</label>
                                    <div class="col">
                                        <select class="form-control" name="kewarganegaraan"
                                            value="{{ $value->kewarganegaraan }}" autocomplete="off"
                                            id="exampleFormControlSelect1">
                                            <option>{{ $value->kewarganegaraan }}</option>
                                            <option disabled></option>
                                            <option>WNI</option>
                                            <option>WNA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>No Paspor</label>
                                    <input type="text" name="no_paspor" class="form-control"
                                        value="{{ $value->no_paspor }}" maxlength="50" required=""
                                        placeholder="No Paspor" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>No KITAP</label>
                                    <input type="text" name="no_kitap" class="form-control"
                                        value="{{ $value->no_kitap }}" maxlength="50" required=""
                                        placeholder="No KITAP" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Nama Ayah</label>
                                    <input type="text" name="nama_ayah" class="form-control"
                                        value="{{ $value->nama_ayah }}" maxlength="50" required=""
                                        placeholder="Nama Ayah" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Nama Ibu</label>
                                    <input type="text" name="nama_ibu" class="form-control"
                                        value="{{ $value->nama_ibu }}" maxlength="50" required=""
                                        placeholder="Nama Ibu" autocomplete="off">
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
        {{-- batas modal edit user --}}

        {{-- Modal Hapus user --}}
        @foreach ($data as $no => $value)
            <div class="modal fade" id="modal-hapus{{ $value->nik }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" autocomplete="off">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Master User</h5>
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
                                href="{{ url($value->nik . '/hapus-masteruser') }}" class="btn btn-danger">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- batad modal hapus user --}}
@endsection
{{-- Batas Section Content --}}

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
