<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class statusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'name' => 'Yanıt Bekliyor',
        ]);

        DB::table('status')->insert([
            'name' => 'İşlemde',
        ]);

        DB::table('status')->insert([
            'name' => 'Kapalı',
        ]);

    }
}
