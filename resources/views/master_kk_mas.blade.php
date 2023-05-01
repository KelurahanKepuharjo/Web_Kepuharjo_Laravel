@extends('layouts.mainlayouts')
@section('title', 'Master KK')

{{-- Section Content --}}
@section('content')

    {{-- Page 2 Halaman master Masyarakat --}}

    <div class="header-atas">
        <h4>Halaman Master User</h4>
        <button data-toggle="modal" data-target="#modal-tambahmas">Tambah data</button>
    </div>
    <div class="table_wrapper" style="overflow-x: scroll;">
        <table id="myTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No KK</th>
                    <th>NIK</th>
                    <th>Nama Lengkap</th>
                    <th>Status Keluarga</th>
                    <th>Tempat Tanggal Lahir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <form action="" method="post">
                    @foreach ($data as $no => $value)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $value->no_kk }}</td>
                            <td>{{ $value->nik }}</td>
                            <td>{{ $value->nama_lengkap }}</td>
                            <td>{{ $value->status_keluarga }}</td>
                            <td>{{ $value->tempat_lahir }}, {{ $value->tgl_lahir }}</td>
                            <td>
                                <a class="btn btn-warning fa fa-pencil" style="color:white;" href=""
                                    data-toggle="modal" data-target="#modal-edit{{ $value->nik }}">
                                </a>
                                <a class="btn btn-danger icon-trash" name='Hapus' href="#" data-toggle="modal"
                                    data-target="#modal-hapus{{ $value->nik }}" style="margin-left: 10px; "
                                    href="{{ url('masteruser') }}"></a>
                            </td>
                        </tr>
                    @endforeach
                </form>
            </tbody>
        </table>

        {{-- Batas Page 2  --}}

        {{-- modal tambah user --}}
        <div class="modal fade" id="modal-tambahmas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Master User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('simpanuser') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" id="input" name="nokk" class="form-control" maxlength="50"
                                required="" value="{{ $nomor_kk }}" autocomplete="off" readonly>
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" maxlength="50"
                                     placeholder="NIK" autocomplete="off">
                                     @error('nik')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                     @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap') }}" maxlength="50"
                                     placeholder="Nama Lengkap" autocomplete="off">
                                     @error('nama_lengkap')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                     @enderror
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <div class="col">
                                    <select class="form-control @error('kelamin') is-invalid @enderror" name="kelamin" autocomplete="off"
                                        id="exampleFormControlSelect1">
                                        <option value="pilih" {{ "pilih" === old('kelamin') ? 'selected' : '' }}>Pilih</option>
                                        <option value="lk" {{ "lk" === old('kelamin') ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="pr" {{ "pr" === old('kelamin') ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}"
                                        maxlength="50" placeholder="Tempat Lahir" autocomplete="off">
                                        @error('tempat_lahir')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="col">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}"
                                        maxlength="50" placeholder="Tanggal Lahir" autocomplete="off">
                                        @error('tgl_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label>Agama</label>
                                    <div class="col">
                                        <select class="form-control @error('agama') is-invalid @enderror" value="{{ old('agama') }}" name="agama" autocomplete="off"
                                            id="exampleFormControlSelect1">
                                            <option value="pilih" {{ "pilih" === old('agama') ? 'selected' : '' }}>Pilih</option>
                                            <option value="islam" {{ "islam" === old('agama') ? 'selected' : '' }}>Islam</option>
                                            <option value="kristen" {{ "kristen" === old('agama') ? 'selected' : '' }}>Kristen Protestan</option>
                                            <option value="katolik" {{ "katolik" === old('agama') ? 'selected' : '' }}>Katolik</option>
                                            <option value="hindu" {{ "hindu" === old('agama') ? 'selected' : '' }}>Hindu</option>
                                            <option value="buddha" {{ "buddha" === old('agama') ? 'selected' : '' }}>Buddha</option>
                                            <option value="konghucu" {{ "konghucu" === old('agama') ? 'selected' : '' }}>Konghucu</option>
                                        </select>
                                        @error('agama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <label>Pendidikan</label>
                                    <div class="col">
                                        <select class="form-control @error('pendidikan') is-invalid @enderror" value="{{ old('pendidikan') }}" name="pendidikan" autocomplete="off"
                                            id="exampleFormControlSelect1">
                                            <option value="pilih" {{ "pilih" === old('pendidikan') ? 'selected' : '' }}>Pilih</option>
                                            <option value="tdk/blmsekolah" {{ "tdk/blmsekolah" === old('pendidikan') ? 'selected' : '' }}>Tidak/Belum Sekolah</option>
                                            <option value="blmtmtSD/sederajat" {{ "blmtmtSD/sederajat" === old('pendidikan') ? 'selected' : '' }}>Belum Tamat SD/Sederajat</option>
                                            <option value="tmtSD/sederajat" {{ "tmtSD/sederajat" === old('pendidikan') ? 'selected' : '' }}>Tamat SD/Sederajat</option>
                                            <option value="sltp" {{ "sltp" === old('pendidikan') ? 'selected' : '' }}>SLTP/Sederajat</option>
                                            <option value="slta" {{ "slta" === old('pendidikan') ? 'selected' : '' }}>SLTA/Sederajat</option>
                                            <option value="d1/2" {{ "d1/2" === old('pendidikan') ? 'selected' : '' }}>Diploma I/II</option>
                                            <option value="d3" {{ "d3" === old('pendidikan') ? 'selected' : '' }}>Diploma III/S.Muda</option>
                                            <option value="d4" {{ "d4" === old('pendidikan') ? 'selected' : '' }}>Diploma IV/Strata I</option>
                                            <option value="s1" {{ "s1" === old('pendidikan') ? 'selected' : '' }}>Strata II</option>
                                            <option value="s2" {{ "s2" === old('pendidikan') ? 'selected' : '' }}>Strata III</option>
                                        </select>
                                        @error('pendidikan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan') }}"
                                    maxlength="50" placeholder="Pekerjaan" autocomplete="off">
                                    @error('pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label>Golongan Darah</label>
                                    <div class="col">
                                        <select class="form-control @error('gol_darah') is-invalid @enderror" value="{{ old('gol_darah') }}" name="gol_darah" autocomplete="off"
                                            id="exampleFormControlSelect1">
                                            <option value="pilih" {{ "pilih" === old('gol_darah') ? 'selected' : '' }}>Pilih</option>
                                            <option value="-" {{ "-" === old('gol_darah') ? 'selected' : '' }}>-</option>
                                            <option value="a" {{ "a" === old('gol_darah') ? 'selected' : '' }}>A</option>
                                            <option value="b" {{ "b" === old('gol_darah') ? 'selected' : '' }}>B</option>
                                            <option value="o" {{ "o" === old('gol_darah') ? 'selected' : '' }}>O</option>
                                            <option value="ab" {{ "ab" === old('gol_darah') ? 'selected' : '' }}>AB</option>
                                        </select>
                                        @error('gol_darah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <label>Status Perkawinan</label>
                                    <div class="col">
                                        <select class="form-control @error('status_perkawinan') is-invalid @enderror" value="{{ old('status_perkawinan') }}" name="status_perkawinan" autocomplete="off"
                                            id="exampleFormControlSelect1">
                                            <option value="pilih" {{ "pilih" === old('status_perkawinan') ? 'selected' : '' }}>Pilih</option>
                                            <option value="belumkawin" {{ "belumkawin" === old('status_perkawinan') ? 'selected' : '' }}>Belum Kawin</option>
                                            <option value="kawin" {{ "kawin" === old('status_perkawinan') ? 'selected' : '' }}>Kawin</option>
                                            <option value="cerai" {{ "cerai" === old('status_perkawinan') ? 'selected' : '' }}>Cerai</option>
                                        </select>
                                        @error('status_perkawinan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Perkawinan</label>
                                <input type="date" name="tgl_perkawinan" class="form-control @error('tgl_perkawinan') is-invalid @enderror" value="{{ old('tgl_perkawinan') }}"
                                    maxlength="50" placeholder="Tanggal Perkawinan" autocomplete="off">
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label>Status Keluarga</label>
                                    <div class="col">
                                        <select class="form-control @error('status_keluarga') is-invalid @enderror)" value="{{ old('status_keluarga') }}" name="status_keluarga" autocomplete="off"
                                            id="exampleFormControlSelect1">
                                            <option value="pilih" {{ "pilih" === old('status_keluarga') ? 'selected' : '' }}>Pilih</option>
                                            {{-- <option>Kepala Keluarga</option> --}}
                                            <option value="istri" {{ "istri" === old('status_keluarga') ? 'selected' : '' }}>Istri</option>
                                            <option value="anak" {{ "anak" === old('status_keluarga') ? 'selected' : '' }}>Anak</option>
                                            <option value="wali" {{ "wali" === old('status_keluarga') ? 'selected' : '' }}>Wali</option>
                                        </select>
                                        @error('status_keluarga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <label>Kewarganegaraan</label>
                                    <div class="col">
                                        <select class="form-control @error('kewarganegaraan') is-invalid @enderror" value="{{ old('kewarganegaraan') }}" name="kewarganegaraan" autocomplete="off"
                                            id="exampleFormControlSelect1">
                                            <option value="pilih" {{ "pilih" === old('kewarganegaraan') ? 'selected' : '' }}>Pilih</option>
                                            <option value="wni" {{ "wni" === old('kewarganegaraan') ? 'selected' : '' }}>WNI</option>
                                            <option value="wna" {{ "wna" === old('kewarganegaraan') ? 'selected' : '' }}>WNA</option>
                                        </select>
                                        @error('kewarganegaraan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label>No Paspor</label>
                                    <input type="text" name="no_paspor" class="form-control @error('no_paspor') is-invalid @enderror" value="{{ old('no_paspor') }}"
                                        maxlength="50" placeholder="No Paspor" autocomplete="off">
                                </div>
                                <div class="col">
                                    <label>No KITAP</label>
                                    <input type="text" name="no_kitap" class="form-control @error('no_kitap') is-invalid @enderror" value="{{ old('no_kitap') }}"
                                        maxlength="50" placeholder="No KITAP" autocomplete="off">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label>Nama Ayah</label>
                                    <input type="text" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror" value="{{ old('nama_ayah') }}"
                                        maxlength="50" placeholder="Nama Ayah" autocomplete="off">
                                        @error('nama_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="col">
                                    <label>Nama Ibu</label>
                                    <input type="text" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror" value="{{ old('nama_ibu') }}"
                                        maxlength="50" placeholder="Nama Ibu" autocomplete="off">
                                        @error('nama_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                </div>
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
        {{-- batas modal tambah user --}}


        {{-- MOdal Edit --}}
        @foreach ($data as $no => $value)
            <div class="modal fade" id="modal-edit{{ $value->nik }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Master User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('update-masteruser/' . $value->nik) }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" id="input" name="nokk" class="form-control" maxlength="50"
                                    required="" value="{{ $nomor_kk }}" autocomplete="off" readonly>
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" maxlength="50"
                                        placeholder="NIK" autocomplete="off"
                                        value="{{ $value->nik }}">
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                        value="{{ $value->nama_lengkap }}" maxlength="50"
                                        placeholder="Nama Lengkap" autocomplete="off">
                                        @error('nama_lengkap')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <div class="col">
                                        <select class="form-control @error('kelamin') is-invalid @enderror" name="kelamin" autocomplete="off"
                                            id="exampleFormControlSelect1">
                                            <option value="pilih" {{ "pilih" === old('kelamin') ? 'selected' : '' }}>{{ $value->jenis_kelamin }}</option>
                                            <option value="lk" {{ "lk" === old('kelamin') ? 'selected' : '' }}>Laki Laki</option>
                                            <option value="pr" {{ "pr" === old('kelamin') ? 'selected' : '' }}>Perempuan</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col">
                                        <label>Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            value="{{ $value->tempat_lahir }}" maxlength="50"
                                            placeholder="Tempat Lahir" autocomplete="off">
                                            @error('tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                    </div>
                                    <div class="col">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                            value="{{ $value->tgl_lahir }}" maxlength="50"
                                            placeholder="Tanggal Lahir" autocomplete="off">
                                            @error('tgl_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col">
                                        <label>Agama</label>
                                        <div class="col">
                                            <select class="form-control @error('agama') is-invalid @enderror" name="agama" autocomplete="off"
                                                id="exampleFormControlSelect1">
                                                <option value="pilih" {{ "pilih" === old('agama') ? 'selected' : '' }}>{{ $value->agama }}</option>
                                                <option value="islam" {{ "islam" === old('agama') ? 'selected' : '' }}>Islam</option>
                                                <option value="kristen" {{ "kristen" === old('agama') ? 'selected' : '' }}>Kristen Protestan</option>
                                                <option value="katolik" {{ "katolik" === old('agama') ? 'selected' : '' }}>Katolik</option>
                                                <option value="hindu" {{ "hindu" === old('agama') ? 'selected' : '' }}>Hindu</option>
                                                <option value="buddha" {{ "buddha" === old('agama') ? 'selected' : '' }}>Buddha</option>
                                                <option value="konghucu" {{ "konghucu" === old('agama') ? 'selected' : '' }}>Konghucu</option>
                                            </select>
                                            @error('agama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label>Pendidikan</label>
                                        <div class="col">
                                            <select class="form-control @error('pendidikan') is-invalid @enderror" name="pendidikan" autocomplete="off"
                                                id="exampleFormControlSelect1">
                                                <option value="pilih" {{ "pilih" === old('pendidikan') ? 'selected' : '' }}>{{ $value->pendidikan }}</option>
                                                <option value="tdk/blmsekolah" {{ "tdk/blmsekolah" === old('pendidikan') ? 'selected' : '' }}>Tidak/Belum Sekolah</option>
                                                <option value="blmtmtSD/sederajat" {{ "blmtmtSD/sederajat" === old('pendidikan') ? 'selected' : '' }}>Belum Tamat SD/Sederajat</option>
                                                <option value="tmtSD/sederajat" {{ "tmtSD/sederajat" === old('pendidikan') ? 'selected' : '' }}>Tamat SD/Sederajat</option>
                                                <option value="sltp" {{ "sltp" === old('pendidikan') ? 'selected' : '' }}>SLTP/Sederajat</option>
                                                <option value="slta" {{ "slta" === old('pendidikan') ? 'selected' : '' }}>SLTA/Sederajat</option>
                                                <option value="d1/2" {{ "d1/2" === old('pendidikan') ? 'selected' : '' }}>Diploma I/II</option>
                                                <option value="d3" {{ "d3" === old('pendidikan') ? 'selected' : '' }}>Diploma III/S.Muda</option>
                                                <option value="d4" {{ "d4" === old('pendidikan') ? 'selected' : '' }}>Diploma IV/Strata I</option>
                                                <option value="s1" {{ "s1" === old('pendidikan') ? 'selected' : '' }}>Strata II</option>
                                                <option value="s2" {{ "s2" === old('pendidikan') ? 'selected' : '' }}>Strata III</option>
                                            </select>
                                            @error('pendidikan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror"
                                        value="{{ $value->pekerjaan }}" maxlength="50"
                                        placeholder="Pekerjaan" autocomplete="off">
                                        @error('pekerjaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="row form-group">
                                    <div class="col">
                                        <label>Golongan Darah</label>
                                        <div class="col">
                                            <select class="form-control @error('gol_darah') is-invalid @enderror" name="gol_darah" autocomplete="off"
                                                id="exampleFormControlSelect1">
                                                <option value="pilih" {{ "pilih" === old('gol_darah') ? 'selected' : '' }}>{{ $value->golongan_darah }}</option>
                                                <option value="-" {{ "-" === old('gol_darah') ? 'selected' : '' }}>-</option>
                                                <option value="a" {{ "a" === old('gol_darah') ? 'selected' : '' }}>A</option>
                                                <option value="b" {{ "b" === old('gol_darah') ? 'selected' : '' }}>B</option>
                                                <option value="o" {{ "o" === old('gol_darah') ? 'selected' : '' }}>O</option>
                                                <option value="ab" {{ "ab" === old('gol_darah') ? 'selected' : '' }}>AB</option>
                                            </select>
                                            @error('gol_darah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label>Status Perkawinan</label>
                                        <div class="col">
                                            <select class="form-control @error('status_perkawinan') is-invalid @enderror" name="status_perkawinan" autocomplete="off"
                                                id="exampleFormControlSelect1">
                                                <option value="pilih" {{ "pilih" === old('status_perkawinan') ? 'selected' : '' }}>{{ $value->status_perkawinan }}</option>
                                                <option value="belumkawin" {{ "belumkawin" === old('status_perkawinan') ? 'selected' : '' }}>Belum Kawin</option>
                                                <option value="kawin" {{ "kawin" === old('status_perkawinan') ? 'selected' : '' }}>Kawin</option>
                                                <option value="cerai" {{ "cerai" === old('status_perkawinan') ? 'selected' : '' }}>Cerai</option>
                                            </select>
                                            @error('status_perkawinan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Perkawinan</label>
                                    <input type="date" name="tgl_perkawinan" class="form-control @error('tgl_perkawinan') is-invalid @enderror"
                                        value="{{ $value->tgl_perkawinan }}" maxlength="50"
                                        placeholder="Tanggal Perkawinan" autocomplete="off">
                                </div>
                                <div class="row form-group">
                                    <div class="col">
                                        <label>Status Keluarga</label>
                                        <div class="col">
                                            <select class="form-control" name="status_keluarga" autocomplete="off"
                                                id="exampleFormControlSelect1">
                                                <option value="pilih" {{ "pilih" === old('status_keluarga') ? 'selected' : '' }}>{{ $value->status_keluarga }}</option>
                                                <option value="kepalakeluarga" {{ "kepala keluarga" === old('status_keluarga') ? 'selected' : '' }}>Kepala Keluarga</option>
                                                <option value="istri" {{ "istri" === old('status_keluarga') ? 'selected' : '' }}>Istri</option>
                                                <option value="anak" {{ "anak" === old('status_keluarga') ? 'selected' : '' }}>Anak</option>
                                                <option value="wali" {{ "wali" === old('status_keluarga') ? 'selected' : '' }}>Wali</option>
                                            </select>
                                            @error('status_keluarga')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label>Kewarganegaraan</label>
                                        <div class="col">
                                            <select class="form-control @error('kewarganegaraan') is-invalid @error" name="kewarganegaraan" autocomplete="off"
                                                id="exampleFormControlSelect1">
                                                <option value="pilih" {{ "pilih" === old('kewarganegaraan') ? 'selected' : '' }}>{{ $value->kewarganegaraan }}</option>
                                                <option value="wni" {{ "wni" === old('kewarganegaraan') ? 'selected' : '' }}>WNI</option>
                                                <option value="wna" {{ "wna" === old('kewarganegaraan') ? 'selected' : '' }}>WNA</option>
                                            </select>
                                            @error('kewarganegaraan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col">
                                        <label>No Paspor</label>
                                        <input type="text" name="no_paspor" class="form-control @error('no_paspor') is-invalid @enderror"
                                            value="{{ $value->no_paspor }}" maxlength="50" placeholder="No Paspor"
                                            autocomplete="off">
                                    </div>
                                    <div class="col">
                                        <label>No KITAP</label>
                                        <input type="text" name="no_kitap" class="form-control @error('no_kitap') is-invalid @enderror"
                                            value="{{ $value->no_kitap }}" maxlength="50" placeholder="No KITAP"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col">
                                        <label>Nama Ayah</label>
                                        <input type="text" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror"
                                            value="{{ $value->nama_ayah }}" maxlength="50"
                                            placeholder="Nama Ayah" autocomplete="off">
                                            @error('nama_ayah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                    </div>
                                    <div class="col">
                                        <label>Nama Ibu</label>
                                        <input type="text" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror"
                                            value="{{ $value->nama_ibu }}" maxlength="50"
                                            placeholder="Nama Ibu" autocomplete="off">
                                            @error('nama_ibu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                    </div>
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

        {{-- modal edit user --}}


        {{-- Modal Hapus user --}}
        @foreach ($data as $no => $value)
            <div class="modal fade" id="modal-hapus{{ $value->nik }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" autocomplete="off">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Master User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="">Yakin untuk Menghapus Data {{ $value->nama_lengkap }} ?</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <a type="button" onclick="showNotification()"
                                href="{{ url($value->nik . '/hapus-masteruser') }}" class="btn btn-danger">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- batad modal hapus user --}}
@endsection
{{-- Batas Section Content --}}

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function() {
        readData()
        $('#input').keyup(function() {
            var strcari = $("#input").val();
            if (strcari != "") {
                $("#read").html('<p class="text-muted">Menunggu Mencari Data ...</p>')
                $.ajax({
                    type: "get",
                    url: "{{ url('ajax') }}",
                    data: "nik=" + strcari,
                    success: function(data) {
                        $("#read").html(data);
                    }
                });
            } else {
                readData()
            }
        });
    });

    function readData() {
        $.get("{{ url('read') }}", {}, function(data, status) {
            $("#read").html(data);
        });
    }
</script>


<script>
    function isiTextfield(nilai) {
        document.getElementById("input").value = nilai;
    }

    var input = document.querySelector('#input'); // mengambil elemen input

    input.addEventListener('keyup', function(event) {
        if (event.keyCode === 13) { // cek jika tombol yang ditekan adalah tombol "Enter"
            event.preventDefault(); // membatalkan perilaku default tombol "Enter"
            document.querySelector('form').submit(); // melakukan submit form
        }
    });
</script>

<script>
    function isiTextfield2(nilai) {
        document.getElementById("input2").value = nilai;
    }

    var input = document.querySelector('#input'); // mengambil elemen input

    input.addEventListener('keyup', function(event) {
        if (event.keyCode === 13) { // cek jika tombol yang ditekan adalah tombol "Enter"
            event.preventDefault(); // membatalkan perilaku default tombol "Enter"
            document.querySelector('form').submit(); // melakukan submit form
        }
    });
</script>


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
