<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tarifs = [
          ['name' => 'Газ', 'price' => 7.96, 'unit' => 'кубометр'],
          ['name' => 'Электоэнергия', 'price' => 4.32, 'unit' => 'кВт.ч'],
          ['name' => 'Холодная вода', 'price' => 30.38, 'unit' => 'кубометр'],
          ['name' => 'Горячая вода', 'price' => 80.62, 'unit' => 'кубометр'],
        ];
        DB::table('tarifs')->insert($tarifs);
    }
}
