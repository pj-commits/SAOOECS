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
                'user_id' => 5,
                'organization_id' => 1,
                'position'=>'President',
                'role' => 'Moderator',
            ],
            [
                'user_id' => 4,
                'organization_id' => 1,
                'position'=>'Adviser',
                'role' => 'Editor',
            ],  
            [
                'user_id' => 6,
                'organization_id' => 1,
                'position'=>'Secretary',
                'role' => 'Editor',
            ], 
            [
                'user_id' => 7,
                'organization_id' => 1,
                'position'=>'Member',
                'role' => 'Viewer',
            ], 
            [
                'user_id' => 7,
                'organization_id' => 2,
                'position'=>'President',
                'role' => 'Moderator',
            ], 
            [
                'user_id' => 1,
                'organization_id' => 2,
                'position'=>'Adviser',
                'role' => 'Moderator',
            ], 
        ];

        DB::table('organization_user')->insert($orgusers);
    }
    
}
