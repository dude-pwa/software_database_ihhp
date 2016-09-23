<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class KblicodeRequest extends Request
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return[];
                }
            case 'POST':
                {
                    return[
                        'kbli' => 'required|unique:kblicodes',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return[
                        'kbli' => 'required',
                    ];
                }
            default:break;
        }
    }
}
