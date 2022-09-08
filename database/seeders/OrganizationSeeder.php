<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;
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
        $organizations = [
            [
                'orgName' => 'Sample Org 1'
                
            ], 
        ];
        

        foreach($organizations as $i){
            Organization::create($i);
        }

      

        

    }
   
    
}
