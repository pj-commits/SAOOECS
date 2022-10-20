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
            //1
            [
                'firstName' => 'Sample',
                'middleName' => null,
                'lastName' => 'Sao',
                'phoneNumber' => '09123456789',
                'userType' => 'Staff',
                'email' => 'sao@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //2
            [
                'firstName' => 'Sample',
                'middleName' => null,
                'lastName' => 'Finance',
                'phoneNumber' => '09123456789',
                'userType' => 'Staff',
                'email' => 'finance@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //3
            [
                'firstName' => 'Sample',
                'middleName' => null,
                'lastName' => 'AcadServ',
                'phoneNumber' => '09123456789',
                'userType' => 'Staff',
                'email' => 'acadserv@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //4
            [
                'firstName' => 'Sample',
                'middleName' => null,
                'lastName' => 'Adviser',
                'phoneNumber' => '09123456789',
                'userType' => 'Professor',
                'email' => 'adviser@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //5
            [
                'firstName' => 'Sample',
                'middleName' => null,
                'lastName' => 'President',
                'phoneNumber' => '09123456789',
                'userType' => 'Student',
                'email' => 'president@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //6
            [
                'firstName' => 'Sample',
                'middleName' => null,
                'lastName' => 'Vice-President',
                'phoneNumber' => '09123456789',
                'userType' => 'Student',
                'email' => 'vice@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //7
            [
                'firstName' => 'Morganica',
                'middleName' => 'Scanlan',
                'lastName' => 'Bounde',
                'phoneNumber' => '09123456789',
                'userType' => 'Student',
                'email' => 'msbounde@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //8
            [
                'firstName' => 'Ellswerth',
                'middleName' => 'Kinkaid',
                'lastName' => 'Pieche',
                'phoneNumber' => '09123456789',
                'userType' => 'Student',
                'email' => 'ekpieche@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //9
            [
                'firstName' => 'Janice',
                'middleName' => 'Stables',
                'lastName' => 'Baden',
                'phoneNumber' => '09123456789',
                'userType' => 'Student',
                'email' => 'jsbaden@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //10
            [
                'firstName' => 'Mark',
                'middleName' => 'Ludmann',
                'lastName' => 'Kittman',
                'phoneNumber' => '09123456789',
                'userType' => 'Student',
                'email' => 'mlkittman@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //11
            [
                'firstName' => 'Cairistiona',
                'middleName' => 'Kayser',
                'lastName' => 'Fellgatt',
                'phoneNumber' => '09123456789',
                'userType' => 'Student',
                'email' => 'ckfellgatt@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //12
            [
                'firstName' => 'Sydney',
                'middleName' => 'Yegorovnin',
                'lastName' => 'Vynall',
                'phoneNumber' => '09123456789',
                'userType' => 'Student',
                'email' => 'syvynall@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //13
            [
                'firstName' => 'Gregorio',
                'middleName' => 'Geake',
                'lastName' => 'Branthwaite',
                'phoneNumber' => '09123456789',
                'userType' => 'Student',
                'email' => 'ggbranthwaite@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //14
            [
                'firstName' => 'Dyann',
                'middleName' => 'Durgan',
                'lastName' => 'Enser',
                'phoneNumber' => '09123456789',
                'userType' => 'Student',
                'email' => 'ddenser@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //15
            [
                'firstName' => 'Gale',
                'middleName' => 'Appleby',
                'lastName' => 'Cheyenne',
                'phoneNumber' => '09123456789',
                'userType' => 'Student',
                'email' => 'gacheyenne@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //16
            [
                'firstName' => 'Gale',
                'middleName' => 'Origan',
                'lastName' => 'Marrion',
                'phoneNumber' => '09123456789',
                'userType' => 'Student',
                'email' => 'gomarrion@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //17
            [
                'firstName' => 'Marc Kenneth',
                'middleName' => 'Elfa',
                'lastName' => 'Ricahuerta',
                'phoneNumber' => '09123456789',
                'userType' => 'Professor',
                'email' => 'mericahuerta@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //18
            [
                'firstName' => 'Paul John',
                'middleName' => 'Deluna',
                'lastName' => 'Signo',
                'phoneNumber' => '09123456789',
                'userType' => 'Professor',
                'email' => 'pdsigno@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //19
            [
                'firstName' => 'Michelle',
                'middleName' => 'Montales',
                'lastName' => 'Manadero',
                'phoneNumber' => '09123456789',
                'userType' => 'Professor',
                'email' => 'mmmanadero@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //20
            [
                'firstName' => 'Louise Gerard',
                'middleName' => 'Martinez',
                'lastName' => 'Binotapa',
                'phoneNumber' => '09123456789',
                'userType' => 'Professor',
                'email' => 'lmbinotapa@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //21
            [
                'firstName' => 'Therese Nicole',
                'middleName' => 'Conception',
                'lastName' => 'Yumul',
                'phoneNumber' => '09123456789',
                'userType' => 'Professor',
                'email' => 'tcyumul@apc.edu.ph',
                'password' => bcrypt('password')
            ],
        ];

        foreach($users as $i){
            User::create($i);
        }
    }
    
}
