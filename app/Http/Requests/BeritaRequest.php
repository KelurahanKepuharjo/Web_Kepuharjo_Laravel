<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeritaRequest extends FormRequest
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
            'judul' => 'required',
            'sub_title' => 'required',
            'deskripsi' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'judul.required' => 'Judul harus diisi',
            'sub_title.required' => 'Sub Judul harus diisi',
            'deskripsi.required' => 'Isi Berita Harus diisi',
        ];
    }
}
