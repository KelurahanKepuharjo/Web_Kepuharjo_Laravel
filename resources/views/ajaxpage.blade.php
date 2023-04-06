@foreach ($data as $item)
    <form action="{{ url('simpanrtrw') }}" method="post">
        @csrf
        <div class="form-group">
            <input type="text" name="nik" class="form-control" value="{{ $item->nik }}" maxlength="50"
                required="" placeholder="NIK" autocomplete="off" disabled>
        </div>
        <div class="form-group">
            <input type="text" name="nama_lengkap" class="form-control" value="{{ $item->nama_lengkap }}"
                maxlength="50" required="" placeholder="Nama Lengkap" autocomplete="off" disabled>
        </div>
        <div class="form-group">
            <input type="text" name="alamatkk" class="form-control" value="{{ $item->tempat_lahir }}" maxlength="50"
                required="" placeholder="Alamat" autocomplete="off" disabled>
        </div>
        <div class="form-group">
            <input type="text" name="no_hp" class="form-control" value="" maxlength="50" required=""
                placeholder="No HP" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="text" name="password" class="form-control" value="" maxlength="50" required=""
                placeholder="Password" autocomplete="off">
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <input type="text" name="rt" class="form-control" placeholder="RT" autocomplete="off"
                        disabled>
                </div>
                <div class="col">
                    <input type="text" name="rw" class="form-control" placeholder="RW" autocomplete="off"
                        disabled>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="">Hak Akses : </label>
            <!-- Default inline 1-->
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="defaultInline1"
                    name="inlineDefaultRadiosExample">
                <label class="custom-control-label" for="defaultInline1">Masyarakat</label>
            </div>

            <!-- Default inline 2-->
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="defaultInline2"
                    name="inlineDefaultRadiosExample">
                <label class="custom-control-label" for="defaultInline2">RT</label>
            </div>

            <!-- Default inline 3-->
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="defaultInline3"
                    name="inlineDefaultRadiosExample">
                <label class="custom-control-label" for="defaultInline3">RW</label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-Success">Simpan</button>
        </div>
    </form>
@endforeach
