<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ReceiptPrint;

class ReceiptPrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $receipts = \App\Receipt::all();

        return view('receiptinfo.index',compact('receipts'));

    }

/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $receipt = \App\Receipt::find($id);
        $details = \App\receipt_detail::wherereceipt_id($id)->get;
        return view('receiptinfo.show', compact('receipt','details'));
    }

    public function print($id)
    {
        $company = \App\Company_infomation::whereCompany_id($id)->first();

        ReceiptPrint::printPDF($company);

    }
}
