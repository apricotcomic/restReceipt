<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\company;
use Illuminate\Support\Facades\Log;


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
            'branch_id' => 'a-0001_1',
            'terminal_id' => '1-1-557',
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
        $company = DB::table('company')
                    ->select('id')
                    ->orderBy('id','DESC')
                    ->first();
        $company_id = $company->id;
        \App\Receipt::create([
            'company_id' => $company_id,
            'branch_id' => 'a-0001_2',
            'terminal_id' => 'trm555',
            'original_receipt_id' => '12345',
            'total_tax' => 100,
            'total_fee' => 1000,
            'original_JSON_id' => 0
        ]);
        $receipt = DB::table('receipt')
                    ->orderByRaw('id','DESC')
                    ->first();
        $receipt_id = $receipt->id;
        \App\Receipt_detail::create([
            'receipt_id' => $receipt_id,
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
            'receipt_id' => $receipt_id,
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
        // inputデータ
        $showdata = [
            'company_id' => $company_id,
            'branch_id' => 'a-0001_2',
            'terminal_id' => 'trm555',
            'original_receipt_id' => '12345'
        ];
        //　テスト
        $response = $this->get(route('receipt.show',$showdata));

        $response->assertStatus(200)
        ->assertJsonFragment([
            'status' => 0,
            'receipt_id' => $receipt_id
        ]);
    }

    //
    // edit test
    //
    public function testEdit()
    {
        //データ仕込み
        $company = \App\Company::create([
            'name' => 'Test corp'
        ]);
        $company_id = $company->id;

        $receipt = \App\Receipt::create([
            'company_id' => $company_id,
            'branch_id' => 'a-0001_3',
            'terminal_id' => 'tm111',
            'original_receipt_id' => '123',
            'total_tax' => 100,
            'total_fee' => 1000,
            'original_JSON_id' => 0
        ]);
        $receipt_id = $receipt->id;

        log::debug('receipt id:'.$receipt_id);

        \App\Receipt_detail::create([
            'receipt_id' => $receipt_id,
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
            'receipt_id' => $receipt_id,
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

        $json_data = [
            'company_id' => $company_id,
            'branch_id' => 'a-0001_3',
            'terminal_id' => 'tm111',
            'original_receipt_id' => '123',
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

        $json = json_encode($json_data);

        \App\original_json::create([
            'JSON_data' => $json,
            'receipt_id' => $receipt_id
        ]);

        //JSONデータ作成
        $data = [
            'company_id' => $company_id,
            'branch_id' => 'a-0001_3',
            'terminal_id' => 'tm111',
            'original_receipt_id' => '123',
            'total_tax' => '100',
            'total_fee' => '1000',
            'receipt_details' => [[
                'no' => '1',
                'item_name' => 'product-x',
                'unit_price' => '500',
                'quantity' => '2',
                'tax' => '10',
                'fee' => '100',
                'item_1' => '',
                'item_2' => '',
                'item_3' => '',
                'item_4' => '',
                'item_5' => ''
                ],
                ['no' => '2',
                'item_name' => 'product-y',
                'unit_price' => '889900',
                'quantity' => '1',
                'tax' => '7700',
                'fee' => '77000',
                'item_1' => 'zzz',
                'item_2' => 'yyy',
                'item_3' => 'xxx',
                'item_4' => 'www',
                'item_5' => 'vvv'
                ]]
            ];

        $response = $this->putjson(route('receipt.update'),$data);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'status' => 0,
                'receipt_id' => $receipt_id
            ]);
    }

    public function testcretify()
    {
        //データ仕込み
        \App\Company::create([
            'name' => 'Test corp'
        ]);
        $company = DB::table('company')
                    ->select('id')
                    ->orderBy('id','DESC')
                    ->first();
        $company_id = $company->id;
        \App\Receipt::create([
            'company_id' => $company_id,
            'branch_id' => 'a-0001_2',
            'terminal_id' => 'trm555',
            'original_receipt_id' => '12345',
            'total_tax' => 100,
            'total_fee' => 1000,
            'original_JSON_id' => 0
        ]);
        $receipt = DB::table('receipt')
                    ->orderByRaw('id','DESC')
                    ->first();
        $receipt_id = $receipt->id;
        \App\Receipt_detail::create([
            'receipt_id' => $receipt_id,
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
            'receipt_id' => $receipt_id,
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
        // inputデータ
        $showdata = [
            'company_id' => $company_id,
            'branch_id' => 'a-0001_2',
            'terminal_id' => 'trm555',
            'original_receipt_id' => '12345'
        ];
        //　テスト
        $response = $this->get(route('receipt.certify',$showdata));

        $response->assertStatus(200)
        ->assertJsonFragment([
            'status' => 0,
            'receipt_id' => $receipt_id
        ]);
    }

    //
    // destory test
    //
    public function testdestroy()
    {
        //データ仕込み
        $company = \App\Company::create([
            'name' => 'Test corp'
        ]);
        $company_id = $company->id;

        $receipt = \App\Receipt::create([
            'company_id' => $company_id,
            'branch_id' => 'del-01',
            'terminal_id' => 'del-trm-01',
            'original_receipt_id' => '12345',
            'total_tax' => 100,
            'total_fee' => 1000,
            'original_JSON_id' => 0
        ]);
        $receipt_id = $receipt->id;

        \App\Receipt_detail::create([
            'receipt_id' => $receipt_id,
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
            'receipt_id' => $receipt_id,
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
        // inputデータ
        $deletedata = [
            'company_id' => $company_id,
            'branch_id' => 'del-01',
            'terminal_id' => 'del-trm-01',
            'original_receipt_id' => '12345'
        ];
        //　テスト
        $response = $this->deletejson(route('receipt.destroy',$deletedata));

        $response->assertStatus(200)
            ->assertExactJson([
                'status' => 0,
                'receipt_id' => $receipt_id
            ]);
    }

    //
    // Exsists Company id
    //
    public function testexists_company_id()
    {
        //JSONデータ作成
        $data = [
            'company_id' => '99999',
            'branch_id' => 'a-0001_1',
            'terminal_id' => '1-1-557',
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

        $response->assertStatus(400)
            ->assertJsonFragment([
                'status' => 400,
            ]);
    }

    public function testalphadash_branch_id()
    {
        //JSONデータ作成
        $data = [
            'company_id' => '99999',
            'branch_id' => '$$$',
            'terminal_id' => '1-1-557',
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

        $response->assertStatus(400)
            ->assertJsonFragment([
                'status' => 400,
            ]);
    }

    public function testnumeric_total_tax()
    {
        //JSONデータ作成
        $data = [
            'company_id' => '1',
            'branch_id' => 'a-0001_1',
            'terminal_id' => '1-1-557',
            'original_receipt_id' => '0000001',
            'total_tax' => '10z',
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

        $response->assertStatus(400)
            ->assertJsonFragment([
                'status' => 400,
            ]);
    }

    public function testnumeric_total_fee()
    {
        //JSONデータ作成
        $data = [
            'company_id' => '1',
            'branch_id' => 'a-0001_1',
            'terminal_id' => '1-1-557',
            'original_receipt_id' => '0000001',
            'total_tax' => '100',
            'total_fee' => 'a000',
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

        $response->assertStatus(400)
            ->assertJsonFragment([
                'status' => 400,
            ]);
    }

    public function testnumeric_no()
    {
        //JSONデータ作成
        $data = [
            'company_id' => '1',
            'branch_id' => 'a-0001_1',
            'terminal_id' => '1-1-557',
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
                ['no' => 'k',
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

        $response->assertStatus(400)
            ->assertJsonFragment([
                'status' => 400,
            ]);
    }

    public function testdistinct_no()
    {
        //JSONデータ作成
        $data = [
            'company_id' => '1',
            'branch_id' => 'a-0001_1',
            'terminal_id' => '1-1-557',
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
                ['no' => '1',
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

        $response->assertStatus(400)
            ->assertJsonFragment([
                'status' => 400,
            ]);
    }

    public function testnumeric_unit_price()
    {
        //JSONデータ作成
        $data = [
            'company_id' => '1',
            'branch_id' => 'a-0001_1',
            'terminal_id' => '1-1-557',
            'original_receipt_id' => '0000001',
            'total_tax' => '100',
            'total_fee' => '1000',
            'receipt_details' => [[
                'no' => '1',
                'item_name' => 'product-1',
                'unit_price' => '200i',
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

        $response->assertStatus(400)
            ->assertJsonFragment([
                'status' => 400,
            ]);
    }

    public function testnumeric_quantity()
    {
        //JSONデータ作成
        $data = [
            'company_id' => '1',
            'branch_id' => 'a-0001_1',
            'terminal_id' => '1-1-557',
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
                'quantity' => 'p',
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

        $response->assertStatus(400)
            ->assertJsonFragment([
                'status' => 400,
            ]);
    }

    public function testnumeric_tax()
    {
        //JSONデータ作成
        $data = [
            'company_id' => '1',
            'branch_id' => 'a-0001_1',
            'terminal_id' => '1-1-557',
            'original_receipt_id' => '0000001',
            'total_tax' => '100',
            'total_fee' => '1000',
            'receipt_details' => [[
                'no' => '1',
                'item_name' => 'product-1',
                'unit_price' => '200',
                'quantity' => '1',
                'tax' => 'qq',
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

        $response->assertStatus(400)
            ->assertJsonFragment([
                'status' => 400,
            ]);
    }

    public function testnumeric_fee()
    {
        //JSONデータ作成
        $data = [
            'company_id' => '1',
            'branch_id' => 'a-0001_1',
            'terminal_id' => '1-1-557',
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
                'fee' => 'zzzzzzz',
                'item_1' => 'A',
                'item_2' => 'B',
                'item_3' => 'C',
                'item_4' => 'D',
                'item_5' => 'E'
                ]]
            ];
        $response = $this->postjson(route('receipt.store'),$data);

        $response->assertStatus(400)
            ->assertJsonFragment([
                'status' => 400,
            ]);
    }

    public function tearDown():void
    {
        Artisan::call('migrate:refresh');
        parent::tearDown();
    }
}
