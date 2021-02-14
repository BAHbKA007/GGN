<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(RolesTableSeeder::class);
        // $this->call(GgnsTableSeeder::class);
        // $this->call(ArtikelsTableSeeder::class);
        // $this->call(KundesTableSeeder::class);
        // $this->call(SettingTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Johann Schneider',
            'email' => 'j.schneider@gemuesering.de',
            'password' => '$2y$10$pnWpk6//tWQ7jJ2I4KZ2JOh0RRIi.7YARGqfkg1wkyA9FBNtdKPnO',
        ]);
    }
}
