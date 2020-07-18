<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowReceiptRequest;
use Validator;

class ShowReceiptController extends Controller
{
    //
    public function index() {
    //
        return view('showreceipt/index');
    }

    //
    public function display(ShowReceiptRequest $request) {
        //
        /*
        $company_id = $request->company_id;
        $branch_id = $request->branch_id;
        $terminal_id = $request->terminal_id;
        $original_receipt_id = $request->original_receipt_id;

        $receipt = \App\Receipt::where([
            ['company_id', '=', $company_id],
            ['branch_id', '=', $branch_id],
            ['terminal_id', '=', $terminal_id],
            ['original_receipt_id', '=', $original_receipt_id]
        ])->first();

        $details = \App\receipt_detail::wherereceipt_id($receipt->id)
            ->orderby('line_no')
            ->get();
        */
        $receipt = $request->getReceipt();
        $details = $request->getReceiptDetail($receipt->id);

        return view('showreceipt/display', compact('receipt','details'));

    }
}
