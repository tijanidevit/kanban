<?php

namespace App\Http\Requests\Card;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ResponseTrait;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    use ResponseTrait;
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
            'title' => 'required|unique:cards',
            'column_id' => [
                'required',
                Rule::exists('columns','id')
            ],
            'description' => 'required',
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors()->first(), 422));
    }


    public function messages()
    {
        return [
            'title.unique' => "You have already created a card with the same title",
            'column_id.exists' => "Please select a valid column",
        ];
    }
}
