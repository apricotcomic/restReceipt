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
        $receipt = $request->getReceipt();
        $details = $request->getReceiptDetail($receipt->id);

        return view('showreceipt/display', compact('receipt','details'));

    }
}
