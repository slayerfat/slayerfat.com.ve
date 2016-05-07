<?php

namespace App\Http\Requests;

use Auth;

class PostUpdateRequest extends Request
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
        return [
            'title'        => 'between:5,255|alpha_dash',
            'summary'      => 'alpha_dash|min:5',
            'publish_date' => 'date',
            'tag_id'       => 'exists:tags,id',
        ];
    }
}
