<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CounterShowRequest extends FormRequest
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
            'from' => ['date_format:Y-m-d'],
            'to' => ['date_format:Y-m-d'],
        ];
    }

    /**
     * Get error messages for specific validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'from.date_format' => 'The date does not match the format YYYY-MM-DD.',
            'to.date_format' => 'The date does not match the format YYYY-MM-DD.',
        ];
    }

    /**
     * Get the json error for the defined validation rules.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return json
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
