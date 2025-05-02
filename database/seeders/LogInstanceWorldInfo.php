<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogInstanceWorldInfo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('log')->unprepared(
            file_get_contents('database/seeders/_LogInstanceWorldInfo.sql'),
            file_get_contents('database/seeders/_AddLogInstanceWorldInfo.sql')
        );
    }
}
