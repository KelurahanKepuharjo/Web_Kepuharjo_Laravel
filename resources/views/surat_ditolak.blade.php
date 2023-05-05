@extends('layouts.mainlayout')
@section('title', 'Surat Ditolak')
<!-- partial -->
@section('content')
    @php
        $nama = session()->get('nama');
        $akses = session()->get('hak_akses');
        $rt = session()->get('rt');
        $rw = session()->get('rw');
    @endphp
    <h4 class="font-weight-bold text-dark">Ini Halaman Surat Masuk</h4>
    <table id="myTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jenis Surat</th>
                <th>Tanggal </th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $no => $value)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $value->nik }}</td>
                    <td>{{ $value->nama_lengkap }}</td>
                    <td>{{ $value->nama_surat }}</td>
                    <td>{{ $value->keterangan }}</td>
                    <td>{{ $value->status }}</td>
                    <td>
                        <a class="btn btn-secondary" style="background: #00AAAA; color: white;" data-toggle="modal"
                            data-target="#exampleModal" style="color: white;" href="#">Detail</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
        <tfoot>
    </table>




    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tempat, Tanggal Lahir </label>
                        <input type="text" name="ttl" class="form-control" value="" maxlength="50"
                            required="">
                    </div>
                    <div class="form-group">
                        <label>Kartu Keluarga</label>
                        <input type="hidden" id="idsurat" value="" />

                    </div>
                    <div class="form-group">
                        <img src="{{ asset('template/images/logo.png') }}" class="img-thumbnail" alt="Responsive image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
