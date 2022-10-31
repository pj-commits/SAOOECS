<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {        
        $this->call(UserSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(OrganizationSeeder::class);
        // $this->call(StaffSeeder::class);
        // $this->call(OrganizationUserSeeder::class);
        // $this->call(FormSeeder::class);
    }
}
