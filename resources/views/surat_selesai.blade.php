@extends('layouts.mainlayout')
@section('title', 'Surat Selesai')
<!-- partial -->
@section('content')
    @php
        $nama = session()->get('nama');
        $akses = session()->get('hak_akses');
        $rt = session()->get('rt');
        $rw = session()->get('rw');
    @endphp
    <h4 class="font-weight-bold text-dark">Surat Selesai</h4>
    <table id="myTable" class="table table-striped" style="width:100%">
        <thead>
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
                    <td>{{ $value->nik }}</td>
                    <td>{{ $value->nama_lengkap }}</td>
                    <td>{{ $value->nama_surat }}</td>
                    <td>{{ $value->created_at->format('d-m-Y') }} Pukul {{ $value->created_at->format('H:i') }}</td>
                    <td>{{ $value->status }}</td>
                    <td>
                        <a class="btn btn-secondary" style="background: #00AAAA; color: white;" data-toggle="modal"
                            data-target="#exampleModal{{ $value->nik }}" style="color: white;" href="#">Detail
                            Surat</a>
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
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
