@extends('layouts.mainlayout')
@section('title', 'Master Surat')
@include('sweetalert::alert')
<!-- partial -->
@section('content')
    <div class="header-atas" style="display: flex; justify-content: space-between; align-items: center;">
        @php
            $nama = session()->get('nama');
            $akses = session()->get('hak_akses');
            $rt = session()->get('rt');
            $rw = session()->get('rw');
        @endphp
        <h4 class="font-weight-bold text-dark">Master Surat</h4>
        <button data-toggle="modal" name='tambah' data-target="#modal-tambah">Tambah data</button>
    </div>
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
    @if (session::has('successhapus'))
        <script>
            toastr.success('Data Berhasil Dihapus', '')
        </script>
    @endif
    @if ($errors->any())
        <script>
<<<<<<< HEAD
            toastr.error('Cek Kembali Data yang Anda Input', 'Data Gagal Ditambahkan')
=======
            toastr.error('Cek Kembali Data Yang Anda Input', 'Berita Gagal Ditambahkan')
>>>>>>> 9f6f1e7a10ff22ca034479b73df9c79f367600a7
        </script>
    @endif
    <div class="table_wrapper" style="overflow-x: scroll;">
        <table id="myTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Surat</th>
                    <th>Jenis Surat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <form action="mastersurat" method="post">
                    @foreach ($data as $no => $value)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $value->id_surat }}</td>
                            <td>{{ $value->nama_surat }}</td>
                            <td>
                                <a class="btn btn-warning fa fa-pencil" style="color:white;"
                                    data-id="{{ $value->id_surat }}" href="" data-toggle="modal"
                                    data-target="#modal-editsurat{{ $value->id_surat }}">
                                </a>
                                <a class="btn btn-danger icon-trash" name='Hapus' data-toggle="modal"
                                    data-target="#modal-hapus{{ $value->id_surat }}" style="margin-left: 10px; "
                                    href="{{ url('/mastersurat') }}"></a>
                            </td>
                        </tr>
                    @endforeach
                </form>
            </tbody>
        </table>
    </div>

    {{-- modal tambah data surat --}}
    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" autocomplete="off">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Master Surat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('simpansurat') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nomor-kartu"></label>
                            <input type="number" name="id_surat" class="form-control" value="" placeholder="Id Surat"
                                autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="nomor-kartu"></label>
                            <input type="text" name="nama_surat" class="form-control" value="" maxlength="50"
                                required="" placeholder="Masukkan Nama Surat Contoh : Domisili" autocomplete="off">
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
    {{-- batas modal tambah surat --}}


    {{-- modal edit master surat --}}
    @foreach ($data as $no => $value)
        <div class="modal fade" id="modal-editsurat{{ $value->id_surat }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" autocomplete="off">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Master Surat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('editsurat/' . $value->id_surat) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nomor-kartu"></label>
                                <input type="number" name="id_surat" class="form-control" value="{{ $value->id_surat }}"
                                    placeholder="Id Surat" autocomplete="off" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nomor-kartu"></label>
                                <input type="text" name="nama_surat" class="form-control"
                                    value="{{ $value->nama_surat }}" placeholder="Jenis Surat" autocomplete="off">
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
    @endforeach
    {{-- batas modal edit --}}

    {{-- Modal Hapus --}}
    @foreach ($data as $no => $value)
        <div class="modal fade" id="modal-hapus{{ $value->id_surat }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" autocomplete="off">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ url('hapussurat/' . $value->id_surat) }}" method="get">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Master Surat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="">Yakin untuk Menghapus Jenis {{ $value->nama_surat }} ?</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- Batas Modal Hapus --}}

@endsection

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

{{-- toast cdn --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- jquery cdn --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
