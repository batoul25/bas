<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id'          => ['required'],
            'admin_id'         => ['required'],
            'category'         => ['required' , 'string'],
            'logo'             => ['required','image','mimes:jpg,png,jpeg','max:2048'] ,
            'company_name'     => ['required' , 'string'] ,
            'order'            => ['required' , 'integer' , 'min:1' , 'between:1,50'],
            'path'             =>  [ 'string'],


        ];
    }

       //if there is an error with the validation display the error as a Json response.
       protected function failedValidation(Validator $validator)
       {
            throw new HttpResponseException(response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422));
       }
}
