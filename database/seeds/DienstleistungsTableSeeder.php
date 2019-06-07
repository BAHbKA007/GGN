<?php

use Illuminate\Database\Seeder;

class DienstleistungsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = base_path('database/seeds/dienstleistung.sql');

        //collect contents and pass to DB::unprepared
        DB::unprepared(file_get_contents($sql));
    }
}
