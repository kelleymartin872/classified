<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Maye Jacob',
            'role_id' => '1',
            'email' => 'admin@mayeconcept.com.ng',
            'password' => bcrypt('12345678'),
        ]);
        DB::table('users')->insert([
            'name' => 'Jayboss',
            'role_id' => '2',
            'email' => 'mayejacob3@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
