@extends('layouts.mainlayout')
@section('title', 'Surat Masuk')
<!-- partial -->
@php
    $nama = session()->get('nama');
    $akses = session()->get('hak_akses');
    $rt = session()->get('rt');
    $rw = session()->get('rw');
@endphp
@section('content')
    <div class="card" style="border-radius: 2px;">
        <div class="card-body">
            <div class="header-atas">
                <h5 class="font-weight-bold text-dark">Surat Masuk</h5>
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
                            <td>{{ $value->created_at }} Pukul {{ $value->created_at }}</td>
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



    <!-- Modal RT dan RW-->
    @foreach ($data as $no => $value)
        <div class="modal fade" id="exampleModal{{ $value->nik }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control" value="{{ $value->nik }}"
                                maxlength="50" required="">
                            <span class="text-danger">
                        </div>
                        <div class="form-group">
                            <label>Nama </label>
                            <input type="text" name="nama" class="form-control" value="{{ $value->nama_lengkap }}"
                                maxlength="50" required="">
                        </div>
                        <div class="form-group">
                            <label>Tempat, Tanggal Lahir </label>
                            <input type="text" name="ttl" class="form-control"
                                value="{{ $value->tempat_lahir }}, {{ $value->tgl_lahir }}" maxlength="50" required="">
                        </div>
                        <div class="form-group">
                            <label>Jenis kelamin</label>
                            <input type="text" name="kelamin" class="form-control" value="{{ $value->jenis_kelamin }}"
                                maxlength="50" required="">
                        </div>
                        <div class="form-group ">
                            <label>Kebangsaan/Agama</label>
                            <input type="text" name="kebangsaan" class="form-control"
                                value="{{ $value->kewarganegaraan }} / {{ $value->agama }}" maxlength="30" required="">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" name="status" class="form-control"
                                value="{{ $value->status_perkawinan }}" maxlength="50" required="">
                            <span class="text-danger">
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control" value="{{ $value->pekerjaan }}"
                                maxlength="50" required="">
                            <span class="text-danger">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{ $value->alamat }}"
                                maxlength="50" required="">
                            <span class="text-danger">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pengajuan</label>
                            <input type="text" name="tglpengajuan" class="form-control" value="{{ $value->created_at }}"
                                maxlength="50" required="">
                            <span class="text-danger">
                        </div>
                        <div class="form-group">
                            <label>Keperluan Surat</label>
                            <input type="text" name="keperluan" class="form-control"
                                value="{{ $value->keterangan }}" maxlength="50" required="">
                            <span class="text-danger">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-secondary"
                            style="background-color: rgb(0, 189, 0); color: white;"
                            href="{{ url('updatestatus/' . $value->id . '/' . $akses) }}">Setujui</a>
                        <a type="button" class="btn btn-danger"
                            href="{{ url('updatestatustolak/' . $value->id . '/' . $akses) }}">Tolak</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>


                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal Admin Kelurahan --}}
    @if ($akses == 'admin')
        @foreach ($data as $no => $value)
            <div class="modal fade" id="exampleModal{{ $value->nik }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <label>NIK</label>
                                <input type="text" name="nik" class="form-control" value="{{ $value->nik }}"
                                    maxlength="50" required="">
                                <span class="text-danger">
                            </div>
                            <div class="form-group">
                                <label>Nama </label>
                                <input type="text" name="nama" class="form-control"
                                    value="{{ $value->nama_lengkap }}" maxlength="50" required="">
                            </div>
                            <div class="form-group">
                                <label>Tempat, Tanggal Lahir </label>
                                <input type="text" name="ttl" class="form-control"
                                    value="{{ $value->tempat_lahir }}, {{ $value->tgl_lahir }}" maxlength="50"
                                    required="">
                            </div>
                            <div class="form-group">
                                <label>Jenis kelamin</label>
                                <input type="text" name="kelamin" class="form-control"
                                    value="{{ $value->jenis_kelamin }}" maxlength="50" required="">
                            </div>
                            <div class="form-group ">
                                <label>Kebangsaan/Agama</label>
                                <input type="text" name="kebangsaan" class="form-control"
                                    value="{{ $value->kewarganegaraan }} / {{ $value->agama }}" maxlength="30"
                                    required="">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" name="status" class="form-control"
                                    value="{{ $value->status_perkawinan }}" maxlength="50" required="">
                                <span class="text-danger">
                            </div>
                            <div class="form-group">
                                <label>Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control"
                                    value="{{ $value->pekerjaan }}" maxlength="50" required="">
                                <span class="text-danger">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="alamat" class="form-control" value="{{ $value->alamat }}"
                                    maxlength="50" required="">
                                <span class="text-danger">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pengajuan</label>
                                <input type="text" name="tglpengajuan" class="form-control"
                                    value="{{ $value->created_at }}" maxlength="50" required="">
                                <span class="text-danger">
                            </div>
                            <div class="form-group">
                                <label>Keperluan Surat</label>
                                <input type="text" name="keperluan" class="form-control"
                                    value="{{ $value->keterangan }}" maxlength="50" required="">
                                <span class="text-danger">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-secondary"
                                style="background-color: rgb(0, 189, 0); color: white;">Kirim melalui
                                WhatsApp</button>
                            <button type="button" class="btn btn-danger">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
