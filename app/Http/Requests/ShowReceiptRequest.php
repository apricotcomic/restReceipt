<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowReceiptRequest extends FormRequest
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
            'branch_id' => ['required','alpha_dash'],
            'terminal_id' => 'required',
            'original_receipt_id' => 'required'
        ];
    }

    public function withValidator ($validator) {
        $validator->after(function ($validator) {

            $receipt = $this->getReceipt();

            if ($receipt === null) {
                $validator->errors()->add('receipt','No Receipt Data');
                return;
            }

            $details = $this->getReceiptDetail($receipt->id);

            if ($details === null) {
                $validator->errors()->add('receipt_detail','No Details Data');
            }
        });

    }

    public function getReceipt() {
        return (
            \App\Receipt::where([
            ['company_id', '=', $this->input('company_id')],
            ['branch_id', '=', $this->input('branch_id')],
            ['terminal_id', '=', $this->input('terminal_id')],
            ['original_receipt_id', '=', $this->input('original_receipt_id')]
        ])->first()
        );
    }

    public function getReceiptDetail($id) {
        return (
            \App\receipt_detail::wherereceipt_id($id)
            ->orderby('line_no')
            ->get()
        );
    }

}
