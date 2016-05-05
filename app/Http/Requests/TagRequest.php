<?php

namespace App\Http\Requests;

use Auth;

class TagRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|unique:tags,name,' . (int)$this->route('id'),
                ];
            default:
                return [
                    'name' => 'required|unique:tags',
                ];
        }
    }
}
