<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DataUpdateHistory;
use Illuminate\Support\Facades\DB;

class DataUpdateHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_update_history')->insert([
            'created_at' => '2021-05-01 00:00:00',
            'updated_at' => '2021-05-01 00:00:00',
        ]);
    }
}
