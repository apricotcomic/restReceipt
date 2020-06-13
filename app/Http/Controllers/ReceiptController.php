<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\company;
use App\original_json;
use App\receipt;
use App\receipt_detail;
use App\Http\Requests\ReceiptRequest;

class ReceiptController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ReceiptRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReceiptRequest $request)
    {
        //JSON decode
        $content = $request->getContent();
        $json = json_decode($content, true);

        //insert receipt
        $receipt = new receipt();
        $receipt->company_id = $request->input('company_id');
        $receipt->branch_id = $request->input('branch_id');
        $receipt->terminal_id = $request->input('terminal_id');
        $receipt->original_receipt_id = $request->input('original_receipt_id');
        $receipt->total_tax = $request->input('total_tax');
        $receipt->total_fee = $request->input('total_fee');
        $receipt->original_JSON_id = 0;
        $receipt->save();
        $receipt_id = $receipt->count();

        //insert receipt_detail
        foreach ($json["receipt_details"] as $key => $value) {
            receipt_detail::create([
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
        $original_json = new original_json();
        $original_json->JSON_data = $content;
        $original_json->receipt_id = $receipt_id;
        $original_json->save();

        $receipt = receipt::find($receipt_id)
            ->update([
                'original_JSON_id' => $original_json->count()
            ]);

        Log::info('post receipt id:'.$receipt_id.
                    ' company id:'.$request->input('company_id').
                    ' branch id:'.$request->input('branch_id').
                    ' terminal id:'.$request->input('terminal_id'));

        return response()->json([
            'status' => 0,
            'receipt_id' => $receipt_id
        ],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(request $request)
    {
        //
        $receipt = receipt::where('company_id', '=', $request->input('company_id'))
            ->where('branch_id', '=', $request->input('branch_id'))
            ->where('terminal_id', '=', $request->input('terminal_id'))
            ->where('original_receipt_id', '=', $request->input('original_receipt_id'))
            ->first();

        if (empty($receipt)) {
            $receipt_json = [
                'status' => 500,
                'company_id' => $request->input('company_id'),
                'branch_id' => $request->input('branch_id'),
                'terminal_id' => $request->input('terminal_id'),
                'original_receipt_id' => $request->input('original_receipt_id')
            ];

            Log::info('GET ERROR company_id:'.$request->input('company_id').
                    ' branch_id:'.$request->input('branch_id').
                    ' terminal_id:'.$request->input('terminal_id').
                    ' original_receipt_id:'.$request->input('orijinal_receipt_id'));

            return response()->json($receipt_json);
        }
        $company = company::findOrFail($receipt->company_id);
        $receipt_json = [
            'status' => null,
            'receipt_id' => $receipt->id,
            'company_name' => $company->name,
            'total_tax' => $receipt->total_tax,
            'total_fee' => $receipt->total_fee,
            'detail_count' => null
        ];

        $detail_count = 0;
        $receipt_detail = receipt_detail::where($receipt->receipt_id)->get();
        $receipt_details_json = null;
        foreach ($receipt_detail as $key => $value) {
            $receipt_json['receipt_details'][$key] = [
                'no' => $value->id,
                'item_name' => $value->item_name,
                'unit_price' => $value->unit_price,
                'quantity' => $value->quantity,
                'tax' => $value->tax,
                'fee' => $value->fee,
                'item_1' => $value->item_1,
                'item_2' => $value->item_2,
                'item_3' => $value->item_3,
                'item_4' => $value->item_4,
                'item_5' => $value->item_5
            ];
            $detail_count++;
        }
        $receipt_json['status'] = 0;
        $receipt_json['detail_count'] = $detail_count;

        Log::info('GET receipt_id:'.$receipt->id);

        return response()->json($receipt_json);

    }

    /**
     * Show the form for editing the specified resource.0
     *
     * @param  request $reqest
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
