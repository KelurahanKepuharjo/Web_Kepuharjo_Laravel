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
    <div class="card" style="border-radius: 2px;">
        <div class="card-body">
            <div class="header-atas">
                <h5 class="font-weight-bold text-dark">Surat Ditolak</h5>
            </div>
            <table id="myTable" class="table table-bordered">
                <thead style="background-color: grey; color: white;">
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Surat</th>
                        <th>Waktu Pengajuan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $no => $value)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $value->pengajuan->nik }}</td>
                            <td>{{ $value->pengajuan->nama_lengkap }}</td>
                            <td>{{ $value->pengajuan->nama_surat }}</td>
                            <td>{{ $value->created_at->format('d-m-Y') }} Pukul {{ $value->created_at->format('H:i') }}</td>
                            <td>{{ $value->status }}</td>
                            <td>
                                <a class="btn btn-secondary" style="background: #00AAAA; color: white;" data-toggle="modal"
                                    data-target="#exampleModal{{ $value->nik }}" style="color: white;"
                                    href="#">Proses
                                    Surat</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pratinjau Data</h5>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

                </div>
            </div>
        </div>
    </div>
@endsection
