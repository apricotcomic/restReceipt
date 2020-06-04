<?php

namespace App\Http\Requests;

use Illuminate\contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReceiptRequest extends FormRequest
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
            //
            'company_id' => 'exists:company,id',
            'remarks' => 'same:$array_count',
            'no' => ['numeric','lt:$array_count']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $res = response()->json([
            'status' => 400,
            'errors' => $validator->errors(),
        ],400);
        throw new HttpResponseException($res);
    }

    public function withValidator(Validator $validator) {
        $validator->after(function ($validator) {
            $content = $this->getContent();
            $json = json_decode($content, true);
            foreach ($this["receipt_details"] as $key => $value) {

            }
        });
    }
}
