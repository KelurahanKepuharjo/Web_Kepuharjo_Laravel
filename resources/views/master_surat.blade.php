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
            toastr.error('Cek Kembali Data yang Anda Input', 'Data Gagal Ditambahkan')
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
                <form action="{{ url('simpansurat') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" name="image"
                                class="form-control  @error('image')is-invalid
                                @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nomor-kartu"></label>
                            <input type="number" name="id_surat"
                                class="form-control  @error('id_surat')is-invalid
                                @enderror"
                                value="" placeholder="Id Surat" autocomplete="off">
                            @error('id_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nomor-kartu"></label>
                            <input type="text" name="nama_surat"
                                class="form-control @error('nama_surat')is-invalid
                                @enderror"
                                value="" placeholder="Jenis Surat" autocomplete="off">
                            @error('nama_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                    <form action="{{ url('editsurat/' . $value->id_surat) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <img src="{{ asset('images/' . $value->image) }}" alt="">
                            <div class="form-group">
                                <input type="file" name="image"
                                    class="form-control  @error('image')is-invalid
                                @enderror">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nomor-kartu"></label>
                                <input type="number" name="id_surat"
                                    class="form-control  @error('id_surat')is-invalid
                                @enderror"
                                    value="{{ old('id_surat', $value->id_surat) }}" placeholder="Id Surat"
                                    autocomplete="off">
                                @error('id_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nomor-kartu"></label>
                                <input type="text" name="nama_surat"
                                    class="form-control @error('nama_surat')is-invalid
                                @enderror"
                                    value="{{ old('nama_surat', $value->nama_surat) }}" placeholder="Jenis Surat"
                                    autocomplete="off">
                                @error('nama_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
