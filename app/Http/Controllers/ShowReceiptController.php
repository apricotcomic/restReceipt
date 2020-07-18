<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowReceiptController extends Controller
{
    //
    public function index() {
    //
        return view('showreceipt/index');
    }

    //
    public function display(Request $request) {
        //
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
        return view('showreceipt/display', compact('receipt','details'));

    }
}
