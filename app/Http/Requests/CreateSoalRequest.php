<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateSoalRequest extends Request
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
            'kode_soal' => 'required|unique:tbl_soal'
        ];
    }
}
