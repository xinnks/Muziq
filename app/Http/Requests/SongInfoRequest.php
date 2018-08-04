<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SongInfoRequest extends FormRequest
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
            'audio_file' => 'max:10000|required',
            'song_title' => 'string|required',
            'artist_id' => 'integer|required',
            'album_id' => 'integer',
            'cover_art' => 'image|mimes:jpeg,bmp,png|max:50000',
            'lyrics' => 'string'
        ];
    }
}
