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
            'company_id' => 'exists:company,id',        //comapnyテーブルのidに存在すること
            'total_tax' => 'numeric',
            'total_fee' => 'numeric',
            'receipt_details.*.no' => ['numeric', 'distinct'],   //数字、かつ重複チェック
            'receipt_details.*.unit_price' => 'numeric',
            'receipt_details.*.quantity' => 'numeric',
            'receipt_details.*.tax' => 'numeric',
            'receipt_details.*.fee' => 'numeric'
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
}
