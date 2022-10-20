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
        //                 'first_name' => 'Sample',
        //                 'middle_name' => null,
        //                 'last_name' => ucwords(str_replace('_', ' ', $rolename)).$i,
        //                 'phone_number' => '09123456789',
        //                 'email' => $rolename.$i.'@apc.edu.ph',
        //                 'password' => bcrypt('password')
        //             ]
        //         );
        //     }
        // }

        $users = [
            //1
            [
                'first_name' => 'Sample',
                'middle_name' => null,
                'last_name' => 'Sao',
                'phone_number' => '09123456789',
                'user_type' => 'Staff',
                'email' => 'sao@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //2
            [
                'first_name' => 'Sample',
                'middle_name' => null,
                'last_name' => 'Finance',
                'phone_number' => '09123456789',
                'user_type' => 'Staff',
                'email' => 'finance@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //3
            [
                'first_name' => 'Sample',
                'middle_name' => null,
                'last_name' => 'AcadServ',
                'phone_number' => '09123456789',
                'user_type' => 'Staff',
                'email' => 'acadserv@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //4
            [
                'first_name' => 'Sample',
                'middle_name' => null,
                'last_name' => 'Adviser',
                'phone_number' => '09123456789',
                'user_type' => 'Professor',
                'email' => 'adviser@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //5
            [
                'first_name' => 'Sample',
                'middle_name' => null,
                'last_name' => 'President',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'president@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //6
            [
                'first_name' => 'Sample',
                'middle_name' => null,
                'last_name' => 'Vice-President',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'vice@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //7
            [
                'first_name' => 'Morganica',
                'middle_name' => 'Scanlan',
                'last_name' => 'Bounde',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'msbounde@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //8
            [
                'first_name' => 'Ellswerth',
                'middle_name' => 'Kinkaid',
                'last_name' => 'Pieche',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'ekpieche@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //9
            [
                'first_name' => 'Janice',
                'middle_name' => 'Stables',
                'last_name' => 'Baden',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'jsbaden@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //10
            [
                'first_name' => 'Mark',
                'middle_name' => 'Ludmann',
                'last_name' => 'Kittman',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'mlkittman@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //11
            [
                'first_name' => 'Cairistiona',
                'middle_name' => 'Kayser',
                'last_name' => 'Fellgatt',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'ckfellgatt@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //12
            [
                'first_name' => 'Sydney',
                'middle_name' => 'Yegorovnin',
                'last_name' => 'Vynall',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'syvynall@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //13
            [
                'first_name' => 'Gregorio',
                'middle_name' => 'Geake',
                'last_name' => 'Branthwaite',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'ggbranthwaite@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //14
            [
                'first_name' => 'Dyann',
                'middle_name' => 'Durgan',
                'last_name' => 'Enser',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'ddenser@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //15
            [
                'first_name' => 'Gale',
                'middle_name' => 'Appleby',
                'last_name' => 'Cheyenne',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'gacheyenne@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //16
            [
                'first_name' => 'Gale',
                'middle_name' => 'Origan',
                'last_name' => 'Marrion',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'gomarrion@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //17
            [
                'first_name' => 'Marc Kenneth',
                'middle_name' => 'Elfa',
                'last_name' => 'Ricahuerta',
                'phone_number' => '09123456789',
                'user_type' => 'Professor',
                'email' => 'mericahuerta@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //18
            [
                'first_name' => 'Paul John',
                'middle_name' => 'Deluna',
                'last_name' => 'Signo',
                'phone_number' => '09123456789',
                'user_type' => 'Professor',
                'email' => 'pdsigno@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //19
            [
                'first_name' => 'Michelle',
                'middle_name' => 'Montales',
                'last_name' => 'Manadero',
                'phone_number' => '09123456789',
                'user_type' => 'Professor',
                'email' => 'mmmanadero@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //20
            [
                'first_name' => 'Louise Gerard',
                'middle_name' => 'Martinez',
                'last_name' => 'Binotapa',
                'phone_number' => '09123456789',
                'user_type' => 'Professor',
                'email' => 'lmbinotapa@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //21
            [
                'first_name' => 'Therese Nicole',
                'middle_name' => 'Conception',
                'last_name' => 'Yumul',
                'phone_number' => '09123456789',
                'user_type' => 'Professor',
                'email' => 'tcyumul@apc.edu.ph',
                'password' => bcrypt('password')
            ],
        ];

        foreach($users as $i){
            User::create($i);
        }
    }
    
}
