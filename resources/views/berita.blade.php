@extends('layouts.mainlayout')
@section('title', 'Berita')
<!-- partial -->
@section('content')
    <div class="header-atas">
        <h4 class="font-weight-bold text-dark">Ini Halaman Berita</h4>
        <button data-toggle="modal" name='tambah' data-target="#modal-tambah">Tambah data</button>
    </div>
    <div class="table_wrapper" style="overflow-x: scroll;">
        <table id="myTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Id berita</th>
                    <th>Judul</th>
                    <th>Sub title</th>
                    <th>Deskripsi</th>
                    <th>Created_at</th>
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
                            <td>{{ $value->created_at }}</td>
                            <td>
                                <a class="btn btn-warning fa fa-pencil" style="color:white;"
                                    data-id="{{ $value->id_berita }}" href="" data-toggle="modal"
                                    data-target="#modal-editberita{{ $value->id }}">
                                </a>
                                <a class="btn btn-danger icon-trash" name='Hapus' data-toggle="modal"
                                    data-target="#modal-hapus" style="margin-left: 10px; " value="{{ $value->id_berita }}"
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
                            <input type="text" name="judul" class="form-control" value="" maxlength="50"
                                required="" placeholder="Judul Berita" autocomplete="off" name="judul">
                        </div>
                        <div class="form-group">
                            <input type="text" name="subtitle" class="form-control" value="" maxlength="50"
                                required="" placeholder="Sub Title" autocomplete="off" name="subtitle">
                        </div>
                        <div class="form-group">
                            <input type="text" name="deskripsi" class="form-control" value="" maxlength="50"
                                required="" placeholder="Deskripsi" autocomplete="off" name="deskripsi">
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
                        <a type="button" onclick="showNotification()"
                            href="{{ url( 'hapus-berita/' .$value->id) }}" class="btn btn-danger">Hapus</a>
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
</style>
