<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $rules = [];
       
        $rules['description'] = 'required';
        $rules['content'] = 'required';
        $rules['photo'] = 'required|image';

        if(\Request::method() == 'PUT')
        {   $id = \Request::segment(2) ? \Request::segment(2) : 0;
            $rules = [
                'name' => 'required|unique:posts,name,'.$id
               
            ];          
        }
        else
        {
            $rules = [
                'name' => 'required|unique:posts,name'
            ];
        }
        
        return $rules;
    }
}
