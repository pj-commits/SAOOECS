<?php

namespace Database\Seeders;

use App\Models\Organization;
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

        $organizations = [
            [
                'org_name' => 'Brewing Minds',
                'adviser' => 'Sample Adviser'
            ],
            [
                'org_name' => 'Tricky Tech',
                'adviser' => 'Sample Sao'
            ],
        ];

        foreach($organizations as $i){
            Organization::create($i);
        }
    }
   
    
}
