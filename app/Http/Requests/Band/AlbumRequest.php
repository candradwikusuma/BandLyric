<?php

namespace App\Http\Requests\Band;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest
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
                        // 'name'=>'required|unique:albums,name,'.optional($this->album)->id,
            //cara array
            'name'=>['required',Rule::unique('albums')->where(function($query){
                return $query->where('band_id',$this->band);
            })],
            'year'=>'required',
            'band'=>'required'
        ];
    }
}
