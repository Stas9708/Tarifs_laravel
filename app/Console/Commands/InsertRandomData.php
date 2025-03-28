<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InsertRandomData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:insert-data {count=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert random data in records table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = (int) $this->argument('count');

        for ($i = 0; $i < $count; $i++) {
            DB::table('records')->insert([
                'tarif_id' => rand(1, 4),
                'price' => round(mt_rand(10, 1000), 2),
                'unit_points' => round(mt_rand(10, 1000) , 2),
            ]);
        }

        $this->info("Успішно вставлено {$count} записів у таблицю records.");
    }
}
