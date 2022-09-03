<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $config = Config::get('laratrust_seeder.roles_structure');
        
        // User::create([
        //     'name' => 'Sample Saohead',
        //     'email' => 'samplesaohead@apc.edu.ph',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('samplesaohead')
        // ])->attachRole('guest');

        // // $user = User::create([
        // //     'name' => 'Sample President',
        // //     'email' => 'samplepresident@student.apc.edu.ph',
        // //     'email_verified_at' => now(),
        // //     'password' => bcrypt('samplepresident')
        // // ]);
        // // $user->attachRole('pres');
    }
}
