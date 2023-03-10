<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('points')->insert([
            [
                'account_id' => 1,
                'point' => 100,
            ],
            [
                'account_id' => 2,
                'point' => 200,
            ]
        ]);
    }
}
