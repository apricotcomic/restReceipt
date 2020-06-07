<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReceiptControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStore()
    {
        // companyテーブルにデータを仕込む
        \App\Company::create([
            'name' => 'Test corp'
        ]);

        //JSONデータ作成
        $data = [
            'company_id' => '1',
            'register_id' => '1-1-557',
            'original_receipt_id' => '0000001',
            'total_tax' => '100',
            'total_fee' => '1000',
            'receipt_details' => [[
                'no' => '1',
                'item_name' => 'product-1',
                'unit_price' => '200',
                'quantity' => '1',
                'tax' => '20',
                'fee' => '200',
                'item_1' => '',
                'item_2' => '',
                'item_3' => '',
                'item_4' => '',
                'item_5' => ''
                ],
                ['no' => '2',
                'item_name' => 'product-2',
                'unit_price' => '1234567',
                'quantity' => '1',
                'tax' => '12345',
                'fee' => '1234567',
                'item_1' => 'A',
                'item_2' => 'B',
                'item_3' => 'C',
                'item_4' => 'D',
                'item_5' => 'E'
                ]]
            ];

        $response = $this->postjson(route('receipt.store'),$data);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'status' => 0,
                'receipt_id' => 1
            ]);
    }

    public function testShow()
    {
        //データ仕込み
        \App\Company::create([
            'name' => 'Test corp'
        ]);
        $company = \App\Company::all();
        $company_id = $company->count();
        \App\Receipt::create([
            'company_id' => $company_id,
            'register_id' => '',
            'original_receipt_id' => '',
            'total_tax' => 100,
            'total_fee' => 1000,
            'original_JSON_id' => 0
        ]);
        \App\Receipt_detail::create([
            'receipt_id' => 2,
            'line_no' => 1,
            'item_name' => 'product-1',
            'unit_price' => 200,
            'quantity' => 1,
            'tax' => 20,
            'fee' => 200,
            'item_1' => '',
            'item_2' => '',
            'item_3' => '',
            'item_4' => '',
            'item_5' => ''
        ]);
        \App\Receipt_detail::create([
            'receipt_id' => 2,
            'line_no' => 2,
            'item_name' => 'product-2',
            'unit_price' => 1234567,
            'quantity' => 1,
            'tax' => 12345,
            'fee' => 1234567,
            'item_1' => 'A',
            'item_2' => 'B',
            'item_3' => 'C',
            'item_4' => 'D',
            'item_5' => 'E'
        ]);

        $response = $this->get(route('receipt.show',['receipt' => 2]));

        $response->assertStatus(404)
            ->assertJson([
                'status' => 0,
                'receipt_id' => 2,
                'company_name' => 'Test corp',
                'total_tax' => 100,
                'total_fee' => 1000,
                'receipt_details' => [[
                    'no' => 1,
                    'item_name' => 'product-1',
                    'unit_price' => 200,
                    'quantity' => 1,
                    'tax' => 20,
                    'fee' => 200,
                    'item_1' => '',
                    'item_2' => '',
                    'item_3' => '',
                    'item_4' => '',
                    'item_5' => ''
                    ],
                    ['no' => 2,
                    'item_name' => 'product-2',
                    'unit_price' => 1234567,
                    'quantity' => 1,
                    'tax' => 12345,
                    'fee' => 1234567,
                    'item_1' => 'A',
                    'item_2' => 'B',
                    'item_3' => 'C',
                    'item_4' => 'D',
                    'item_5' => 'E'
                    ]
                ]
            ]);
    }
}
