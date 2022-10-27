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

        /* 
            |========================================
            |
            | Users 5 - 9 : Brewing Minds Officers
            |
            | Users 10 : Adviser
            |
            | Users 11 - 19 : Dummy Stundents
            |
            |========================================        
        */
 
        $users = [
            //1 - Sao Head
            [
                'first_name' => 'Sample',
                'middle_name' => null,
                'last_name' => 'Sao',
                'phone_number' => '09123456789',
                'user_type' => 'Staff',
                'email' => 'sao@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //2 - Finance Head
            [
                'first_name' => 'Sample',
                'middle_name' => null,
                'last_name' => 'Finance',
                'phone_number' => '09123456789',
                'user_type' => 'Staff',
                'email' => 'finance@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //3 - AcadServ
            [
                'first_name' => 'Sample',
                'middle_name' => null,
                'last_name' => 'AcadServ',
                'phone_number' => '09123456789',
                'user_type' => 'Staff',
                'email' => 'acadserv@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //4 - Adviser
            [
                'first_name' => 'Sample',
                'middle_name' => null,
                'last_name' => 'Adviser',
                'phone_number' => '09123456789',
                'user_type' => 'Professor',
                'email' => 'adviser@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //5 - Brewing Minds President
            [
                'first_name' => 'Michelle',
                'middle_name' => 'Montales',
                'last_name' => 'Manadero',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'mmmanadero@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //6 Brewing Minds Vice-President
            [
                'first_name' => 'Paul John',
                'middle_name' => 'Deluna',
                'last_name' => 'Signo',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'pdsigno@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //7 Brewing Minds - Secretary
            [
                'first_name' => 'Marc Kenneth',
                'middle_name' => 'Elfa',
                'last_name' => 'Ricahuerta',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'mericahuerta@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //8 Brewing Minds - Treasurer
            [
                'first_name' => 'Louise Gerard',
                'middle_name' => 'Martinez',
                'last_name' => 'Binotapa',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'lmbinotapa@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //9 Brewing Minds - Auditor
            [
                'first_name' => 'Therese Nicole',
                'middle_name' => 'Conception',
                'last_name' => 'Yumul',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'tcyumul@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //10 Adviser
            [
                'first_name' => 'Morganica',
                'middle_name' => 'Scanlan',
                'last_name' => 'Bounde',
                'phone_number' => '09123456789',
                'user_type' => 'Professor',
                'email' => 'msbounde@apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //11
            [
                'first_name' => 'Ellswerth',
                'middle_name' => 'Kinkaid',
                'last_name' => 'Pieche',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'ekpieche@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //12
            [
                'first_name' => 'Janice',
                'middle_name' => 'Stables',
                'last_name' => 'Baden',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'jsbaden@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //13
            [
                'first_name' => 'Mark',
                'middle_name' => 'Ludmann',
                'last_name' => 'Kittman',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'mlkittman@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //14
            [
                'first_name' => 'Cairistiona',
                'middle_name' => 'Kayser',
                'last_name' => 'Fellgatt',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'ckfellgatt@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //15
            [
                'first_name' => 'Sydney',
                'middle_name' => 'Yegorovnin',
                'last_name' => 'Vynall',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'syvynall@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //16
            [
                'first_name' => 'Gregorio',
                'middle_name' => 'Geake',
                'last_name' => 'Branthwaite',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'ggbranthwaite@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //17
            [
                'first_name' => 'Dyann',
                'middle_name' => 'Durgan',
                'last_name' => 'Enser',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'ddenser@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //18
            [
                'first_name' => 'Gale',
                'middle_name' => 'Appleby',
                'last_name' => 'Cheyenne',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'gacheyenne@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //19
            [
                'first_name' => 'Gale',
                'middle_name' => 'Origan',
                'last_name' => 'Marrion',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'gomarrion@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //20
            [
                'first_name' => 'Maxy',
                'middle_name' => 'Fairhall',
                'last_name' => 'Boobyer',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'mfboobyer@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //21
            [
                'first_name' => 'Obediah',
                'middle_name' => 'Gottelier',
                'last_name' => 'Faircliff',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'ogfaircliff@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //22
            [
                'first_name' => 'Harriott',
                'middle_name' => 'Dehn',
                'last_name' => 'Nyland',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'hdnyland@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //23
            [
                'first_name' => 'Jobye',
                'middle_name' => 'Cruces',
                'last_name' => 'Gibby',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'jcgibby@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //24
            [
                'first_name' => 'Coleman',
                'middle_name' => 'Scase',
                'last_name' => 'Jessop',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'csjessop@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            //25
            [
                'first_name' => 'Wally',
                'middle_name' => 'Lowry',
                'last_name' => 'Cragoe',
                'phone_number' => '09123456789',
                'user_type' => 'Student',
                'email' => 'wlcragoe@student.apc.edu.ph',
                'password' => bcrypt('password')
            ],
            [
            //26 - Codeseekers Adviser
                'first_name' => 'Code',
                'middle_name' => 'xtianpogi',
                'last_name' => 'Seekers',
                'phone_number' => '09456643543',
                'user_type' => 'Professor',
                'email' => 'codeseekers@apc.edu.ph',
                'password' => bcrypt('xtianpogi')
            ],
            //27 - Codeseekers President
            [
                'first_name' => 'Christian Paul',
                'middle_name' => null,
                'last_name' => 'Pili',
                'phone_number' => '09363378264',
                'user_type' => 'Student',
                'email' => 'cbpili@student.apc.edu.ph',
                'password' => bcrypt('xtianpogi')
            ],

        ];

        foreach($users as $i){
            User::create($i);
        }
    }
    
}
