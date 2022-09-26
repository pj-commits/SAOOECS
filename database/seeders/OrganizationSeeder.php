<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // for($i = 1; $i < 3; $i++){
        //     DB::table('organizations')->insert(
        //         [
        //             'orgName' => 'Sample Org '.$i
        //         ]
        //     );
        
        // }

        DB::table('organizations')->insert(
            [
                'orgName' => 'Brewing Minds',
            ]
        );
    }
   
    
}
