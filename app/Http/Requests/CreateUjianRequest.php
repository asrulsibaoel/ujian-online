<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUjianRequest extends Request
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
            'id_mapel' => 'required',
            'id_kelas' => 'required',
            'id_jurusan' => 'required',
            'waktu' => 'required',
            'kkm' => 'required',
            'id_soal' => 'required',
            'status' => 'required'
        ];
    }
}
