<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->insert([
            'account_id' => 1,
            'transaction_date' => '2021-03-10 12:37:27',
            'description' => 'Beli Pulsa',
            'transaction_type' => 'C',
            'amount' => 10000,
        ]);
    }
}
