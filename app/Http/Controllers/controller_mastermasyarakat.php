<?php

namespace App\Http\Controllers;
use App\Models\master_masyarakat;
use App\Models\master_akun;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Alert;
use Redirect;

class controller_mastermasyarakat extends Controller
{
    // Controller Master Masyarakat

    public function master_kk_mas(Request $request, $id){
        $data = DB::table('master_masyarakats')
        ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
        ->where('master_kks.id','=', $id)
        ->get();
        return view('master_kk_mas', ['nomor_kk'=> $id] , compact('data'));
    }

    public function simpanmasteruser(Request $request)
    {
        $this->validate($request, [
        ]);
            try {
                $data = new master_masyarakat();
                $uuid = Str::uuid()->toString();
                $data->id_masyarakat = $uuid;
                $data->id = $request->nokk;
                $data->nik = $request->nik;
                $data->nama_lengkap = $request->nama_lengkap;
                $data->jenis_kelamin = $request->kelamin;
                $data->tempat_lahir = $request-> tempat_lahir;
                $data->tgl_lahir = $request-> tgl_lahir;
                $data->agama = $request->agama;
                $data->pendidikan = $request->pendidikan;
                $data->pekerjaan = $request->pekerjaan;
                $data->golongan_darah = $request->gol_darah;
                $data->status_perkawinan = $request->status_perkawinan;
                $data->tgl_perkawinan = $request->tgl_perkawinan;
                $data->status_keluarga = $request->status_keluarga;
                $data->kewarganegaraan = $request->kewarganegaraan;
                $data->no_paspor = $request->no_paspor;
                $data->no_kitap = $request->no_kitap;
                $data->nama_ayah = $request->nama_ayah;
                $data->nama_ibu = $request->nama_ibu;
                $data->save();
                // return Redirect('masterkkmas/'.$data->id);
                return Redirect('simpanakuns/'.$data->id_masyarakat);
            } catch (\Throwable $th) {
                //throw $th;
            }

            try {
                $data = DB::table('master_masyarakats')
                ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
                ->orderBy('created_at', 'desc')
                ->limit(1)
                ->select('master_kks.id')
                ->first();
                // return Redirect('simpanuserakuns/'.$data->id_masyarakat);
                // return Redirect('simpanakuns'.$data->id_masyarakat);
            } catch (\Throwable $th) {
                //throw $th;
            }


    }

    public function simpanmasteruserakun(Request $request, $id){
        try {
            $data = new master_akun();
            $uuid = Str::uuid()->toString();
            $data->id = $uuid;
            $data->no_hp = 62;
            $data->password = "KepuharjoBermantra";
            $data->role = "masyarakat";
            $data->id_masyarakat = $id;
            $data->save();

        } catch (\Throwable $th) {
            //throw $th;
        }

        try {
            $data = DB::table('master_masyarakats')
            ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
            ->where('master_masyarakats.id_masyarakat','=', $id )
            ->first();
            // return Redirect('masterkkmas/'.$data->no_kk);
            return Redirect('masterkkmas/'.$data->id);
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    public function updatemasteruser(Request $request, $id){
        try {
                $data = DB::table('master_masyarakats')->where('nik', $id)->update([
                    // $data->nik = $request->nik,
                    'nama_lengkap' => $request->nama_lengkap,
                    'jenis_kelamin' => $request->kelamin,
                    'tempat_lahir' => $request-> tempat_lahir,
                    'tgl_lahir' => $request-> tgl_lahir,
                    'agama' => $request->agama,
                    'pendidikan' => $request->pendidikan,
                    'pekerjaan' => $request->pekerjaan,
                    'golongan_darah' => $request->gol_darah,
                    'status_perkawinan' => $request->status_perkawinan,
                    'tgl_perkawinan' => $request->tgl_perkawinan,
                    'status_keluarga' => $request->status_keluarga,
                    'kewarganegaraan' => $request->kewarganegaraan,
                    'no_paspor' => $request->no_paspor,
                    'no_kitap' => $request->no_kitap,
                    'nama_ayah' => $request->nama_ayah,
                    'nama_ibu' => $request->nama_ibu
                ]);
            // $data->no_kk = $request->nokk;

                // $data->save();


        } catch (\Throwable $th) {
            //throw $th;
        }

        try {
            $data = DB::table('master_masyarakats')
            ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
            ->where('nik','=', $request->nik)
            ->select('master_kks.id')
            ->first();
            return Redirect('masterkkmas/'.$data->id);
            // return Redirect('simpanuserakuns/'.$data->id_masyarakat);
            // return Redirect('simpanakuns'.$data->id_masyarakat);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function hapusmasteruser(Request $request, $id){
            $data = master_masyarakat::where('nik', $id);
            $data -> delete();
        return Redirect('masterkkmas/'.$request->nokk);
    }


    // public function simpanmasteruser(Request $request)
    // {
    //     $this->validate($request, [
    //     ]);

    //     try {
    //         $data = new master_masyarakat();
    //         $uuid = Str::uuid()->toString();
    //         $data->id_masyarakat = $uuid;
    //         $data->id = $request->nokk;
    //         $data->nik = $request->nik;
    //         $data->nama_lengkap = $request->nama_lengkap;
    //         $data->jenis_kelamin = $request->kelamin;
    //         $data->tempat_lahir = $request-> tempat_lahir;
    //         $data->tgl_lahir = $request-> tgl_lahir;
    //         $data->agama = $request->agama;
    //         $data->pendidikan = $request->pendidikan;
    //         $data->pekerjaan = $request->pekerjaan;
    //         $data->golongan_darah = $request->gol_darah;
    //         $data->status_perkawinan = $request->status_perkawinan;
    //         $data->tgl_perkawinan = $request->tgl_perkawinan;
    //         $data->status_keluarga = $request->status_keluarga;
    //         $data->kewarganegaraan = $request->kewarganegaraan;
    //         $data->no_paspor = $request->no_paspor;
    //         $data->no_kitap = $request->no_kitap;
    //         $data->nama_ayah = $request->nama_ayah;
    //         $data->nama_ibu = $request->nama_ibu;
    //         $data->save();
    //         // return Redirect('masterkkmas/'.$data->id);
    //         return Redirect('simpanakuns/'.$data->id_masyarakat);
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }

    //     try {
    //         $data = DB::table('master_masyarakats')
    //         ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
    //         ->orderBy('created_at', 'desc')
    //         ->limit(1)
    //         ->select('master_kks.id')
    //         ->first();
    //         // return Redirect('simpanuserakuns/'.$data->id_masyarakat);
    //         // return Redirect('simpanakuns'.$data->id_masyarakat);
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }


    // }

    // public function simpanmasteruserakun(Request $request, $id){
    //     try {
    //         $data = new master_akun();
    //         $uuid = Str::uuid()->toString();
    //         $data->id = $uuid;
    //         $data->no_hp = 62;
    //         $data->password = "KepuharjoBermantra";
    //         $data->role = "masyarakat";
    //         $data->id_masyarakat = $id;
    //         $data->save();
    //         // return Redirect('masterkkmas/'.$data->no_kk);
    //         return Redirect('masterkkmas/'.$request->nokk);

    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }

    //     try {
    //         $data = DB::table('master_masyarakats')
    //         ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
    //         ->join('master_akuns', 'master_masyarakats.id_masyarakat', '=', 'master_akuns.id_masyarakat')
    //         ->where('id_masyarakat','=', $id )
    //         ->get();
    //         return Redirect('masterkkmas/'.$data->no_kk);

    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }
    //     // return Redirect('masterkkmas/'.$data->no_kk);
    // }

    // public function updatemasteruser(Request $request, $id){
    //     try {
    //             $data = DB::table('master_masyarakats')->where('nik', $id)->update([
    //                 // $data->nik = $request->nik,
    //                 'nama_lengkap' => $request->nama_lengkap,
    //                 'jenis_kelamin' => $request->kelamin,
    //                 'tempat_lahir' => $request-> tempat_lahir,
    //                 'tgl_lahir' => $request-> tgl_lahir,
    //                 'agama' => $request->agama,
    //                 'pendidikan' => $request->pendidikan,
    //                 'pekerjaan' => $request->pekerjaan,
    //                 'golongan_darah' => $request->gol_darah,
    //                 'status_perkawinan' => $request->status_perkawinan,
    //                 'tgl_perkawinan' => $request->tgl_perkawinan,
    //                 'status_keluarga' => $request->status_keluarga,
    //                 'kewarganegaraan' => $request->kewarganegaraan,
    //                 'no_paspor' => $request->no_paspor,
    //                 'no_kitap' => $request->no_kitap,
    //                 'nama_ayah' => $request->nama_ayah,
    //                 'nama_ibu' => $request->nama_ibu
    //             ]);

    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }

    //     try {
    //         $data = DB::table('master_masyarakats')
    //         ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
    //         ->where('nik','=', $request->nik)
    //         ->select('master_kks.id')
    //         ->first();
    //         return Redirect('masterkkmas/'.$data->id);
    //         // return Redirect('simpanuserakuns/'.$data->id_masyarakat);
    //         // return Redirect('simpanakuns'.$data->id_masyarakat);
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }
    // }

    // public function hapusmasteruser(Request $request, $id){
    //         $data = master_masyarakat::where('nik', $id);
    //         $data -> delete();
    //     return Redirect('masterkkmas/'.$request->nokk);
    // }

}