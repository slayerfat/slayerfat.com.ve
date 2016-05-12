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
            'title'        => 'required|between:5,255|string',
            'body_one'     => 'required',
            'body_two'     => 'required_with:body_one',
            'body_three'   => 'required_with_all:body_one,body_two',
            'body_four'    => 'required_with_all:body_one,body_two,body_three',
            'summary'      => 'required|string|min:5',
            'publish_date' => 'required|date',
            'thumbnails'   => 'required',
            'tag_id'       => 'required|exists:tags,id',
        ];
    }
}
