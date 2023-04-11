@foreach ($data as $item)
    <form action="{{ url('simpanrtrw') }}" method="post">
        @csrf
        <div class="form-group">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" value="{{ $item->no_kk }}" maxlength="50"
                required="" placeholder="NIK" autocomplete="off" disabled>
        </div>
        <div class="form-group">
            <label>Nama Kepala Keluarga</label>
            <input type="text" name="nama_lengkap" class="form-control" value="{{ $item->nama_lengkap }}"
                maxlength="50" required="" placeholder="Nama Lengkap" autocomplete="off" disabled>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamatkk" class="form-control" value="{{ $item->tempat_lahir }}" maxlength="50"
                required="" placeholder="Alamat" autocomplete="off" disabled>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="defaultInline3" name="inlineDefaultRadiosExample">
            <label class="custom-control-label" for="defaultInline3">RW</label>
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-Success">Simpan</button>
        </div>
    </form>
@endforeach
