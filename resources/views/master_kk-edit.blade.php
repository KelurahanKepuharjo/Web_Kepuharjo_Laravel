@extends('layouts.mainlayout')
@section('title', 'Master KK')
<!-- partial -->
@section('content')
    <div class="header-atas">
        <h4>Halaman Master KK</h4>
        <button data-toggle="modal" name='tambah' data-target="#modal-tambah">Tambah data</button>
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
