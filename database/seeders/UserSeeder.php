<?php

namespace Database\Seeders;

use App\Models\User;
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
        // $config = Config::get('laratrust_seeder.roles_structure');

        // if ($config === null) {
        //     $this->command->error("The configuration has not been published. Did you run `php artisan vendor:publish --tag=\"laratrust-seeder\"`");
        //     $this->command->line('');
        //     return false;
        // }

        // foreach (array_slice($config, 4) as $key => $rolename ) {
        //     $this->command->info('Wait pre, gumagawa ng extra accounts para sa '. strtoupper($rolename));
        
        //     for($i = 1; $i < 3; $i++){
        //         DB::table('users')->insert(
        //             [
        //                 'firstName' => 'Sample',
        //                 'middleName' => null,
        //                 'lastName' => ucwords(str_replace('_', ' ', $rolename)).$i,
        //                 'phoneNumber' => '09123456789',
        //                 'email' => $rolename.$i.'@apc.edu.ph',
        //                 'password' => bcrypt('password')
        //             ]
        //         );
        //     }
        // }

        $users = [
            [
                'firstName' => 'Sample',
                'middleName' => null,
                'lastName' => 'Sao',
                'phoneNumber' => '09123456789',
                'userType' => 'Staff',
                'email' => 'sao@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            [
                'firstName' => 'Sample',
                'middleName' => null,
                'lastName' => 'Finance',
                'phoneNumber' => '09123456789',
                'userType' => 'Staff',
                'email' => 'finance@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            [
                'firstName' => 'Sample',
                'middleName' => null,
                'lastName' => 'AcadServ',
                'phoneNumber' => '09123456789',
                'userType' => 'Staff',
                'email' => 'acadserv@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            [
                'firstName' => 'Sample',
                'middleName' => null,
                'lastName' => 'Adviser',
                'phoneNumber' => '09123456789',
                'userType' => 'Professor',
                'email' => 'adviser@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            [
                'firstName' => 'Sample',
                'middleName' => null,
                'lastName' => 'President',
                'phoneNumber' => '09123456789',
                'userType' => 'Student',
                'email' => 'president@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            [
                'firstName' => 'Sample',
                'middleName' => null,
                'lastName' => 'Secretary',
                'phoneNumber' => '09123456789',
                'userType' => 'Student',
                'email' => 'secretary@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            [
                'firstName' => 'Sample',
                'middleName' => null,
                'lastName' => 'Member',
                'phoneNumber' => '09123456789',
                'userType' => 'Student',
                'email' => 'member@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
        ];

        foreach($users as $i){
            User::create($i);
        }
    }
    
}
