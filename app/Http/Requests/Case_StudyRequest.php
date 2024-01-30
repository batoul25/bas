<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Case_StudyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' =>['required'],
            'category' => ['required'],
            'logo'     => ['required','image','mimes:jpg,png,jpeg,gif,svg','max:2048'] ,
            'company_name'     => ['required' , 'string'] ,
            'order'    => ['required' , 'integer' , 'min:1' , 'between:1,50']
        ];
    }
}
