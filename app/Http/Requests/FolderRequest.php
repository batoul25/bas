<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FolderRequest extends FormRequest
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
            'name'     => ['required' , 'string'],
            'size'     => ['required'],
            'creation_date'     => ['required'],
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
