<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ImportsRequest extends Request
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
            'tahun' => 'required', 
            'hscode' => 'required', 
            'nama_item' => 'required',
            'kode_negara' => 'required', 
            'nama_negara' => 'required', 
            'kode_pelabuhan' => 'required', 
            'nama_pelabuhan' => 'required', 
            'berat_bersih' => 'required', 
            'nilai' => 'required'
        ];
    }
}
