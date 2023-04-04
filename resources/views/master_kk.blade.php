@extends('layouts.mainlayout')
@section('title', 'Master KK')
<!-- partial -->
@section('content')
    <div class="header-atas">
        <h4>Halaman Master KK</h4>
        <button data-toggle="modal" name='tambah' data-target="#modal-tambah">Tambah data</button>
    </div>
    <div class="table_wrapper" style=" overflow-x: scroll;">
        <table id="myTable" class="table table-striped" style="width:100%">
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
                                    data-toggle="modal" data-target="#myModal{{ $value->no_kk }}">
                                </a>
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

    @foreach ($data as $no => $value)
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
                        <a type="button" onclick="showNotification()"
                            href="{{ url($value->no_kk . '/hapus-masterkk') }}" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data as $no => $value)
        <div class="modal fade" id="myModal{{ $value->no_kk }}" tabindex="-1" role="dialog"
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
                                        placeholder="Nomor KK">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="kepala_keluarga" class="form-control"
                                        value="{{ $value->nama_kepala_keluarga }}" maxlength="50" required=""
                                        placeholder="Nama Kepala Keluarga">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="alamatkk" class="form-control"
                                        value="{{ $value->alamat }}" maxlength="50" required=""
                                        placeholder="Alamat">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="rt"
                                                value="{{ $value->rt }} "class="form-control" placeholder="RT">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="rw" value="{{ $value->rw }}"
                                                class="form-control" placeholder="RW">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="kdpos" value="{{ $value->kode_pos }}"
                                                class="form-control" placeholder="Kode Pos">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="kel" class="form-control"
                                                placeholder="Kelurahan" value="{{ $value->kelurahan }}" maxlength="50"
                                                required="">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="kec" class="form-control"
                                                placeholder="Kecamatan"value="{{ $value->kecamatan }}" maxlength="50"
                                                required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="kab" class="form-control"
                                                placeholder="Kabupaten"value="{{ $value->kabupaten }}" maxlength="50"
                                                required="">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="prov" class="form-control"
                                                placeholder="Provinsi"value="{{ $value->provinsi }}" maxlength="50"
                                                required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">KK Tanggal</label>
                                    <!-- Input type date dengan format yyyy-mm-dd -->
                                    <input type="date" class="form-control" value="{{ $value->kk_tgl }}"
                                        name="tglkk" id="myDate" name="myDate" placeholder="yyyy-mm-dd"
                                        min="1000-01-01" max="9999-12-31">
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
        </div>
    @endforeach
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

{{--
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
</script> --}}

<script>
    function showNotification() {
        // Buat elemen notifikasi
        var notification = document.createElement("div");
        notification.classList.add("notification");
        notification.textContent = "Ini adalah notifikasi!";

        // Tambahkan notifikasi ke dalam dokumen
        document.body.appendChild(notification);

        // Hilangkan notifikasi setelah 5 detik
        setTimeout(function() {
            notification.remove();
        }, 5000);
    }
</script>
<style>
    .notification {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background-color: #ffcc00;
        color: #333;
        font-weight: bold;
        padding: 10px;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
</style>
