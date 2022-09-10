<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
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
        $config = Config::get('laratrust_seeder.roles_structure');

        if ($config === null) {
            $this->command->error("The configuration has not been published. Did you run `php artisan vendor:publish --tag=\"laratrust-seeder\"`");
            $this->command->line('');
            return false;
        }

        foreach (array_slice($config, 4) as $key => $rolename ) {
            $this->command->info('Wait pre, gumagawa ng extra accounts para sa '. strtoupper($rolename));
        
        for($i = 1; $i < 3; $i++){
            DB::table('users')->insert(
                [
                    'firstName' => 'Sample',
                    'middleName' => null,
                    'lastName' => ucwords(str_replace('_', ' ', $rolename)).$i,
                    'phoneNumber' => '09123456789',
                    'email' => $rolename.$i.'@apc.edu.ph',
                    'password' => bcrypt('password')
                ]
            );
        }
    }

        
    }
    
}
