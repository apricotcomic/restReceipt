<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\receipt;
use app\receipt_detail;
use app\original_json;
use Illuminate\Support\Facades\Log;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::debug('message', ['msg' => 'store start']);
        //insert receipt
        $receipt = new \App\receipt();
        $receipt->company_id = $request->input('company_id');
        $receipt->register_id = $request->input('register_id');
        $receipt->original_receipt_id = $request->input('original_receipt_id');
        $receipt->total_tax = $request->input('total_tax');
        $receipt->total_fee = $request->input('total_fee');
        $receipt->original_JSON_id = 0;
        $receipt->save();
        $receipt_id = $receipt->count();
        Log::debug('message', ['msg' => 'receipt insert', 'id' => $receipt_id]);

        //insert receipt_detail
        $receipt_detail = new \App\receipt_detail();
        $array_receipt = array();
        $array_receipt = json_decode($request,true);
        $receipt_detail->receipt_id = $receipt_id;
        Log::debug('message', ['msg' => 'receipt insert', 'no' => $array_receipt]);
        //foreach ($array_receipt as $key1 => $value1) {
        //    foreach ($value1 as $key2 => $value2) {
        //        $receipt_detail->line_no = $value2['no'];
        //        $receipt_detail->item_name = $value2['item_name'];
        //        $receipt_detail->unit_price = $value2['unit_price'];
        //        $receipt_detail->quantity = $value2['quantity'];
        //        $receipt_detail->tax = $value2['tax'];
        //        $receipt_detail->fee = $value2['fee'];
        //        $receipt_detail->item_1 = $value2['item_1'];
        //        $receipt_detail->item_2 = $value2['item_2'];
        //        $receipt_detail->item_3 = $value2['item_3'];
        //        $receipt_detail->item_4 = $value2['item_4'];
        //        $receipt_detail->item_5 = $value2['item_5'];
        //        $receipt_detail->save();
        //        Log::debug('message', ['msg' => 'receipt insert', 'no' => array_search('no',$value2)]);
        //    }
        //}
        //insert original_JSON
        Log::debug('message', ['msg' => 'original_JSON insert', 'id' => $receipt_id]);
        $original_json = new \App\original_json();
        $original_json->JSON_data = $request->input('receipt_details');
        Log::debug('message', ['msg' => 'json_decode', 'error' => json_last_error_msg()]);
        $original_json->receipt_id = $receipt_id;
        $original_json->save();
        $receipt = \App\receipt::find($receipt_id)
            ->update(['original_JSON_id' => $original_json->count()]);

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
