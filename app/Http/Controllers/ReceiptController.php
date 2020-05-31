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

        //insert receipt_detail
        $content = $request->getContent();
        $json = json_decode($content, true);
        foreach ($json["receipt_details"] as $key => $value) {
            \App\receipt_detail::create([
                'receipt_id' => $receipt_id,
                'line_no' => $value["no"],
                'item_name' => $value["item_name"],
                'unit_price' => $value["unit_price"],
                'quantity' => $value["quantity"],
                'tax' => $value["tax"],
                'fee' => $value["fee"],
                'item_1' => $value["item_1"],
                'item_2' => $value["item_2"],
                'item_3' => $value["item_3"],
                'item_4' => $value["item_4"],
                'item_5' => $value["item_5"]
            ]);
        }

        //insert original_JSON
        Log::debug('message', ['msg' => 'original_JSON insert', 'id' => $receipt_id]);
        $original_json = new \App\original_json();
        $original_json->JSON_data = $content;
        $original_json->receipt_id = $receipt_id;
        $original_json->save();

        //$receipt = \App\receipt::find($receipt_id)
        //    ->update([
        //        'original_JSON_id' => $original_json->count()
        //    ]);
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
