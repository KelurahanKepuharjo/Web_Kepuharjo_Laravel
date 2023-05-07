<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KartukkeditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nokkedit' => 'required|max:16|min:16',
            'alamatkkedit' => 'required',
            'rtedit' => 'required',
            'rwedit' => 'required',
            'kdposedit' => 'required',
            'keledit' => 'required',
            'kecedit' => 'required',
            'kabedit' => 'required',
            'provedit' => 'required',
            'tglkkedit' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'nokkedit' => 'no_kk',
            'alamatkkedit' => 'alamat',
            'rtedit' => 'rt',
            'rwedit' => 'rw',
            'kdposedit' => 'kode_pos',
            'keledit' => 'kelurahan',
            'kecedit' => 'kecamatan',
            'kabedit' => 'kabupaten',
            'provedit' => 'provinsi',
            'tglkkedit' => 'kk_tgl',
        ];
    }

    public function messages()
    {
        return [
            'nokkedit.required' => 'Nomor kartu keluarga tidak boleh kosong',
            'nokkedit.min' => 'Nomor kartu keluarga miniman 16 angka',
            'nokkedit.max' => 'Nomor kartu keluarga maximal 16 angka',
            'alamatkkedit.required' => 'Alamat tidak boleh kosong',
            'kdposedit.required' => 'Kode Pos Tidak boleh kosong',
            'rtedit.required' => 'Rt tidak boleh kosong',
            'rwedit.required' => 'Rw tidak boleh kosong',
            'tglkkedit.required' => 'Tanggal KK tidak boleh kosong',
        ];
    }
}
