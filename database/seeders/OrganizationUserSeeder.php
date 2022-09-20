<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrganizationUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrganizationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orgusers = [
            [
                'user_id' => 6,
                'organization_id' => 1,
                'position'=>'President'
                
            ], 
            [
                'user_id' => 7,
                'organization_id' => 1,
                'position'=>'Secretary'
                
            ], 
            [
                'user_id' => 8,
                'organization_id' => 1,
                'position'=>'Member'
                
            ], 
            // [
            //     'user_id' => 12,
            //     'organization_id' => 2,
            //     'position'=>'President'
                
            // ], 
        ];

        DB::table('organization_user')->insert($orgusers);
    }
    
}
