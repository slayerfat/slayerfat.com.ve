<?php

namespace App\Http\Requests;

use Auth;

class PostRequest extends Request
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
            'title'         => 'required|between:5,255|alpha_dash',
            'body'          => 'required',
            'summary'       => 'required|alpha_dash',
            'publish_date'  => 'required|date',
            'thumbnail_url' => 'required|url',
            'tag_id'          => 'required|exists:tags,id',
        ];
    }
}
