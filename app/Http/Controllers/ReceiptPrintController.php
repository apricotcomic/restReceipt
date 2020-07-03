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

    }


    public function print($id)
    {
        $company = \App\Company_infomation::whereCompany_id($id)->first();

        ReceiptPrint::printPDF($company);

    }
}
