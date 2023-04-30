<?php

namespace App\Http\Controllers;
use App\Models\master_kks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\master_masyarakat;
use Alert;
use Redirect;

class controller_masterkk extends Controller
{
    //Untuk Menampilkan data KK
    public function master_kk(){
        // $data = master_kks::all();
        $data = DB::table('master_kks')
        ->join('master_masyarakats','master_masyarakats.id','=','master_kks.id')
        ->where('master_masyarakats.status_keluarga','=','Kepala Keluarga')
        // ->orWhere('master_masyarakats.status_keluarga','=', '')
        ->orderBy('master_kks.rw','asc')
        ->orderBy('master_kks.rt','asc')
        ->get();
        return view('master_kk', compact('data'));
    }

    public function simpankepalakeluarga(Request $request, $id, $other_id, $nik){
        $datakepala = DB::table('master_kks')
        ->select('master_kks.id')
        ->where('master_kks.no_kk','=', $id)
        ->first();

        // dd($datakepala);
        // dd($other_id);
        $data = new master_masyarakat();
        $uuid = Str::uuid()->toString();
        $data->id_masyarakat = $uuid;
        $data->id = $datakepala->id;
        $data->nik = $nik;
        $data->nama_lengkap = $other_id;
        $data->status_keluarga = 'Kepala Keluarga';
        $data->save();


         $data = DB::table('master_kks')
        ->join('master_masyarakats','master_masyarakats.id','=','master_kks.id')
        ->where('master_masyarakats.status_keluarga','=','Kepala Keluarga')
        // ->orWhere('master_masyarakats.status_keluarga','=', '')
        ->orderBy('master_kks.rw','asc')
        ->orderBy('master_kks.rt','asc')
        ->get();
        return view('master_kk', compact('data'));

    }

      // Untuk Simpan Master KK
      public function simpanmasterkk(Request $request)
      {
        $request->validate([
            'nokk' => 'required|max:16|min:16',
            'nik' => 'required|max:16|min:16',
            'kepala_keluarga' => 'required',
            'alamatkk' => 'required',
            'rt' => 'required',
            'rw' => 'required',
        ],[
            'nokk.required' => 'Nomor kartu keluarga tidak boleh kosong',
            'nokk.min' => 'Nomor kartu keluarga miniman 16 angka',
            'nokk.max' => 'Nomor kartu keluarga maximal 16 angka',
            'nik.required' => 'Nik tidak boleh kosong',
            'nik.min' => 'Nik minimal 16 angka',
            'nik.max' => 'Nik maximal 16 angka',
            'kepala_keluarga.required' => 'Nama Kepala Keluarga tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'Rt.required' => 'Rt tidak boleh kosong',
            'Rw.required' => 'Rw tidak boleh kosong',

        ]);
        $data = new master_kks();
        $data->no_kk = $request->nokk;
        // $data->nama_kepala_keluarga = $request->kepala_keluarga;
        $data->alamat = $request-> alamatkk;
        $data->rt = $request->rt;
        $data->rw = $request->rw;
        $data->kode_pos = $request->kdpos;
        $data->kelurahan = $request->kel;
        $data->kecamatan = $request->kec;
        $data->kabupaten = $request->kab;
        $data->provinsi = $request->prov;
        $data->kk_tgl = $request->tglkk;
        $data->save();
        return redirect('simpankepala/'.$request->nokk.'/'.$request->kepala_keluarga.'/'.$request->nik);
        //   try {

        //   } catch (\Throwable $th) {
        //       echo "<script>alert('Data Gagal Ditambahkan.');window.location='masterkk';</script>";
        //   }
      }

      //Untuk Edit Master KK
      public function edit(Request $request, $id){
          $data= master_kks::where('no_kk', $id)->first();
          return view('master_kk-edit', compact('data'));
      }


    //Untuk Update Master KK
      public function update(Request $request, $id){
        $request->validate([
            'nokk' => 'required|max:16|min:16',
            'nik' => 'required|max:16|min:16',
            'kepala_keluarga' => 'required',
            'alamatkk' => 'required',
            'rt' => 'required',
            'rw' => 'required',
        ],[
            'nokk.required' => 'Nomor kartu keluarga tidak boleh kosong',
            'nokk.min' => 'Nomor kartu keluarga miniman 16 angka',
            'nokk.max' => 'Nomor kartu keluarga maximal 16 angka',
            'nik.required' => 'Nik tidak boleh kosong',
            'nik.min' => 'Nik minimal 16 angka',
            'nik.max' => 'Nik maximal 16 angka',
            'kepala_keluarga.required' => 'Nama Kepala Keluarga tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'Rt.required' => 'Rt tidak boleh kosong',
            'Rw.required' => 'Rw tidak boleh kosong',
        ]);
          $data = master_kks::where('no_kk', $id)->first();
          $data->no_kk = $request->nokk;
        //   $data->nama_kepala_keluarga = $request->kepala_keluarga;
          $data->alamat = $request-> alamatkk;
          $data->rt = $request->rt;
          $data->rw = $request->rw;
          $data->kode_pos = $request->kdpos;
          $data->kelurahan = $request->kel;
          $data->kecamatan = $request->kec;
          $data->kabupaten = $request->kab;
          $data->provinsi = $request->prov;
          $data->kk_tgl = $request->tglkk;
      $data->save();
      return Redirect('masterkk');
      }


      //Untuk Hapus Master KK
      public function hapus(Request $request, $id){
          $data = master_kks::where('no_kk', $id);
          $data -> delete();
          return Redirect('masterkk');
      }
      // Batas Controller Master KK
}
