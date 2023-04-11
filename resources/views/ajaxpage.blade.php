@foreach ($data as $item)
    <form action="{{ url('simpanrtrw') }}" method="post">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label>No Kartu Keluarga</label>
                <input type="text" name="no_kk" class="form-control" value="{{ $item->no_kk }}" maxlength="50"
                    required="" placeholder="NIK" autocomplete="off" disabled>
            </div>
            <div class="form-group">
                <label>Nama Kepala Keluarga</label>
                <input type="text" name="kepala_keluarga" class="form-control"
                    value="{{ $item->nama_kepala_keluarga }}" maxlength="50" required="" autocomplete="off" disabled>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ $item->alamat }}" maxlength="50"
                    required="" autocomplete="off" disabled>
            </div>
            <div class="form-group">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" value="" maxlength="50" required=""
                    placeholder="NIK" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" value="" maxlength="50"
                    required="" placeholder="Nama Lengkap" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="" maxlength="50"
                    required="" placeholder="Tempat Lahir" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="" maxlength="50" required=""
                    placeholder="Tanggal Lahir" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Agama</label>
                <div class="col">
                    <select class="form-control" name="agama" autocomplete="off" id="exampleFormControlSelect1">
                        <option>Pilih</option>
                        <option>Islam</option>
                        <option>Kristen Protestan</option>
                        <option>Katolik</option>
                        <option>Hindu</option>
                        <option>Buddha</option>
                        <option>Konghucu</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Pendidikan</label>
                <div class="col">
                    <select class="form-control" name="pendidikan" autocomplete="off" id="exampleFormControlSelect1">
                        <option>Pilih</option>
                        <option>Tidak/Belum Sekolah</option>
                        <option>Belum Tamat SD/Sederajat</option>
                        <option>Tamat SD/Sederajat</option>
                        <option>SLTP/Sederajat</option>
                        <option>SLTA/Sederajat</option>
                        <option>Diploma I/II</option>
                        <option>Diploma III/S.Muda</option>
                        <option>Diploma IV/Strata I</option>
                        <option>Strata II</option>
                        <option>Strata III</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Jenis kelamin</label>
                <div class="col">
                    <select class="form-control" name="jenis_kelamin" autocomplete="off" id="exampleFormControlSelect1">
                        <option>Pilih</option>
                        <option>Laki-Laki</option>
                        <option>Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan" class="form-control" value="" maxlength="50" required=""
                    placeholder="Pekerjaan" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Golongan Darah</label>
                <div class="col">
                    <select class="form-control" name="gol_darah" autocomplete="off" id="exampleFormControlSelect1">
                        <option>Pilih</option>
                        <option>A</option>
                        <option>B</option>
                        <option>O</option>
                        <option>AB</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Status Perkawinan</label>
                <div class="col">
                    <select class="form-control" name="status_perkawinan" autocomplete="off"
                        id="exampleFormControlSelect1">
                        <option>Pilih</option>
                        <option>Belum Kawin</option>
                        <option>Kawin</option>
                        <option>Cerai</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Tanggal Perkawinan</label>
                <input type="date" name="tgl_perkawinan" class="form-control" value="" maxlength="50"
                    required="" placeholder="Tanggal Perkawinan" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Status Keluarga</label>
                <input type="text" name="status_keluarga" class="form-control" value="" maxlength="50"
                    required="" placeholder="Status Keluarga" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Kewarganegaraan</label>
                <div class="col">
                    <select class="form-control" name="kewarganegaraan" autocomplete="off"
                        id="exampleFormControlSelect1">
                        <option>Pilih</option>
                        <option>WNI</option>
                        <option>WNA</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>No Paspor</label>
                <input type="text" name="no_paspor" class="form-control" value="" maxlength="50"
                    required="" placeholder="No Paspor" autocomplete="off">
            </div>
            <div class="form-group">
                <label>No KITAP</label>
                <input type="text" name="no_kitap" class="form-control" value="" maxlength="50"
                    required="" placeholder="No KITAP" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Nama Ayah</label>
                <input type="text" name="nama_ayah" class="form-control" value="" maxlength="50"
                    required="" placeholder="Nama Ayah" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Nama Ibu</label>
                <input type="text" name="nama_ibu" class="form-control" value="" maxlength="50"
                    required="" placeholder="Nama Ibu" autocomplete="off">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-Success">Simpan</button>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-Success">Simpan</button>
        </div>
    </form>
@endforeach
