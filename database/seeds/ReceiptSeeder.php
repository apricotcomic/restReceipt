<?php

use Illuminate\Database\Seeder;
use App\company;
use App\receipt;
use App\receipt_detail;

class ReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(company::class, 10)->create()->each(function ($company) {
            factory(receipt::class, 20)->create(['company_id' => $company->id])->each(function ($receipt){
                factory(receipt_detail::class, 5)->create(['receipt_id' => $receipt->id]);
            });
        });
    }
}
