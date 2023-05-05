@extends('layouts.mainlayout')
@section('title', 'Berita')
@include('sweetalert::alert')
<!-- partial -->
@section('content')
    <div class="header-atas">
        <h4 class="font-weight-bold text-dark">Ini Halaman Berita</h4>
        <button data-toggle="modal" name='tambah' data-target="#modal-tambah">Tambah data</button>
    </div>

    @if (session::has('success'))
        <script>
            toastr.success('Berita Berhasil Ditambahkan', '')
        </script>
    @endif
    @if (session::has('successedit'))
        <script>
            toastr.success('Berita Berhasil Diedit', '')
        </script>
    @endif
    @if (session::has('successhapus'))
        <script>
            toastr.success('Berita Berhasil Dihapus', '')
        </script>
    @endif
    @if ($errors->any())
        <script>
            toastr.error('Cek Kembali Data yang Anda Input', 'Data Gagal Ditambahkan')
        </script>
    @endif

    <div class="table_wrapper" style="overflow-x:auto; margin: 10px; padding: 10px;">
        <table id="myTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Id berita</th>
                    <th>Judul</th>
                    <th>Sub title</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <form action="berita" method="post">
                    @foreach ($data as $no => $value)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $value->judul }}</td>
                            <td>{{ $value->sub_title }}</td>
                            <td>{{ $value->deskripsi }}</td>
                            <td>
                                <a class="btn btn-warning fa fa-pencil" style="color:white;"
                                    data-id="{{ $value->id_berita }}" href="" data-toggle="modal"
                                    data-target="#modal-editberita{{ $value->id }}">
                                </a>
                                <a class="btn
                                    btn-danger icon-trash" name='Hapus'
                                    data-toggle="modal" data-target="#modal-hapus" value="{{ $value->id_berita }}"
                                    href="{{ url('masterberita') }}"></a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Master Berita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('simpanberita') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="judul" class="form-control" value="" required=""
                                placeholder="Judul Berita" autocomplete="off" name="judul">
                        </div>
                        <div class="form-group">
                            <input type="text" name="subtitle" class="form-control" value="" required=""
                                placeholder="Sub Title" autocomplete="off" name="subtitle">
                        </div>
                        <div class="form-group">
                            <input type="text" name="deskripsi" class="form-control" value="" required=""
                                placeholder="Deskripsi" autocomplete="off" name="deskripsi">
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

    {{-- Modal Hapus --}}
    @foreach ($data as $no => $value)
        <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" autocomplete="off">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Master Berita</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="">Yakin untuk Menghapus Data ?</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <a type="button" onclick="showNotification()" href="{{ url('hapus-berita/' . $value->id) }}"
                            class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- Batas Modal Hapus --}}

    <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Master Berita</h5>
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

    @foreach ($data as $no => $value)
        <div class="modal fade" id="modal-editberita{{ $value->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Berita</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('update-berita/' . $value->id) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" name="judul" class="form-control" value="{{ $value->judul }}"
                                    maxlength="50" required="" placeholder="Judul Berita" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="text" name="subtitle" class="form-control"
                                    value="{{ $value->sub_title }}" maxlength="50" required=""
                                    placeholder="Sub Title" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="text" name="deskripsi" class="form-control"
                                    value="{{ $value->deskripsi }}" maxlength="50" required=""
                                    placeholder="Deskripsi" autocomplete="off">
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

@endsection


<style>
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

    a {
        style="margin-top: 10px;

    }

    /* table {
        width: 100%;
        table-layout: fixed;
        word-wrap: break-word;
        overflow: hidden;
    } */
</style>





<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

{{-- toast cdn --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- jquery cdn --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
