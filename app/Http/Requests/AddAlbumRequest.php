<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAlbumRequest extends FormRequest
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
            'name' => 'string|required',
            'year' => 'integer|required',
            'artist_id' => 'integer|required',
            'cover' => 'mimes:jpeg,bmp,png,jpg|required'
        ];
    }
}
